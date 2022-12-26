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
                                    <?php foreach ($data["posts"]["tags"] as $key => $val) {
                                        ?>
                                        <div>
                                            <a>
                                                <button class="tag-btn filterBtn">
                                                    <h6><?= $val["tag"] ?></h6>
                                                </button>
                                            </a>
                                        </div>
                                        <?
                                    } ?>

                                </div>

                            </div>
                            <div class="categories-sort">
                                <div class="categories-sort-header">
                                    CATEGORIES
                                </div>
                                <div class="categories-sort-content">
                                    <?php foreach ($data["posts"]["categories"] as $key => $val) {
                                        ?>
                                        <div>
                                            <a>
                                                <button class="category-btn filterBtn">
                                                    <h6><?= $val["category"] ?></h6>
                                                </button>
                                            </a>
                                        </div>
                                        <?
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
        <button class="dropdown-item blog-pagination-button">3</button>
        <button class="dropdown-item blog-pagination-button" href="/blog/?count=5/">5</button>
        <button class="dropdown-item blog-pagination-button" href="/blog/?count=10">10</button>
        <button class="dropdown-item blog-pagination-button" href="/blog/?count=15">15</button>
    </div>
</div>
<div class="blog">
    <div class="blog-content">
        <div class="blog-context row blog-container">

        </div>
        <div class="page-choose-container">
            <button class="go-first-page swipe-page-button"><<</button>
            <button class="go-prew-page swipe-page-button"><</button>
            <div class="numeric-buttons-container">
            </div>
            <button class="go-next-page swipe-page-button">></button>
            <button class="go-last-page swipe-page-button">>></button>
        </div>
    </div>
</div>

    <script src="/assets/js/User/Blog/blogWork.js"></script>