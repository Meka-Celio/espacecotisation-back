<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <a href="index.php?c=medecin&task=show&id=<?= $medecin['id'] ?>" class="text-warning">
                            <i class="fa fa-angle-double-left"></i>
                        </a> 
                        <?php echo $medecin['nom_complet'] ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php if ($source == 'tel') { ?>
                <?php if ($alert == 'null') { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="alert alert-danger">
                                Merci de mentionner un numéro de téléphone !
                            </div>
                        </div>
                    </div>
                <?php } else if ($alert == 'bad_format') { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="alert alert-danger">
                                Le format renseigné ne correspond pas à celui imposé !
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="alert alert-success">
                                Le numéro de téléphone a bien été modifié !
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else if ($source == 'email') { ?>
                <?php if ($alert == 'null') { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="alert alert-danger">
                                Merci de mentionner une adresse mail !
                            </div>
                        </div>
                    </div>
                <?php } else if ($alert == 'bad_format') { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="alert alert-danger">
                                Adresse mail invalide, merci de renseigner une adresse valide !
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="alert alert-success">
                                L'email a bien été modifié !
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else {} ?>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row flex">
                                <div class="col-md-6">
                                    Information médecin 1
                                </div>
                            </div>
                        </div>
                        <div class="panel-body bg-warning">
                            <p><b>Nom : </b><?= $medecin['nom'] ?></p>
                            <p><b>Prenom : </b><?= $medecin['prenom'] ?></p>
                            <p><b>Specialite : </b><?= $medecin['specialite'] ?></p>

                            <form action="index.php?c=medecin&task=update&column=telephone" method="post" class="form updateForm">
                                <input type="hidden" name="id" value="<?= $medecin['id'] ?>">
                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label for="" class="label">
                                            N° Telephone
                                            <input type="tel" name="update" value="<?= $medecin['telephone'] ?>" placeholder="" class="form-control">
                                        </label>
                                        <sub>Format : 660000000</sub>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="submit" name="submit" value="Modifier" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>

                            <form action="index.php?c=medecin&task=update&column=email" method="post" class="form updateForm">
                                <input type="hidden" name="id" value="<?= $medecin['id'] ?>">
                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label for="" class="label">Email
                                            <input type="email" name="update" value="<?= $medecin['email'] ?>" placeholder="" class="form-control">
                                        </label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class="label">
                                            <input type="submit" name="submit" value="Modifier" class="btn btn-warning">
                                        </label>
                                    </div>
                                </div>
                            </form>

                            <p><b>Situation :</b> 
                                <?php if ($medecin['situation']) { ?>
                                    <span class="text-success">A jour</span>
                                <?php } else { ?>
                                    <span class="text-danger">Pas à jour</span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>