<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>

                <!-- Post header-->
                <header class="post_header mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= /** @var $data */
                        $data["pageData"]["title"] ?></h1>
                    <!-- Post meta content-->
                    <div class="post_date_of_publication text-muted fst-italic mb-2">Posted on <?= $data["pageData"]["dateOfPublication"] ?> by
                        Start Bootstrap
                    </div>
                    <!-- Post categories-->
                    <div class="hidden" id="post-id"><?= $data["pageData"]["id"] ?></div>
                    <div class="post_tags badge bg-secondary text-decoration-none link-light"><?= $data["pageData"]["tags"] ?></div>

                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="<?= $data["pageData"]["imgSrc"] ?>"/></figure>
                <!-- Post content-->
                <section class="mb-5">

                    <p class="post_text fs-5 mb-4"><?= $data["pageData"]["content"] ?></p>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="comments-form">
                        <form action="/ajax/saveComment" method="post" id="comment-form" class="form-horizontal form-wizzard">
                            <h3 class="h3">Leave a comment</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input name="login" type="text" class="form-control" placeholder="Enter your name ..."/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" placeholder="Enter your email ..."/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" rows="8" class="form-control" placeholder="Your comment ..."></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post comment" class="btn btn-default sumbit-btn"/>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">

                    </div>


                </div>
            </section>
        </div>
        <div class="col-lg-4">
            <!-- Categories widget-->
            <div class="mb-4">
                <p style="color: white">Categories</p>
                <div class="row">
                    <div class="post_categories badge bg-secondary text-decoration-none link-light"><?= $data["pageData"]["categories"] ?></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/blogComments.js"></script>
    <script src="/assets/js/blogPost.js"></script>

