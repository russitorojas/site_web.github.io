<?php
    if (!empty($_POST["choixEleve"]) ) {
        date_default_timezone_set('Europe/Paris');

        include 'connexion.php';
        $date_actuelle = date("Y-m-d"); //date d'aujourd'hui
        $ideleve = $_POST["choixEleve"];

        $querySeances="SELECT d.idseance, d.DateSeance, themes.nom FROM 
        (SELECT c.* FROM (SELECT seances.* FROM seances LEFT JOIN (SELECT DISTINCT(idseance) AS idseance FROM inscription WHERE ideleve='$ideleve')AS a ON seances.idseance=a.idseance WHERE a.idseance IS NULL) AS c 
        INNER JOIN 
        (SELECT seances.*FROM seances LEFT JOIN (SELECT idseance, COUNT(idseance) AS eff FROM inscription GROUP BY idseance) AS b ON seances.idseance = b.idseance WHERE seances.EffMax > b.eff OR b.eff is NULL) AS d 
        ON c.idseance = d.idseance WHERE c.DateSeance >= NOW()) AS d INNER JOIN themes ON d.Idtheme = themes.idtheme";
    
        
        $res_2 = mysqli_query($connect,$querySeances);

	    if(!$res_2){
			echo "<br> Erreur :".mysqli_error($connect);
	    }

        //Formulaire pour choisir une seance
        echo "<FORM METHOD='POST' ACTION='inscrire_eleve2.php' >" ;
        echo "<input type='hidden' name='eleveChoisi' value='$ideleve'>"; // Añadir el choixEleve como campo oculto
	    echo "<p>Liste des séances: <br>";
        echo "<select name='choixSeance' size='4'>";
	    while ($rows = mysqli_fetch_array($res_2)){  //on utilise les noms des colonnes
		    echo "<option value='".$rows['idseance']."'>"."Seance du theme: ".$rows['nom']." le date ".$rows['DateSeance']."</option>";
			
	    }

	    echo "</select></p>";

	    echo "<br><br><INPUT type='submit' value='Enregistrer inscription'>";
	    echo "</FORM>";

    
        mysqli_close($connect);
    
    } else {
        echo "Erreur de saisie!!<br>";
    }
?>
