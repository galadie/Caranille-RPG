<?php
function debug_log($text)//,$trace = true 
{
	global $debug_log_array ;

	if($text !="")
	{
		$log['message'] = $text ;
		/**if($trace)**/$log['trace'] = debug_backtrace() ;//[1];
		
		$debug_log_array[] = $log ;
	}
}

function show_debug($ID,$title,$content,$line=1)
{
	global $installing;
	
	if($installing || verif_access("Admin",true)) 
	{	
		$html =""; 
		$html .= '<div class="debug_screen_clos" id="debug_'.$ID.'_clos">';
		$html .= '<div class="debug_screen" id="debug_'.$ID.'">';
		$html .= '<h4>'.$title.'</h4>';
		$html .= '<div class="volet">';
		$html .= $content ;
		$html .= "</div>";
		$html .= '<a href="#debug_'.$ID.'" class="ouvrir line'.$line.'" aria-hidden="true">'.$title.'</a>';
		$html .= '<a href="#debug_'.$ID.'_clos" class="fermer line'.$line.'" aria-hidden="true">&cross;</a>';
		$html .= '</div>';
		$html .= '</div>';	
		
		return $html ;
	}
}

function debug_array($s= array())
{
	global $installing;
	
	if($installing || verif_access("Admin",true)) 
	{	
		$html =""; 
		$html .= "<table border='1'>";
		if(isset($s) && is_array($s) && !empty($s))
		{
			foreach( $s as $x => $r)  
			{
				$html .= "<tr><th>$x</th><td>";
				if(is_array($r))
				{
					$html .= debug_array($r);
				}
				else
					$html .= strip_tags ($r);
				$html .= "</td></tr>";
			}
		}
		$html .= "</table>" ;				
		return $html ;
	}
}

function debug_screen()
{
	global $debug_log_array , $debug_warning_array , $debug_notice_array , $debug_unknow_array,  $debug_sql_array, $debug_sql_error ,$_path , $Account_Data , $Stats_Data,  $installing;
	
	if($installing || verif_access("Admin",true)) 
	{	
		$html =""; 
		$corrig_path = str_replace("/",'\\',$_path);

		if(!empty($debug_log_array))
		{
			$content = "";
			$content .= "<table border='1'>";
			if(isset($debug_log_array))
			{
				foreach( $debug_log_array as $x => $req)  
				{
					foreach($req['trace'] as $n => $t)
					{
						if($n!=0 && $t['function']!=='debug_log')
						{
							$content .= "<tr>";
							if($n == 1)
								$content .= "<th rowspan='".(count($req['trace'])-1)."'>$x</th><td rowspan='".(count($req['trace'])-1)."' >".$req['message']."</td>";
							$content .= "<td>".(isset($t['file']) ? str_replace($corrig_path,"",$t['file']) : "")."</td>
								<td>".(isset($t['line']) ? $t['line']: '')."</td>
								<td>".$t['function']."</td>
								<td>".print_r($t['args'],1)."</td>";
							$content .= "</tr>";
						}
					}
				}
			}
			$content .= "</table>";
						
			$html .= show_debug("log","Log",$content);
		}
		
		if(!empty($Account_Data) && verif_connect(true) )
		{
			$content="";
			$content .= debug_array($Stats_Data);
			$content .= debug_array($Account_Data);
			
			$html .= show_debug("perso","Avatar",$content);

		}
		
		if(!empty($_SESSION))
		{
			$html .= show_debug("session","Session",debug_array($_SESSION));
		}
		
		if(!empty($debug_sql_array))
		{
			$content = "";
			$content .= "<table border='1'>";
			foreach( $debug_sql_array as $x => $req)  
			{
				$content .= "<tr><th>$x</th><td>$req</td>";
				if(isset($debug_sql_error[$x]))
				{
					$content .="<td>".$debug_sql_error[$x][0]."</td>";
					$content .="<td>".$debug_sql_error[$x][1]."</td>";
					$content .="<td>".$debug_sql_error[$x][2]."</td>";
				}
				$content .= "</tr>";
			}
			$content .= "</table>";

			$html .= show_debug("sql","Requetes",$content);
		}
		
		if(!empty($_SERVER))
		{
			$content = "";
			$content .= "<table border='1'>";
			$content .= debug_array($_SERVER);
			$content .= "</table>";
			
			$html .= show_debug("server","Serveur",$content);
		}

		if(!empty($debug_warning_array))
		{
			$content="";
			$content .= "<table border='1'>";
			foreach( $debug_warning_array as $x => $req)  
			{
				$content .= "<tr>";
				$content .= "<th>$x</th><td>".$req['code']."</td><td>".$req['message']."</td>";
				$content .= "<td>".str_replace($corrig_path,"",$req['file'])."</td>
					<td>".$req['line']."</td>";
				if(isset($req['trace']))
				{
					$content .= "<td><table>";
					foreach($req['trace'] as $n => $t)
					{
						if($n!=0 && $t['function']!=='debug_log')
						{
							$content .= "<tr>";
							$content .= "<td>".(isset($t['file']) ? str_replace($corrig_path,"",$t['file']) : "")."</td>
								<td>".(isset($t['line']) ? $t['line']: '')."</td>
								<td>".$t['function']."</td>
								<td>".print_r($t['args'],1)."</td>";
							$content .= "</tr>";
						}
					}
					$content .= "</table></td>";
				}
				$content .= "</tr>";
			}
			$content .= "</table>";
			
			$html .= show_debug("warning","Alertes",$content,2);
		}
		
		if(!empty($debug_notice_array))
		{
			$content = "";
			$content .= "<table border='1'>";
			foreach( $debug_notice_array as $x => $req)  
			{
				$content .= "<tr>";
				$content .= "<th>$x</th>";
				$content .= "<td>".$req['code']."</td>";
				$content .= "<td>".$req['message']."</td>";
				$content .= "<td>".str_replace($corrig_path,"",$req['file'])."</td>";
				$content .= "<td>".$req['line']."</td>";
				$content .= "</tr>";
			}
			$content .= "</table>";
			
			$html .= show_debug("notice","Avertissement",$content,2);
		}	
	
		if(!empty($debug_unknow_array))
		{
			$content = "";
			$content .= "<table border='1'>";
			foreach( $debug_unknow_array as $x => $req)  
			{
				$content .= "<tr>";
				$content .= "<th>$x</th><td>".$req['code']."</td><td>".$req['message']."</td>";
				$content .= "<td>".str_replace($corrig_path,"",$req['file'])."</td>
					<td>".$req['line']."</td>";
				$content .= "</tr>";
			}
			$content .= "</table>";
						
			$html .= show_debug("unknow","Inconnu",$content,2);
		}	
			
		if(!empty($_FILES))
		{
			$content = "";
			$content .= "<table border='1'>";
			foreach( $_FILES as $x => $req)  $content .= "<tr><th>$x</th><td>$req</td></tr>";
			$content .= "</table>";
			
			$html .= show_debug("file","Fichier",$content,2);
		}
			
		if(!empty($_POST)||!empty($_GET))
		{
			$content = "";
			if(!empty($_POST))
			{
				$content .= "<table border='1'>";
				foreach( $_POST as $x => $req)  $content .= "<tr><th>$x</th><td>$req</td></tr>";
				$content .= "</table>";
			}
			if(!empty($_GET))
			{
				$content .= "<table border='1'>";
				foreach( $_GET as $x => $req)  $content .= "<tr><th>$x</th><td>$req</td></tr>";
				$content .= "</table>";
			}
			$html .= show_debug("request","Formulaire",$content,2);
		}

/**        	$content = "";
			$content .= "<table border='1'>";
			$content .= debug_array(get_defined_functions());
			$content .= "</table>";
			
			$html .= show_debug("function","Fonctions",$content);

            $content = "";
			$content .= "<table border='1'>";
			$content .= debug_array(get_defined_constants(true));
			$content .= "</table>";
			
			$html .= show_debug("constants","Constantes",$content,2);
			
			$content = "";
			$content .= "<table border='1'>";
			$content .= debug_array(get_defined_vars());
			$content .= "</table>";
			
			$html .= show_debug("vars","Variables",$content);
**/
            
		return $html ;
	}
}

