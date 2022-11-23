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
            console.log("test 1: " + colors[i].code);
            document.cookie = `bg=${colors[i].code}`;
            document.body.style.background = colors[i].code;
        })
        allButtons.append(button);
    }
    $(".gradient-choose-container").append(allButtons);


    const cookieValue = document.cookie
        .split('; ')
        .find((row) => row.startsWith('bg='))
        ?.split('=')[1];
    if (cookieValue !== undefined) {
        document.body.style.background = cookieValue;
    }



    $("#custom-bg").on("click", () => {
        $("#gp").removeClass("d-none");
        var gp;
        var swAngle = document.getElementById('switch-angle');

        swAngle.addEventListener('change', function (e) {
            gp && gp.setDirection(this.value || 'right');
        });

        var createGrapick = function () {
            let resultValue = "";
            let prewBg = document.cookie
                .split('; ')
                .find((row) => row.startsWith('bg='))
                ?.split('=')[1];
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

            console.log(colors);
            console.log(sizes);
            console.log(prewBg);


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
                document.cookie = "bg=" + resultValue;
                $("#gp").remove();
            })
            $(".cancel").on("click", () => {
                $("#gp").remove();
            })
        };

        var destroyGrapick = function () {
            gp.destroy();
            gp = 0;
        }

        createGrapick();
    })
})