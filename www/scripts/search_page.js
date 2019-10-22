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

 

function get_events() {
    console.log("here")
    $.post('server/api_layer.php', {
        kind: "all_events"
    },(res,status)=> {
        res  = JSON.parse(res)
        res.forEach(e => {
            let el = $(`#${e["id"]}_event`)
            console.log(`#${e["id"]}_event`)
            el.find('.date_range').html(`${date_format(e["start"])} - ${date_format(e["start"])} `)
            // el.find(".owner").html("By "+e["owner_name"]).attr("href","user.php?user_id="+e["owner"])
            tags = e["tags"].split(',');
            tags.forEach(t=>{el.find('.tags').append(chip_gen(t))});
        });
    });
}

$(document).ready(function(){
    get_events();
})