<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">

                    <div class="card card-blue ">
                        <div class="card-header">
                            <h3 class="card-title">Author blog manage</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <input type="text" name="Id" readonly value="Id" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="name" readonly value="Blog title"
                                           class="form-control">
                                </div>
                                <div class="col-4">
                                    <input type="text" readonly class="form-control" value="Blog img">
                                </div>
                                <div class="col-3">
                                    <div class="btn-group w-100">
                                        <p>
                                            <a class="btn btn-success" data-toggle="collapse" href="/user/writePost">
                                                Write new post
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        /** @var $data */
                        foreach ($data['posts'] as $index => $post) {
                            ?>
                            <div class="card-body">
                                    <div class="row dataContainer">
                                        <div class="col-1">
                                            <input type="text" readonly value="<?= $post["id"] ?>"
                                                   class="form-control id" placeholder=".col-3">
                                        </div>
                                        <div class="col-2">
                                            <input readonly type="text" value="<?= $post['title'] ?>"
                                                   class="form-control title" placeholder=".col-4">
                                        </div>
                                        <img class="form-control imgContainer" src="<?= $post['img_src'] ?>"
                                             width="200px" height="200px" alt = "<?= $post["img_alt"] ?>"/>

                                        <div class="col-3">
                                            <div class="btn-group w-100">
                                                <button class="btn btn-success col start updateBtn">
                                                    <span>Update</span>
                                                </button>
                                                <button class="btn btn-danger col deleteBtn">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <?php
                        }
                        ?>


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

<script src="/assets/js/User/User/updateUserPosts.js"></script>