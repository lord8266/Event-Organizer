$(document).ready(function () {
console.log("THIS PIECE OF shit ")
})

function validate_email(s) {
    var p = /\w+\@\w+\.\w+/;

    return s.match(p)!=null;
}

$('#signup').click((a,b) => {
    var username = $('#username');
    var email = $('#email');
    var password = $('#password');


    var b = true;
    var err = []
    if (!username.val()) {
        err.push('Empty Name')
        b=false;
    }
    if (!email.val()) {
        err.push('Empty Email')
        b=false;
    }
    if (!password.val()) {
        err.push('Empty Password')
        b=false;
    }
    if (!b) {
        M.toast({html:err.join("<br>")})
    }
    if (b) {
    if (validate_email(email.val())) {
        $.post('server/api_layer.php',{kind:"signup",username:username.val(),email:email.val(),password:password.val()},(data,status) => { 
            console.log(data)
            if (data=='1') {
                window.location.href = "user_page.php";
            }
            else {
                M.toast({html:'Email Already Exists on this site?' })
            }
        });
    }
    else {
        M.toast({html:"Invalid Email"})
    }
}
   
});