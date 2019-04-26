<?php
include_once('inc/init.inc.php');
include_once('inc/modal.inc.php');

$infosCategorie = $pdo->prepare("SELECT titre, id_categorie FROM categorie");
        $infosCategorie->bindParam(':id_annonce', $_GET['id_annonce'], PDO::PARAM_STR);
        $infosCategorie->execute();
        
        $infosCategorie = $infosCategorie->fetchAll(PDO::FETCH_ASSOC);





//Ouverture du fichier
$myfile = fopen("communes1.csv", "r") or die("Unable to open file!");
$maChaine = fread($myfile,filesize("communes1.csv"));

//On crée une liste, en creant un nouvel element a chaque oint virgule
$maListe = explode(";", $maChaine);
array_shift($maListe);
//echo $maChaine;
//echo count($maListe);
//echo '<pre>';
//print_r($maListe);
//echo '</pre>';
//fclose($myfile);

//On crée une liste qui contient toute les informations d'une ville'
$lesVilles = [];
$maPetiteListe = [];
for ($i=0; $i<count($maListe);$i++){
    if ($i%7 == 0){
//        Tout les 6 tours, j'ajoute le contenue de ma petite liste dans ma super liste
        array_push($lesVilles, $maPetiteListe);
        $maPetiteListe = [];
    }
//    A chaque tour, j'ajoute l'element a ma petite liste
    array_push($maPetiteListe, $maListe[$i]);
}
//array_shift($lesVilles);
//echo '<pre>';
//print_r($lesVilles);
//echo '</pre>';

//echo $lesVilles[2][1];

//On recupere ici la liste de toutes les regions
$listeRegions = [];
for ($i=2; $i<count($lesVilles);$i++){
    if (!empty($lesVilles[$i][1])){
        if (!in_array($lesVilles[$i][1], $listeRegions)){
    array_push($listeRegions, $lesVilles[$i][1]);  
        }
    }      
}

//On recupere ici la liste de tout les departements
$listeDepartements = [];
for ($i=2; $i<count($lesVilles);$i++){
    if (!empty($lesVilles[$i][2])){
        if (!in_array($lesVilles[$i][2], $listeDepartements)){
    array_push($listeDepartements, $lesVilles[$i][2]);  
        }
    }      
}

sort($listeRegions);
sort($listeDepartements);

     
//echo '<pre>';
//print_r($listeRegions);
//echo '</pre>';     
//echo '<pre>';
//print_r($listeDepartements);
//echo '</pre>';

include_once('inc/header.inc.php');
include_once('inc/nav.inc.php');
?>

<div class="containerPage container-fluid row border border-primary">

    <nav class="col-lg-4 mt-3">
        <div class="form-group">
            <label for="categorie">Categorie</label>
            <select class="custom-select" id="categorie" name="categorie">
              <option value="toutes">Toutes les catégories</option>
               <?php 
                
                foreach($infosCategorie AS $laCategorie){
                    echo '<option value="' . $id_categorie . '">' . $laCategorie['titre'] . '</option>';
                }
                ?>
                
            </select>
        </div>
        <div class="form-group">
            <label for="regions">Regions</label>
            <select class="custom-select" id="regions" name="regions">
                <option value="toutes">Toutes les regions</option>
                <?php foreach($listeRegions as $laRegion){
                echo '<option>' . $laRegion . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="regions">Departement</label>
            <select class="custom-select" id="regions" name="regions">
                <option value="toutes">Tout les departements</option>
                <?php foreach($listeDepartements as $leDepartement){
                echo '<option>' . $leDepartement . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="prixMinimum">Prix minimum</label>
            <input type="range" class="prixMinimum" id="prixMinimum" min="0" max="10000" step="100">
        </div>
        <div class="form-group">
            <label for="prixMaximum">Prix maximum</label>
            <input type="range" class="prixMaximum" id="prixMinimum" min="0" max="10000" step="100">
        </div>
    </nav>
    <!-- Affichage des annonces en pages d'accueil -->
    <div class="container annonce-index col-lg-8 border border-primary mt-3">
        <div class="starter-template">
            <h1><i class="fas fa-shopping-cart mes_icones"></i> Bienvenue sur Annonceo <i class="fas fa-shopping-cart mes_icones"></i></h1>
            <p class="lead">
                <?php echo $msg;?>
            </p>
        </div>
        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="images/img1.jpg" class="w-100 img-fluid" alt="...">
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0">Columns with stretched link</h5>
                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                <a href="<?php echo URL . " annonce.php?id_annonce=2"; ?>" class="stretched-link">Go somewhere</a>
            </div>
        </div>
        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="images/img1.jpg" class="w-100 img-fluid" alt="...">
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0">Columns with stretched link</h5>
                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                <a href="#" class="stretched-link">Go somewhere</a>
            </div>
        </div>
        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="images/img1.jpg" class="w-100 img-fluid" alt="...">
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0">Columns with stretched link</h5>
                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                <a href="#" class="stretched-link">Go somewhere</a>
            </div>
        </div>
        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="images/img1.jpg" class="w-100 img-fluid" alt="...">
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0">Columns with stretched link</h5>
                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                <a href="#" class="stretched-link">Go somewhere</a>
            </div>
        </div>
        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="images/img1.jpg" class="w-100 img-fluid" alt="...">
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0">Columns with stretched link</h5>
                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                <a href="#" class="stretched-link">Go somewhere</a>
            </div>
        </div>
    </div>

</div>
<!-- Fin d'affichage des annonces en pages d'accueil -->
<?php
include_once('inc/footer.inc.php');
?>
