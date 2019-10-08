
$('document').ready(
    function() {
        $('.tabs').tabs();
        $('.dropdown-trigger').dropdown();
        $('#collapsible_front').collapsible();
        $('#collapsible_tal').collapsible();
        $('#date_start').datepicker();
        $('#date_end').datepicker();
        console.log( $('#time_start').timepicker());
        $('#time_end').timepicker();
        $('#modal_add_tags').modal();
        $('#tags').data('count',0);
        $('#tags').data('max',4);
        price_show()
        $('#check_paid').on('change',price_show)
    }

);
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
// function update() {
//     var c =`rgba(${$('#R').val()},${$('#G').val()},${$('#B').val()},${$('#A').val()})`;
//     console.log(c)
//     $('#profile').css("border-color",c);
// }
// $('#R').on('input',()=> {update()});
// $('#G').on('input',()=> {update()});
// $('#B').on('input',()=> {update()});
// $('#A').on('input',()=> {update()});

