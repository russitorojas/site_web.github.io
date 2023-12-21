<html>
    <head>
        <meta charset="utf-8">
        <title>noter eleves</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body >
    <?php
      // connexion
      include 'connexion.php';
      date_default_timezone_set('Europe/Paris');
      $date = date("Y-m-d");

      $idseance = $_POST['seance'];

      //Securite : pour eviter l'injection SQL
      $idseance_ech = mysqli_real_escape_string($connect, $idseance);

      // requete pour recuperer les info de la table inscription jointe à celle eleves, pour la seance correspondante
      $query = "SELECT * FROM inscription inner join eleves on inscription.ideleve = eleves.ideleve WHERE idseance = $idseance_ech";
      $result_inscrits = mysqli_query($connect, $query);

    
      if (!$result_inscrits) {
        echo "La requete $query a échoué :" .mysqli_error($connect);
        exit();
      }

      while ($ligne_eleves = mysqli_fetch_array($result_inscrits)){ // les eleves inscrits

        //infos eleves
        $ideleve=$ligne_eleves['ideleve'];
        $nom = $ligne_eleves['nom'];
        $prenom = $ligne_eleves['prenom'];

        $nb_fautes=$_POST[$ideleve];  // le nombre de fautes (à l'indice [ideleve])

        if (is_numeric($nb_fautes) and $nb_fautes<=40 and $nb_fautes>=0) {// verif nbombre de fautes est nombre compris entre  0 et 40
            $note = 40 - $nb_fautes;

            //requete pour la mise à jour de note de l'eleve pour la seance
            $update_note = mysqli_query($connect, " UPDATE inscription set note = $note where ideleve = $ideleve and idseance = $idseance;");
            if (!$update_note) {
              echo "échoué :" .mysqli_error($connect);
              echo "<br><a href=\"validation_seance.php\">Recommencer en cliquant ici</a>";
              exit();
            }
            echo "<br>$nom $prenom : $note/40<br>";
        }
        else {
          echo "  <br> $nom $prenom :  Pas de nouvelle note (Champ laissé vide ou invalide) <br> ";
        }
      }
      echo "<br><a href=\"validation_seance.php\">Valider d'autres séances en cliquant ici</a>";
      echo "<br><br><a href=\"accueil.php\">Revenir à l'acceuil en cliquant ici</a>";
      mysqli_close($connect);
     ?>

  </body>
</html>