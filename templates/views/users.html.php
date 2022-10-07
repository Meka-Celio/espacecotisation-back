<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-success">Utilisateurs <span><a href="index.php?c=user&task=add" class="btn btn-success"><i class="fa fa-plus"></i></a></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Tous les utilisateurs
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

                        <?php 
                            if (isset($_GET['msgAlert'])) {
                                var_dump(explode(',', $_GET['msgAlert']));
                            }
                        ?>

                        <div class="row">
                            <div class="table_filters">
                                <form action="index.php?c=medecin&task=find" class="form" method="post">
                                    <div class="col-sm-3">
                                        <div class="filter">
                                            <div class="col-sm-10">
                                                <input type="text" name="cin" value="" placeholder="CIN" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="filter">
                                            <div class="col-sm-10">
                                                <input type="text" name="nom" value="" placeholder="Nom Medecin" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="filter">
                                            <div class="col-sm-10">
                                                <input type="text" name="prenom" value="" placeholder="Prenom" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="submit" value="submit">
                                    <div class="col-sm-2">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="gradeX">
                                        <th>#</th>
                                        <th>Login</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td><?php echo $user['id'] ?></td>
                                            <td><?php echo $user['login'] ?></td>
                                            <td><?php echo $user['email'] ?></td>
                                            <td>
                                                <?php if ($user['autorisation'] == 1) { 
                                                    echo "User";
                                                } else if($user['autorisation'] == 2) {
                                                    echo "Manager";
                                                } else {
                                                    echo "Admin";
                                                } ?>
                                                
                                            </td>
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
                                        <li><a href="index.php?c=medecin&task=index&page=<?php echo $currentPage - 1 ?>">Precedent</a></li>
                                        <li><a href="index.php?c=medecin&task=index&page=<?php echo $currentPage + 1 ?>">Suivant</a></li>
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