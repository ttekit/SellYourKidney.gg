window.addEventListener("load", () => {

    let files;
    let categories = "";
    let tags = [];

    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
        console.log(files);
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
            console.log(categories);
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

            $.ajax({
                url: '/user/addNewPost',
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
                                    location.href = "/Blog/";
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
        });
})
