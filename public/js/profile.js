$(document).ready(function(){
    const current_inv_img = document.querySelector("#preview-inv-img").src;
    
    $("#profileInput").change(async function(event){
        const [file] = await event.target.files;
        
        if(file){
            document.querySelector("#preview-inv-img").src = URL.createObjectURL(file);
        }
        else{
            document.querySelector("#preview-inv-img").src = current_inv_img;
        }
    })
});

$("#deleteAccountBtn").click(()=>{
    Swal.fire({
        text: 'Hapus akun',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'red',
    }).then(res => {
        if(res.isConfirmed){
            fetch('/api/profile', {
                method: 'DELETE',
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            }).then(async apiRes => {
                const bodyResponse = await apiRes.json();
                if(apiRes.status == 200){
                    Swal.fire({
                        icon: 'success',
                        text: bodyResponse.message,
                    }).then(res => {
                        window.location.href = '/login';
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: bodyResponse.message,
                    });
                }
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    text: err,
                }).then(res => {
                    window.location.reload();
                });
            })
        }
    });
});