// Gestionnaire d'erreurs
function debug_ErrorHandler($errno, $errstr, $errfile, $errline)
{
	global $debug_warning_array , $debug_notice_array , $debug_unknow_array ;
	
   if (!(error_reporting() & $errno)) {
        // Ce code d'erreur n'est pas inclus dans error_reporting()
        return;
    }
	$error = array(
		'code' => $errno ,
		'message' => $errstr, 
		'file' => $errfile, 
		'line' => $errline,
		'trace' =>  debug_backtrace(),
	);
	
	//print_r($error);
	
    switch ($errno) {
		case E_USER_ERROR:
			echo "<b>Mon ERREUR</b> [$errno] $errstr<br />\n";
			echo "  Erreur fatale sur la ligne $errline dans le fichier $errfile";
			echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
			echo "Arrêt...<br />\n";
			exit(1);
			break;
		
		case E_USER_WARNING:
			echo "[!!]";
			$debug_warning_array[] = $error ;
			break;

		case E_USER_NOTICE:
			echo "[!]";
			$debug_notice_array[] = $error ;
			break;

		default:
			echo "[?]";
			$debug_unknow_array[] = $error ;
			break;
    }

    /* Ne pas exécuter le gestionnaire interne de PHP */
    return true;
}

function debug_exceptionHandler($exception) {
  echo "Exception non attrapée : " . print_r( $exception,1) . "\n";
}

function debug_shutDown() 
{
	global $_url, $debug_sql_array;
	
	$trace = debug_backtrace();
	$e = error_get_last();
	
	if ($e['type'] == 1)
	{ 
		$_SESSION['erreurFatale'] = $e;
		$_SESSION['erreurFatale']['page'] = getenv('HTTP_REFERER');
		$_SESSION['erreurFatale']['sql'] = end($debug_sql_array);
		//$_SESSION['erreurFatale']['trace'] = $trace ;
		
		header('location:'.$_url.'Erreur.php');
	}
} 

error_reporting(E_ALL); 
			
set_error_handler('debug_ErrorHandler',E_ALL);
set_exception_handler('debug_exceptionHandler');
register_shutdown_function('debug_shutDown');
		