<?php
	if(verif_access("Admin"))
	{

		if (request_confirm('Edit'))
		{
			$Account_List = list_db("list_t",array( 'table' => "Caranille_Accounts"));

			list_html_db('Caranille_Accounts','Accounts',array('Account_Pseudo','Account_Email','Account_Access'));
/**			
			echo '<table class="Admin list">' ;
				echo '<tr>' ;
				echo '<th>Name</th>';
				echo '<th>Email</th>';
				echo '<th>Access</th>';
				echo '<th></th>';
				echo '</tr>' ;
				echo '<tr><td class="none" colspan="2" ></td></tr>';
				
			foreach($Account_List as $Account)
			{				
				$Account_ID = htmlspecialchars(addslashes($Account['Account_ID']));
?>				
				<tr>
				<td><?php echo htmlspecialchars(addslashes($Account['Account_Pseudo']))?></td>
				<td><?php echo htmlspecialchars(addslashes($Account['Account_Email']))?></td>
				<td><?php echo htmlspecialchars(addslashes($Account['Account_Access']))?></td>
				<td><form method="POST" action="<?php echo get_link("Accounts","Admin") ?>">
				<input type="hidden" name="Account_ID" value="<?php echo $Account_ID ?>"/>
				<input type="submit" name="Second_Edit" value="modifier"/>
				<input type="submit" name="Second_Delete" value="supprimer" />
				</form></td>
				</tr>
				<tr><td class="none" colspan="2" ></td></tr>
<?php
			}
			
			echo "</table>";
**/
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Account = get_db("edit_admin",array(
				'table' => 'Caranille_Accounts' ,
				'ID' => 'Account_ID',
				'value' => request_data('Account_ID')
			));
			
			formulaire($Account);
		}
		else
		if (request_confirm('Second_Show'))
		{
			$Account = get_db("edit_admin",array(
				'table' => 'Caranille_Accounts' ,
				'ID' => 'Account_ID',
				'value' =>  request_data('Account_ID')
			));
			
			echo show_db('Caranille_Accounts' ,$Account);
		}
		else
		if (request_confirm('Second_Delete'))
		{
?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Accounts","Admin") ?>">
				<input type="hidden" name="Account_ID" value="<?php echo request_data('Account_ID') ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Accounts","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier un Compte">';
			echo '</form>';
		}
	}