let loginbtn = document.getElementById("login");
let usernameInput = document.getElementById("email");
let passwordInput = document.getElementById("password");


function showNotify(){
    notify = document.getElementById("notify");
    notify.style.right = 0;
    setTimeout(()=>{
        notify.style.right='-500px';
    },1000)
}



let showpassword = document.getElementById("showpassword");
let show = false;
showpassword.onclick = ()=>{
    if(show==false){
        passwordInput.type = "text";
        showpassword.src = "img/eye.svg"
        show = true;
    }
    else if(show == true){
        passwordInput.type = "password";
        showpassword.src = "img/eye-fill.svg"
        show = false;
    }
}


let remember = document.getElementById("remember")
let checked = "false";
remember.onclick = ()=>{
    if(remember.checked == true){
        checked = "true";
    }
    else if(remember.checked == false){
        checked = "false";
    }
}