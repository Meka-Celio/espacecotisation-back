<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transactions</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

            <div class="col-sm-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Recherche
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <form action="index.php?c=transaction&task=search" class="form" method="post">
                                    <div class="form-group">
                                        <label for="">CIN du médecin</label>
                                        <input type="text" name="cin" value="" placeholder="CIN" class="form-control">
                                        <input type="hidden" name="submit" value="submit">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-12">
                                <form action="index.php?c=transaction&task=search" class="form" method="post">
                                    <div class="form-group">
                                        <label for="">Nom du médecin</label>
                                        <input type="text" name="nom" value="" placeholder="Nom Medecin" class="form-control">
                                        <input type="hidden" name="submit" value="submit">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-12">
                                <form action="index.php?c=transaction&task=search" class="form" method="post">
                                    <div class="form-group">
                                        <label for="">N° Commande</label>
                                        <input type="text" name="n_commande" value="" placeholder="N° Commande" class="form-control">
                                        <input type="hidden" name="submit" value="submit">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-12">
                                <form action="index.php?c=transaction&task=search" class="form" method="post">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="date" name="date_paiement" value="" placeholder="Date Paiement" class="form-control">
                                        <input type="hidden" name="submit" value="submit">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Rechercher une transaction
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="gradeX">
                                        <th>CIN</th>
                                        <th>Nom</th>
                                        <th>N° Commande</th>
                                        <th>Montant</th>
                                        <th>Date Paiement</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $trans) { ?>
                                        <?php if ($trans['validation'] == 1) { ?>
                                            <tr class='text-success'>
                                                <td><?= $trans['cin'] ?></td>
                                                <td><?= $trans['nom'] ?></td>
                                                <td><?= $trans['n_commande'] ?></td>
                                                <td><?= $trans['montant'] ?></td>
                                                <td><?= $trans['datePaiement'] ?></td>
                                                <td>
                                                    <a href="index.php?c=transaction&task=show&id=<?= $trans['id'] ?>" class="btn btn-warning btn-circle"><i class="fa fa-search"></i></a>
                                                </td>
                                            </tr>
                                        <?php } else  { ?>
                                            <tr>
                                                <td><?= $trans['cin'] ?></td>
                                                <td><?= $trans['nom'] ?></td>
                                                <td><?= $trans['n_commande'] ?></td>
                                                <td><?= $trans['montant'] ?></td>
                                                <td><?= $trans['datePaiement'] ?></td>
                                                <td>
                                                    <a href="index.php?c=transaction&task=show&id=<?= $trans['id'] ?>" class="btn btn-warning btn-circle"><i class="fa fa-search"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="row">
                                <div class="col-sm-6">
                                    Page <?= $currentPage ?> sur <?= $nbrPages ?>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="paginator">
                                        <li><a href="index.php?c=transaction&task=index&page=<?php echo $currentPage - 1 ?>">Precedent</a></li>
                                        <li><a href="index.php?c=transaction&task=index&page=<?php echo $currentPage + 1 ?>">Suivant</a></li>
                                    </ul>
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