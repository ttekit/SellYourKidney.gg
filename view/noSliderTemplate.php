<!DOCTYPE html>



<?php use Models\Navigate; ?>
<html lang="<?= /** @var $data */
$data['options']['lang'] ?>">

<?php require_once(COMPONENTS_PATH . "head.php") ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
<?php require_once(COMPONENTS_PATH."header.php") ?>
<?php require_once(COMPONENTS_PATH . "navbar.php") ?>
<!-- end header section -->
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

<?php require_once(COMPONENTS_PATH . "scripts.php") ?>'

<script src="https://apis.google.com/js/platform.js" async defer></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Round slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/roundSlider/1.3.2/roundslider.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
</body>
</html>