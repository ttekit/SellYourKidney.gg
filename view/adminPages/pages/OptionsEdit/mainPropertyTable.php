<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">

                    <div class="card card-blue ">
                        <div class="card-header">
                            <h3 class="card-title">Управление настройками сайта</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <input type="text" name="Id" readonly value="Id" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="name" readonly value="Название свойства"
                                           class="form-control">
                                </div>
                                <div class="col-4">
                                    <input type="text" readonly class="form-control" value="Значение свойства">
                                </div>
                                <div class="col-2">
                                    <input type="text" readonly class="form-control" value="Группирование">
                                </div>
                                <div class="col-3">
                                    <div class="btn-group w-100">
                                        <p>
                                            <a class="btn btn-success" data-toggle="collapse" href="#collapseExample"
                                               role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Создать новое свойство
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div class="card-body">
                                        <form action="/admin/addNewOption" method="post">
                                            <div class="row">
                                                <div class="col-2">
                                                    <input type="text" name="name" placeholder="Название свойства"
                                                           class="form-control">
                                                </div>
                                                <div class="col-6">
                                                    <textarea rows="1" name="value" class="form-control"> </textarea>
                                                </div>
                                                <div class="col-2">
                                                    <input type="text" name="group" class="form-control"
                                                           placeholder="Группирование">
                                                </div>
                                                <div class="col-2"
                                                <div class="btn-group w-100">
                                                    <p>
                                                        <button class="btn btn-success" aria-controls="collapseExample">
                                                            Создать
                                                        </button>
                                                        <button type="reset" class="btn btn-danger"
                                                                aria-controls="collapseExample">
                                                            Отмена
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        $tmp = [];
                        /** @var $data */
                        for ($i = 0; $i < count($data["options"]); $i++) {
                            if (isset($data["options"][$i]["id"])) {
                                array_push($tmp, $data["options"][$i]);
                            }
                        }
                        $data["options"] = $tmp;
                        unset($tmp);
                        foreach ($data['options'] as $index => $option) {
                            ?>
                            <div class="card-body">
                                <form action="/admin/updateRow" method="post">
                                    <div class="row">
                                        <div class="col-1">
                                            <input type="text" name="id" readonly value="<?= $option["id"] ?>"
                                                   class="form-control" placeholder=".col-3">
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="name" value="<?= $option['name'] ?>"
                                                   class="form-control" placeholder=".col-4">
                                        </div>
                                        <div class="col-4">
                                                <textarea rows="4" name="value"
                                                          class="form-control"><?= $option['value'] ?></textarea>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="group" class="form-control"
                                                   value="<?= $option['group'] ?>">
                                        </div>
                                        <div class="col-3">
                                            <div class="btn-group w-100">
                                                <button type="submit" class="btn btn-success col start">
                                                    <span>Update</span>
                                                </button>
                                                <button type="reset" class="btn btn-danger col cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancel</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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