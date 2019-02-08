 <?php
$to = "bunmie.esther@gmail.com";
			$subject = "WAEC : Login details";
			$content= "Dear Officer, \n You have been successfully registered. \n To access your profile, please use the log-in details provided below: \n 
					username : Oluwabunmi \n 
					Password : bunmi";
			$headers = "From:bunmie.esther@gmail.com\r\n";

			if(mail($to,$subject,$content,$headers))
				
			{
				echo "successful";
			}
			else
			{
				echo "failed!!";
			}	
?>