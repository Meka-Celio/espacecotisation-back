<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span><a href="index.php?c=transaction&task=index"><i class="fa fa-angle-double-left text-warning"></i></a></span> Transaction N° <span class="text-warning"><?php echo $transaction['n_commande'] ?></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row flex">
                                <div class="col-md-12">
                                    Information de la transaction 
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php echo $alert ?>

                            <table width="100%" class="transaction-table table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="gradeX">
                                        <th>ID</th>
                                        <th>CIN</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Années Payées</th>
                                        <th>Montant</th>
                                        <th>Date Paiement</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($transaction['validation']) { ?>
                                        <tr class="text-success">
                                            <td><?= $transaction['id'] ?></td>
                                            <td><?= $transaction['cin'] ?></td>
                                            <td><?= $transaction['nom'] ?></td>
                                            <td><?= $transaction['mail'] ?></td>
                                            <td><?= $transaction['anneesPayees'] ?></td>
                                            <td><?= $transaction['montant'] ?></td>
                                            <td><?= $transaction['datePaiement'] ?></td>
                                            <td><span class="badge text-bg-success">Activé</span></td>
                                        </tr>
                                    <?php }  else { ?>
                                        <tr>
                                            <td><?= $transaction['id'] ?></td>
                                        <td><?= $transaction['cin'] ?></td>
                                            <td><?= $transaction['nom'] ?></td>
                                            <td><?= $transaction['mail'] ?></td>
                                            <td><?= $transaction['anneesPayees'] ?></td>
                                            <td><?= $transaction['montant'] ?></td>
                                            <td><?= $transaction['datePaiement'] ?></td>
                                            <td><span class="badge text-bg-danger">Désactivé</span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="action-buttons col-md-4"> 
                                <form action="index.php?c=transaction&task=activate" method="post" class="form">
                                    <input type="hidden" name="transaction_id" value="<?= $transaction_id ?>">
                                    <input type="hidden" name="n_commande" value="<?= $transaction['n_commande'] ?>">
                                    <input type="submit" name="submit" value="Activer" class="btn btn-warning">
                                </form>

                                <form action="index.php?c=cotisation&task=check" method="post" class="form">
                                    <input type="hidden" name="transaction_id" value="<?= $transaction_id ?>">
                                    <input type="submit" name="submit" value="Enregistrer" class="btn btn-success">
                                </form>

                                <form action="index.php?c=cotisation&task=getRecu" class="form" method="post">
                                    <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                                    <input type="submit" name="submit" value="Voir les reçus" class="btn btn-light">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php if (isset($recusPaiement)) { ?>
                <div class="row">
                    <?php if (is_array($recusPaiement)) { ?>
                        <?php for ($i=0; $i < count($recusPaiement); $i++) { ?>
                            <div class="col-lg-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row flex">
                                            <div class="col-md-12">
                                                Reçu de paiement
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <p><b>N° Reçu                   : </b><?= $recusPaiement[$i]->NumRecuGenere ?></p>
                                        <p><b>Date Reçu : <?php echo date('d-m-Y') ?></b></p>
                                        <p><b>Année de cotisation       : </b><?= $recusPaiement[$i]->AnneeCotisation ?></p>
                                        <?php if ($recusPaiement[$i]->MontantCotisation == 300) {
                                                $somme = "Trois Cent";
                                            } else if ($recusPaiement[$i]->MontantCotisation == 700) { 
                                                $somme = "Sept Cent";
                                            } else {
                                                $somme = "Cinq Cent";
                                            }
                                            ?>
                                        <div class="action-buttons">
                                            <form action="PDF/index.php" method="post" class="form">
                                                <input type="hidden" name="NumTransaction" value="<?= $recusPaiement[$i]->NumRecuTransaction ?>">
                                                <input type="hidden" name="NumRecu" value="<?= $recusPaiement[$i]->NumRecuGenere ?>">
                                                <input type="hidden" name="Nom" value="<?= $maritMedecin->NomComplet ?>">
                                                <input type="hidden" name="SecteurMedecin" value="<?= $maritMedecin->SecteurMedecin ?>">
                                                <input type="hidden" name="SpecialiteMedecin" value="<?= $medecin['specialite'] ?>">
                                                <input type="hidden" name="DateDiplome" value="<?= $maritMedecin->DateDiplome ?>">
                                                <input type="hidden" name="DateRecrutement_Installation" value="<?= $maritMedecin->DateRecrutement_Installation ?>">
                                                <input type="hidden" name="AdressePro" value="<?= $recusPaiement[$i]->AdresseMedecin ?>">
                                                <input type="hidden" name="Province" value="<?= $maritMedecin->LibelleProvince ?>">
                                                <input type="hidden" name="Region" value="<?= $medecin['region'] ?>">
                                                <input type="hidden" name="DateCreation" value="<?php echo date('d-m-Y') ?>">
                                                <input type="hidden" name="AnneePayee" value="<?= $recusPaiement[$i]->AnneeCotisation ?>">
                                                <input type="hidden" name="MontantCotisation" value="<?= $recusPaiement[$i]->MontantCotisation ?>">
                                                <input type="hidden" name="Somme" value="<?= $somme ?>">
                                                <input type="submit" name="submit" value="Générer Reçu" class="btn btn-primary"> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-lg-6">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="row flex">
                                        <div class="col-md-12">
                                            Reçu de paiement
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <p><b>N° Reçu                   : </b><?= $recusPaiement->NumRecuGenere ?></p>
                                    <p><b>Date Reçu : <?php echo date('d-m-Y') ?></b></p>
                                    <p><b>Année de cotisation       : </b><?= $recusPaiement->AnneeCotisation ?></p>
                                    <?php if ($recusPaiement->MontantCotisation == 300) {
                                        $somme = "Trois Cent";
                                    } else if ($recusPaiement->MontantCotisation == 700) {
                                        $somme = "Sept Cent";
                                    } else {
                                        $somme = "Cinq Cent";
                                    }?>
                                    <div class="action-buttons">
                                        <form action="PDF/index.php" method="post" class="form">
                                            <input type="hidden" name="NumTransaction" value="<?= $recusPaiement[$i]->NumRecuTransaction ?>">
                                            <input type="hidden" name="NumRecu" value="<?= $recusPaiement[$i]->NumRecuGenere ?>">
                                            <input type="hidden" name="Nom" value="<?= $maritMedecin->NomComplet ?>">
                                            <input type="hidden" name="SecteurMedecin" value="<?= $maritMedecin->SecteurMedecin ?>">
                                            <input type="hidden" name="SpecialiteMedecin" value="<?= $medecin['specialite'] ?>">
                                            <input type="hidden" name="DateDiplome" value="<?= $maritMedecin->DateDiplome ?>">
                                            <input type="hidden" name="DateRecrutement_Installation" value="<?= $maritMedecin->DateRecrutement_Installation ?>">
                                            <input type="hidden" name="AdressePro" value="<?= $recusPaiement[$i]->AdresseMedecin ?>">
                                            <input type="hidden" name="Province" value="<?= $maritMedecin->LibelleProvince ?>">
                                            <input type="hidden" name="Region" value="<?= $medecin['region'] ?>">
                                            <input type="hidden" name="DateCreation" value="<?php echo date('d-m-Y') ?>">
                                            <input type="hidden" name="AnneePayee" value="<?= $recusPaiement[$i]->AnneeCotisation ?>">
                                            <input type="hidden" name="MontantCotisation" value="<?= $recusPaiement[$i]->MontantCotisation ?>">
                                            <input type="hidden" name="Somme" value="<?= $somme ?>">
                                            <input type="submit" name="submit" value="Générer Reçu" class="btn btn-primary"> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>