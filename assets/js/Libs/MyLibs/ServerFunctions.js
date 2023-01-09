const sendDataToDataBase = (formData, link) => {
    $.ajax({
        url: link,
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            Swal.fire({
                title: "Success",
                text: data,
                icon: "success",
            })
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

// cropper settings
let cropBoxData;
let canvasData;
let cropper;
let uploadedImageType = 'image/jpeg';
let uploadedImageName = 'cropped.jpg';
let uploadedImageURL;
const imageOptions = {
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

function prepareUpload(event){
    let files = event.target.files;
    let file = files[0];

    if(file.type.includes("image")){
        uploadedImageType = file.type;
        uploadedImageName = file.name;

        if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
        }

        image.src = uploadedImageURL = URL.createObjectURL(file);

        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(image, imageOptions);
        event.target.value = null;
    }
    else{
        Swal.fire({
            title: "Upload error",
            text: "You can load only images",
            logo:"error"
        })
    }

}
