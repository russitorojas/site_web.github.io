<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">

    </head>
    <div>
        <p class="subtitle" align="center">VALIDATION D'UNE SEANCE</p>
    </div>
    <body>
    <form action="valider_seance.php" method="POST" >
    <p>Veuillez choisir la séance que vous souahitez valider:</p>
     
        <select name="idseance" size="4">
         <?php
          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");
          include 'connexion.php';
          $query = "SELECT * FROM seances INNER JOIN themes WHERE themes.idtheme = seances.idtheme and seances.DateSeance < '$date'";
          $result_seances = mysqli_query($connect, $query);
          //verif
          if (!$result_seances) {
            echo "La requete $query a échoué :" .mysqli_error($connect);
            echo "<br><a href=\"validation_seance.php\" >Recommencer en cliquant ici</a>";
            exit();
          }

          while ($seance = mysqli_fetch_array($result_seances, MYSQLI_NUM)) {
            echo "<option value = \"$seance[0]\"> $seance[1] $seance[5]</option>";
          }

          mysqli_close($connect);
          ?>
       </select><br>
  
       <input type="submit" value="Valider">
       <input type="reset" value="Reset">
 
  </body>
</html>