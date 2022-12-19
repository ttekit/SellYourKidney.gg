window.addEventListener("load", function () {
    let $addToCartBtn = $(".addToCartBtn");
    let cartArr = [];
    $addToCartBtn.on("click", (e) => {
        let product = {
            id: $(e.target).parent().find(".product-id").text(),
            name: $(e.target).parent().find(".name").text().toUpperCase(),
            price: $(e.target).parent().find(".price").text()
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

            let summaryPrise = 0;
            $cartContainer.fadeIn(500);
            hasPressed = true;

            for (let i = 0; i < cartArr.length; i++) {

                let cartItem = $(`<li class="row cart-li">
                    <p>${cartArr[i].name}</p>
                    <p>${cartArr[i].price}</p>
                    <a type="button" class="remove-cart-elem">del</a>
                </li>`);

                cartItem.find(".remove-cart-elem").on("click", () => {
                    summaryPrise -= parseInt(cartArr[i].price);
                    cartArr[i] = null;
                    cartItem.remove();
                    if(summaryPrise <= 0){
                        $buyBtnContainer.remove();
                    }
                    $(".summary-prise").text("summary price: "+summaryPrise+"$");
                })

                $elemContainer.append(cartItem);
                summaryPrise += parseInt(cartArr[i].price);

            }
            if (summaryPrise > 0) {
                paypal.Buttons({
                    createOrder: function(data, actions) {
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
                $(".summary-prise").text("summary price: "+summaryPrise+"$");
            }
        } else {
            $cartContainer.fadeOut(500);
            hasPressed = false;
            $elemContainer.empty();
        }
    })
})
