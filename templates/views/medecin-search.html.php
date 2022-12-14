<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Medecins</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Nombre de résultats trouvés : <?php echo $nbrMedecins ?> pour <?php echo $query ?>
                        </div>
                        <!-- /.panel-heading -->

                        <?php if (!$msgAlert == "") { ?>
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="alert alert-danger">
                                    <?php echo $msgAlert ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="row">
                            <div class="table_filters">
                                <form action="index.php?c=medecin&task=find" class="form" method="post">
                                    <div class="col-sm-2">
                                        <div class="filter">
                                            <div class="col-sm-12">
                                                <input type="text" name="cin" value="" placeholder="CIN" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="filter">
                                            <div class="col-sm-12">
                                                <input type="text" name="nom" value="" placeholder="Nom Medecin" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="filter">
                                            <div class="col-sm-12">
                                                <input type="text" name="prenom" value="" placeholder="Prenom" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="filter">
                                            <div class="col-sm-12">
                                                <input type="text" name="region" value="" placeholder="Region" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="filter">
                                            <div class="col-sm-12">
                                                <input type="text" name="specialite" value="" placeholder="Specialite" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="submit" value="submit">
                                    <div class="col-sm-2">
                                        <button class="btn btn-success"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="gradeX">
                                        <th>CIN</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Region</th>
                                        <th>Specialite</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($medecins as $med) { ?>
                                        <tr>
                                            <td><?php echo $med['cin'] ?></td>
                                            <td><?php echo $med['nom'] ?></td>
                                            <td><?php echo $med['prenom'] ?></td>
                                            <td><?php echo $med['region'] ?></td>
                                            <td><?php echo $med['specialite'] ?></td>
                                            <td>
                                            <?php if ($med['pwd'] == '12345') { ?>
                                                <span class="badge text-bg-danger">Non Inscrit</span>
                                            <?php } else { ?>
                                                <span class="badge text-bg-success">Inscrit</span>
                                            <?php } ?>
                                            </td>
                                            <td><a href="index.php?c=medecin&task=show&id=<?= $med['id'] ?>" class="btn btn-success btn-circle"><i class="fa fa-edit "></i></a></td>
                                        </tr>
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
                                        <li><a href="index.php?c=medecin&task=find&page=<?php echo $currentPage - 1 ?>&cin=<?= $cin ?>&nom=<?= $nom ?>&prenom=<?= $prenom ?>&region=<?= $region ?>&specialite=<?= $specialite ?>">Precedent</a></li>
                                        <li><a href="index.php?c=medecin&task=find&page=<?php echo $currentPage + 1 ?>&cin=<?= $cin ?>&nom=<?= $nom ?>&prenom=<?= $prenom ?>&region=<?= $region ?>&specialite=<?= $specialite ?>">Suivant</a></li>
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