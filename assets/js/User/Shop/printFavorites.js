window.addEventListener("load", ()=>{

    let cont = $(".favorites-container");
    $.ajax({
        url: "/ajax/getFavorites",
        method: "post",
        data: {
            fav: localStorage.getItem("favorites")
        },
        success: (data)=>{
            data = JSON.parse(data);
            for(let i = 0; i < data.length; i++){
                let elem = $(`<div class="favorites-main-container w-100">
                        <div class="product-image">
                            <img alt="" src="${data[i].img_src}" width="80%" class="product-img-container" />
                        </div>
                        <div class="product-info" style="border:0px solid gray">
                            <h3 class="text-white bold">${data[i].name}</h3>                   
                            <h3 class="product-price">${data[i].price} $</h3>                    
                            <div>
                                <a href="/products/product?device=6" class="product-goto-button">buy now</a>                  
                                <button class="product-remove-button">remove</button>                     
                            </div>
                
                        </div>
                    </div>`)
                elem.find(".product-remove-button").on("click", (e)=>{
                    let locData = localStorage.getItem("favorites");
                    locData = JSON.parse(locData);
                    locData.splice(i, 1);
                    localStorage.setItem("favorites", JSON.stringify(locData));
                    elem.remove();
                })
                cont.append(elem);
            }
        }
    })

})