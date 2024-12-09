let passwordInput1 = document.getElementById("password");
let passwordInput2 = document.getElementById("password_confirmation");

let show1 = false;
$('#showPassword1').click(()=>{
    if(show1==false){
        passwordInput1.type = "text";
        $("#showPassword1").attr('src',"/img/eye.svg")
        show1 = true;
    }
    else if(show1 == true){
        passwordInput1.type = "password";
        $("#showPassword1").attr('src',"/img/eye-fill.svg")
        show1 = false;
    }
});

let show2 = false;
$("#showPassword2").click(()=>{
    if(show2==false){
        passwordInput2.type = "text";
        $("#showPassword2").attr('src', "/img/eye.svg")
        show2 = true;
    }
    else if(show2 == true){
        passwordInput2.type = "password";
        $("#showPassword2").attr('src', "/img/eye-fill.svg")
        show2 = false;
    }
});