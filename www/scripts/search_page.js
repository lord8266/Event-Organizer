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


var all_events;

function get_events() {
    console.log("here")
    $.post('server/api_layer.php', {
        kind: "all_events",
        query: $("#search_text").val()
    },(res,status)=> {
        res  = JSON.parse(res)
        all_events = res;
        if (res.length==0) {
            $("#events").html("<h5> Empty </h5>")
        }
        else {
        res.forEach(e => {
            let el = $(`#${e["id"]}_event`)
            console.log(`#${e["id"]}_event`)
            el.find('.date_range').html(`${date_format(e["start"])} - ${date_format(e["start"])} `)
            // el.find(".owner").html("By "+e["owner_name"]).attr("href","user.php?user_id="+e["owner"])
            tags = e["tags"].split(',');
            if (tags!="")
                tags.forEach(t=>{el.find('.tags').append(chip_gen(t))});
            
            if (e.verified==1)
                el.find("#verified").html('<span class="green-text"><i class="material-icons icon">check_circle</i>Verified</span>')
            else
                el.find("#verified").html('<span class="blue-text"><i class="material-icons icon">info_outline</i>Not Verified</span>')
            
            });
        }
});
    
}
var all_events_dropdown;

function update_list(s) {
    all = []
    let t = function(name,id) {return `<li><a href=event.php?event_id=${id}> ${name} </a></li>`}
    let p = function(s1,s2) {
        let f=0;
        for (let i=0;i<s2.length;i++) {
            if (s1.includes(s2[i])) {
                f+=1
            }
        }
        return f;
    } 
    let l = document.getElementById("dropdown_events")
    for (let i=0;i<all_events.length;i++) {
        if (all_events[i].name.includes(s)) {
            all.push([i,p(s,all_events[i].name)])
        }
    }
    all.sort(function(a, b){
        a = a[1]
        b =b[1]
        if(a < b) return -1;
        if(a > b) return 1;
        return 0;})
    next = ""
    for (let i=0;i<all.length;i++) {
        next+=t(all_events[all[i][0]].name,all_events[all[i][0]].id)
    }
    l.innerHTML = next;
    all_events_dropdown.recalculateDimensions()
}
$(document).ready(function(){
    get_events();
    document.getElementById("search_text").onkeydown = function (e) {
        if (e.key=="Enter") {
            if (this.value)
                window.location = "search_page.php?query="+this.value
        }
        else {
            if (!all_events_dropdown.isOpen)
                all_events_dropdown.open()
            }
        }
    
    document.getElementById("search_text").onkeyup = function() {
        if (this.value) {
            update_list(this.value)
        }
    }
    document.getElementById("search_text").onfocusout = function(e) {
        all_events_dropdown.close()
    }
    all_events_dropdown = M.Dropdown.init( $('.dropdown-trigger_events')[0],{'autoTrigger':false,'coverTrigger':false
,'onOpenEnd':function() {

    document.getElementById("search_text").focus()
}});
    
    $("#search_button").on("click",function(e) {
        console.log("here")
        t = document.getElementById("search_text")
        if (t.value)
            window.location = "search_page.php?query="+t.value
    })
})