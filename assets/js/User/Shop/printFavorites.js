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
                let elem = getContainerElem(data[i])
                elem.find(".removeFromFavorites").on("click", (e)=>{
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
    function getContainerElem(data) {
        return $(`
                <div class="favorites-main-container">
                    <div class="favorites-info-container">
                        <div class="img-container">
                            <img src="${data.img_src}" alt="${data.img_alt}" class="favorites-img" width="200px" height="200px">
                        </div>
                        <div class="favorites-detail-container">
                            <div class="title">
                                ${data.name}
                            </div>
                            <div class="price">
                                ${data.price}$
                            </div>
                        </div>
                    </div>
                    <div class="favorites-button-container">
                        <button class="removeFromFavorites">Remove</button>
                       <a href="/products/product?device=${data.id}" class="buy-now-button">Buy Now</a>
                    </div>
                </div>
                `);
    }

})