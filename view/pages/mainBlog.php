<!-- inner page section -->
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Blog List</h3>
                    <div class="bolg-filters">
                        <div class="sortNode">
                            <div class="tag-sort">
                                <div class="categories-sort-header">
                                    TAGS
                                </div>

                                <div class="tag-sort-content">
                                    <?php
                                    /** @var $data */
                                    \App\Pagination::printTagsPanel($data["posts"]["tags"], $data["href"]);
                                    ?>
                                </div>

                            </div>
                            <div class="categories-sort">
                                <div class="categories-sort-header">
                                    CATEGORIES
                                </div>
                                <div class="categories-sort-content">
                                    <?php
                                    foreach ($data["posts"]["categories"] as $key => $value) {
                                        echo "<button class='filterBtn'><h6>" . $value["category"] . ".</h6></button>";
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="blog-pagination-container">
    <h1>Pagination</h1>
    <div class="blog-pagination-filter">
        <a class="dropdown-item" href="/blog/?count=3/">3</a>
        <a class="dropdown-item" href="/blog/?count=5/">5</a>
        <a class="dropdown-item" href="/blog/?count=10">10</a>
        <a class="dropdown-item" href="/blog/?count=15">15</a>
    </div>
</div>
<div class="blog">
    <div class="blog-content">
        <div class="blog-context row">
            <?php
            $postContent = $data["blog"]["posts"];
            if (isset($data["pagination"]["page"])) {
                $starterPosition = $data["pagination"]["page"];
            } else {
                $starterPosition = 0;
            }
            $tmp = [];
            foreach ($postContent as $key => $value) {
                if (isset($data["blog"]["filter"])) {
                    if ($value["tagName"] == $data["blog"]["filter"]) {
                        array_push($tmp, $value);
                    }
                } else {
                    array_push($tmp, $value);
                }
            }
            $postContent = $tmp;
            unset($tmp);
            for ($i = $starterPosition * 3; $i < (int)$data["pagination"]["postsCount"] + $starterPosition * 3; $i++) {
                if (isset($postContent[$i])) {
                    \App\Pagination::printElem($postContent[$i]);
                }
            }
            echo "<div class = 'page-count-container'>";
            ?>
        </div>
    </div>
</div>

<!--Pagination controll buttons-->
<?php if ($data["pagination"]["postsCount"] < count($postContent)) {
    \App\Pagination::printControlPanel($data["pagination"], count($postContent), $data["href"]);
} ?>