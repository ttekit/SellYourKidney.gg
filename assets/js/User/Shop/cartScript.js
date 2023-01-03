window.addEventListener("load", function () {
    let $addToCartBtn = $(".addToCartBtn");
    let cartArr = [];
    $addToCartBtn.on("click", (e) => {
        let product = {
            id: $(e.target).parent().find(".product-id").text(),
            name: $(e.target).parent().find(".name").text().toUpperCase(),
            price: $(e.target).parent().find(".price").text(),
            prodCount: 1
        };
        cartArr.push(product);
    })

    let $cartButton = $(".cart-button");
    let hasPressed = false;
    let $cartContainer = $(".cart-block");

    $cartButton.on("click", () => {

        let $elemContainer = $cartContainer.find("ul");
        let $buyBtnContainer = $(`<div id="paypal-button-container" class="buy-all-button"> </div>`)

        $elemContainer.append($buyBtnContainer);

        if (hasPressed === false) {
            if (cartArr.length > 0) {
                let summaryPrise = 0;
                $cartContainer.fadeIn(500);
                hasPressed = true;

                for (let i = 0; i < cartArr.length; i++) {
                    let cartItem = $(`
                <li class="cart-li">
                    <div class="count-cart-elem">${cartArr[i].prodCount}</div>
                    <div class="cart-product-name">${cartArr[i].name}
                        <span class="tooltiptext">${cartArr[i].name}</span>
                    </div>
                    <p class="cart-product-price">${cartArr[i].price}</p>
                    <div class="count-cart-elems">
                        <div class="count-cart-buttons">
                            <a type="button" class="add-cart-elem"></a>
                            <a type="button" class="decrease-cart-elem"></a>                          
                        </div>
      
                    </div>
                    <a type="button" class="remove-cart-elem">x</a>
                </li>`);

                    cartItem.find(".remove-cart-elem").on("click", () => {
                        summaryPrise -= parseInt(cartArr[i].price) * parseInt(cartArr[i].prodCount);
                        cartArr[i] = null;
                        cartItem.remove();
                        if (summaryPrise <= 0) {
                            cartArr = [];
                            $cartContainer.fadeOut(500);
                            hasPressed = false;
                            $elemContainer.empty();
                        }
                        $(".summary-prise").text("summary price: " + summaryPrise + "$");
                    })

                    cartItem.find(".add-cart-elem").on("click", () => {
                        summaryPrise += parseInt(cartArr[i].price);
                        cartArr[i].prodCount++;
                        cartItem.find(".count-cart-elem").text(cartArr[i].prodCount);
                        $(".summary-prise").text("summary price: " + summaryPrise + "$");
                    });

                    cartItem.find(".decrease-cart-elem").on("click", () => {
                        if (cartArr[i].prodCount > 1) {

                            cartArr[i].prodCount--;
                            summaryPrise -= parseInt(cartArr[i].price);

                            cartItem.find(".count-cart-elem").text(cartArr[i].prodCount);
                            $(".summary-prise").text("summary price: " + summaryPrise + "$");
                        }

                    })


                    $elemContainer.append(cartItem);
                    summaryPrise += parseInt(cartArr[i].price);

                }
                if (summaryPrise > 0) {
                    paypal.Buttons({
                        createOrder: function (data, actions) {
                            // Set up the transaction
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: summaryPrise
                                    }
                                }]
                            });
                        }
                    }).render('#paypal-button-container');
                    $(".summary-prise").text("summary price: " + summaryPrise + "$");
                }
            }
        } else {
            $cartContainer.fadeOut(500);
            hasPressed = false;
            $elemContainer.empty();
        }
    })
})
