window.addEventListener("load", function () {

    let $btnsDelete = $(".ban-user");
    $btnsDelete.on("click", function (e){

        let $container = $(e.target).parent();
        let $userId = $container.find("#id").val();

        $.ajax({
            url: "/ajax/banUser",
            method: "POST",
            data: {
                "id": $userId
            },
            success: () => {
                    $container.parent("div").remove();
            },
            error: (msg) => {
                alert(msg);
            },
            beforeSend: function() {
                $('#preloader').fadeIn(500);
            },
            complete: function() {
                $('#preloader').fadeOut(500);
            },
        })
    })

});