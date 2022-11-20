<!DOCTYPE html>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- popper js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<!-- bootstrap js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>

<html lang="<?= /** @var $data */
$data['options']['lang'] ?>">
<?php require_once(COMPONENTS_PATH."head.php") ?>

<body>
<div class="">
    <!--    Preloader-->
    <div id="preloader" class="visible"></div>

    <!-- header section starts -->
    <div class="gradient-choose-container ml-5">
        <div class="d-flex">
            <button class="choose-gradient-button" id="black-pink">
            </button>
            <button class="choose-gradient-button" id="black-white">
            </button>
            <button class="choose-gradient-button" id="red-pink">
            </button>
            <button class="choose-gradient-button" id="pink-darkpink">
            </button>
        </div>
    </div>

    <?php require_once(COMPONENTS_PATH."header.php") ?>
</div>


<!-- end header section -->
<!-- slider section -->
<?php require_once(COMPONENTS_PATH . "slider.php") ?>
<!-- end slider section -->

<main>
    <?php /** @var $contentView */
    require_once $contentView; ?>
</main>
<!-- footer start -->
<?php require_once(COMPONENTS_PATH . "footer.php") ?>
<!-- footer end -->
<div class="cpy_">
    <p>© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
</div>

<!-- custom js -->
<script src="/assets/js/custom.js"></script>
<!-- chane color of item on nav panel-->
<script src="/assets/js/nav-item-color.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>