
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="/"><img width="250"
                                                  src="/<?php echo $data['options']['logo'] ?>"
                                                  alt="#"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <ul class="collapse navbar-collapse navbar-nav" id="navbarSupportedContent">

                <?php
                $navigate = $data["navigation"];
                foreach ($navigate as $key => $navElem) {
                    if (count($navElem["childs"]) == 0) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $navElem["title"] ?>"
                               href="<?= $navElem["href"] ?>"><?= $navElem["title"] ?></a>
                        </li>
                        <?php
                    } else { ?>
                        <li class="nav-item dropdown"><a href="<?= $navElem['href'] ?>"
                                                         class="nav-link dropdown-toggle" data-toggle="dropdown"
                                                         role="button" aria-expanded="true">
                                        <span class="nav-label"><?= $navElem["title"] ?><span
                                                class="caret"></span></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($navElem["childs"] as $childKey => $child) {
                                    ?>
                                    <li><a href="<?= $child['href'] ?>"><?= $child["title"] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php
                    }
                } ?>
                <?php require_once(COMPONENTS_PATH . "navbar.php") ?>
            </ul>
        </nav>
    </div>
</header>