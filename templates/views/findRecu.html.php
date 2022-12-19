<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-grey">Voir reçu(s) de paiement</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="col-ml-8">
                <?= $alert ?>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="panel panel-grey">
                        <div class="panel-heading">
                            Rechercher
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <form action="index.php?c=recu&task=find" method="post">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="nCommandeInput" class="form-label">N° Commande...</label>
                                        <input type="text" class="form-control" id="nCommandeInput" name="nCommande" placeholder="W........">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="cinInput" class="form-label">CIN du médecin</label>
                                        <input type="text" class="form-control" id="cinInput" name="cin" placeholder="la cin à chercher">
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

                <div class="col-lg-9">
                    <div class="panel panel-grey">
                        <div class="panel-heading">
                            Les reçus
                        </div>
                        <!-- /.panel-heading -->



                        <div class="panel-body">
                            <div class="row">
                                <?php if (isset($recusPaiement)) { ?>
                                    <?php if (is_array($recusPaiement)) { ?>
                                        <?php foreach ($recusPaiement as $recu) { ?>
                                            <div class="recuPaiement col-md-4">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">Reçu N° <b><?php echo $recu->NumRecuGenere ?></b> </div>
                                                    <div class="panel-body">
                                                        <p>CIN : <?= $recu->CINMedecin ?></p>
                                                        <p>N° Commande : <span class="text-info"><?= $recu->NumRecuTransaction ?></span> </p>
                                                        <h4>Année : <b><?php echo $recu->AnneeCotisation ?></b> </h4>
                                                        <a href="#" class="btn btn-primary">Télécharger</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="recuPaiement col-md-4">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">Reçu N° <b><?php echo $recusPaiement->NumRecuGenere ?></b> </div>
                                                <div class="panel-body">
                                                    <p>CIN : <?= $recusPaiement->CINMedecin ?></p>
                                                    <p>N° Commande : <span class="text-info"><?= $recusPaiement->NumRecuTransaction ?></span> </p>
                                                    <h4>Année : <b><?php echo $recusPaiement->AnneeCotisation ?></b> </h4>
                                                    <a href="#" class="btn btn-primary">Télécharger</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>