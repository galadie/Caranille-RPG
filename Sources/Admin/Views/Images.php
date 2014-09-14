<?php

	if(verif_access("Admin"))
	{	
		if (request_confirm('Second_Delete'))
		{
		    			$Image_ID = request_data('Image_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Images","Admin") ?>">
				<input type="hidden" name="Image_ID" value="<?php echo $Image_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else //if(empty($_POST) || request_confirm('Back'))//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo '<form method="POST" action="'.get_link("Images","Admin").'">';
			echo 'Poids<input type="number" name="avatar_maxsize" value="'.$avatar_maxsize.'"/>';
			echo 'Hauteur<input type="number" name="avatar_maxh" value="'.$avatar_maxh.'"/>';
			echo 'Largeur<input type="number" name="avatar_maxl" value="'.$avatar_maxl.'"/>';
			echo '<input type="submit" name="End_Edit" value="Terminer"/>';
			echo '</form>';
			echo 'vous pouvez uploader plusieurs fichiers simultanement.'
			?>
                <form method="POST" enctype="multipart/form-data" action="<?php echo get_link("Images","Admin") ?>">
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $avatar_maxsize ?>" />
					fichier : <input type="file" multiple="multiple" name="caranille_image[]" />
    				<input type="submit" name="Back" value="Annuler" />
					<input type="submit" name="End_Add" value="Terminer"/>
    		    </form>			
			<?php
		}
			
		if(isset($message) && $message !=="")
		{
			echo "<p>$message</p>" ;
		}
		
		if(!empty($list_img))
		{
			foreach ( $list_img as $img)
			{
				echo '<div style="float:left;position:relative;" >';
				echo "<img title='".$img['Image_Name']."' height='100px' src='data:".$img['Image_Type'].";base64,".$img['Image_Base64']."' />";
				echo '<form style="margin:0;padding:0;float:right;position:absolute;bottom:0" method="POST" action="'.get_link('Images','Admin').'">';
				echo '<input type="hidden" value="'.$img['Image_ID'].'" name="Image_ID"/>';				
				echo '<input type="submit" name="Second_Delete" value="&cross;"/>';
				echo '</form>';
				echo '</div>';
			}
		}
	}