function loadData() {
    return new Promise((resolve, reject) => {
        // setTimeout не является частью решения
        // Код ниже должен быть заменен на логику подходящую для решения вашей задачи
        setTimeout(resolve, 2000);
    })
}

loadData()
    .then(() => {
        let preloaderEl = document.getElementById('preloader');
        preloaderEl.classList.add('hidden');
        preloaderEl.classList.remove('visible');
    });


$(document).ready(function() {
    $('#preloader').fadeOut(400);
});


window.addEventListener("load", ()=>{
    let $buttons = $(".choose-gradient-button");

    const cookieValue = document.cookie
        .split('; ')
        .find((row) => row.startsWith('bg='))
        ?.split('=')[1];
    if(cookieValue !== undefined){
        console.log(cookieValue);
        $("body").attr("id", cookieValue);
    }


    $buttons.on("click", (e)=>{
        let idName = $(e.target).attr('id');
        console.log(idName)
        $("body").attr("id", idName);
        document.cookie = `bg=${idName}`;
    })
})