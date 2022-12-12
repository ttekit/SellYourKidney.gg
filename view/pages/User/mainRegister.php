<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Register
                    </h3>
                    <?php
                    /** @var $data */
                    if ($data["error"] != null) {
                        foreach ($data["error"] as $item) {
                            ?>

                            <h3><?=$item?></h3>

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">
                            <form action="/user/RegUser" method="post">
                                <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                                <p class="text-white-50 mb-5">Please enter your data!</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="typeEmailX" name="login"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="typeEmailX">Login</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="typeEmailX" name="email"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="typePasswordX" name="password"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="typePasswordX" name="passwordConfirm"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="typePasswordX">Password Confirm</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>