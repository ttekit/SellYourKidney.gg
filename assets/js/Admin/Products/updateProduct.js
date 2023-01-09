window.addEventListener("load", () => {


    let link = "/AdminAjax/updateProduct";



    let fileInput = $('input[type=file]');
    fileInput.on('change', prepareUpload);

    $(document).on('click',
        '#submit',
        function () {
            let formData = new FormData();
            // TODO: validation
            let name = $("[name='name']").val();
            let price = $("[name='price']").val();
            let content = $("[name='content']").val();
            let corr = 0;
            let error = "";

            if (name.length > 5) {
                corr++;
            } else {
                error = "name is too short";
            }
            if (price > 10) {
                corr++;
            } else {
                error = "price is too small...";
            }
            if (content.length  > 50) {
                corr++;
            } else {
                error = "add more info over product";
            }

            if(corr === 3){
                formData.append('name', name);
                formData.append('price', price);
                formData.append('content', content);
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
            }else{
                Swal.fire({
                    title: "Error",
                    text: error,
                    icon: "warning"
                });
            }


            return false;

        })
    });
