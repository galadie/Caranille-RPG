<!DOCTYPE html>
	<head><?php include_once($header) ?></head>
	
	<body>

		<table align="left" valign="middle" border="1" cellpadding="5" cellspacing="5" width="300px">	
		
			<tbody>
				<tr>
					<td width="50px" valign="top" align="left" rowspan="2"><?php if(!is_null($left)) include_once($left) ?></td>
					<td width="200px" valign="top" align="center" >
						<div style="overflow:auto;width:200px;height:200px" id="wrapper">
							<?php include_once($content) ?>
						</div>
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

					
