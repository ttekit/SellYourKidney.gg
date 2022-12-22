<?php
/** @var $data */
?>

<div class="content-wrapper adminBlogCont">
    <!-- Main content -->
    <form class="send-data-form" enctype="multipart/form-data">
        <input name="id" id="id" class="d-none" value="<?= $data["postData"]["id"] ?>"/>
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
                            Отправить этот файл: <input name="userfile" type="file"
                                                        value="<?= $data["postData"]["img_src"] ?>"/>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
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
                                <label for="inputName">Title</label>
                                <input type="text" id="inputName" name="title" class="form-control"
                                       value="<?= $data["postData"]["title"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Slogan</label>
                                <textarea id="inputDescription" class="form-control" name="slogan"
                                          rows="4"><?= $data["postData"]["slogan"] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Categories</label>
                                <div class="categories">
                                    <div class="categories-active-categories">
                                    </div>
                                    <?php
                                    $catM = new \Models\categories();
                                    $allCats = $catM->getAllCategories();
                                    $activeCategory = $catM->getCategoryByPostId($data["postData"]["id"]);
                                    $activeCategory = $activeCategory[0];
                                    foreach ($allCats as $key => $value) {
                                        if ($value["category"] != $activeCategory["category"]) {
                                            ?>
                                            <a type="button" class="addNewCategoryBtn"><?= $value["category"] ?></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a type="button"
                                               class="addNewCategoryBtn pressed"><?= $value["category"] ?></a>
                                            <?
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputProjectLeader">Tags</label>
                                <div class="tags">
                                    <?php
                                    $tagM = new \Models\tags();
                                    $allTags = $tagM->getManyRows();
                                    $activeTags = $tagM->getByPostId($data["postData"]["id"]);
                                    $flag = false;
                                    foreach ($allTags as $key => $value) {
                                        $flag = true;
                                        foreach ($activeTags as $secKey => $usedValue) {
                                            if ($value["tag"] == $usedValue["tag"]) {
                                                ?>
                                                <a type="button"
                                                   class="addNewTagBtn pressed"><?= $value["tag"] ?></a>
                                                <?php
                                                $flag = false;
                                            }
                                        }
                                        if ($flag == true) {
                                            ?>
                                            <a type="button" class="addNewTagBtn"><?= $value["tag"] ?></a>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
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
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea id="summernote" class="main-content"
                                          name="content"> <?= $data["postData"]["content"] ?></textarea>
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
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" id="submit" class="btn btn-success float-right">
                </div>
            </div>
        </section>
    </form>
    <!-- /.content -->
</div>

<script src="/assets/js/Blog/tagsCategoriesWork.js"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });
</script>