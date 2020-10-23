<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
// ligne de code pour se connecter à la base MySQL
$bdd = new PDO('mysql:host=localhost;dbname=exo_php05;charset=utf8', 'root', '');

?>

<!-- Bloc ajout d'un livre à la base de données-->
<div class="container bg-success" id="ajoutBDD">
<h2>Veuillez compléter les champs pour ajouter un livre à la BDD</h2>
<form name="ajout" method="get">
                <div class="form-group">
                    <input type="text" placeholder="titre de l'oeuvre" name="titre" class="form-control"></input><br />
                    <input type="text" placeholder="Auteur" name="auteur" class="form-control"></input><br />
                    <input type="date" placeholder="année" name="annee" class="form-control"></input><br />
                    <button class="btn btn-primary" type="submit" name="ajouter" value="OK">Ajouter</button>
                </div>
            </form>
<?php
if(isset($_GET['ajouter'])&&!empty($_GET['titre'])&&!empty($_GET['auteur'])&&!empty($_GET['annee'])){
    $req = $bdd->prepare('INSERT INTO Livres(Id_Livres, Titre_livre_Livres, annee_ecriture_Livres, nom) VALUES(NULL, :titre, :annee, :auteur)');
$req->execute(array(
	'titre' => $_GET['titre'],
	'annee' => $_GET['annee'],
	'auteur' => $_GET['auteur'],
	));

echo 'Le livre a bien été ajouté !';
}

?>
</div>
<!-- Bloc modifcation du titre d'un livre à la base de données-->
<div class="container bg-warning" id="modifBDD">
<h2>Vous voulez modifier le champ titre d'un livre</h2>
<form name="Modif" method="get">
                <div class="form-group">
                    <input type="number" placeholder="identifiant du livre" name="id" class="form-control"></input><br />
                    <input type="text" placeholder="Nouveau Titre" name="titre_modif" class="form-control"></input><br />
                    <button class="btn btn-primary" type="submit" name="modif_titre" value="OK">modifier</button>
                </div>
            </form>
<?php
if(isset($_GET['modif_titre'])&&!empty($_GET['id'])&&!empty($_GET['titre_modif'])){
    $id=$_GET['id'];
     $info_avant_modif = $bdd->query("SELECT * FROM Livres WHERE Id_Livres=$id");
     $affichage = $info_avant_modif->fetch();
    echo "le titre du livre que vous allez modifier est : ".$affichage['Titre_livre_Livres']."<br/>";
    $req = $bdd->prepare('UPDATE Livres SET Titre_livre_Livres = :nvtitre WHERE Id_Livres= :id');
    $req->execute(array(
	'nvtitre' => $_GET['titre_modif'],
	':id' => $id
    ));
    $info_apres_modif = $bdd->query("SELECT * FROM Livres WHERE Id_Livres=$id");
     $affichage = $info_apres_modif->fetch();
    echo "le nouveau titre du livre est : ".$affichage['Titre_livre_Livres']."<br/>";
}
?>
</div>

<!-- Bloc suppression d'un livre à la base de données-->
<div class="container bg-danger" id="suppressionBDD">
<h2>Vous voulez supprimer un livre de la base de données</h2>
<form name="suppr" method="get">
                <div class="form-group">
                    <input type="number" placeholder="identifiant du livre" name="id" class="form-control"></input><br />
                    <button class="btn btn-primary" type="submit" name="suppr_donnees" value="OK">supprimer</button>
                </div>
            </form>
<?php
if(isset($_GET['suppr_donnees'])&&!empty($_GET['id'])){
    $id=$_GET['id'];
    $info_avant_modif = $bdd->query("SELECT * FROM Livres WHERE Id_Livres=$id");
    $affichage = $info_avant_modif->fetch();
    echo "le livre que vous allez supprimer est : ".$affichage['Titre_livre_Livres']." de ".$affichage['nom']."<br/>";
    $req = $bdd->prepare('DELETE FROM Livres WHERE Id_Livres= :id');
    $req->execute(array(
	':id' => $id
    ));
   echo "le livre a été supprimé.";
}
?>
</div>
<div class="container bg-info d-flex" style="flex-wrap:wrap">
<h2>La collection de livres</h2>
<div class="row">
<?php
//ligne de code pour faire une requête dans la base query =requete
$reponse = $bdd->query('SELECT * FROM livres');
//On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
echo "<div class=\"col-3 p-3  border text-center\"><p>".$donnees['Id_Livres']."</p><p>".$donnees['Titre_livre_Livres']."</p><p>". $donnees['nom']."</p><p>".$donnees['annee_ecriture_Livres']."</p></div>";
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>
</div>
</div>
</body>
</html>

