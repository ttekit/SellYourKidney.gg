<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Управление контакт ас</h3>
                        </div>
                        <?php

                        /** @var $data */
                        foreach ($data["contactUs"] as $index => $message) {
                            ?>
                            <div class="card-body">
                                <div class="post">
                                    <h2><?= $message["name"] ?></h2>
                                    <div class="row col-2">
                                        <div>
                                            <div class="email"> <?= $message["email"] ?></div>
                                            <div class="message"> <?= $message["message"] ?></div>
                                        </div>
                                        <div>
                                            <input class="d-none" id="id" value="<?= $message["id"] ?>"/>
                                            <button class="ban-user-message">Delete</button>
                                            <button class="answ-user">Answ</button>
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
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="/assets/js/Admin/Contact/buttonsActions.js"></script>