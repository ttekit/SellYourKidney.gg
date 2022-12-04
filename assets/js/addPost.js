window.addEventListener("load", () => {

    let files;
    let fileInput = $('input[type=file]');
    let categories = "";
    let tags = [];
    fileInput.on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
    }


    $(".addNewCategoryBtn").on("click", (e) => {
        let $button = $(e.target);
        if ($button.hasClass("pressed")) {
            categories = "";
            $button.attr("class", "addNewCategoryBtn");
            console.log(categories);
        } else {
            if (categories === "") {
                categories = $button.text();
                $button.addClass("pressed");
            }
        }
    });

    $(".addNewTagBtn").on("click", (e) => {

        let $button = $(e.target);
        if ($button.hasClass("pressed")) {
            tags.splice(tags.indexOf($button.text()), 1);
            $button.attr("class", "addNewTagBtn");
        } else {
            tags.push($button.text());
            $button.addClass("pressed");
        }
    });


    $(document).on('click',
        '#submit',
        function () {

            let formData = new FormData();

            if (files != null) {
                formData.append('logo', files[0]);
            }

            formData.append('title', $("[name='title']").val());
            formData.append('slogan', $("[name='slogan']").val());
            formData.append('content', $("[name='content']").val());
            formData.append('category', categories);
            formData.append('tags', JSON.stringify(tags));
            console.log(JSON.stringify(tags));
            $.ajax({
                url: '/user/addNewPost',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Are you sure you want to share" + data,
                        icon: "success",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                Swal.fire("Poof! Your post is on checking!", {
                                    icon: "success",
                                }).then(() => {
                                    location.href = "/Blog/";
                                });
                            }
                        });
                },
                error: function (err, errmsg) {
                    Swal.fire({
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
        });
})
