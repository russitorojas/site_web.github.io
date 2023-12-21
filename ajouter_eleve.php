<!DOCTYPE html>
<html>
    <head>
    
        <meta charset="UTF8">    
    </head>
   
    <body>
    <?php
    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["date_n"])){
        //ici
        date_default_timezone_set('Europe/Paris');

        include 'connexion.php';
            
        $nom = strtoupper($_POST["nom"]);
        $prenom= strtoupper($_POST["prenom"]); 
        $date_n=$_POST["date_n"];
        $date = date("Y-m-d");
        
        //verification d'un eleve avec le meme nom et prenom 
        $checkQuery= "SELECT * FROM eleves WHERE nom='$nom' AND prenom='$prenom'"; 
        $checkResult= mysqli_query($connect,$checkQuery);
        if (mysqli_num_rows($checkResult)>0){
            echo"<br><br>";
            echo"Un élève avec le même nom et prénom existe déjà. Confirmez-vous l'ajout ?";
            
            //METHODE GET ICI ? 
            echo "<FORM METHOD='POST' ACTION='valider_eleve.php'>";
            echo "<input type='hidden' name='nom' value='$nom'>";
            echo "<input type='hidden' name='prenom' value='$prenom'>";
            echo "<input type='hidden' name='date_n' value='$date_n'>";
            echo "<input type='submit' name='confirmation' value='OUI'>";
            echo "<input type='submit' name='confirmation' value='NON'>";
            echo "</FORM>";

            mysqli_close($connect);
        }
        else{
            $query = "INSERT INTO `eleves` (nom, prenom, dateNaiss, dateInscription) VALUES ('$nom', '$prenom', '$date_n', '$date')";
            
            echo "<br>$query<br>"; // important echo a faire systematiquement, c'est impose !
        
            $result = mysqli_query($connect, $query); 
            if (!$result){
                echo "<br>pas bon".mysqli_error($connect);
            }
        
            mysqli_close($connect);

        }
        
    }
    else{
        echo"error de saisie!!<br>";
    }

    ?>
    </body>
</html>