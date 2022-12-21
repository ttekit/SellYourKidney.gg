window.addEventListener("load", () => {

    let categories = "";
    let tags = [];

    let categoryBtn = $(".addNewCategoryBtn");
    for (let i = 0; i < categoryBtn.length; i++) {
        if (categoryBtn[i].classList.contains("pressed")) {
            categories = categoryBtn[i].innerHTML;
        }
    }
    categoryBtn.on("click", (e) => {
        let $button = $(e.target);
        if ($button.hasClass("pressed")) {
            categories = "";
            $button.attr("class", "addNewCategoryBtn");
        } else {
            if (categories === "") {
                categories = $button.text();
                $button.addClass("pressed");
            }
        }
    });

    let tagBtn = $(".addNewTagBtn");
    for (let i = 0; i < tagBtn.length; i++) {
        if (tagBtn[i].classList.contains("pressed")) {
            tags.push(tagBtn[i].innerHTML);
        }
    }
    tagBtn.on("click", (e) => {
        let $button = $(e.target);
        if ($button.hasClass("pressed")) {
            tags.splice(tags.indexOf($button.text()), 1);
            $button.attr("class", "addNewTagBtn");
        } else {
            tags.push($button.text());
            $button.addClass("pressed");
        }
    });
    let fileInput = $("input[type=file]");
    let files = fileInput.val();

    fileInput.on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
    }

    // Отсыл данных на сервер
    $(document).on('click',
        '#submit',
        function () {

            let formData = new FormData();

            formData.append('id', $("[name='id']").val());
            formData.append('name', $("[name='title']").val());
            formData.append('slogan', $("[name='slogan']").val());
            formData.append('content', $("[name='content']").val());
            formData.append('tags', JSON.stringify(tags));
            formData.append('categories', categories);
            if(files[0] !== undefined ){
                formData.append('logo', files[0]);
            }
            $.ajax({
                url: '/ajax/updatePost',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data)
                    // if (willDelete) {
                    //     Swal.fire("Poof! Your post is on checking!", {
                    //         icon: "success",
                    //     }).then(() => {
                    //     //    location.href = "/User/";
                    //     });
                    // } else {
                    //     Swal.fire("Ok :( ");
                    // }
                },
                error: function (err, errmsg) {
                    Swal.fire({
                        title: "Error",
                        text: "Pls try later",
                        icon: "error"
                    })
                }
                ,
                beforeSend: function () {
                    $('#preloader').fadeIn(500);
                }
                ,
                complete: function () {
                    $('#preloader').fadeOut(500);
                }
                ,
            });

            return false;

        })
})
;