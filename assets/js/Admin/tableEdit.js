window.addEventListener("load", function () {

    let $table = $(".datatable");
    let pressed = false;
    let $newOptionBtn = $table.find(".newOptionBtn");

    $newOptionBtn.on("click", function () {
        let $addOptionBlock = $table.find(".addBlock");
        if (pressed === false) {
            $addOptionBlock.removeClass("hidden");
            pressed = true;
        } else {
            $addOptionBlock.addClass("hidden");
            pressed = false;
        }
    })
})