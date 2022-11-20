<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">
                    <div class="card card-blue ">
                        <div class="card-header">
                            <h3 class="card-title">Управление постами в блоге</h3>
                        </div>
                        <?php
                        $postM = new \Models\post();
                        $posts = $postM->executeQuery("SELECT blogposts.id, blogposts.title, blogposts.state, blogposts.imgSrc, blogposts.altSrc FROM blogposts");
                        $data["status"] = ["created", "published", "archived"];
                        foreach ($posts

                                 as $index => $post) {
                            ?>
                            <div class="card-body">
                                <div class="post">
                                    <h2><?= $post["title"] ?></h2>
                                    <div class="row">
                                        <img class='blog-img-box-manage' src="<?= $post["imgSrc"] ?>" width="450px"
                                             alt="<?= $post["altSrc"] ?>">
                                        <div class="post-manage flex-column">
                                            <div class="hidden id"><?= $post["id"] ?></div>
                                            <button href="#" class="btn btn-info btn-lg blog-edit-button blog-btn">
                                                <i class="fas fa-info-circle">Edit</i>
                                            </button>
                                            <button href="#" class="btn btn-info btn-lg blog-update-button blog-btn"
                                                    disabled>
                                                <i class="fas fa-info-circle">Update</i>
                                            </button>
                                            <button href="#" class="btn btn-danger btn-lg blog-delete-button blog-btn">
                                                <i class="fas fa-trash">Delete</i>
                                            </button>
                                            <select class="form-control">
                                                <?php
                                                foreach ($data["status"] as $key => $value) {
                                                    if (!strcmp($value, $post["state"])) {
                                                        echo "<option selected>$value</option>";
                                                    } else {
                                                        echo "<option>$value</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<script src="/assets/js/postwork.js"></script>