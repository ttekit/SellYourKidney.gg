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

    $("#submit").on("click", (e)=>{
        let $container = $(e.target).parent().parent().find("input");
        let login = $container.val();

        $.ajax({
            url: "/ajax/findUserByLogin",
            method: "POST",
            data: {
                "login": login
            },
            success: (res) => {
                if(res === "false"){
                    Swal.fire("Incorrect login")
                }
                else{
                    let data = JSON.parse(res);
                    console.log(data);

                    Swal.fire({
                        title: data.login,
                        html: `<p class="text-white">email: ${data.email}</p>
                                <a class="text-gray-100 font-weight-bold"  href="/user/${data.id}">profile</a>
                        `,
                        showDenyButton: true,
                        denyButtonText: `BAN`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            Swal.fire('BAN!', '', 'success')
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
            complete: function() {
                $container.fadeIn(500);
            },
        })
    })

});