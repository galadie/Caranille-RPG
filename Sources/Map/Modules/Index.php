<?php
if(!function_exists('bousole'))
{
	function bousole($carte="Map")
	{
		$bousole_token = generer_token('deplacement-'.$carte) ;
	?>
		<table style="float:right;margin-right:5px" border="0" cellpadding="0" cellspacing="0" >
			<tr>
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&nwArr;" />
					<input type="hidden" name="deplacement" value="-1|1" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
				
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&uArr;" />
					<input type="hidden" name="deplacement" value="0|1" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
				
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&neArr;" />
					<input type="hidden" name="deplacement" value="1|1" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
			</tr>
			
			<tr>
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&lArr;" />
					<input type="hidden" name="deplacement" value="-1|0" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
				
				<td align="center" valign="middle" >
					<?php if($carte == "Map") echo user_data("Account_PosX")."-".user_data("Account_PosY") ?>
				<?php if($carte == "Town") {
					
				$recup = get_db('position_account', array('Town_ID' => $_SESSION['Town_ID'] , 'Account_ID' => user_data('Account_ID') ) );

					echo $recup['Position_PosX']."-".$recup['Position_PosY'];

				} ?>  		
				</td>
				
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&rArr;" />
					<input type="hidden" name="deplacement" value="1|0" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
			</tr>
			
			<tr>
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&swArr;" />
					<input type="hidden" name="deplacement" value="-1|-1" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
				
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&dArr;" />
					<input type="hidden" name="deplacement" value="0|-1" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
				
				<td>
					<form action="<?php echo get_link('Map','Map') ?>" method="post">
					<input type="submit" value="&seArr;" />
					<input type="hidden" name="deplacement" value="1|-1" />
					<input type="hidden" name="token" value="<?php echo $bousole_token ?>" />
					</form>
				</td>
			</tr>
		</table>
	<?php
	
		unset($bousole_token);
	}	
}

function instruction($message="")
{
?>
	<div><!-- style="position:fixed;top:320px;right:330px;width:200px;display:block"-->
		<?php //if(isset($message) && $message!="") echo $message ?>
		La carte vous montrera tous les lieux où vous pouvez aller que çe soit pour vous balader ou pour une mission<br />
		</div>	
<?php
}

load_css('map.css','map');
load_css('boussole.css','boussole');

    $baseline= "Bienvenue ".   ( !verif_town(true) ? "dans la carte du monde" : "à " .$information_Town['Town_Name']);
