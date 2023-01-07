const sendDataToDataBase = (formData, link) => {
    $.ajax({
        url: link,
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
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

