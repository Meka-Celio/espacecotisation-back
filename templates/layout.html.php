<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle ?> - Espace Cotisation - Backoffice</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Personal CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/Logo-cnom.png" alt="" style="width:260px;">
                </a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?c=user&task=dashboard" class="link-danger"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user-md fa-fw"></i> M??decins<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?c=medecin&task=index" class="link-danger"><i class="fa fa-user-md fa-fw"></i> Tous les M??decins</a>
                                </li>
                                <li>
                                    <a href="index.php?c=medecin&task=add" class="text-success"><i class="fa fa-user-md fa-fw"></i> Ajouter un m??decin</a>
                                </li>
                                <li>
                                    <a href="index.php?c=medecin&task=rechercher" class="text-warning"><i class="fa fa-user-md fa-fw"></i> Rechercher un m??decin</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="index.php?c=transaction&task=index"><i class="fa fa-th-list"></i> Transactions</a>
                        </li>
                        <li>
                            <a href="index.php?c=user&task=index"><i class="fa fa-group"></i> Utilisateurs</a>
                        </li>
                        <!-- <li>
                            <a href="index.php?c=recu&task=index"><i class="fa fa-file"></i> Re??us de paiement</a>
                        </li> -->
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Cotisations<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?c=cotisation&task=add"><i class="fa fa-edit"></i> Ajout de cotisations</a>
                                </li>
                                
                                <li>
                                    <a href="index.php?c=recu&task=show"><i class="fa fa-edit"></i> Rechercher re??us de paiement</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="index.php?c=user&task=logout" class="btn btn-danger"><i class="glyphicon glyphicon-log-out"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <main>
            <?php echo $pageContent ?>
        </main>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/js/sb-admin-2.js"></script>

</body>

</html>
