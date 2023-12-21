<?php
    if (!empty($_POST["choixSeance"]) ) {
        date_default_timezone_set('Europe/Paris');

        include 'connexion.php';
        $date_actuelle = date("Y-m-d"); //date d'aujourd'hui
        $idseance = $_POST["choixSeance"];

        $ideleve= $_POST["eleveChoisi"];
        
        $insertQuery = "INSERT INTO `inscription`(`idseance`, `ideleve`, `note`) VALUES ('$idseance','$ideleve',-1)";
            
        echo "<br>$insertQuery<br>"; // Importante echo para debugging

        $insertResult = mysqli_query($connect, $insertQuery);
        if (!$insertResult) {
            echo "<br>Erreur d'insertion : " . mysqli_error($connect);
        } else {
            echo "Séance ajoutée avec succès!";
        }
        mysqli_close($connect);
    
    } else {
        echo "Erreur de saisie!!<br>";
    }
?>
