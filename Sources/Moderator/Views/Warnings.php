<?php

	if(verif_access("Modo"))
	{
		if (empty($_POST['Add']) && (empty($_POST['End_Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link('Warnings','Moderator').'">';
			echo '<input type="submit" name="Add" value="Ajouter une sanction">';
			echo '</form>';
		}
		if (request_confirm('Add'))
		{
			$warning = array();
			$warning['Sanction_Transmitter'] = user_data('Account_Pseudo');
			
			echo '<form method="POST" action="'.get_link('Warnings','Moderator').'">';
    		echo forumulaire_db('Caranille_Sanctions',$warning); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php 
		}
	}