
function accept(id) {
    $.post('server/api_layer.php',{
        kind:"accept_request",
        id:id
    },(res,status)=> {
        if (status=="success") {
            M.toast({html:"Accepted"});
            update_pending();
            update_participants();
        }
        else {
            M.toast({html:"Server Error"})
        }
    })
}
function reject(id) {
    $.post('server/api_layer.php',{
        kind:"decline_request",
        id:id
    },(res,status)=> {
        if (status=="success") {
            M.toast({html:"Rejected"});
            update_pending();
            update_participants();
        }
        else {
            M.toast({html:"Server Error"})
        }
    })
}

function template_row(u) {
    var r = $(`<tr> <td> <a href="user.php?user_id=${u["user_id"]}"> ${u["username"]} </a> </td> </tr>`);
    var d = $("<td></td>").append($('<a class="btn">Accept</a>').click(()=>{accept(u["user_id"])}));
    r.append(d)
    d = $("<td></td>").append($('<a class="btn" >Decline</a>').click(()=>{reject(u["user_id"])}));
    r.append(d)
    return r;
}

function update_pending() {
    $.post("server/api_layer.php",{
        kind: "pending_requests"
    },(res,status) => {
        console.log("aaa")
        if (status=="success") {
            res = JSON.parse(res);
            $("#pending").html("");
            if (res.length) {
                
                $("#pending").append($("<table><tr> <th> Pending Requests </th> <th> Action </th> <th> </th> </tr> </table>"))
                console.log(res)
                res.forEach((u) => {$("#pending table").append(template_row(u)) });
                $("#pending .dropdown-trigger").dropdown()
            }
            else {
                $("#pending").append($("<h5> No Pending Requests!!</h5>"))
            }
        }
        else {
            $("#pending").append($("<h5> No Pending Requests!!</h5>"))
        }
    })
}

$("document").ready(()=> {
    update_pending();

})