
function validate_email(s) {
    var p = /\w+\@\w+\.\w+/;
    return s.match(p)!=null;
}

function validate_password(s) {
    var p = /\w+/;
    return s.match(p)!=null;
}


function toast(message) {
    message = message.replace(/\n/g,"<br>");
    $('.toast').attr('data-delay',3000);
    $('.toast-body').html(message)
    $('.toast').toast('show')
}

function error_template(err) {
    return `<tr><td>${err}</td></tr>`;
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
        err.push(error_template('Empty Email'))
        b=false;
    }
    if (!password) {
        err.push(error_template('Empty Password'))
        b=false;
    }
    if (!b) {
        toast(err.join(""))
    }
    else {
    if (validate_email(email)) {
        $.post('server/login.php',{email:email,password:password},function(data,status) {
            
            if (data==0) {
                toast('Email Not Found');
                clear_form(1,1);
            }
            else if (data==1) {
                toast('Invalid Password');
                clear_form(0,1);
            }
            else {
                window.location.replace('user_page.php')
            }
        })
    }
    else {
        toast('Invalid Email');
        clear_form(1,1);
    }
    
} } )