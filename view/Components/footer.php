<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="full">
                    <div class="logo_footer">
                        <a href="#"><img width="210" src="/images/logo.png" alt="#"/></a>
                    </div>
                    <div class="information_f">
                        <p><strong>ADDRESS:</strong> <?php echo($data["options"]["address"]); ?></p>
                        <p><strong>TELEPHONE:</strong> <?php echo($data["options"]["tel"]); ?></p>
                        <p><strong>EMAIL:</strong> <?php echo($data["options"]["email"]); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="widget_menu">
                            <h3>Newsletter</h3>
                            <div class="information_f">
                                <p>Subscribe by our newsletter and get news.</p>
                            </div>
                            <div class="form_sub">
                                <form action="/Contact/addEmailingList" method="post">
                                    <fieldset>
                                        <div class="field">
                                            <input type="email" placeholder="Enter Your Mail" name="email"/>
                                            <!-- TODO: new database for same info-->
                                            <input type="submit" value="Subscribe"/>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>