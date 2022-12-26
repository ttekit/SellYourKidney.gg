window.addEventListener("load", (e)=>{
   let priceInput =  $("#priceInput");

   let $maxPriceCont =  $(".max-price");
   let $minPriceCont = $(".min-price");

   let maxPrice = $maxPriceCont.text();
   let minPrice = $minPriceCont.text();

   $maxPriceCont.remove();
   $minPriceCont.remove();
   if(!isNaN(maxPrice) && !isNaN(minPrice)){
       priceInput.ionRangeSlider({
           skin: "square",
           min: minPrice,
           max: maxPrice,
           from: minPrice,
           prefix: "$",
           type: "double",
           onFinish: (data)=>{
               let allPosts = $(".product-container");
               allPosts.removeClass("d-none")
               let allPrice = allPosts.find(".price")
               for (let i = 0; i < allPrice.length; i++){
                   if(parseInt(allPrice[i].innerHTML) > data.to || parseInt(allPrice[i].innerHTML) < data.from){
                       $(allPrice[i]).closest(".product-container").addClass("d-none");
                   }
               }
           }
       });
   } else{
       priceInput.remove();
   }
})
