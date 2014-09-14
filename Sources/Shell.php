 <?php
        $Last_Run = request_confirm('Run') ? $_POST['prompt'] : null;
		
        echo '<form method="POST" action="Shell.php">';
        echo "Executer une commande<br /><textarea name=\"Message\" ID=\"message\" rows=\"10\" cols=\"50\">$Last_Run</textarea><br /><br />";
        echo '<input type="submit" name="Run" value="Lancer la commande">';
?>