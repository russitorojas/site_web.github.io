<html>
    <head>
        <meta charset="utf-8">
        <title>Desinscription d'un éléve</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <div>
        <p class="subtitle" align="center">DESINSCRIPTION DE UNE SEANCE</p>
    </div>
    <body>
    <form action="desinscrire_seance.php" method="post">
        <table>
          <tr>
            <td> <p>Choisir l'éléve:</p> </td>
            <td> <p>Choisir la séance:</p> </td>
          </tr>
          <tr>
          <?php
            // connexion
            include 'connexion.php';

            //requete pour les eleves
            $query_eleves = "SELECT * FROM eleves"; // recuperer la liste de tous les eleves
            $result_eleves = mysqli_query($connect, $query_eleves);

            if (!$result_eleves) {
              echo "La requete $query_eleves a échoué : ".mysqli_error($connect);
              echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
              exit();
            }

            date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d");

            //requete pour les seances
            $query_seances = "SELECT * FROM seances INNER JOIN themes ON themes.idtheme = seances.idtheme where seances.DateSeance>=$date"; 
            //recuperer les seances à venir
            $result_seances = mysqli_query($connect, $query_seances);

            if (!$result_seances) {
              echo "La requete $query_seances a échoué : ".mysqli_error($connect);
              echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
              exit();
            }


          	// select eleve
          	echo "<td> <select size='4' name='ideleve' required>";

            while ($row = mysqli_fetch_array($result_eleves))
            {
            echo "<option value=$row[ideleve]> $row[nom] $row[prenom]</option>"; // eleves
            }
            echo "</select></td>";

          	// select seances
            echo "<td><select size='4' name='idseance' required>";
            while ($row2 = mysqli_fetch_array($result_seances))
            {
            echo "<option value=$row2[idseance]>$row2[nom] $row2[DateSeance]</option>";//  seances
            }
            echo "</select></td></tr>";


            mysqli_close($connect);
            ?>          
        </table><br>
        <input type="submit" value="Desinscrire"> 
        <input type="reset" value="Reset">
      </form>
  </body>
</html>