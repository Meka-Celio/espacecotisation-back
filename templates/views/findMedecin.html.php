<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-warning">Rechercher un médecin</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="col-ml-8">
                <?= $alert ?>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-2">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Rechercher
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <form action="index.php?c=medecin&task=findOnMarit" method="post">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="cinInput" class="form-label">CIN du médecin</label>
                                        <input type="text" class="form-control" id="cinInput" name="cin">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="submit" value="Récupérer" class="btn btn-secondary">
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-5">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Informations Médecins
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <div class="row">
                                <div class="mb-3">
                                    <?php if (isset($mMedecin)) { ?>
                                        <p><b>Nom : </b><?= $mMedecin->NomComplet ?></p>
                                        <p><b>Cin        : </b><?= $mMedecin->Cin ?> </p>
                                        <p><b>N°GSM           : </b><?= $mMedecin->TelephoneMobile ?></p>
                                        <p><b>Email           : </b><?= $mMedecin->Email ?></p>
                                        <p>-----------------------------------------</p>
                                        <p><b>Région        : </b><?= $mMedecin->LibelleRegion ?> </p>
                                        <p><b>Province      : </b><?= $mMedecin->LibelleProvince ?> </p>
                                        <p><b>Commune       : </b><?= $mMedecin->LibelleCommune ?></p>
                                        <p><b>Specialité    : </b><?= $mMedecin->SpecialiteMedecin ?> </p>
                                        <p><b>Adresse professionnelle : </b>
                                        <?php if (isset($mMedecin->AdressePro)) { 
                                                echo $mMedecin->AdressePro;
                                            }
                                            else {
                                                echo '';
                                            }
                                        ?>
                                        <p><b>Secteur       : </b><?= $mMedecin->SecteurMedecin ?> </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

                <div class="col-md-5">
                    <div class="col-lg-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                Cotisations non payées
                            </div>
                            <!-- .panel-heading -->
                            <div class="panel-body">
                                <?php if ($cotisationNonPayer) { ?>
                                    <div class="table-responsive">
                                        <table class="cotisation-table table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Année Cotisation</th>
                                                    <th>Montant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- si il y a plusieurs transactions -->
                                                <?php if (is_array($cotisationNonPayer)) { ?>
                                                    <?php for ($i=0; $i < count($cotisationNonPayer); $i++) { ?>
                                                        <?php if ($cotisationNonPayer[$i]->Annee > $lastyearPaid) { ?>
                                                        <tr>
                                                            <td>N° <?php echo $cotisationNonPayer[$i]->Id ?></td>
                                                            <td><?php echo $cotisationNonPayer[$i]->Annee ?></td>
                                                            <td><?php echo substr($cotisationNonPayer[$i]->AnneeMontant, 7) ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td>N° <?php echo $cotisationNonPayer->Id ?></td>
                                                        <td><?php echo $cotisationNonPayer->Annee ?></td>
                                                        <td><?php echo substr($cotisationNonPayer->AnneeMontant, 7) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th colspan="2">Montant a payer : </th> 
                                                <th><?php echo $montantNonPayer ?> DH</th>
                                                </tr>
                                            </tfoot>
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
                    
                    <div class="col-lg-12">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                Cotisations cachées non payées
                            </div>
                            <!-- .panel-heading -->
                            <div class="panel-body">
                                <?php if ($cotisationNonPayer) { ?>
                                    <div class="table-responsive">
                                        <table class="cotisation-table table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Année Cotisation</th>
                                                    <th>Montant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- si il y a plusieurs transactions -->
                                                <?php if (is_array($cotisationNonPayer)) { ?>
                                                    <?php for ($i=0; $i < count($cotisationNonPayer); $i++) { ?>
                                                        <?php if ($cotisationNonPayer[$i]->Annee < $lastyearPaid) { ?>
                                                        <tr>
                                                            <td>N° <?php echo $cotisationNonPayer[$i]->Id ?></td>
                                                            <td><?php echo $cotisationNonPayer[$i]->Annee ?></td>
                                                            <td><?php echo substr($cotisationNonPayer[$i]->AnneeMontant, 7) ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Montant non réglé : </th> 
                                                <th><?php echo $montantCacher ?> DH</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <p class="text-success">
                                        Aucune cotisation n'est cachée !
                                    </p>
                                <?php } ?>
                            </div>
                            <!-- .panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                Cotisations Payées
                            </div>
                            <!-- .panel-heading -->
                            <div class="panel-body">
                                <?php if ($cotisationPayer) { ?>
                                    <div class="table-responsive">
                                        <table class="cotisation-table table">
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
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Montant réglé : </th> 
                                                    <th><?php echo $montantRegler ?> DH</th>
                                                </tr>
                                            </tfoot>
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
                </div>

            </div>
            <!-- /.row -->
        </div>