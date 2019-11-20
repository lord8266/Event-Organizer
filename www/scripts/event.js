var tabs;
var data;

function date_format(date) {
    return moment(date).format("DD MMM, YYYY")
}

function chip_gen(s) {
    return $(`<div></div>`, {
        "class": "chip waves-effect waves-light",
        "data-value":s,
        html:s
      });
}

function update_participants() {
    $.post("server/api_layer.php",{
        kind: "participants",
    },(res,status) => {
        if (status=="success") {
            res = JSON.parse(res)
            console.log(res)
            $("#participants").html("");
            if (res.length) {
                
                $("#participants").append($("<table> <tr> <th> Participants </th> </tr> </table>"))
                
                res.forEach((u) => {$("#participants table").append($("<tr></tr>").append($("<td></td>").append($("<a></a>",{html: u["username"],href: `user.php?user_id=${u["user_id"]}` })))) }  )
            }
            else {
                $("#participants").append($("<h5> No Participants Yet! </h5>"))
            }
        }
        else {
            $("#participants").append($("<h5> No Participants Yet! </h5>"))
        }
    } )
}

function request_join() {
    if ($("#request").data("access") ==-1) {
        $.post("server/api_layer.php",{
            kind: "request_join"
        },(res,status)=> {
            if (status=="success") {
                if (res==1) {
                    M.toast({html: "Successfully Sent Request"});
                    $("#request").html("Request Pending");
                }
                else {
                    M.toast({html: "Server Error!!"})
                }
            }
            else {
                M.toast({html: "Server Error"})
            }
        })
}

}
function check_request() {
    $.post("server/api_layer.php",{
        kind:"check_join"
    },(res,status) => {
        if (res==2) {
            $("#request").html("Edit").data("access",2)
        }
        else if (res==1) {
            $("#request").html("Leave Event").data("access",1)
        }
        else if (res==0) {
            $("#request").html("Request Pending").data("access",0)
        }
        else if(res==-1) {
            $("#request").html("Request").data("access",-1).click(request_join)
        }
    })
}
$(document).ready(
    function() {
       tabs =  M.Tabs.init($(".tabs"))
       $.post("server/api_layer.php",{
           kind: "event_details"
       },(res,status) => {
            data =JSON.parse(res);
            $("#from").html(date_format(data["start"]));
            $("#to").html(date_format(data["end"]))
            if (data["tags"])
                data["tags"].split(",").forEach((t)=> { $("#tags").append(chip_gen(t)) } )
                if (data["description"]=="") {
                    $("#description").html("No details given")
                }
                else {
                    $("#description").html(data["description"]);
                }
                if (data["location"]=="") {
                    $("#location").html("No details given")
                }
                else {
                    $("#location").html(data["location"]);
                }
                if(data['image_id']!="") {
                    $("#event_image").attr('src',"server/images/"+data["image_id"]);
                }
            
            if (data["paid"]) {
                $('#price')
                .append($(`<table><tr><th>Price</th></tr><tr><td>${data["price"]}</td></tr></table>`))
            }
            else {
                
            }
            console.log("hi")
            console.log(data.verified)
            if (data.verified==1)
                $("#verified").html('<span class="green-text"><i class="material-icons icon">check_circle</i>Verified</span>')
            else
                $("#verified").html('<span class="blue-text"><i class="material-icons icon">info_outline</i>Not Verified</span>')
            update_participants();
            check_request();

    })
       
       
    }
)