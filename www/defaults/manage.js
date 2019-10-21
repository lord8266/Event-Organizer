
function accept(id) {

}
function reject(id) {
    
}
// function drop_down(id) {
//     var d = $("<ul></ul>",{"class":"dropdown-content manage-dropdown","id":id});
//     d.append($("<li></li>").append($('<a href="">Accept</a>').click(()=>{accept(id)})));
//     d.append($("<li></li>").append($('<a href="">Reject</a>').click(()=>{reject(id)})));
//     return d;
// }

function template_row(u) {
    var r = $(`<tr> <td> <a href="user.php?user_id=${u["user_id"]}"> ${u["username"]} </a> </td> </tr>`);
    var d = $("<td></td>").append($('<a href="">Accept</a>').click(()=>{accept(id)}));
    r.append(d)
    d = $("<td></td>").append($('<a href="">Decline</a>').click(()=>{reject(id)}));
    r.append(d)
    return r;
}   

$("document").ready(()=> {
    
    $.post("server/api_layer.php",{
        kind: "pending_requests"
    },(res,status) => {
        console.log("aaa")
        if (status=="success") {
            res = JSON.parse(res);
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
})