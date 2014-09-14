<table border="1" width="99%" >

	<tr>
		<td width="150px" ><h3>Personnage</h3><?php include_once(path_view('Character','Game')); ?></td>
		<td width="49px"><h3>Journal</h3><?php include_once(path_view('Diary','Game')); ?></td>
	</tr>

	<tr>
		<td width="150px"><h3>Ordre</h3><?php include_once(path_view('Order','Game')); ?></td>
		<td width="49px"><h3>Chat</h3><?php include_once(path_view('Chat','User')); ?></td>
	</tr>
	
	<tr>
		<td width="150px"><h3>Inventaire</h3><?php include_once(path_view('Inventory','Game')); ?></td>
		<td width="49px"><h3>Atelier</h3><?php include_once(path_view('Craft','Game')); ?></td>
	</tr>
	
	<tr>
		<td width="150px"><h3>Guilde</h3><?php include_once(path_view('guild','guild')); ?></td>
	</tr>
	
	<?php if(has_guild()) { ?>	
	<tr>
		<td width="150px"><h3>Autel</h3><?php include_once(path_view('gift','guild')); ?></td>
	</tr>
	<?php } ?>
	
	<tr>
		<td width="150px"><h3>Carte</h3><?php include_once(path_view( (verif_town() ? 'Town' : 'World' ),'Map')); ?></td>
		<td width="49px"><h3>Magasin</h3><?php if(isset($racine) && $racine !="") include_once(path_view('Index','Shop')); ?></td>
	</tr>
	
	<tr>
		<td width="150px"><h3>Auberge</h3><?php include_once(path_view('Inn','Map')); ?></td>
		<td width="49px"><h3>Quetes</h3><ul>
								<li><?php include_once(path_view('QuestLogs','Game')); ?></li>
								<li><?php include_once(path_view('QuestBoard','Game')); ?></li>
							</ul></td>
	</tr>
	
</table>											