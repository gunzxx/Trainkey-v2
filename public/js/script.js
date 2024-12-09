$(".close-btn").on("click", function (e) {
    this.parentElement.remove();
});


setTimeout(() => {
    $(".message").remove();
}, 3000);


$("#logoutBtn").on("click", function (e) {
    Swal.fire({
        text: "Logout?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "purple",
    }).then((res) => {
        if (res.isConfirmed) {
            window.location.href = "/logout";
        }
    });
});


const profileimg = document.getElementById("profile");
const profilemenu = document.getElementById("profile-menu");
let tampil = true;
profileimg.addEventListener("click", () => {    
    if (tampil == true) {
        profileimg.style.transform = "rotate(360deg)";
        profilemenu.style.opacity = 1;
        profilemenu.style.display = "flex";
        tampil = false;
    } else if (tampil == false) {
        profileimg.style.transform = "rotate(0deg)";
        profilemenu.style.opacity = 0;
        profilemenu.style.display = "none";
        tampil = true;
    }
});