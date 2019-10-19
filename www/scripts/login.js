
function validate_email(s) {
    var p = /\w+\@\w+\.\w+/;
    return s.match(p)!=null;
}

function validate_password(s) {
    var p = /\w+/;
    return s.match(p)!=null;
}


function clear_form(u,p) {
    if (u) {
        $('#email').val('')
    }
    if (p) {
        $('#password').val('')
    }
}
$('#login').click(function() {
    var email = $('#email').val()
    var password  =$('#password').val()
    var b = true;
    var err = []
    if (!email) {
        err.push('Empty Email')
        b=false;
    }
    if (!password) {
        err.push('Empty Password')
        b=false;
    }
    if (!b) {
        M.toast({html:err.join("<br>")});
    }
    else {
    if (validate_email(email)) {
        $.post('server/api_layer.php',{kind:"login",email:email,password:password},function(data,status) {
            console.log(data);
            if (data==0) {
                M.toast({html:'Email Not Found'});
                clear_form(1,1);
            }
            else if (data==1) {
                M.toast({html:'Invalid Password'});
                clear_form(0,1);
            }
            else {
                window.location = 'search_page.php';
            }
        })
    }
    else {
        M.toast({html:'Invalid Email'});
    }
    
} } )