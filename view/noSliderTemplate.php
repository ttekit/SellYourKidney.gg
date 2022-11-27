<!DOCTYPE html>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- popper js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<!-- bootstrap js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>


<?php use Models\Navigate; ?>
<html lang="<?= /** @var $data */
$data['options']['lang']?>">

<?php require_once(COMPONENTS_PATH."head.php") ?>

<body>



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
<div class="gradient-choose-container ml-5" data-aos="flip-up">
</div>
<button class="choose-gradient-button" id="custom-bg" data-aos="flip-left">
</button>

<!-- end header section -->
<main>
    <?php /** @var $contentView */
    require_once $contentView; ?>
</main>
<!-- footer start -->
<?php require_once(COMPONENTS_PATH."footer.php") ?>
<!-- footer end -->
<div class="cpy_">
    <p>© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
</div>

<!-- custom js -->
<script src="/assets/js/custom.js"></script>
<!-- chane color of item on nav panel-->
<script src="/assets/js/nav-item-color.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/grapick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/roundSlider/1.3.2/roundslider.min.js"></script>
</body>
</html>