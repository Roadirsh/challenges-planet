<?php

	function isconnect($login, $pwd)
	{
		global $connexion;

		try 
		{
			$select = $connexion -> prepare("SELECT * 
											FROM minitp_users
											WHERE USER_LOGIN = '" . $login."'
											AND USER_PASSWORD = '" . $pwd . "'");
												
			$select -> execute();

            
			if($co = $select -> fetch(PDO::FETCH_OBJ))
			{
				$_SESSION['connect_compte'] = true;
				$_SESSION['name'] = "$login";
				$_SESSION['Users'] = $row;
				if (isset($_POST['reco']))
					{
						if(!setcookie("Login",$login,time()+3600*24*31))
						{
							die("cookie ne peut etre enregistré !");
						}
						if(!setcookie("Passwords",$pwd,time()+3600*24*31))
						{
							die("cookie ne peut etre enregistré !");
						}
					}	
				return true;
				
			}
            
			$select -> closeCursor();
			//return true;
		}

		catch (Exception $e)
		{
			echo 'Message:' . $e -> getMessage();
		}
	}	