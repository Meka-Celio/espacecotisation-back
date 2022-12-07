<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-success">Ajouter un Utilisateur</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Ajouter un utilisateur
                        </div>

                        <?php if (isset($_GET['msgAlert'])) { ?>
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <div class="alert alert-danger">
                                        <?php $msgAlert = (explode(',', $_GET['msgAlert']));
                                            for ($i=0; $i<count($msgAlert); $i++) {

                                                if ($msgAlert[$i] == 'login_already_exist') { ?>
                                                <li>Cet utilisateur existe déjà !</li>

                                            <?php } else if ($msgAlert[$i] == 'login_null') { ?>
                                                <li>Merci de renseigner un nom d'utilisateur !</li>

                                            <?php } else if ($msgAlert[$i] == 'email_false') { ?>
                                                <li>L'adresse mail est invalide !</li>

                                            <?php } else if ($msgAlert[$i] == 'email_already_exist') { ?>
                                                <li>Cet email correspond déjà à un utilisateur !</li>

                                            <?php } else if ($msgAlert[$i] == 'email_null') { ?>
                                                <li>Merci de préciser une adresse mail !</li>

                                            <?php } else if ($msgAlert[$i] == 'password_false') { ?>
                                                <li>Le mot de passe doit contenir au moins 5 caractères !</li>

                                            <?php } else if ($msgAlert[$i] == 'password_null') { ?>
                                                <li>Merci de définir un mot de passe !</li>

                                            <?php } else { ?>
                                                <li>Erreur lors de l'execution de la requete !</li>
                                            <?php } ?>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="index.php?c=user&task=insert" method="post" class="form" id="addUserForm">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group" data-rule="text">
                                                    <label for="" class="control-label">Login * </label>
                                                    <input type="text" name="login" value="" placeholder="Login" class="form-control">
                                                    <p class="help-block"></p>
                                                </div>
                                                <div class="form-group" data-rule="email">
                                                    <label for="" class="control-label">Email *</label>
                                                    <input type="email" name="email" value="" placeholder="Email *" class="form-control">
                                                    <p class="help-block"></p>
                                                </div>
                                                <div class="form-group" data-rule="password">
                                                    <label for="" class="control-label">Mot de passe *</label>
                                                    <input type="password" name="motdepasse" value="" placeholder="Mot de passe *" class="form-control">
                                                    <p class="help-block">Doit contenir au moins 5 caractères</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Type du user</label>
                                                    <select name="autorisation" id="" class="form-control text-success">
                                                        <option value="1">Utilisateur</option>
                                                        <option value="2">Manager</option>
                                                        <option value="10">Admin</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="submit" value="submit">

                                                <button type="submit" class="btn btn-success">Ajouter</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

        <script src="assets/js/verif-form.js" type="text/javascript" charset="utf-8" async defer></script>