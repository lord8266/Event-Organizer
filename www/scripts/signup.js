$(document).ready(function () {
console.log("THIS PIECE OF shit ")
})

function validate_email(s) {
    var p = /\w+\@\w+\.\w+/;

    return s.match(p)!=null;
}

function toast(message) {
    message = message.replace(/\n/g,"<br>")
    $('.toast').attr('data-delay',2000);
    $('.toast-body').html(message)
    $('.toast').toast('show')
}

function error_template(err) {
    return `<tr><td>${err}</td></tr>`;
}

$('#signup').click((a,b) => {
    var username = $('#username');
    var email = $('#email');
    var password = $('#password');


    var b = true;
    var err = []
    if (!username.val()) {
        err.push(error_template('Empty Name'))
        b=false;
    }
    if (!email.val()) {
        err.push(error_template('Empty Email'))
        b=false;
    }
    if (!password.val()) {
        err.push(error_template('Empty Password'))
        b=false;
    }
    if (!b) {
        toast(err.join(""))
    }
    if (b) {
    if (validate_email(email.val())) {
        $.post('server/api_layer.php',{kind:"signup",username:username.val(),email:email.val(),password:password.val()},(data,status) => { 
            console.log(data)
            if (data=='1') {
                window.location.href = "user_page.php";
            }
            else {
                toast(error_template('Email Already Exists on this site?'))
            }
        });
    }
    else {
        toast(error_template("Invalid Email"))
    }
}
   
});