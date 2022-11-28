<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Управление аккаунтами пользователей</h3>
                        </div>
                        <form
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                                method="post"
                                id="userSearchForm"
                        >
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Искать по Email"
                                       aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append" id="submit">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php


                        /** @var $data */
                        foreach ($data["user"] as $index => $post) {
                            ?>
                            <div class="card-body">
                                <div class="post">
                                    <h2><?= $post["login"] ?></h2>
                                    <div class="row col-2">
                                        <div>
                                            <?= $post["email"] ?>
                                            <?= $post["FullName"] ?>
                                        </div>
                                        <div>
                                            <input class="d-none" id="id" value="<?= $post["id"] ?>"/>
                                            <button class="ban-user">Ban</button>
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
    </section>
</div>
<!-- /.container-fluid -->
<!-- /.content -->
<script src="/assets/js/userAccWork.js"></script>