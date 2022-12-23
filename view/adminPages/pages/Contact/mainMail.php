<div class="content-wrapper adminBlogCont">
    <!-- Main content -->
    <section class="content col-12">
        <form method="post" action="/admin/newMail" class="row">
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Content</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                                <textarea id="summernote" class="main-content"
                                          name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Subject</label>
                            <input id="inputDescription" class="form-control" name="subject"/>
                        </div>
                        <input type="submit" value="Save Changes" id="submit" class="btn btn-success float-right">
                        <a href="/admin/" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
        <div class="card card-info">
            <!-- /.card -->
        </div>
    </section>
</div>
