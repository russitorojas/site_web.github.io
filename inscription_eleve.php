<html>
    <head>
        <meta charset="UTF8"> 
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <div>
        <p class="subtitle" align="center">INSCRIPTION D'UN ELEVE</p>
    </div>
    <body>

    <?php
   
    //connexion a la BDD
    
    include 'connexion.php';
   
    $queryEleves="SELECT * FROM eleves ";
    $res_1 = mysqli_query($connect,$queryEleves);
    if(!$res_1){
        echo "<br> Erreur :".mysqli_error($connect);
    }
    
    //Formulaire pour choisir un élève 
    echo "<FORM METHOD='POST' ACTION='inscrire_eleve.php' >";
    echo" <p>Liste d'Elèves: <br>";
    echo '<br><select name="choixEleve" size="4">';
    while ($row = mysqli_fetch_array($res_1, MYSQLI_NUM)){ 
        echo "<option value='".$row[0]."'>".$row[1]."  ".$row[2]." né le ".$row[4]."</option>";
         
    }
    echo "</select><br>";
     
    echo "<br><INPUT type='submit' value='Accepter'>";
    echo "</FORM>";
    
    mysqli_close($connect);
    ?>
    </body>
</html>