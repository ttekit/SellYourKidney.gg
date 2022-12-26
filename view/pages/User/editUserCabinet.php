<div class="container py-5">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0 user-path">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="main-form">
        <div class="row">
            <div class="col-lg-4 ">
                <div class="card mb-4 user-main-info">
                    <div class="card-body text-center user-main-info">
                        <img src="<?= $data["userData"]["avatar"] ?>"
                             alt="avatar" id="avatar"
                             class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                        <div class="crop-image-container">
                            <img id="image">
                        </div>
                        <input type="file" name="avatar"/>
                        <h5 class="my-3"><label class="w-100">
                                <input class="user-edit-input" name="login"
                                       value="<?= /** @var $data */
                                       $data["userData"]["login"] ?> " placeholder="login" disabled/>
                            </label></h5>
                        <p class="text-muted mb-1"><label class="w-100">
                                <input class="user-edit-input" name="Job" value="<?= $data["userData"]["job"] ?>"
                                       placeholder="job"/>
                            </label></p>
                        <div class="d-flex justify-content-center mb-1">
                            <input type="submit" class="btn btn-primary" id="submit"/>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="soc-media-group list-group list-group-flush rounded-3">
                            <div class="d-none id-container"><?= $data["userData"]["id"] ?> </div>

                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <input type="button" class="border-0 add-new-soc-button" value="Add new soc"/>
                            </li>

                            <?php
                            foreach ($data["reg"]["socLinks"] as $key => $value) {
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <input class="soc-link-id-container d-none" value="<?= $value["id"] ?>"/>
                                    <a href="<?= $value["socLink"] ?>"><p class="mb-0"><?= $value["socName"] ?></p>
                                    </a>
                                    <a type="button" class="delete-soc-link-button"><p class="mb-0">Delete</p>
                                    </a>
                                </li>
                                <?php
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><label class="w-100">
                                        <input class="user-edit-input" name="FullName"
                                               value="<?= $data["userData"]["fullName"] ?>"
                                               placeholder="full name"/>
                                    </label></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><label class="w-100">
                                        <input disabled class="user-edit-input" name="Email"
                                               value="<?= $data["userData"]["email"] ?>"
                                               placeholder="email"/>
                                    </label></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><label class="w-100">
                                        <input class="user-edit-input" name="Phone"
                                               value="<?= $data["userData"]["phone"] ?>"
                                               placeholder="phone"/>
                                    </label></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Mobile</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><label class="w-100">
                                        <input class="user-edit-input" name="Mobile"
                                               value="<?= $data["userData"]["mobile"] ?>"
                                               placeholder="mobile"/>
                                    </label></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><label class="w-100">
                                        <input class="user-edit-input" name="Address"
                                               value="<?= $data["userData"]["address"] ?>"
                                               placeholder="Address"/>
                                    </label></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
</section>

<script src="/assets/js/User/User/userProfileEdit.js"></script>
