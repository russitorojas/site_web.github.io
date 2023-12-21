<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <title>Calendrier éléve</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <div>
    <p class="subtitle" align="center">CALENDRIER D'UN ELEVE</p>
  </div>
  <body >
  <?php
    
    include 'connexion.php';

    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    // recuperer id eleve
    $ideleve = $_POST['ideleve'];

    //Securite pour eviter l'injection SQL
    $ideleve_ech = mysqli_real_escape_string($connect,$ideleve);

    if (empty($ideleve_ech)) {
      echo "Attention, il faut remplir tous les champs";
      echo "<br><a href=\"visualisation_calendrier_eleve.php\" >Recommencer en cliquant ici</a>";
        exit();
    }

    //requete
    $query_nom = "SELECT * FROM eleves WHERE eleves.ideleve = $ideleve_ech"; // recuperer les lignes (rows) de l'eleve choisie dans le formulaire
    $result_nom = mysqli_query($connect, $query_nom);

    if (!$result_nom) {
      echo "La requete $query_nom a échoué : ".mysqli_error($connect);
      echo "<br><a href=\"visualisation_calendrier_eleve.php\">Recommencer en cliquant ici</a>";
      exit();
    }

    while ($row_nom = mysqli_fetch_array($result_nom)){
      $nom = $row_nom['nom'];
      $prenom = $row_nom['prenom'];
    }


    //requete pour recuperer les infos des inscriptions
    $query = "SELECT inscription.idseance, inscription.ideleve, note, DateSeance, themes.nom, descriptif FROM inscription INNER JOIN seances ON inscription.idseance = seances.idseance INNER JOIN themes ON seances.idtheme = themes.idtheme WHERE inscription.ideleve = $ideleve AND seances.DateSeance >= '$date' ORDER BY DateSeance";
    $result = mysqli_query($connect, $query);
    //order by ->il range les resultats par rapport a la date,
    if (!$result){
      echo "La requete $query_nom a échoué : ".mysqli_error($connect);
      echo "<br><a href=\"visualisation_calendrier_eleve.php\">Recommencer en cliquant ici</a>";
      exit();
    }
    
    echo "<table>";
    if (mysqli_num_rows($result) == 0){ // si leleve est pas inscrit quelque part
      echo "<tr><td>Pas encore inscrit dans des séances</td></tr>";
    }
    else{//afficher les seances futures
      echo "<tr><td><b>Calendrier de $nom $prenom:</b></td></tr>";
      echo "<tr><td><b>Séances à venir:</b></td></tr>";
      
      while ($row = mysqli_fetch_array($result)){
          echo "<tr><td>Nom :</td> <td>$row[nom]</td></tr>";
          echo "<tr><td>Date : </td><td>$row[DateSeance]</td></tr>";
          echo "<tr><td>Description : </td><td>$row[descriptif]</td></tr>";
      }
      echo "</table>";
    }
    
    mysqli_close($connect);
  ?>
  </body>
</html>