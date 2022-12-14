<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-danger">Enregister une cotisation</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Renseigner les données de la transaction
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                
                    <?php echo $alert ?>

                    <form action="index.php?c=cotisation&task=insert" method="post">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="cinInput" class="form-label">CIN du médecin</label>
                                <input type="text" class="form-control" id="cinInput" name="cin" placeholder="la cin à chercher">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="nCommandeInput" class="form-label">N° Commande...</label>
                                <input type="text" class="form-control" id="nCommandeInput" name="nCommande" placeholder="W........">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="years" onload="showYears()">
                                <script>
                                    let year = 2009;
                                    let i = 25
                                    while (year <= 2022) 
                                    {
                                        document.write(`<div class="col-md-2">
                                                    <label for="id-${i}">${year}</label>
                                                    <input type="checkbox" name="idCotisation[]" id="id-${i}" value="${i}">
                                                </div>`)
                                        year++
                                        i++
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="form-group" style="clear:both;">
                            <div class="mb-3">
                                <input type="submit" name="submit" value="Ajouter des cotisations" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
