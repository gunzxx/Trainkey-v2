let passwordInput1 = document.getElementById("password");
let passwordInput2 = document.getElementById("password2");



let showpassword1 = document.getElementById("showpassword1");
let show1 = false;
showpassword1.onclick = ()=>{
    if(show1==false){
        passwordInput1.type = "text";
        showpassword1.src = "img/eye.svg"
        show1 = true;
    }
    else if(show1 == true){
        passwordInput1.type = "password";
        showpassword1.src = "img/eye-fill.svg"
        show1 = false;
    }
}

let showpassword2 = document.getElementById("showpassword2");
let show2 = false;
showpassword2.onclick = ()=>{
    if(show2==false){
        passwordInput2.type = "text";
        showpassword2.src = "img/eye.svg"
        show2 = true;
    }
    else if(show2 == true){
        passwordInput2.type = "password";
        showpassword2.src = "img/eye-fill.svg"
        show2 = false;
    }
}

$(document).ready(function(){
    const current_inv_img = document.querySelector("#preview-inv-img").src;
    
    $("#profile").change(async function(event){
        const [file] = await event.target.files;
        
        if(file){
            document.querySelector("#preview-inv-img").src = URL.createObjectURL(file);
        }
        else{
            document.querySelector("#preview-inv-img").src = current_inv_img;
        }
    })
})