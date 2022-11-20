window.addEventListener("load", () => {
    let files;

    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
        console.log(files);
    }

    $(document).on('click',
        '#submit',
        function () {

            let formData = new FormData();

            if (files != null) {
                formData.append('logo', files[0]);
            }

            formData.append('name', $("[name='name']").val());
            formData.append('price', $("[name='price']").val());
            formData.append('content', $("[name='content']").val());


            $.ajax({
                url: '/ajax/addNewProd',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    swal("Poof! Added new project!", {
                        icon: "success",
                    }).then(() => {
                        location.href = "/Admin/";
                    });
                },
                error: function (err, errmsg) {
                    swal({
                        title: "Error",
                        text: "Try later pls: " + errmsg,
                        icon: "error"
                    })
                }, beforeSend:
                    function () {
                        $('#preloader').fadeIn(500);
                    },
                complete: function () {
                    $('#preloader').fadeOut(500);
                },
            });

            return false;
        });
})
