
var date_picker_start;
var date_picker_end;
var time_picker_start;
var time_picker_end;
var login_dropdown;
var collapisble_front;
var collapsible_tal;
var tabs;

$('document').ready(
    function() {
        
        tabs = M.Tabs.init( $('.tabs')[0]) ;
        login_dropdown = M.Dropdown.init( $('.dropdown-trigger')[0]) ;
        collapisble_front = M.Collapsible.init( $('#collapsible_front')[0]) ;
        collapsible_tal = M.Collapsible.init( $('#collapsible_tal')[0],{accordion:false}) ;
        date_picker_start =M.Datepicker.init( $('#date_start')[0],{format: "dd mmm, yyyy",minDate: new Date(),onClose:()=>{on_close('s','d')}  }) ;
        date_picker_end = M.Datepicker.init( $('#date_end')[0],{format: "dd mmm, yyyy",minDate: new Date(),onClose:()=>{on_close('e','d')} ,onOpen:()=>{on_open('e')} }) ;

        time_picker_start= M.Timepicker.init( $('#time_start')[0],{twelveHour:true,onCloseEnd:()=>{on_close('s','t')}});
        time_picker_end = M.Timepicker.init( $('#time_end')[0],{twelveHour:true,onCloseEnd:()=>{on_close('e','t')}} );
        $('#modal_add_tags').modal();
        $('#tags').data('count',0);
        $('#tags').data('max',4);
        price_show()
        $('#check_paid').on('change',price_show)
        $("#description_text").val("")
    }

);


$('#logout').click(() => {
    $.post('server/api_layer.php', {
        kind: "logout"
    }, (data, status) => {
        window.location.href = "index.php"
    });
})
function get_time(s) {
    
    h = s.hours
    if (s.amOrPm=='PM') {
        h+=12
    }
    m=  s.minutes
    
    return `${("00"+h).slice(-2)}:${("00"+m).slice(-2)}`
}

function get_moment(s) {
    console.log(s)
    m = moment(s,"DD MMM, YYYY HH:mm")
    return m
}

function reset_end_pickers() {
    date_picker_end.setDate("")
    date_picker_end.setInputValue("")
    $("#time_end").val("")
}

function on_close(t,f) {
    var s0 = date_picker_start.toString()
    var s1 = date_picker_end.toString()
    var s2 = time_picker_start
    var s3 = time_picker_end
    if (t=='s') {
        if (s0 && s2.time && s1 && s3.time) {
            let m0 = get_moment(s0.toString()+" " + get_time(s2))
            console.log(m0);
            let m1  = get_moment(s1.toString()+" " + get_time(s3))
            if (m0.isAfter(m1)) {
                date_picker_end.setDate("")
                date_picker_end.setInputValue("")
            }
        }
        date_picker_end.options.minDate = date_picker_start.date
    }
   
    else if (t=='e') {

        if (!(s0 && s2.time)) {
            reset_end_pickers()
            M.toast( {html:"Select Start Date and Time"} );
            date_picker_end.open()
        }
        if (s3.time && s1 && s2.time && s0) {
            console.log("here")
            let m0 = get_moment(s0.toString()+" " + get_time(s2))
            let m1  = get_moment(s1.toString()+" " + get_time(s3))
            if (m0.isAfter(m1)) {
                if (f==1) {
                    $("#time_end").val("")
                }
                else {
                    date_picker_end.setDate("")
                    date_picker_end.setInputValue("")
                }
                M.toast({html:"Invalid End"})
            }
        }
       
    }
    else if (t=='s_t') {
        s2 = get_time(time_picker_start);
        s3 = get_time(time_picker_end);
        if (s3) {
            if (s2.isAfter(s3)) {  
            }
        }
    }
}

function on_open(t) {
  
    
}

function validate_time() {
    var s0 = date_picker_start.toString()
    var s1 = date_picker_end.toString()
    var s2 = time_picker_start
    var s3 = time_picker_end
    let m0 = get_moment(s0.toString()+" " + get_time(s2))
    let m1  = get_moment(s1.toString()+" " + get_time(s3))
    return m0.isBefore(m1)
}

function serialize_data() {
    var s0 = date_picker_start.toString()
    var s1 = date_picker_end.toString()
    var s2 = time_picker_start
    var s3 = time_picker_end
    let data = {"start":get_moment(s0.toString()+" " + get_time(s2)).format(),
                "end":get_moment(s1.toString()+" " + get_time(s3)).format(),
                "name":$("#event_name").val(),
                "paid":$("#check_paid").prop("checked") ?1:0,
                "price":$("#price").val(),
                "tags":serialize_tags(),
                "description":$("#description_text").val()}
    return JSON.stringify(data);
}

function send_data(data) {
    
}

function validate_price(s) {
    exp = /\d+/
    s.mat
}
function serialize_tags() {
    t = []
    $("#tags").find('div.chip').each((e,a)=>{t.push($(a).data("value")) })
    return t.join(",")
}

function validate_input() {
    var ret = 1;
    if (!validate_time()) {
        M.toast( {html:"Invalid Time Range"})
        tabs.select("tal")
        ret =0;
    }
    else if ($("#event_name").val()=="") {
        M.toast({html:"Invalid Event Name"})
        tabs.select("front")
        ret =0;
    }
    else if ($("#check_paid").prop("checked") && (!$("#price").val().match(/^\d+$/)) ) {
        M.toast({html:"Invalid Price"})
        ret =0;
    }
    return ret;
    
    
}

function price_show() {
    if ($('#check_paid').prop('checked')) {
        $('#price_div').show()
    }
    else {
        $('#price_div').hide()
    }
}
function rem_tag(e) { 
    $(e.currentTarget).remove()
    $("#tags").data("count",$("#tags").data("count") -1);
    $("#add_tag_button").show()
    
}
function add_tag(e) {
    var c = $('#tags').data('count')
    var m = $('#tags').data('max');
    if (c<m) {
        console.log($('#tag_name').val().length)
        if ($('#tag_name').val().length<15 && $('#tag_name').val().length>=3 ) {
            $(`<div></div>`, {
                "class": "chip waves-effect waves-light",
                "data-value":$('#tag_name').val(),
                click: rem_tag,
                html:`<i class="close material-icons">close</i> ${$('#tag_name').val()}`
              }).insertBefore( "#add_tag_button" );
            c++;
        }
        else {
            M.toast({html:"Tag length 3 - 8",displayLength:2000} )
        }
    }
    if (c==m) {
        $("#add_tag_button").hide()
    }
    
    $('#tags').data('count',c);
    
}
$('#add_tag').click(add_tag)

$("#create_event").click(function() {
    if (validate_input()) {
        d = serialize_data();
        $.ajax({
            url: 'server/api_layer.php', 
            type: "POST",
            contentType: "application/json",
            data: d,
            error: (res,status) => { console.log(res)},
            success: (res,status) => { console.log(res)}
        });
    }
});


