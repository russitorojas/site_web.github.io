<!DOCTYPE html>
<html>
    <head>
 
        <meta charset="UTF8"> 
        <link rel="stylesheet" href="styles.css">

    </head>
    <?php
    if($_POST['confirmation']=='OUI'){

        date_default_timezone_set('Europe/Paris');
        include 'connexion.php';
        
        $nom = strtoupper($_POST["nom"]);
        $prenom = strtoupper($_POST["prenom"]);
        $date_n = $_POST["date_n"];
        $date = date("Y-m-d");

        // Requête pour insérer l'élève
        $query = "INSERT INTO `eleves` (nom, prenom, dateNaiss, dateInscription) VALUES ('$nom', '$prenom', '$date_n', '$date')";
        echo "<br>$query<br>"; // important echo a faire systematiquement, c'est impose !
        
        $result = mysqli_query($connect, $query);
        if (!$result) {
            echo "Erreur d'insertion : " . mysqli_error($connect);
        } else {
            echo "Élève ajouté avec succès!";
        }

        mysqli_close($connect);
    }
    else{
        echo"L'ajout a été annulé<br>";
        echo"<a href='ajout_eleve.html'>Ajout d'un élève</a><br><br>";
    }
    
    ?>

</html>