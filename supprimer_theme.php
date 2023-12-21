<html>
    <head>
        <meta charset="utf-8">
        <title>Suppression d'un thème</title>
        <link rel="stylesheet" href="styles.css">
    </head>
  
    <body >
    <?php
        // connexion
        include 'connexion.php';

        // determiner la date du jour
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        // recuperer idtheme
        $idtheme = $_POST['idtheme'];

        //Securite pour eviter l'injection SQL
        $idtheme_ech = mysqli_real_escape_string($connect,$idtheme);

        //test si le "required" de html n'a pas abouti
        if (empty($idtheme_ech) ) {
            echo "Attenion, il faut remplir tous les champs";
            echo "<br><a href=\"suppression_theme.php\" >Recommencer en cliquant ici</a>";
            exit();
        }

        //requete pour supprimer le theme
        $query_supr_theme = "UPDATE themes SET supprime = 1 WHERE idtheme=$idtheme_ech";
        $result_supr_theme = mysqli_query($connect, $query_supr_theme);
        if (!$result_supr_theme) {
            echo "La requete $query_supr_theme a échoué : ".mysqli_error($connect);
            echo "<br><a href=\"suppression_theme.php\" >Recommencer en cliquant ici</a>";
            exit();
        }

        //requete pour recuperer les seances deja planifiées, sur le theme à supprimer
        $query_futur_seances = "SELECT themes.nom, seances.DateSeance FROM seances INNER JOIN themes ON seances.idtheme=themes.idtheme WHERE seances.idtheme=$idtheme_ech AND seances.DateSeance >$date ";
        $result_futur_seances = mysqli_query($connect, $query_futur_seances);

        if (!$result_futur_seances) {
            echo "La requete $query_futur_seances a échoué : ".mysqli_error($connect);
            echo "<br><a href=\"suppression_theme.php\" >Recommencer en cliquant ici</a>";
            exit();
        }

        echo "Vous venez de supprimer le thème demandé";
        echo "<br>Votre requête SQL: $query_supr_theme<br>";

        // prevenir l'utilisateur sur les seance deja planifié est non vide
        if (mysqli_num_rows($result_futur_seances)>0) {
            $nb_seances_restants=mysqli_num_rows($result_futur_seances);
            echo "<br>Attention: il reste encore <b>$nb_seances_restants</b> séance.s prévues autour de ce thème";

        }

        mysqli_close($connect);
    ?>

  </body>
</html>