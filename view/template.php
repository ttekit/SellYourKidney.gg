<!DOCTYPE html>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- popper js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<!-- bootstrap js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<html lang="<?= /** @var $data */
$data['options']['lang'] ?>">
<?php require_once(COMPONENTS_PATH."head.php") ?>

<body>

<div class="">
    <!--    Preloader-->
    <div id="preloader" class="visible"></div>

    <!-- header section starts -->
    <div class="gradient-choose-container ml-5" data-aos="flip-up">
        <div class="d-flex">
            <button class="choose-gradient-button" id="black-pink" data-aos="flip-left">
            </button>
            <button class="choose-gradient-button" id="black-white" data-aos="flip-left">
            </button>
            <button class="choose-gradient-button" id="red-pink" data-aos="flip-left">
            </button>
            <button class="choose-gradient-button" id="pink-darkpink" data-aos="flip-left">
            </button>
        </div>
    </div>
    <div>

    </div>
    <?php require_once(COMPONENTS_PATH."header.php") ?>
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

<!-- custom js -->
<script src="/assets/js/custom.js"></script>
<!-- chane color of item on nav panel-->
<script src="/assets/js/nav-item-color.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="/assets/js/scrollRevAnimation.js"></script>
</body>
</html>