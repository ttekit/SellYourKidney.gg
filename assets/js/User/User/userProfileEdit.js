window.addEventListener("load", function () {
    const link = "/ajax/updateUserData";

    let $addNewSocButton = $(".add-new-soc-button");
    let $container = $(".soc-media-group");
    let $deleteSocLinkButton = $(".delete-soc-link-button");
    let fileInput = $('input[type=file]');

    fileInput.on('change', prepareUpload);

    $addNewSocButton.on("click", () => {
        $container.append(`
            <li class="inputs-container list-group-item d-flex justify-content-between align-items-center p-3">
                    <input type="text" class="mb-0" placeholder="Name" Name="Name"/>
                    <input type="text" class="mb-0" placeholder="Url" name="Url"/>
                    <input type="button" class="mb-0 border-0 appendSocDataToArray" value="Add"/>
            </li>
        `)

        $(".appendSocDataToArray").on("click", () => {
            let allInputs = $(".inputs-container input[type=text]");
            $.ajax({
                type: "POST",
                url: "/ajax/addNewSocLinkData",
                data: {
                    name: allInputs[0].value,
                    link: allInputs[1].value,
                    userId: $(".id-container").text()
                },
                success: function (msg) {
                    msg = JSON.parse(msg);
                    allInputs.val("");
                    $container.append(`
                         <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                              <a href=${msg.link}><p class="mb-0">${msg.name}</p></a>
                         </li>
                    `);
                },
                beforeSend: function() {
                    $('#preloader').fadeIn(500);
                },
                complete: function() {
                    $('#preloader').fadeOut(500);
                },
            });
        })
    })

    $deleteSocLinkButton.on("click", (e) => {
        let $parentContainer = $(e.target).parent().parent();
        let idToDelete = $parentContainer.find(".soc-link-id-container").val();
        $parentContainer.css("color", "red");
        $.ajax({
            type: "POST",
            url: "/ajax/removeSocLinkById",
            data: {
                id: idToDelete
            },
            success: function (msg) {
                if(msg[0] == "1"){
                    $parentContainer.remove();
                }
            },
            beforeSend: function() {
                $('#preloader').fadeIn(500);
            },
            complete: function() {
                $('#preloader').fadeOut(500);
            },
        });
    });


    $(".main-form").submit((e)=>{
        let cont = $(e.target);
        let inputs = cont.find("input");
        let formData = new FormData();

        for (let i = 1; i < inputs.length; i++){
            if(inputs[i].name != ""){
                formData.set(inputs[i].name, inputs[i].value)
            }
        }

        if(cropper){
            cropper.getCroppedCanvas({
                width: 100,
                height: 100,
            }).toBlob((blob)=>{
                formData.set("avatar", blob);
                sendDataToDataBase(formData, link);
            })
        }else{
            sendDataToDataBase(formData, link);
        }


        return false;
    })

})