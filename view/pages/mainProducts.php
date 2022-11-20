<!-- end inner page section -->
<!-- product section -->

<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            <?php
            /** @var $data */
            foreach ($data["products"] as $key => $value) {
                ?>
                <div class=" col-sm-6 col-md-4 col-lg-3">
                    <div class="product-box box">
                        <div class="option_container">
                            <div class="options">
                                <div class="d-none product-id">
                                    <?php echo $value["id"] ?>
                                </div>
                                <h5 class="name">
                                    <?php echo $value["name"] ?>
                                </h5>
                                <h6 class="price">
                                    <?php echo $value["price"] ?>$
                                </h6>
                                <a type="button" class="option1 addToCartBtn bubbly-button">
                                    Add to cart
                                </a>
                                <a href="/products/product?device=<?php echo $value["id"] ?>" class="option2">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="<?php echo $value["img_src"] ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5 class=".name">
                                <?php echo $value["name"] ?>
                            </h5>
                            <h6 class="ml-2 .price">
                                <?php echo $value["price"] ?>$
                            </h6>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script src="../../assets/js/cartScript.js"></script>
<script src="../../assets/js/addToCartAnimation.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=Ad0ypubZ_l3K1qOGKieJ-H3Ia1oBMGYOl8cL57rrkl3xLa0Nzo-OtKpZquP2SNMiFOwj6Vol0ZIlJJuW&components=buttons"></script>
