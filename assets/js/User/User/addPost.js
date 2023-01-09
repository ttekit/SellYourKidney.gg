window.addEventListener("load", () => {
    const link = '/user/addNewPost';

    let image = document.getElementById('image');
    let fileInput = $('input[type=file]');

    let categories = "";
    let tags = [];

    fileInput.on('change', prepareUpload);

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
            let name = $("[name='title']").val();
            let slogan = $("[name='slogan']").val();
            let content = $("[name='content']").val();
            // pagination
            let corr = 0;
            let error = "";
            if (name.length > 5) {
                corr++;
            } else {
                error = "Name is too short!";
            }
            if (slogan.length > 12) {
                corr++;
            } else {
                error = "Slogan is too short!";
            }
            if (categories !== "") {
                corr++;
            } else {
                error = "You need to choose a category";
            }
            if (content.length > 150) {
                corr++;
            } else {
                error = "Content size is too small to post";
            }

            if (corr >= 4) {
                formData.append('category', categories);
                formData.append('tags', JSON.stringify(tags));
                formData.append('title', name);
                formData.append('slogan', slogan);
                formData.append('content', content);

                if (cropper) {
                    cropper.getCroppedCanvas({
                        width: 450,
                        height: 450,
                    }).toBlob((blob) => {
                        formData.set("logo", blob);
                        sendDataToDataBase(formData, link);
                    })
                } else {
                    sendDataToDataBase(formData, link);
                }
            } else {
                Swal.fire({
                    title: "Error",
                    text: error,
                    icon: "warning"
                });
            }

            return false;
        });
})


