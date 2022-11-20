window.addEventListener("load", function (){
    let $btnsContainer = $(".post-manage");
    let $btnsUpdate = $btnsContainer.find(".blog-update-button");
    let $btnsEdit = $btnsContainer.find(".blog-edit-button");
    let $btnsDelete = $btnsContainer.find(".blog-delete-button");
    let $status = $btnsContainer.find(".form-control");

    $btnsEdit.on("click", function (e){
        $postId = $(e.target).closest("div").find(".id").text();
        window.location = "/admin/OnePostEdit?postId="+$postId;
    })

    $btnsDelete.on("click", function (e){

        let $container = $(e.target).closest("div");
        let $postId = $container.find(".id").text();

        $.ajax({
            url: "/ajax/deleteOnePost",
            method: "POST",
            data: {
                "postId": $postId
            },
            success: (data) => {
                console.log(data);
                if(data=="POST_REMOVED"){
                    $container.parent("div").parent("div").remove();
                }
            },
            error: (msg) => {
                alert(msg);
            }
        })
    })

    $btnsUpdate.on("click", function (e){

        let $container = $(e.target).closest("div");
        let $postId = $container.find(".id").text();
        let newData = $container.find(".form-control option:selected").val();

        $.ajax({
            url: "/ajax/updatePostStatus",
            method: "POST",
            data: {
                "postId": $postId,
                "newStatus": newData
            },
            success: (data) => {
                console.log(data);

            },
            beforeSend: function() {
                $('#preloader').fadeIn(500);
            },
            complete: function() {
                $('#preloader').fadeOut(500);
            },
            error: (msg) => {
                alert(msg);
            }
        })

        let updateButton = $container.find(".blog-update-button");
        updateButton.attr("disabled", true);
    });

    $status.change(function (e){
        let updateButton =  $(e.target).closest("div").find(".blog-update-button");
        updateButton.attr("disabled", false)
    })
});