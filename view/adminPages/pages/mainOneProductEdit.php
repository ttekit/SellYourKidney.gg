<div class="content-wrapper adminBlogCont">
    <!-- Main content -->
    <section class="content col-12">
        <div class="row">
            <div class="col-md-12 file-input">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Logo</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        Отправить этот файл: <input name="userfile" type="file" value="<?= /** @var $data */
                        $data["prodData"]["img_src"] ?>"/>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <form method="post" action="/admin/updateProd" class="row">
                <input type="text" name="id" id="id" class="d-none" value="<?=
                $data["prodId"] ?>"/>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" name="name" class="form-control"
                                       value="<?= $data["prodData"]["name"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Price</label>
                                <input id="inputDescription" class="form-control" name="price" type="number"
                                       value="<?= $data["prodData"]["price"] ?>"/>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Content</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea id="summernote" class="main-content"
                                          name="content"> <?= $data["prodData"]["content"] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card card-info">

                    <!-- /.card -->
                </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="/admin/" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Save Changes" id="submit" class="btn btn-success float-right">
            </div>
        </div>
    </section>
    </form>
    <!-- /.content -->
</div>

<script src="/assets/js/saveNewPostImage.js"></script>