
window.addEventListener("load", () => {
    const link = '/ajax/updatePost';

    let image = document.getElementById('image');
    let cropBoxData;
    let canvasData;
    let cropper;
    let uploadedImageType = 'image/jpeg';
    let uploadedImageName = 'cropped.jpg';
    let uploadedImageURL;
    let options = {
        aspectRatio: 1,
        viewMode: 1,
        cropBoxResizable: false,
        background: false,
        highlight: false,
        guides: false,
        minCropBoxWidth: 400,
        maxWidth: 4096,
        maxHeight: 4096,
        minWidth: 256,
        minHeight: 256,
        ready: function () {
            cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
        }
    }


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
    function prepareUpload(event) {
        files = event.target.files;
        let file = files[0];

        uploadedImageType = file.type;
        uploadedImageName = file.name;

        if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
        }

        image.src = uploadedImageURL = URL.createObjectURL(file);

        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(image, options);
        event.target.value = null;

    }

    // Отсыл данных на сервер
    $(document).on('click',
        '#submit',
        function () {
            let formData = new FormData();
            formData.append('tags', JSON.stringify(tags));
            formData.append('categories', categories);
            formData.append('logo', files[0]);
            formData.append('id', $("[name='id']").val());
            formData.append('name', $("[name='title']").val());
            formData.append('slogan', $("[name='slogan']").val());
            formData.append('content', $("[name='content']").val());

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
            return false;
//
        })
})
