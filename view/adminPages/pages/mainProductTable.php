<div class="content-wrapper w-100">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class=" pt-3 w-100">

                    <div class="card card-blue d-flex">
                        <div class="card-header">
                            <h3 class="card-title">Управление продуктами в магазине</h3>
                            <a href="./AddProd/" class="border-0">
                                <button class="border-3 bg-success text-white border-success ">Add New Prod</button>
                            </a>
                        </div>
                        <div class="row m-3 products-container">
                            <?php

                            /** @var $data */
                            foreach ($data["allProd"]
                                     as $index => $post) {
                                ?>
                                <div class="card-body col-5">
                                    <div class="product">
                                        <h2><?= $post["name"] ?></h2>
                                        <h3><?= $post["price"] ?></h3>
                                        <div class="row">
                                            <img class='product-img-box-manage' src="<?= $post["img_src"] ?>"
                                                 width="450px"
                                                 alt="<?= $post["img_alt"] ?>">
                                            <div class="post-manage flex-column">
                                                <div class="hidden id"><?= $post["id"] ?></div>
                                                <button href="#"
                                                        class="btn btn-info btn-lg product-edit-button blog-btn">
                                                    <i class="fas fa-info-circle">Edit</i>
                                                </button>
                                                <button href="#"
                                                        class="btn btn-danger btn-lg product-delete-button blog-btn">
                                                    <i class="fas fa-trash">Delete</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->

<script src="/assets/js/productwork.js"></script>