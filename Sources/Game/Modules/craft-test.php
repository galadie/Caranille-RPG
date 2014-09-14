CREATE TABLE `objet` (
`oID` int(11) NOT NULL auto_increment,
`oname` varchar(255) character set utf8 NOT NULL,
`Typeo` int(11) NOT NULL default '0',
`oStats` int(11) NOT NULL,
`oPrice` int(11) NOT NULL,
`odesc` varchar(255) character set utf8 NOT NULL,
`oicon` varchar(244) NOT NULL,
PRIMARY KEY (`oID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=208 ;

INSERT INTO `objet` VALUES(1, 'Skull', 1, 0, 150, 'A skull', '1.png');
INSERT INTO `objet` VALUES(4, 'Iron', 1, 50, 80, 'An iron nugget', '4.png');
INSERT INTO `objet` VALUES(24, 'Cladio', 11, 5, 100, 'A plain old sword', '24.png');
INSERT INTO `objet` VALUES(90, 'White amulet', 12, 10, 125, 'This amulet seems to glow in the night', '86.png');
INSERT INTO `objet` VALUES(118, 'Leather belt', 14, 5, 100, 'A plain old belt made of leather', '121.png');
INSERT INTO `objet` VALUES(148, 'Leather boots', 16, 5, 100, 'A pair of boots', '148.png');
INSERT INTO `objet` VALUES(164, 'Wolf''s hide', 1, 0, 20, 'The hide of a wolf', '164.png');
INSERT INTO `objet` VALUES(167, 'Snake fang', 1, 0, 50, 'A small snake fang', '167.png');
INSERT INTO `objet` VALUES(171, 'Cocoon', 1, 0, 50, 'A silk cocoon', '171.png');

Then let's create the recipe table:

CREATE TABLE `recette` (
`Rid` int(11) NOT NULL auto_increment,
`Rori1` int(11) NOT NULL,
`Rori2` int(11) NOT NULL,
`Rresult` int(11) NOT NULL,
`Mresult` int(11) NOT NULL,
PRIMARY KEY (`Rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

INSERT INTO `recette` VALUES(141, 133, 171, 24, 24);
INSERT INTO `recette` VALUES(140, 167, 164, 24, 24);
INSERT INTO `recette` VALUES(139, 1, 4, 90, 90);

 

Now the form:

<?php
if(!$_POST[create]){
?>

<form method="post" action="mypage.php">
<table width="750" border="0" align="center">
<tr>
<td width="51%" class="bodycell4">objet 1</td>
<td width="49%">
<select name="o1" id="websites3" style="width:360px;">
<option value="0" selected="selected"> </option>
<?php

$result2 = mysql_query("SELECT * FROM objet ORDER BY oname");

while ($tab2 = mysql_fetch_array($result2)) {

echo '<option value="'; echo "$tab2[oID]"; echo '" title="../images/objmini/'; echo "$tab2[oID]"; echo '.png">'; echo "$tab2[oname]"; echo "(";echo "$tab2[oPrice]";echo ")"; echo '</option>';
}
echo "";
?>
</select>
</td>
</tr>
<tr>
<td class="bodycell4">objet 2</td>
<td><select name="o2" id="websites4" style="width:360px;">
<option value="0" selected="selected"> </option>
<?php

$result2 = mysql_query("SELECT * FROM objet ORDER BY oname");

while ($tab2 = mysql_fetch_array($result2)) {

echo '<option value="'; echo "$tab2[oID]"; echo '" title="../images/objmini/'; echo "$tab2[oID]"; echo '.png">'; echo "$tab2[oname]"; echo "(";echo "$tab2[oPrice]";echo ")"; echo '</option>';

}echo "";
?>
</select></td>
</tr>
<tr>
<td class="bodycell4">resultat</td>
<td><select name="o3" id="websites5" style="width:360px;">
<option value="0" selected="selected"> </option>
<?php

$result2 = mysql_query("SELECT * FROM objet ORDER BY oname");

while ($tab2 = mysql_fetch_array($result2)) {

echo '<option value="'; echo "$tab2[oID]"; echo '" title="../images/objmini/'; echo "$tab2[oID]"; echo '.png">'; echo "$tab2[oname]"; echo "(";echo "$tab2[oPrice]";echo ")"; echo '</option>';

}
echo "";
?>
</select></td>
</tr>
<tr>
<td class="bodycell4">HQ</td>
<td><div align="left"><select name="o4" id="websites6" style="width:360px;">
<option value="0" selected="selected"> </option>
<?php

$result2 = mysql_query("SELECT * FROM objet ORDER BY oname");

while ($tab2 = mysql_fetch_array($result2)) {

echo '<option value="'; echo "$tab2[oID]"; echo '" title="../images/objmini/'; echo "$tab2[oID]"; echo '.png">'; echo "$tab2[oname]"; echo "(";echo "$tab2[oPrice]";echo ")"; echo '</option>';

}echo "";
?>
</select></div></td>
</tr>
<tr>
<td colspan="2">
<div align="center">
<input name="create" type="submit" value="create">
</div></td>
</tr>
</table>
</form>

<?php
}
elseif($_POST['create']){
$o1=round(str_replace("-","",$_POST['o1']));
$o2=round(str_replace("-","",$_POST['o2']));
$o3=round(str_replace("-","",$_POST['o3']));
$o4=round(str_replace("-","",$_POST['o4']));

$db->query("INSERT INTO recette (`Rori1`,`Rori2`,`Rresult`,`Mresult`) VALUES ('$o1','$o2','$o3','$o4')");

}

?>

PS: you can use this code if you want unique recipes:

if ($Vaconf[recette]==1) {
$result2 = mysql_query("SELECT * FROM objet WHERE oID NOT IN (SELECT Rresult FROM recette) ORDER BY oname");
} else {
$result2 = mysql_query("SELECT * FROM objet ORDER BY oname");
}

just need to set $Vaconf[recette] in another table, like settings for instance.

You can also use this code to display all the previously created recipes:

<?php
$result = mysql_query("SELECT Rid,Rori1,Rori2,Rresult,Mresult FROM recette ORDER BY Rid DESC ");
while ($tab = mysql_fetch_array($result)) {
$result2 = mysql_query("SELECT * FROM objet WHERE oID = '$tab[Rori1]'");
while ($tab2 = mysql_fetch_array($result2)) {
$result3 = mysql_query("SELECT * FROM objet WHERE oID = '$tab[Rori2]'");
while ($tab3 = mysql_fetch_array($result3)) {
$result4 = mysql_query("SELECT * FROM objet WHERE oID = '$tab[Rresult]'");
while ($tab4 = mysql_fetch_array($result4)) {
$result5 = mysql_query("SELECT * FROM objet WHERE oID = '$tab[Mresult]'");
while ($tab5 = mysql_fetch_array($result5)) {
echo '<img src ="../images/objmini/';
echo "$tab2[oID]";
echo '.png"> ';
echo "$tab2[oname]";
echo " + ";
echo '<img src ="../images/objmini/';
echo "$tab3[oID]";
echo '.png"> ';
echo "$tab3[oname]";
echo " = ";
echo '<img src ="../images/objmini/';
echo "$tab4[oID]";
echo '.png"> ';
echo "$tab4[oname]";
echo " (";
echo '<img src ="../images/objmini/';
echo "$tab5[oID]";
echo '.png"> ';
echo "$tab5[oname]";
echo ")";
echo "<br />";

}
}
}
}
}

?>

 

If you want to have the same look and feel, include these in your header:

<link rel="stylesheet" type="text/css" href="msdropdown/dd.css" />
<body onLoad="$('#websites3').msDropDown();$(this).hide();" >
<script language="javascript" type="text/javascript" src="msdropdown/js/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript" src="msdropdown/js/jquery.dd.js"></script>

and this before the first select

<script language="javascript">
$(document).ready(function(e) {
$("body select").msDropDown();
});
</script>