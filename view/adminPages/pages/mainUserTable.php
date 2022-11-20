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

                        $userM = new \Models\userAcc();
                        $acc = $userM->getManyRows();

                        foreach ($acc as $index => $post) {
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
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<script src="/assets/js/userAccWork.js"></script>