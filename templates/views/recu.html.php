<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-warning">Reçus de paiement</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Toutes les reçus
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="gradeX danger">
                                        <th>CIN</th>
                                        <th>Nom</th>
                                        <th>N° Commande</th>
                                        <th>Date Paiement</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recus as $recu) { ?>
                                        <?php if ($trans['validation'] == 1) { ?>
                                            <tr class='text-success'>
                                                <td><?= $trans['cin'] ?></td>
                                                <td><?= $trans['nom'] ?></td>
                                                <td><?= $trans['n_commande'] ?></td>
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