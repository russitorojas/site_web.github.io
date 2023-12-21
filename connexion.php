<html>
    <head>
        <meta charset="UTF8">
    </head>
    <body>
    <?php
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a092';
      $dbpass = '7KckBu1yiD1x';  
      $dbname = 'nf92a092'; 

      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
      mysqli_set_charset($connect, 'utf8'); 
    ?>
    </body>
</html>

