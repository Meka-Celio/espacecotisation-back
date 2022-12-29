<div id="page-wrapper"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-success">Ajouter un médecin</h1>
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
                            Chercher
                        </div>
                        <!-- /panel-heading -->

                        <div class="panel-body">
                            <form action="index.php?c=medecin&task=check" method="post">
                                <div class="form-group col-lg-12">
                                    <label for="cin">Cin à chercher</label>
                                    <input type="text" name="cin" id="cin" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="submit" name="submit" value="Chercher" class="btn btn-secondary">
                                </div>
                            </form>
                            <?php if (isset($mMedecin)) { ?>
                                <h4>Résultat : </h4>
                                <p>Cin : <?= $mMedecin->Cin ?></p>
                                <p>Nom : <?= $mMedecin->NomComplet ?></p>
                                <p>Telephone : <?= $mMedecin->Telephone ?></p>
                                <p>Email : <?= $mMedecin->Email ?></p>
                                <p>Region : <?= $mMedecin->LibelleRegion ?></p>
                                <p>Specialite : <?= $mMedecin->SpecialiteMedecin ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Ajouter de médecin
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <form action="index.php?c=medecin&task=store" method="post">
                                <div class="form-group col-md-4">
                                    <?php if (isset($mMedecin)) { ?>
                                        <label for="cin">CIN</label>
                                        <input type="text" name="cin" id="cin" class="form-control" value="<?= $mMedecin->Cin ?>" data-rule="string" required>
                                        <input type="hidden" name="nom_complet" value="<?= $mMedecin->NomComplet ?>">
                                    <?php } else { ?>
                                        <label for="cin">CIN</label>
                                        <input type="text" name="cin" id="cin" class="form-control" data-rule="string" required>
                                    <?php }?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" data-rule="string" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" data-rule="string" required>
                                </div>
                                <div class="form-group col-md-6">
                                <?php if (isset($mMedecin)) { ?>
                                        <label for="telephone">Téléphone</label>
                                        <input type="tel" name="telephone" id="telephone" class="form-control" value="<?= $mMedecin->Telephone ?>" data-rule="number">
                                    <?php } else { ?>
                                        <label for="telephone">Téléphone</label>
                                        <input type="tel" name="telephone" id="telephone" class="form-control" data-rule="number">
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                <?php if (isset($mMedecin)) { ?>
                                        <label for="email">E-mail</label>
                                        <input type="email" name="email" id="email" class="form-control" value="<?= $mMedecin->Email ?>" data-rule="email">
                                    <?php } else { ?>
                                        <label for="email">E-mail</label>
                                        <input type="email" name="email" id="email" class="form-control" data-rule="email">
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="region">Région</label>
                                    <select name="idRegion" id="region" class="form-control">
                                        <option value="0">----- Région -----</option>
                                        <?php for ($i=0; $i < count($regions); $i++) { ?>
                                            <option value="<?php echo $regions[$i]['id'] ?>">
                                                <?php echo $regions[$i]['nomRegion'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="specialite">Spécialité</label>
                                    <select name="idSpecialite" id="specialite" class="form-control" data-rule="number">
                                        <option value="0">----- Specialité -----</option>
                                        <?php for ($i=0; $i < count($specialites); $i++) { ?>
                                            <option value="<?php echo $specialites[$i]['id'] ?>">
                                                <?php echo $specialites[$i]['nomSpecialite'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="submit" value="Ajouter" name="submit" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>