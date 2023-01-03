window.addEventListener("load", () => {

    let image = document.getElementById('image');
    let cropBoxData;
    let canvasData;
    let cropper;
    let uploadedImageType = 'image/jpeg';
    let uploadedImageName = 'cropped.jpg';
    let uploadedImageURL;

    let link = "/AdminAjax/updateProduct";

    let options = {
        aspectRatio: 1,
        viewMode: 1,
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

            formData.append('name', $("[name='name']").val());
            formData.append('price', $("[name='price']").val());
            formData.append('content', $("[name='content']").val());
            formData.append('id', $("[name='id']").val());

            if(cropper){
                cropper.getCroppedCanvas({
                    width: 150,
                    height: 150,
                }).toBlob((blob)=>{
                    formData.set("logo", blob);
                    sendDataToDataBase(formData, link);
                })
            }else{
                sendDataToDataBase(formData, link);
            }

            return false;

        })
    });
