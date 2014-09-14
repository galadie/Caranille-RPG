<?php if(!$installing) { ?>
<aside>
<?php if(verif_connect(true) && ($secteur_module === 'Forum')) { ?>
<h2>Qui est en ligne ?</h2>
<?php
//Le pied de page ici :

$totaldesmessages = count_db('all_posts');
//On compte les membres
$TotalDesMembres = count_db('all_accounts');
$query = get_db('last_account');

echo'<p>Le total des messages du forum est <strong>'.$totaldesmessages.'</strong>.<br />';
echo'Le site et le forum comptent <strong>'.$TotalDesMembres.'</strong> membres.<br />';
echo'Le dernier membre est <a href="'.get_link('Account','Forum', array('m'=>$query['Account_ID'],'action'=>'consulter')).'">'.stripslashes_r($query['Account_Pseudo']).'</a>.</p>';
?>
        <a href="<?php echo get_link('Main','Public') ?>"><div class="important">Retour au jeu</div></a>

<?php
	}
	
	elseif($secteur_module === 'Guild')
	{
		echo "<br/><br/><p>";
		include_once($_path."Sources/Guild/Chat.php");
		echo "</p>";
	}
	elseif($secteur_module === 'Public')
	{
		echo "<br/><br/><p>";
		include_once($_path."Sources/Public/Sidebar.php");
		echo "</p>";
	}
	else
	{
		get_perso_card();
	} 
?>
	<br/>Caranille <?php echo "$version"; ?>
	</aside>
<?php } ?>