let daftarbtn = document.getElementById("daftar");

let usernameInput = document.getElementById("username");
let passwordInput1 = document.getElementById("password");
let passwordInput2 = document.getElementById("password2");
let varss = [usernameInput,passwordInput1,passwordInput2];


varss.forEach((el)=>{
    el.addEventListener("keydown",(e)=>{
        if(e.which == 13){
            let i = 0;
            daftarEvent();
        }
    })
})


let profiles = document.getElementsByName("profile");
let previewprofile = document.getElementById("preview-profile");
let profile_img = 1;


profiles.forEach(p => {
    p.addEventListener("click",()=>{
        imgSrc = "img/pfp/pfp";
        profile_img = p.value;
        imgSrc+=profile_img+".png";
        console.log(imgSrc);
        previewprofile.src = imgSrc;
        imgSrc = "img/pfp/pfp";
    })
});


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