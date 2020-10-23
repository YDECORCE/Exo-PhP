<?php
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    <strong>Livre</strong> : <?php echo $donnees['Titre_livre_Livres']; ?><br /><?php echo $donnees['Id_Livres']; ?><br/>
    écrit par : <?php echo $donnees['nom']; ?>, en <?php echo $donnees['annee_ecriture_Livres']; ?> <br />
    </em>
   </p>
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>