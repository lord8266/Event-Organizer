
function template_row(u) {
    console.log(`<tr> <td> <a href="user.php?user_id=${u["user_id"]}"> ${u["username"]} </a> </tr>`)
    return $(`<tr> <td> <a href="user.php?user_id=${u["user_id"]}"> ${u["username"]} </a> </td> </tr>`).append($("<td> </td>").append($("<a></a>",{html: "Choose",href:"","data-id":u["user_id"]})) )         
}

$("document").ready(()=> {
    
    $.post("server/api_layer.php",{
        kind: "pending_requests"
    },(res,status) => {
        console.log("aaa")
        if (status=="success") {
            res = JSON.parse(res);
            if (res.length) {
                $("#pending").append($("<table><tr> <th> Pending Requests </th> <th> Action </th> </tr> </table>"))
                console.log(res)
                res.forEach((u) => {$("#pending table").append(template_row(u)) });
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