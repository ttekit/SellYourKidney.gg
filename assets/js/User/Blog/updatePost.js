
window.addEventListener("load", () => {
    const link = '/AdminAjax/updatePost';

    let image = document.getElementById('image');


    let categories = "";
    let tags = [];


    let categoryBtn = $(".addNewCategoryBtn");
    let tagBtn = $(".addNewTagBtn");
    let fileInput = $("input[type=file]");

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


    let files = fileInput.val();

    fileInput.on('change', prepareUpload);

    // Отсыл данных на сервер
    $(document).on('click',
        '#submit',
        function () {
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

            if(corr === 4){
                let formData = new FormData();
                formData.append('tags', JSON.stringify(tags));
                formData.append('categories', categories);
                formData.append('logo', files[0]);
                formData.append('id', $("[name='id']").val());
                formData.append('name', name);
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
            } else{
                Swal.fire({
                    title: "Error",
                    text: error,
                    icon: "warning"
                });
            }

            return false;
        })
})
