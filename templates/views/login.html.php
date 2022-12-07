<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Espace Cotisation</h3>
                    </div>
                     
                    <div class="panel-body">

                    <?php echo $alert ?>

                        <form role="form" method="post" action="index.php?c=user&task=login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="login" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Login" class="btn btn-lg btn-warning btn-block">
                            </fieldset>
                        </form>
                        <p>
                            <a href="#">Mot de passe oublié ?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>