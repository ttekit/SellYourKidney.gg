<div class="product-main-container w-100">
    <div class="product-image">
        <img alt="" src="<?= /** @var $data */
        $data["pageData"]["img_src"] ?>" width="80%" class="product-img-container" />
    </div>
    <div class="product-info" style="border:0px solid gray">
        <h3 class="text-white bold"><?= strtoupper($data["pageData"]["name"]) ?></h3>
        <h3 class="product-price" style="margin-top:0px;"><?= $data["pageData"]["price"] ?>$</h3>

        <div class="section" style="padding-bottom:20px;">
            <div id="paypal-button-container"></div>
        </div>
        <div class="text-center text-white product-description">
            <?= $data["pageData"]["content"] ?>
        </div>
    </div>

</div>

<script src="https://www.paypal.com/sdk/js?client-id=Ad0ypubZ_l3K1qOGKieJ-H3Ia1oBMGYOl8cL57rrkl3xLa0Nzo-OtKpZquP2SNMiFOwj6Vol0ZIlJJuW&components=buttons"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Set up the transaction
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: parseInt($(".product-price").text())
                    }
                }]
            });
        }
    }).render('#paypal-button-container');
</script>