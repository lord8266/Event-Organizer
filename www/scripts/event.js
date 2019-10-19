var tabs;
var data;

function date_format(date) {
    return moment(date).format("d MMM, YYYY")
}

$(document).ready(
    function() {
       tabs =  M.Tabs.init($(".tabs"))
       $.post("server/api_layer.php",{
           kind: "event_details"
       },(res,status) => {
           data =JSON.parse(res);
           $("#from").html()
    })
       
       
    }
)