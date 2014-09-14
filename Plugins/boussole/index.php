<?php

	
	function bousole($carte="Map")
	{
	?>
		<form class="boussole" method="post">
			<input type="submit" name="deplacement" value="-1|0" class="arrow topleft"/>
			<input type="submit" name="deplacement" value="0|1"  class="arrow up"/>
			<input type="submit" name="deplacement" value="-1|0" class="arrow left"/>
			<div id="position">
			<?php if($carte == "Map") echo user_data("Account_PosX")."-".user_data("Account_PosY") ?>
			<?php if($carte == "Town") {
				
				$recup = get_db('position_account', array('Town_ID' => $_SESSION['Town_ID'] , 'Account_ID' => user_data('Account_ID') ) ));

				echo $recup['Position_PosX']."-".$recup['Position_PosX'];

			} ?>  		
			</div><input type="submit" name="deplacement" value="1|0"  class="arrow right"/>
			<input type="submit" name="deplacement" value="0|-1" class="arrow down"/>
			<input type="hidden" name="token" value="<?php echo generer_token('deplacement-'.$carte) ?>" />
		</form>       
	<?php
	}