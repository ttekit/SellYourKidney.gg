window.addEventListener("load", function (){
    let input = $(".search-input");
    let cont = $(".search-help-field");
    $(".search-button").on("click", (e)=>{
        console.log(input.val());
    })
    input.on('input', (e)=>{
        console.log("CHANGE");
        $.ajax({
            url: "/ajax/searchProduct",
            method: "post",
            data: {
                "value": $(e.target).val()
            },
            success: (data)=>{
                data = JSON.parse(data);
                cont.empty();
                for(let i = 0; i < data.length; i++){
                    cont.append(`<a href="/products/product?device=${data[i].id}" class="search-elem">
                                    ${data[i].name}
                    </a>`);
                }
            },
            error: (err)=>{
                alert(err)
            }
        })
    })
})