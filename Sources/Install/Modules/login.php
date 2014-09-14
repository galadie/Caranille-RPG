<?php
$array_adm = array(
	'admin' => '23403278'
);

function login()
{
	global $secteur, $page , $_path , $newsAmodifier, $array_adm ;
	
	if( $page =='login')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		//Si l'id passé en paramètre dans l'url n'existe pas, c'est que le visiteur a été amenené ici par hasard
		if(!request_confirm('admin-login')) {
			//Donc on redirige vers index.php
			header('location:'.getenv('HTTP_REFERER'));
			//Puis on stoppe l'exécution du script
			exit();
		}
		
		debug_log('page login');
		
		// si on s'identifie
		if(request_confirm('admin-login'))
		{	
			debug_log('form login');
			
			$login = request_post('pseudo');
			$pass = request_post('password');
			
			if(array_key_exists ( $login , $array_adm ))
			{
				debug_log('exists login'."test($pass == ".$array_adm[$login].")");
				if($pass == $array_adm[$login]  )
				{
					debug_log('pass login');
					$_SESSION['admin'] = true ;
					$_SESSION['user'] = $login ;
				}
				else
					$_SESSION['error'] = "Mot de passe erroné.";
			}
			else
				$_SESSION['error'] = "Cet accès n'existe pas.";
				
			header('location:'.getenv('HTTP_REFERER'));
		}
	}
}

function logout()
{
	global $secteur, $page ;
	
	if( $page =='logout')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{	
		// si on se deconnecte
		//unset($_SESSION);
		$_SESSION['admin'] = false ;
		$_SESSION['user'] = null ;
		$_SESSION['error'] = null;
		header('location:'.getenv('HTTP_REFERER'));
	}
}
		
function login_form()
{
	if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
	{
		echo "<p>Bienvenue, ".$_SESSION['user']."<br/><a href='".get_link("logout","Install")."'>Deconnexion</a></p>";
	}
	else
	{
		if(isset($_SESSION['error']))
		{
			$error = $_SESSION['error'] ; 
			unset($_SESSION['error']) ;
			
			print($error);
		}
			
?>
	<form class="install-login" method="post" action="<?php echo get_link("login","Install") ?>" >
		<input type="text" name="pseudo" placeholder="pseudo"/>
		<input type="password" name="password" placeholder="password"/>
		<input type="submit" name="admin-login" value="OK" />
	</form>
<?php

	}
}