<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8">
        <title>Calendrier éléve</title>
        <link rel="stylesheet" href="styles.css">
  </head>
  <div>
        <p class="subtitle" align="center">CALENDRIER D'UN ELEVE</p>
  </div>
  <body >
      <form action="visualiser_calendrier_eleve.php" method="POST" > 
      <p>Choisir un éléve:</p> </td>
      <?php
        // connexion
        include 'connexion.php';

        $query_eleves = "SELECT * FROM eleves";
        $result_eleves = mysqli_query($connect, $query_eleves);

        if (!$result_eleves) {
          echo "La requete $query_eleves a échoué : ".mysqli_error($connect);
          echo "<br><a href=\"visualisation_calendrier_eleve.php\" >Recommencer en cliquant ici</a>";
          exit();
        }

        echo "<select size='4' name='ideleve' required>";

        while ($row = mysqli_fetch_array($result_eleves)){
            echo "<option value= $row[0]>$row[1] $row[2]</option>"; // option ideleve avec nom prenom
        }
        echo "</select>";

        mysqli_close($connect);
      ?>
      <br>
      <input type="submit" value="Consulter">
      <input type="reset" value="Reset">
  </body>
</html>