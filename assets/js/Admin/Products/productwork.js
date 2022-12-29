window.addEventListener("load", function (){
    let $btnsContainer = $(".post-manage");
    let $btnsEdit = $btnsContainer.find(".product-edit-button");
    let $btnsDelete = $btnsContainer.find(".product-delete-button");


    $btnsEdit.on("click", function (e){
        let $prodId = $(e.target).closest("div").find(".id").text();
        window.location = "/admin/OneProductEdit?prodId="+$prodId;
    })

    $btnsDelete.on("click", function (e){
        let $container = $(e.target).closest("div");
        let $prodId = $container.find(".id").text();
        $.ajax({
            url: "/ajax/deleteOneProduct",
            method: "POST",
            data: {
                "prodId": $prodId
            },
            beforeSend: function() {
                $('#preloader').fadeIn(500);
            },
            complete: function() {
                $('#preloader').fadeOut(500);
            },
            success: () => {
                $container.parent("div").parent("div").remove();
            },
            error: (msg) => {
                alert(msg);
            }
        })
    })
});