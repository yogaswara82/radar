<html>
    <body>
      <head>
         <title>HTML in 10 Simple Steps or Less</title>
         <meta http-equiv="refresh" content="10"> <!-- See the difference? -->
      </head>

                <?php
                      $server   = "localhost" ;
            					$username = "root";
            					$password = "";
            					$database = "antrian";
						
            					//Koneksi dan memilih database di server
            					mysql_connect($server,$username,$password) or die ("Koneksi database gagal");
            					mysql_select_db($database) or die ("Database tidak tersedia");
                               
                                $query = "SELECT * FROM caller";
                                $exe = mysql_query($query);
                                while($row = mysql_fetch_assoc($exe)){
                                    $id 	= $row['id'];
                                    $a1 	= $row['a1'];
            						$c1 	= $row['c1'];
            						$s1 	= $row['s1'];
									$a2 	= $row['a2'];
            						$c2 	= $row['c2'];
            						$s2 	= $row['s2'];
									$a3 	= $row['a3'];
            						$c3 	= $row['c3'];
            						$s3 	= $row['s3'];
									$a4 	= $row['a4'];
            						$c4 	= $row['c4'];
            						$s4 	= $row['s4'];
									$a5 	= $row['a5'];
            						$c5 	= $row['c5'];
            						$s5 	= $row['s5'];
					
                    echo "1:$a1:$c1:$s1:$a2:$c2:$s2:$a3:$c3:$s3:$a4:$c4:$s4:$a5:$c5:$s5";
                    }
               
                ?>

    </body>

</html>