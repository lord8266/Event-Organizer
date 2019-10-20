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

function get_participants() {
    $.post("server/api_layer.php",{
        kind: "participants",
    },(res,status) => {
        if (status=="success") {
            res = JSON.parse(res)
            console.log(res)
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
                data["tags"].split("\n").forEach((t)=> { $("#tags").append(chip_gen(t)) } )
            $("#description").html(data["description"])
            if (data["paid"]) {
                $('#additional_details')
                .append($(`<table><tr><th>Description</th><th>Price</th></tr><tr><td>${data["description"]}</td><td>${data["price"]}</td></tr></table>`))
            }
            else {
                $('#additional_details')
                .append($(`<table><tr><th>Description</th></tr><tr><td>${data["description"]}</td></tr></table>`))
            }
            get_participants();

    })
       
       
    }
)