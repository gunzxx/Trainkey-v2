$('.close-btn').on('click', function(e){
    this.parentElement.remove();
});

setTimeout(() => {
    $(".message").remove();
}, 1500);