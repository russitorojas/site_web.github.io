<html>
    <head>
        <meta charset="utf-8">
        <title>Desinscription d'un éléve</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <div>
        <p class="subtitle" align="center">DESINSCRIPTION DE UNE SEANCE</p>
    </div>
    <body >
      <?php
        
        include 'connexion.php';
     
        $ideleve = $_POST['ideleve'];
        $idseance = $_POST['idseance'];

        //Securite pour eviter l'injection SQL
        $ideleve_ech = mysqli_real_escape_string($connect,$ideleve);
        $idseance_ech = mysqli_real_escape_string($connect,$idseance);

        //test si le "required" de html n'a pas abouti
        if (empty($ideleve_ech) or empty($idseance_ech) ) {
          echo "Attenion, il faut remplir tous les champs";
          echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
          exit();
        }
        
        $query_inscription = "SELECT * FROM inscription WHERE ideleve = $ideleve_ech AND idseance = $idseance_ech"; // recuperer les lignes (rows) de l'eleve choisie dans le formulaire
        $result_inscription = mysqli_query($connect, $query_inscription);

        if (!$result_inscription) {
            echo "La requete $query_inscription a échoué : ".mysqli_error($connect);
            echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
            exit();
        }

        if (mysqli_num_rows($result_inscription) == 0) { // pverifier si l'éleve etait inscrit dans cette seance
            echo " Cet éléve n'etait pas inscrit dans la séance !";
            echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
            exit();
        }
        else {

        //requete pour supprimer l'inscription
        $query = "DELETE FROM inscription WHERE ideleve = $ideleve_ech AND idseance = $idseance_ech";
        $result = mysqli_query($connect, $query);
        if (!$result)
        {
            echo "La requete $query a échoué : ".mysqli_error($connect);
            echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
            exit();
        }
        echo " Vous avez bien retiré l'élève de cette séance.
        <br>Votre requête SQL: $query<br>";
        }
        mysqli_close($connect);
        ?>
    </body>
</html>


