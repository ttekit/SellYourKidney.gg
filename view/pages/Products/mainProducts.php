<!-- end inner page section -->
<!-- product section -->
<div class="max-price d-none"><?= /** @var $data */
    $data["maxPrice"]?></div>
<div class="min-price d-none"><?=
    $data["minPrice"]?></div>

<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <div class="search">
                <input class="search-input" placeholder="Input product name">
                <div class="search-help-field">
                </div>
                <?php  if(isset($data["page"])){?>
                <div class="pagination-count-container">
                    <p>Product on page count</p>
                    <div class="pagination-buttons-count-container">
                        <a class="pagination-count-button" href="/products/?count=4">4</a>
                        <a class="pagination-count-button" href="/products/?count=8">8</a>
                        <a class="pagination-count-button" href="/products/?count=12">12</a>
                        <a class="pagination-count-button" href="/products/?count=16">16</a>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
        <input type="text" id="priceInput" name="price" value=""/>

        <div class="row">
            <?php
            /** @var $data */
            foreach ($data["products"] as $key => $value) {
                ?>
                <div class="product-container col-sm-6 col-md-4 col-lg-3">
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
                                <a type="button" class="addToFavorites bubbly-button">
                                    Add to favorites
                                </a>
                                <a type="button" class="option1 addToCartBtn bubbly-button" id="<?php echo $value["id"] ?>">
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

            <?php }
            if(isset($data["page"])){
                ?>
                <div class="page-choose-container">
                    <a href="/products/?count=<?= $data["count"] ?>&page=1" class="go-first-page swipe-page-button"><<</a>
                    <?php if ($data["page"] - 1 > 0) {
                        ?>
                        <a href="/products/?count=<?= $data["count"] ?>&page=<?= $data["page"] - 1 ?>"
                           class="go-prew-page swipe-page-button"><</a>
                        <?
                    } ?>
                    <div class="numeric-buttons-container">
                        <?php
                        for ($i = 0; $i < $data["pageCount"]; $i++) {
                            ?>
                            <button class="go-first-page swipe-page-button">
                                <a href="/products/?count=<?= $data["count"] ?>&page=<?= $i+1 ?>" ><?=$i+1?>
                                </a>
                            </button>
                            <?
                        }
                        ?>
                    </div>
                    <?php if ($data["page"] + 1 <= $data["pageCount"]) {
                        ?>
                        <a href="/products/?count=<?= $data["count"] ?>&page=<?= $data["page"] + 1 ?>"
                           class="go-next-page swipe-page-button">></a>
                        <?
                    } ?>
                    <a href="/products/?count=<?= $data["count"] ?>&page=<?=$data["pageCount"]?>" class="go-last-page swipe-page-button">>></a>
                </div>
            <?
            }
            ?>


        </div>
    </div>
</section>
<script src="../../../assets/js/User/Shop/productsFavorites.js"></script>
<script src="../../../assets/js/User/Shop/cartScript.js"></script>
<script src="../../../assets/js/User/Shop/priceWork.js"></script>
<script src="../../../assets/js/User/Shop/productSearch.js"></script>
<script src="../../../assets/js/User/Shop/addToCartAnimation.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=Ad0ypubZ_l3K1qOGKieJ-H3Ia1oBMGYOl8cL57rrkl3xLa0Nzo-OtKpZquP2SNMiFOwj6Vol0ZIlJJuW&components=buttons"></script>
