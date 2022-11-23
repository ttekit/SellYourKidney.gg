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

    const cookieValue = document.cookie
        .split('; ')
        .find((row) => row.startsWith('bg='))
        ?.split('=')[1];
    if (cookieValue !== undefined) {
        console.log(cookieValue);
        document.body.style.background = cookieValue;
    }


    $buttons.on("click", (e) => {
        // let idName = $(e.target).attr('id');
        // $("body").attr("id", idName);
        // document.cookie = `bg=${idName}`;
    })


    $("#custom-bg").on("click", () => {
        $("#gp").removeClass("d-none");
        var upType, unAngle, gp;
        var swType = document.getElementById('switch-type');
        var swAngle = document.getElementById('switch-angle');
        var copyToClipboard = function (str) {
            var el = document.createElement('textarea');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        };
        swType.addEventListener('change', function (e) {
            gp && gp.setType(this.value || 'linear');
        });

        swAngle.addEventListener('change', function (e) {
            gp && gp.setDirection(this.value || 'right');
        });

        var createGrapick = function () {
            let resultValue = "";
            gp = new Grapick({
                el: '#grapick',
                direction: 'right',
                min: 1,
                max: 99,
            });
            gp.addHandler(1, '#085078', 1);
            gp.addHandler(99, '#85D8CE', 1, {keepSelect: 1});
            gp.on('change', function (complete) {
                const value = gp.getValue();
                document.body.style.backgroundImage = value;
                resultValue = value;
            })
            gp.emit('change');

            $(".submit").on("click", () => {
                document.cookie = "bg="+resultValue;
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