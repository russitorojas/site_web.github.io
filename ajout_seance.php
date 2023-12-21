<!DOCTYPE html>
<html>
    <head>
 
        <meta charset="UTF8"> 
        <link rel="stylesheet" href="styles.css">

    </head>
    <div>
        <p class="subtitle" align="center">AJOUT D'UNE SEANCE</p>
    </div>
    <body>
    <?php
        date_default_timezone_set('Europe/Paris');
        //connexion a la BDD
    
        include 'connexion.php';
   
        $date = date("Y-m-d"); //date d'aujourd'hui

        $query="SELECT * FROM themes WHERE supprime=0";  //MODIFICAR CON WHERE PARA RECUPERAR SOLO TEMAS ACTIFS 0
        $result = mysqli_query($connect,$query);
        echo"<p>";
        echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' >";
        echo" <p>Liste des thèmes: <br>";
        echo '<select name="menuChoixTheme" size="5" ">';
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        
        }
        echo "</select><br>";
        echo "<br>Date du theme:<br>";

        echo "<INPUT class='special' type='date' name='dateSeance' min='{$date}' ><br>";

        echo "<br>Effectif maximun<br>";
        echo'<input type="number"  name="effmax" min="0" max="20"><br>';
        echo "<br><INPUT class='special' type='submit' value='Enregistrer séance'>";
        echo "</FORM>";
        echo"</p>";
        mysqli_close($connect);
    ?>
    </body>
</html>