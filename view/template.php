<!DOCTYPE html>

<html lang="<?= /** @var $data */
$data['options']['lang'] ?>">
<?php require_once(COMPONENTS_PATH . "head.php") ?>

<body>

<div class="">
    <div id="gp" class="color-picker d-none">
        <div class="container">
            <div class="grapick-cont">
                <div id="grapick"></div>
                <div class="inputs">
                    <div id="slider"></div>
                </div>
                <div class="buttons">
                    <button class="submit">submit</button>
                    <button class="cancel">cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--    Preloader-->
    <div id="preloader" class="visible"></div>
    <!-- header section starts -->
    <div class="gradient-choose-container ml-5" data-aos="flip-up">
    </div>
    <button class="choose-gradient-button" id="custom-bg" data-aos="flip-left">
    </button>
    <div>

    </div>
    <?php require_once(COMPONENTS_PATH . "header.php") ?>
</div>


<!-- end header section -->
<!-- slider section -->
<div data-aos="flip-down">
    <?php require_once(COMPONENTS_PATH . "slider.php") ?>
</div>

<!-- end slider section -->

<main>
    <div data-aos="flip-up">
        <?php /** @var $contentView */
        require_once $contentView; ?>
    </div>
</main>


<!-- footer start -->
<div data-aos="flip-right">
    <?php require_once(COMPONENTS_PATH . "footer.php") ?>'
</div>
<!-- footer end -->
<div class="cpy_">
    <p>© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
</div>

<?php require_once(COMPONENTS_PATH . "scripts.php") ?>'

</body>
</html>