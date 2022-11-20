<div class="content-wrapper adminBlogCont">
    <!-- Main content -->
    <form method="post" id="addNewPost" enctype="multipart/form-data">
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
                        Отправить этот файл: <input name="logo" type="file"/>
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
                                <input type="text" id="inputName" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Slogan</label>
                                <textarea id="inputDescription" class="form-control" name="slogan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Categories</label>
                                <div class="categories">
                                    <div class="postId hidden"></div>
                                    <div class="categories-active-categories">
                                    </div>
                                    <?php

                                    $catM = new \Models\categories();
                                    $allCats = $catM->getAllCategories();
                                    foreach ($allCats as $key=>$value){
                                        ?>
                                            <a type="button" class="addNewCategoryBtn"><?=$value["category"]?></a>
                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputProjectLeader">Tags</label>
                                <div class="tags">
                                    <?php
                                    $catM = new \Models\tags();
                                    $allCats = $catM->getManyRows();

                                    foreach ($allCats as $key=>$value){
                                        ?>
                                        <a type="button" class="addNewTagBtn"><?=$value["tag"]?></a>
                                        <?php
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
                                          name="content"></textarea>
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
                    <a href="/User/" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" id="submit" class="btn btn-success float-right">
                </div>
            </div>
        </section>
    </form>
    <!-- /.content -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.12.17/paper-full.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="/assets/js/addPost.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>