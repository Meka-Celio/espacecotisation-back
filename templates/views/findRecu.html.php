<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-grey">Voir reçu(s) de paiement</h1>
                </div>
                <!-- /.col-lg-12 -->
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
                            <form action="" method="post">
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
                            Voir
                        </div>
                        <!-- /.panel-heading -->



                        <div class="panel-body">
                            <div class="row">
                                <div class="recuPaiement col-md-3">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Reçu N° <?php echo $numRecu ?> </div>
                                        <div class="panel-body">
                                            <h5>Année : <?php echo $anneeCotisation ?></h5>
                                            <a href="#" class="btn btn-primary">Télécharger</a>
                                        </div>
                                    </div>
                                </div>
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