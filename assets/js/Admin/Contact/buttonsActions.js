window.addEventListener("load", () => {
    let $deleteBtns = $(".ban-user-message");
    let $answBtns = $(".answ-user");
    $deleteBtns.on("click", (e) => {
        let cont = $(e.target).parent().parent().parent();
        let id = cont.find("#id").val();

        cont.addClass("d-none");
        removeMessage(cont, id);
    })

    $answBtns.on("click", (e) => {
        let cont = $(e.target).parent().parent().parent();
        let email = cont.find(".email").text()

        Swal.fire({
            title: 'Answer',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Answer',
            showLoaderOnConfirm: true,
            preConfirm: (answ) => {
                Email.send({
                    Host: "smtp.gmail.com",
                    Username: "bootstrapshop.gg@gmail.com",
                    Password: "qwertyua",
                    To: email,
                    From: "bootstrapshop.gg@gmail.com",
                    Subject: "Answering",
                    Body: answ,
                }).then(()=>{
                    removeMessage(cont, cont.find("#id").val())
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `Answer successfully send!`,
                    icon: "success"
                })
            }
        })
    })

    function removeMessage (cont, id) {
        $.ajax({
            url: "/ajax/removeContactInfo",
            method: "post",
            data: {
                id: id
            },
            success: () => {
                cont.remove();
            },
            error: (err) => {
                cont.removeClass("d-none");
                Swal.file({
                    title: "Error",
                    message: "Pls try later",
                    icon: "error"
                });
                console.log(err);
            }
        })
    }
})