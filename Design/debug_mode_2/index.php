
	<head><?php include_once($header) ?></head>
	
	<body>

		<table align="left" valign="middle" border="1" cellpadding="5" cellspacing="5" width="300px">	
		
			<tbody>
				<tr>
					<td width="50px" valign="top" align="left" rowspan="2"><?php if(!is_null($left)) include_once($left) ?></td>
					<td width="200px" valign="top" align="center" >
							<?php /** lecture content **/ 
						
						if($secteur_module == 'Admin' || $secteur_module =='Moderator')
						{
							include_once($content);
						}
						else
						{
							if(isset($page) && $page !='')
							{
								if(in_array($page,$array_game_page) && in_array($secteur_module,$array_game_secteur) )
								{
									include_once('game.php');
								}
							elseif(in_array($page,$array_iden_page) && $secteur_module === 'User')
								{
									include_once('user.php');
								}
							elseif(in_array($page,$array_news_page) && $secteur_module === 'Public')
								{
									include_once($content);
								}
							elseif(in_array($page,$array_forum_page ) && $secteur_module === 'Forum')
								{
									include_once($content);
								}
							elseif($secteur_module == 'Battle' )
								{
									include_once($content);
								}
							else//if(file_exists($page.'.php'))
								{
									include_once(strtolower($page).'.php');
								}
							}
							else
							{
								include_once('main.php');
							}
						}					
					?>
					</td>
					<td width="50px" valign="top" align="right" rowspan="2"><?php if(!is_null($right)) include_once($right) ?></td>
				</tr>
				<tr>
					<td valign="bottom" align="center" ><?php if(!is_null($sub))include_once($sub)  ?></td>
				</tr>
			</tbody>
			
			<thead><?php if(!is_null($head)) include_once($head) ?>
				
			<?php if(isset($baseline) && $baseline!="") { ?>	
				<tr>
					<td valign="top" align="center" colspan="3"><?php echo $baseline ?></td>
				</tr>
			<?php } ?>
			
			</thead>

			<tfoot>
				<tr>
					<td valign="bottom" align="center" colspan="3"><?php if(!is_null($footer))include_once($footer)  ?></td>
				</tr>
				
			</tfoot>
		
		</table>