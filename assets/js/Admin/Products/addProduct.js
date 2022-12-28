window.addEventListener("load", () => {
    let files;

    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
        console.log(files);
    }

    $(document).on('click',
        '#submit',
        function () {

            let formData = new FormData();

            if (files != null) {
                formData.append('logo', files[0]);
            }

            formData.append('name', $("[name='name']").val());
            formData.append('price', $("[name='price']").val());
            formData.append('content', $("[name='content']").val());

            sendDataToDataBase(formData, '/ajax/addNewProd')

            return false;
        });
})
