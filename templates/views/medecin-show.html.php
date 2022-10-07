<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $medecin['nom_complet'] ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row flex">
                                <div class="col-md-6">
                                    Information médecin 1
                                </div>
                                <div class="col-md-6">
                                    <a href="index.php?c=medecin&task=edit&id=<?= $medecin['id'] ?>" class="btn btn-circle btn-default"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p><b>Nom : </b><?= $medecin['nom'] ?></p>
                            <p><b>Prenom : </b><?= $medecin['prenom'] ?></p>
                            <p><b>Specialite : </b><?= $medecin['specialite'] ?></p>
                            <p><b>Telephone : </b><?= $medecin['telephone'] ?></p>
                            <p><b>Email : </b><?= $medecin['email'] ?></p>
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

                <div class="col-lg-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Information Medecin
                        </div>
                        <div class="panel-body">
                            <p><b>Région        : </b><?= $mMedecin->LibelleRegion ?> </p>
                            <p><b>Province      : </b><?= $mMedecin->LibelleProvince ?> </p>
                            <p><b>Specialité    : </b><?= $mMedecin->SpecialiteMedecin ?> </p>
                            <p><b>Adresse professionnelle : </b><?= $mMedecin->AdressePro ?> </p>
                            <p><b>Secteur       : </b><?= $mMedecin->SecteurMedecin ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Cotisations Payées
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <?php if ($cotisationPayer) { ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Année Cotisation</th>
                                                <th>Montant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (is_array($cotisationPayer)) { ?>
                                                <?php for ($i=0; $i < count($cotisationPayer); $i++) { ?>
                                                    <tr>
                                                        <td>N° <?php echo $cotisationPayer[$i]->Id ?></td>
                                                        <td><?php echo $cotisationPayer[$i]->Annee ?></td>
                                                        <td><?php echo $cotisationPayer[$i]->AnneeMontant ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td>N° <?php echo $cotisationPayer->Id ?></td>
                                                    <td><?php echo $cotisationPayer->Annee ?></td>
                                                    <td><?php echo $cotisationPayer->AnneeMontant ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <p class="text-danger">
                                    Aucune cotisation n'est payée !
                                </p>
                            <?php } ?>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

                <div class="col-lg-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            Cotisations non payées
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <?php if ($cotisationNonPayer) { ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Année Cotisation</th>
                                                <th>Montant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (is_array($cotisationNonPayer)) { ?>
                                                <?php for ($i=0; $i < count($cotisationNonPayer); $i++) { ?>
                                                    <tr>
                                                        <td>N° <?php echo $cotisationNonPayer[$i]->Id ?></td>
                                                        <td><?php echo $cotisationNonPayer[$i]->Annee ?></td>
                                                        <td><?php echo substr($cotisationNonPayer[$i]->AnneeMontant, 7) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td>N° <?php echo $cotisationNonPayer->Id ?></td>
                                                    <td><?php echo $cotisationNonPayer->Annee ?></td>
                                                    <td><?php echo substr($cotisationNonPayer->AnneeMontant, 7) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <p class="text-success">
                                    Toutes les cotisation sont payées !
                                </p>
                            <?php } ?>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>