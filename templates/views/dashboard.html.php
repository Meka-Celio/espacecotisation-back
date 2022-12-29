        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">

                <!-- Nbr - Transaction block -->
                <!-- Nbr Block -->
                <div class="col-lg-12">

                    <div class="col-lg-3 col-md-3">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-md fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $nbrMedecins ?></div>
                                        <div>Medecins</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?c=medecin&task=index">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-briefcase fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbrTransactions ?></div>
                                        <div>Transactions</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?c=transaction&task=index">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbrUsers ?></div>
                                        <div>Utilisateurs</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?c=user&task=index">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbrUsers ?></div>
                                        <div>Reçus</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?c=recu&task=index">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /nbr-block -->

                <!-- transaction-block -->
                <div class="col-lg-12">
                    <!-- Lasts save transaction -->
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        Dernières Transactions Enregistrées
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th>N° Commande</th>
                                            <th>CIN</th>
                                            <th>Nom</th>
                                            <th>Date Paiement</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactions as $trans ) { ?>
                                            <tr>
                                                <td><?php echo $trans['n_commande'] ?></td>
                                                <td><?php echo $trans['cin'] ?></td>
                                                <td><?php echo $trans['nom'] ?></td>
                                                <td><?php echo $trans['datePaiement'] ?></td>
                                                <td><a href="index.php?c=transaction&task=show&id=<?= $trans['id'] ?>" class="text-info"><i class="fa fa-search"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Generate money - User Connexion block -->
                <div class="col-lg-3">

                    <!-- <div class="col-lg-12 col-md-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbrUsers ?></div>
                                        <div>Dh</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?c=user&task=index">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> -->

                </div>
                <!-- User-connexion-block -->
                <div class="col-lg-12">
                    <!-- Lasts save transaction -->
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        Dernières Connexions Enregistrées
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="warning">
                                            <th>CIN</th>
                                            <th>Nom</th>
                                            <th>Clé Utilisateur</th>
                                            <th>Date de connexion</th>
                                            <th>Situation</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($medecins as $med ) { ?>
                                        <tr>
                                            <td><?php echo $med['cin'] ?></td>
                                            <td><?php echo $med['nom_complet'] ?></td>
                                            <td><?= $med['keyuser'] ?></td>
                                            <td><?php echo $med['connected_at'] ?></td>
                                            <td>
                                                <?php if ($med['situation'] == 1) { ?>
                                                    <span class="badge text-bg-success">A jour</span>
                                                <?php } else { ?>
                                                    <span class="badge text-bg-danger">Pas à jour</span>
                                                <?php }  ?>
                                            </td>
                                            <td><a href="index.php?c=medecin&task=show&id=<?= $med['id'] ?>" class="text-warning"><i class="fa fa-search "></i></a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user-connexion-block -->
                <!-- /main part -->

            </div>
            <!-- /.row -->
        </div>