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

        cropper = new Cropper(image, options);
        event.target.value = null;

    }



    let fileInput = $('input[type=file]');
    let files = fileInput.val();
    fileInput.on('change', prepareUpload);
    // Отсыл данных на сервер
    $(document).on('click',
        '#submit',
        function () {
            let formData = new FormData();

            if(cropper){
                cropper.getCroppedCanvas({
                    width: 150,
                    height: 150,
                }).toBlob((blob)=>{
                    formData.set("logo", blob);
                    updateProdData(formData);
                })
            }else{
                updateProdData(formData);
            }

            return false;

        })
    });

let updateProdData = (formData) => {
    formData.append('name', $("[name='name']").val());
    formData.append('price', $("[name='price']").val());
    formData.append('content', $("[name='content']").val());
    formData.append('id', $("[name='id']").val());

    $.ajax({
        url: '/ajax/updateProduct',
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
                            location.href = "";
                        });
                    } else {
                        Swal.fire("Ok :( ");
                    }
                });
        },
        error: function (err, errmsg) {
            Swal.fire({
                title: "Error",
                text: "Pls try later",
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