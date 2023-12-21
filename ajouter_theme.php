<html>
    <head>
        <meta charset="UTF8">
    </head>
    <body>
        <?php
        if(!empty($_POST["nom"]) ){
            
            //connexion a la base de donnees,
            include 'connexion.php';

            $nom=$_POST["nom"];
            $descriptif=$_POST["descriptif"]; 
            
            // on verifie si le theme existe deja
            $check_query = "SELECT * FROM `themes` WHERE nom = '$nom' AND supprime = '1'";
            $check_result = mysqli_query($connect, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // El tema ya existe y está marcado como eliminado, reactivarlo
                $reactivation_query = "UPDATE `themes` SET supprime = '0', descriptif = '$descriptif' WHERE nom = '$nom'";
                $reactivation_result = mysqli_query($connect, $reactivation_query);

                if ($reactivation_result) {
                    echo "Theme reactive avec succes!";
                } else {
                    echo "Erreur d'activation" . mysqli_error($connect);
                }
               
             
            }else {
                $query = "INSERT INTO `themes` (nom, supprime, descriptif) VALUES ('$nom', '0', '$descriptif')";
            
                echo "<br>$query<br>"; // important echo a faire systematiquement, c'est impose !
        
                $result = mysqli_query($connect, $query); 
                if (!$result){
                    echo "<br>Erreur de Connexion".mysqli_error($connect);
                }
               
            }
            mysqli_close($connect); 
        
        }else{
            echo"Erreur de saisie!!<br>";
            }

        ?>
    </body>
</html>