window.addEventListener("load", function () {
    let input = $(".search-input");
    let cont = $(".search-help-field");
    $(".search-button").on("click", (e) => {
        console.log(input.val());
    })

    input.keyup($.debounce(500, () => {
        $.ajax({
            url: "/ajax/searchProduct",
            method: "post",
            data: {
                "value": input.val()
            },
            success: (data) => {
                data = JSON.parse(data);
                cont.empty();
                for (let i = 0; i < data.length; i++) {
                    if(i <= 5){
                        cont.append(getContainerElem(data[i]));
                    }
                }
            },
            error: (err) => {
                alert(err)
            },
            beforeSend: () => {
                input.addClass("loading");
            },
            complete: () => {
                input.removeClass("loading")
            }
        })
    }));


    function getContainerElem(data) {
        return `
                <div class="search-elem-container">
                                    <img src="${data.img_src}" alt="${data.img_alt}" width="50px">  
                                    <a href="/products/product?device=${data.id}" class="search-elem">
                                                    ${data.name}
                                    </a>
                </div>`
    }
})