window.addEventListener("load", () => {
    var files;

    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
    }


    // Отсыл данных на сервер
    $(document).on('click',
        '#submit',
        function () {
            let formData = new FormData();

            formData.append('name', $("[name='name']").val());
            formData.append('price', $("[name='price']").val());
            formData.append('content', $("[name='content']").val());
            formData.append('id', $("[name='id']").val());
            formData.append('logo', files[0]);

            $.ajax({
                url: '/ajax/updateProduct',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to share" + data,
                        icon: "success",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                swal("Poof! Your post is on checking!", {
                                    icon: "success",
                                }).then(() => {
                                    location.href = "/Admin/products";
                                });
                            } else {
                                swal("Why are you so close?");
                            }
                        });
                },
                error: function (err, errmsg) {
                    swal({
                        title: "Error",
                        text: "Try later pls: " + errmsg,
                        icon: "error"
                    })
                },
                beforeSend: function () {
                    $('#preloader').fadeIn(500);
                },
                complete: function () {
                    $('#preloader').fadeOut(500);
                },
            });

            return false;

        })
    });
