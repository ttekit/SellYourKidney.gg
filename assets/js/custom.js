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


$(document).ready(function () {
    $('#preloader').fadeOut(400);
});


window.addEventListener("load", () => {
    let $buttons = $(".choose-gradient-button");
    let colors = [
        {
            color: "",
            code: "linear-gradient(0.68turn, #000000 0%, #f5a7ff 100%)"
        },
        {
            color: "",
            code: "linear-gradient(0.68turn, #833ab4 0%, #45fcbb 100%)"
        },
        {
            color: "",
            code:"linear-gradient(0.68turn, #ff6c6c 0%, #f5a7ff 100%)"},
        {
            color: "",
            code: "linear-gradient(0.68turn, #ffb7f5 0%, #67383f 100%)"
        },
    ];

    let allButtons = $("<div class='d-flex row'>");

    for (let i = 0; i < colors.length; i++){
        let button = $(`<button class="choose-gradient-button" id="${colors[i].color}" style="background: ${colors[i].code}" data-aos="flip-left"> </button>`)
        button.on("click", ()=>{
            localStorage.setItem('bg', colors[i].code);
            document.body.style.background = colors[i].code;
        })
        allButtons.append(button);
    }
    $(".gradient-choose-container").append(allButtons);


    // const cookieValue = document.cookie
    //     .split('; ')
    //     .find((row) => row.startsWith('bg='))
    //     ?.split('=')[1];
    const cookieValue = localStorage.getItem('bg');

    if (cookieValue !== undefined) {

        document.body.style.background = cookieValue;
    }



    $("#custom-bg").on("click", () => {
        $("#gp").removeClass("d-none");
        let gp;

        let prewBg =localStorage.getItem("bg");
        prewBg = prewBg.split(" ");

        let colors = [];
        let sizes = [];

        for (let i = 0; i < prewBg.length; i++) {
            if (prewBg[i][0] === "#") {
                colors.push(prewBg[i]);
            }
            if (prewBg[i][0] >= 0 || prewBg[i][0] <= 9) {
                if(prewBg[i][1] !== '.'){
                    sizes.push(prewBg[i]);
                }
            }
        }

        let currentRoundSliderValue = "";
        for (let i = 0; i < prewBg[0].length; i++){
            if(prewBg[0][i] >= 0 || prewBg[0][i] <= 9){
                currentRoundSliderValue += prewBg[0][i];
            }
        }

        $("#slider").roundSlider({
            radius: 85,
            sliderType: "min-range",
            min: 0,
            max: 360,
            value: currentRoundSliderValue,
            drag: function (e){
                e.value += "deg";
                gp && gp.setDirection(e.value || '90deg');
            }
        });
        // swAngle.addEventListener('change', function (e) {
        //     gp && gp.setDirection(this.value || 'right');


        let createGrapick = function () {
            let resultValue = "";


            gp = new Grapick({
                el: '#grapick',
                direction: prewBg[1].slice(0, -1),
                min: 1,
                max: 99,
            });
            for (let i = 0; i < colors.length; i++) {
                gp.addHandler(sizes[i].slice(0, -2), colors[i], 1);
            }


            gp.on('change', function (complete) {
                const value = gp.getValue();
                document.body.style.backgroundImage = value;
                resultValue = value;
            })
            gp.emit('change');

            $(".submit").on("click", () => {
                localStorage.setItem("bg", resultValue);
                $("#gp").addClass("d-none");
            })
            $(".cancel").on("click", () => {
                $("#gp").addClass("d-none");
            })
        };

        var destroyGrapick = function () {
            gp.destroy();
            gp = 0;
        }

        createGrapick();
    })
})