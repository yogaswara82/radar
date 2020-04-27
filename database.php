

		<?php
			$con=mysqli_connect('localhost','root','','sisnav');
			// Check connection
			if (mysqli_connect_errno())
				{
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				
			$result = mysqli_query($con,'SELECT * FROM loc WHERE 1');
			$maps = array();
			while($row = mysqli_fetch_array($result))
				{
					$maps[] = $row;
				}
			?>			
		
			<?= json_encode($maps) ?>
			
