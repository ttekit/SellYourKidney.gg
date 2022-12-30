window.addEventListener("load", function () {

    let $btnsDelete = $(".ban-user");
    $btnsDelete.on("click", function (e){

        let $container = $(e.target).parent();
        let $userId = $container.find("#id").val();

        $.ajax({
            url: "/AdminAjax/banUser",
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

    $("#submit").on("click", (e)=>{
        let $container = $(e.target).closest(".input-group");
        let $input = $(e.target).parent().parent().find("input");
        let login = $input.val();

        $.ajax({
            url: "/AdminAjax/findUserByLogin",
            method: "POST",
            data: {
                "login": login
            },
            success: (res) => {
                $container.fadeIn(500);

                if(res === "false"){
                    Swal.fire("Incorrect login")
                }
                else{
                    console.log(res);
                    let data = JSON.parse(res);

                    Swal.fire({
                        title: data.login,
                        html: `<p class="text-white">email: ${data.email}</p>
                                <a class="text-gray-100 font-weight-bold"  href="/user/?id=${data.id}">profile</a>
                        `,
                        showDenyButton: true,
                        denyButtonText: `BAN`,
                    }).then((result) => {
                        if (result.isDenied) {
                            $.ajax({
                                url: "/ajax/banUser",
                                method: "POST",
                                data: {
                                    "id": data.id
                                },
                                success: () => {
                                    Swal.fire('BAN!', '', 'success').then(()=>{
                                        location.reload();
                                    })
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
                        }
                    })
                }

            },
            error: (msg) => {
                alert(msg);
            },
            beforeSend: function() {
                $container.fadeOut(500);
            },
        })
    })

});