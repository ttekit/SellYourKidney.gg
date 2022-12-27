window.addEventListener("load", () => {


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

    let files;
    let fileInput = $('input[type=file]');


    let categories = "";
    let tags = [];

    fileInput.on('change', prepareUpload);
    function prepareUpload(event) {
        files = event.target.files;
        file = files[0];

        uploadedImageType = file.type;
        uploadedImageName = file.name;

        if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
        }

        image.src = uploadedImageURL = URL.createObjectURL(file);

        if (cropper) {
            cropper.destroy();
        }
        console.log(image)

        cropper = new Cropper(image, options);
        event.target.value = null;

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
            formData.append('category', categories);
            formData.append('tags', JSON.stringify(tags));

            if (cropper) {
                cropper.getCroppedCanvas({
                    width: 450,
                    height: 450,
                }).toBlob((blob) => {
                    formData.set("logo", blob);
                    sendDataToDataBase(formData);
                })
            } else {
                sendDataToDataBase(formData);
            }

            return false;
        });
})


let sendDataToDataBase = (formData) => {

    formData.append('title', $("[name='title']").val());
    formData.append('slogan', $("[name='slogan']").val());
    formData.append('content', $("[name='content']").val());


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
}