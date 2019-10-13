
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
        collapsible_tal = M.Collapsible.init( $('#collapsible_tal')[0]) ;
        date_picker_start =M.Datepicker.init( $('#date_start')[0],{format: "mm/dd/yyyy",minDate: new Date(),onClose:()=>{on_close('s')}  }) ;
        date_picker_end = M.Datepicker.init( $('#date_end')[0],{format: "mm/dd/yyyy",minDate: new Date(),onClose:()=>{on_close('e')} ,onOpen:()=>{on_open('e')} }) ;
        time_picker_start= M.Timepicker.init( $('#time_start')[0] );
        time_picker_start = M.Timepicker.init( $('#time_end')[0] );
        $('#modal_add_tags').modal();
        $('#tags').data('count',0);
        $('#tags').data('max',4);
        price_show()
        $('#check_paid').on('change',price_show)
    }

);

function on_close(t) {
    var s0 = date_picker_start.toString()
    var s1 = date_picker_end.toString()
    if (t=='s') {
        if (s1) {
            if (new Date(s0) >new Date(s1)) {
                date_picker_end.setDate("")
                date_picker_end.setInputValue("")
            }
        
        }
        date_picker_end.options.minDate = date_picker_start.date
    }
    else if (t=='e') {

        if (!s0) {
            date_picker_end.setDate("")
            date_picker_end.setInputValue("")
            M.toast( {html:"Select Start Date"} );
            date_picker_end.open()
        }
       
    }
}

function on_open(t) {
  
    
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


