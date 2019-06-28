<?php session_start(); ?>
<style>
    h1{margin-left:10%;margin-top:5%;font-weight:bold;}
</style>
<?php
require_once('require_once/db.php');
$valide=$pdo->exec('insert into article(nomArticle, description, prix, lieu, etat,etatVente, marque, id_objet, id_membre)                    
values("'.htmlspecialchars($_POST['nomArticle']).'","'.htmlspecialchars($_POST['description']).'",'.htmlspecialchars($_POST['prix']).',"'.htmlspecialchars($_POST['lieu']).'","'.$_POST['etat'].'","A valider","'.htmlspecialchars($_POST['marque']).'",'.$_POST['objet'].','.$_SESSION['id'].')');

if ($valide==1) 
{
    $dossier = 'images/article/';
    $fichier = basename($_FILES['photo_upload']['name']);
    $taille_maxi = 1000000; // 1 Mo
    $taille = filesize($_FILES['photo_upload']['tmp_name']);
    $extensions = array('.png', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['photo_upload']['name'], '.');
    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = '<h1>Vous devez uploader un fichier de type png, jpg, jpeg...  <a href="vendre.php"> Revenir a la page </a></h1>';
    }
    if($taille>$taille_maxi)
    {
        $erreur = '<h1>Le fichier est trop gros...</h1>';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
        //On remplace les lettres accentutées par les non accentuées dans $fichier.
        $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
       
        $articleCree=$pdo->query("select id from article where id_membre='".$_SESSION['id']."'order by id desc limit 1")->fetch();

        $newNameFile=$articleCree['id'].$extension;

        //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        if(move_uploaded_file($_FILES['photo_upload']['tmp_name'], $dossier . $newNameFile))
        {
            echo '<h1>Upload effectué avec succès !<a href="vendre.php"> Revenir a la page </a></h1>';       
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo '<h1 style="texte-aligne:center;">Echec de l\'upload ! <a href="vendre.php"> Revenir a la page </a></h1>';
        }
    }
    else
    {
        echo $erreur;
    }
}
else {
    header('Location:vendre.php');
}
?>

