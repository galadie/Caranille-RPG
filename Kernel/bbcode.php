 <style>
 
.<?php echo $name ?>_toolbar {border-style: outset; border-width: 2px; background-color: #C0C0C0;width: 300px;  margin:auto;}
.<?php echo $name ?>_toolbar input[type=color]{background-color:#C0C0C0;border:none; width:24px;height:24px;content:"color"}
.<?php echo $name ?>_toolbar input[type=color]:hover{background-color:#99CCFF;border:1px solid #808080;}
.<?php echo $name ?>_ed {width: 300px;height: 150px;font-family: verdana, arial, sans-serif;font-size:13px;}
.<?php echo $name ?>_button {border: 1px solid #ccc;margin: 1px;padding: 2px;}
.<?php echo $name ?>_button:hover {filter:progid:DXImageTransform.Microsoft.Alpha(opacity=60);opacity: 0.6;}


</style>
<div class="<?php echo $page ?>_bbcode_editor">

	 <div class="<?php echo $name ?>_toolbar">
		<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAInhI+pa+H9mJy0LhdgtrxzDG5WGFVk6aXqyk6Y9kXvKKNuLbb6zgMFADs=" name="btnBold" title="Bold" onClick="<?php echo $name ?>_doAddTags('b')">
		<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAKEDAAAAAF9vj5WIbf///yH5BAEAAAMALAAAAAAWABYAAAIjnI+py+0Po5x0gXvruEKHrF2BB1YiCWgbMFIYpsbyTNd2UwAAOw==" name="btnItalic" title="Italic" onClick="<?php echo $name ?>_doAddTags('i')">
		<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAKECAAAAAF9vj////////yH5BAEAAAIALAAAAAAWABYAAAIrlI+py+0Po5zUgAsEzvEeL4Ea15EiJJ5PSqJmuwKBEKgxVuXWtun+DwxCCgA7" name="btnUnderline" title="Underline" onClick="<?php echo $name ?>_doAddTags('u')">
		<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAOMKAB1ChDRLY19vj3mOrpGjuaezxrCztb/I19Ha7Pv8/f///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARY8MlJq7046827/2BYIQVhHg9pEgVGIklyDEUBy/RlE4FQF4dCj2AQXAiJQDCWQCAEBwIioEMQBgSAFhDAGghGi9XgHAhMNoSZgJkJei33UESv2+/4vD4TAQA7" name="btnLink" title="Insert URL Link" onClick="<?php echo $name ?>_doURL()"/>
		<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAOYAAJiblo+Sjo6RjMfIxr2+vKOlo5mbmJeZloqNiYmMh4SHg4OGg3+DfqCjnp+inZOWkZqdmJGUkIeKho2QjIWIhJyfmpCSj5WYk5SXkpuemZeale3t7Zmcl4uOif7+/vLy8pGUj4uOiujo6JKVka+xr4iLh6Gkn/X19ZaYlaKkoZKVkPHx8cvNy7W3tZmcmPz8/LW2tIyPioeKhc3Ozd3e3fP08/n5+Z+insTFw62vrZuemqepp4aJhpKUkYaKhpSXk4+SjYyOi6WmpLCyr5udmv39/rO0svHy8Z2gm6mrqHp9edbX1rq7uru9ury9u7S1s/3+/ZWYlKqsqv7//5OVkuPj49LT0sLDwrCysMPEwsTGxLe5t+rq6p+hn6Chn+7v7o2Qi6OmoZCTkL/AvqWopZ2fnKaopYGEgH2AfNjZ2Obm5oiLiK+xrpOVkfDw8MvMysvMy6GjoK+wroaIhOTl5KanpYeKh97f3qyurJCSkIWHhJGTkPv6+/v7+56hnP///yH5BAAAAAAALAAAAAAWABYAAAf/gH+Cg4QeHoSIiYgtOIqOhCIRETSPindOLhUZEWMflYJuZQoJD34NDx12LJ8fJAZBEaYXczlclSJtAgEcDX6mFSMpT1WKL28HFGhRDr6+IGcULYkncRIhJQIczA0XDBgBewMriBt5awoIAM2+PwsWMD0whB8FMjEaYQ3MzQ1IExZdstQY9EUJBQ0ZIAgIsc9XAw4TAui5IugIGzAPUlhYIAHCOl8mHEDQoCPNnxkuhngRgiKDvoYmNExQ8aBEAh5qpmzY4aPDhQcVIKjoAEDCAwx1sBQwAGfJODpUkpghI4bCiC11gDCRw+AAnyJQHlkxc+IPAQRabAyQsuETIQIxGYy4VUQCBJ65iPqgwEDkEF5BL5rcWPX3byAAOw==" name="btnPicture" title="Insert Image" onClick="<?php echo $name ?>_doImage()"/>
	<!--	<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAADljwliE35GjuaezxtHa7P///////yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKSespwjoRFvggCBUBoTFBeq6QIAysQnRHaEOzyaZ07Lu9lUBnC0UGQU1K52s6n5oEADs=" name="btnList" title="Ordered List" onClick="<?php echo $name ?>_doList('LIST',1)">
		<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAAB1ChF9vj1iE33mOrqezxv///////yH5BAEAAAcALAAAAAAWABYAAAMyeLrc/jDKSesppNhGRlBAKIZRERBbqm6YtnbfMY7lud64UwiuKnigGQliQuWOyKQykgAAOw==" name="btnList" title="Unordered List" onClick="<?php echo $name ?>_doList('LIST')">
	-->	<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhFgAWAIQXAC1NqjFRjkBgmT9nqUJnsk9xrFJ7u2R9qmKBt1iGzHmOrm6Sz4OXw3Odz4Cl2ZSnw6KxyqO306K63bG70bTB0rDI3bvI4P///////////////////////////////////yH5BAEKAB8ALAAAAAAWABYAAAVP4CeOZGmeaKqubEs2CekkErvEI1zZuOgYFlakECEZFi0GgTGKEBATFmJAVXweVOoKEQgABB9IQDCmrLpjETrQQlhHjINrTq/b7/i8fp8PAQA7" name="btnQuote" title="Quote" onClick="<?php echo $name ?>_doAddTags('quote')"/> 
		<img class="<?php echo $name ?>_button" src="bbeditor/images/code.gif" name="btnCode" title="Code" alt="Code" onClick="<?php echo $name ?>_doAddTags('code)" />
		<input class="<?php echo $name ?>_button" alt='- color -' title="- color -" type='color' value='Fc' onchange="<?php echo $name ?>_doAddTags('color',this.value );this.value='';" />
	</div>
	<textarea name="<?php echo $name ?>" id="<?php echo $name ?>_textarea" class="<?php echo $name ?>_ed"><?php echo $content ?></textarea>
	 <div class="<?php echo $name ?>_toolbar">
		<div style="background-color:white;" id="<?php echo $name ?>_preview" ></div>
		<img class="<?php echo $name ?>_button" src="data:image/gif;base64,R0lGODlhGAAYAHcAACH5BAEAAAAALAAAAAAYABgApwEAAP///+Hp7uTu8ghNe0F7njRfpRJWhO7y9e3z9TtlrO3y9bvK5GeUrCpokPr6+phHAA1OejJconSduH2lvu3w8jJaorlaAoOmvP//1Ofy9Lq6xVRVfoq661V8wsXU4hxeiRZahvb7/s3b4+3099///73O3DdjqqW42whHdjlkrOft9TNcpH8zCIapv/z7+oaovjpymomrvplAAzljq9by/IyuwIuswbvN28TF0E5enNPz+snZ40F7mXihvW+dtfqFBYmqwH6bx7Hr/3uhvJ64zoiGoniu7fz6+v//vV5fiv//y8vX4MpvBpS0y/z8/KLK66HE42WOpU59nNHX36XBzrfM2eP1/UBPfousxZW54MHQ2MbT2uXo6/+vTYm89+Do9LjO3EtLaPz//Mj6/m6UsVFTb6HF5o+uwbnl9unw+c3j9fH5+Pr8+sv///7//gdMeoatw9nk7OHo7mJpj6fG1d/1+2qYtFmGoDlkqtqzbHh8m9z9/8/b5VtbgLnd8bvd8S5HgvDx8+7z9fT1+ChHkqbL6nx4j5U6Aoipv4zF/0xoo1hmpIimxL6ARNvz+0iApF+R2Y2htX2ku+Lr8cLb8tTx+o+yyl54rv/6snOGuBRTf2CQ2y9WnKW/0dn//87//11vmmlyne+XIJa/52eZ5Mrq+V5jkdHz/Oj//36n1/Lw8LLX77LW6+/y9crZ4//IWOv7/+Dm72Zrl9zj7K/Y8Oz6/vz8+b3Q3j1BbK7S7dji6KXR7tDb45CVq6VOAr/h9Njf6MLT3vP69rDe6P//7IK79rK8yoG185qerR8jTur09ery8KPM6Pz//7K0vv/9uK/E18b0//+KBP+MBeTq7mpqgoa36Zq64N3y+o2Pqcbp+cLZ4359n5S55Hp8nLCvu+v8/fz89/+gGP+JAOf6/+f//5Wzxb3h88va40pFY5W2x7TM2nuivsrw+rnf87bK2iJHh7Xs/8zX52+Ztf//zubu8VyNp/v8/CBiiydljqbI6SpPlQhNfPT2+wAAAAj/AAEItHHDBQwXiYLcaEfhx70YAiNKHChAgD1aI4RZqeIkS4MeECdKlCEgQIA3hFbIYcIuWpweRAqIjEgyAJJhasDs6oUrzKUGW+jJnAmj5JMXIgZ1CTbvQ5EGA+bcGToRgwAGeWioOGGAhQUL8XwEGGBiAtWIVgOIe/CiDRsNlKrhECtoAJcJDiZOKnnrwYNVG75122NE0rlGFChA0jdxwlUVNBaJ8hDpiLFrmjh04ocDTb6JZUriqzCLUwderbSQGiLkkIkR60BMlFJyzAYPHdLw+QNsny43dI7J8iRbIp6rJ/yUglIiQCV07raVqBOoArwQE6eUJKEEWTNAa2rF4qphKRU3XwE+YJdYoGQCDoqiGGJVzs6jK86oaAvQ58DE9igokMsX3pxhCio1hCNCADkU4k86/rHnHjiYyIPNOztkY4tJOqwQAA8RRtReAAksoI4qoEjziTkcMjLKhyEKBKACNCoTCjFk7JADFqd4AUQTr8QIwIglLrDAM9aYIUYyGjgCSzHTXCCkA+4hYKWVrpCwDDMVXJBJBtT8MhGVDBhg5pkGSGCBBBKwMAM09ZAzg0SblGTSnXjiiUgSGYwDQUQRDCDooIQWOkALS+jxp0ARRNAPAZBGKimkcKSQQgt/BgQAOw==" name="btnQuote" title="Quote" onClick="<?php echo $name ?>_preview_bbcode();"/>
	</div>

</div>

<br/>

<script>
var <?php echo $name ?>_textarea = document.getElementById('<?php echo $name ?>_textarea');
var <?php echo $name ?>_scrollTop = <?php echo $name ?>_textarea.scrollTop;
var <?php echo $name ?>_scrollLeft = <?php echo $name ?>_textarea.scrollLeft;

var isIE = (document.selection) ;

function <?php echo $name ?>_preview_bbcode()
{
	var str = parseBBCode(<?php echo $name ?>_textarea.value);
	
	document.getElementById('<?php echo $name ?>_preview').innerHTML=str;
}

function <?php echo $name ?>_doImage()
{
	var url = prompt('Enter the Image URL:','http://');


	if (url != '' && url != null) {

		if (isIE) 
		{
			<?php echo $name ?>_textarea.focus();
			var sel = document.selection.createRange();
			sel.text = '[img]' + url + '[/img]';
		}
		else 
		{
			var len = <?php echo $name ?>_textarea.value.length;
			var start = <?php echo $name ?>_textarea.selectionStart;
			var end = <?php echo $name ?>_textarea.selectionEnd;
			
			var sel = <?php echo $name ?>_textarea.value.substring(start, end);
			//alert(sel);
			var rep = '[img]' + url + '[/img]';
			<?php echo $name ?>_textarea.value =  <?php echo $name ?>_textarea.value.substring(0,start) + rep + <?php echo $name ?>_textarea.value.substring(end,len);
			
				
			<?php echo $name ?>_textarea.scrollTop = <?php echo $name ?>_scrollTop;
			<?php echo $name ?>_textarea.scrollLeft = <?php echo $name ?>_scrollLeft;
		}
	}

}

function <?php echo $name ?>_doURL()
{
	var url = prompt('Enter the URL:','http://');

	if (url != '' && url != null) 
	{
		if (isIE) 
		{
			<?php echo $name ?>_textarea.focus();
			var sel = document.selection.createRange();
			
			if(sel.text=="")
			{
				sel.text = '[url]'  + url + '[/url]';
			}
			else
			{
				sel.text = '[url=' + url + ']' + sel.text + '[/url]';
			}			

			//alert(sel.text);
		}
	   else 
		{
			var len = <?php echo $name ?>_textarea.value.length;
			var start = <?php echo $name ?>_textarea.selectionStart;
			var end = <?php echo $name ?>_textarea.selectionEnd;
			
			var sel = <?php echo $name ?>_textarea.value.substring(start, end);
			
			if(sel=="")
			{
				var rep = '[url]' + url + '[/url]';
			} 
			else
			{
				var rep = '[url=' + url + ']' + sel + '[/url]';
			}
			//alert(sel);
			
			<?php echo $name ?>_textarea.value =  <?php echo $name ?>_textarea.value.substring(0,start) + rep + <?php echo $name ?>_textarea.value.substring(end,len);
			
				
			<?php echo $name ?>_textarea.scrollTop = <?php echo $name ?>_scrollTop;
			<?php echo $name ?>_textarea.scrollLeft = <?php echo $name ?>_scrollLeft;
		}
	}
}

function <?php echo $name ?>_doAddTags(tag,value)
{
	//alert(typeof(value));
	
	var tag1 = '['+tag+(typeof(value) == 'undefined' ? '' : '='+value )+']';
	var tag2 = '[/'+tag+']';
	// Code for IE
	if (isIE) 
	{
		<?php echo $name ?>_textarea.focus();
		var sel = document.selection.createRange();
		
		//alert(sel.text);
		
		sel.text = tag1 + sel.text + tag2;
	}
   else 
    {  // Code for Mozilla Firefox
		var len = <?php echo $name ?>_textarea.value.length;
	    var start = <?php echo $name ?>_textarea.selectionStart;
		var end = <?php echo $name ?>_textarea.selectionEnd;
				
        var sel = <?php echo $name ?>_textarea.value.substring(start, end);
	    
		//alert(sel);
		
		var rep = tag1 + sel + tag2;
        <?php echo $name ?>_textarea.value =  <?php echo $name ?>_textarea.value.substring(0,start) + rep + <?php echo $name ?>_textarea.value.substring(end,len);
		
		<?php echo $name ?>_textarea.scrollTop = <?php echo $name ?>_scrollTop;
		<?php echo $name ?>_textarea.scrollLeft = <?php echo $name ?>_scrollLeft;
		
		
	}
}

function <?php echo $name ?>_doList(tag, value){
	// Code for IE
	
	//alert(typeof(value));
	
	var tag1 = '['+tag+(typeof(value) == 'undefined' ? '' : '='+value )+']';
	var tag2 = '[/'+tag+']';

	if (isIE) 
	{
		<?php echo $name ?>_textarea.focus();
		var sel = document.selection.createRange();
		var list = sel.text.split('\n');

		for(i=0;i<list.length;i++) 
		{
		list[i] = '[*]' + list[i];
		}
		//alert(list.join("\n"));
		sel.text = tag1 + '\n' + list.join("\n") + '\n' + tag2;
	} 
	else // Code for Firefox
	{

		var len = <?php echo $name ?>_textarea.value.length;
	    var start = <?php echo $name ?>_textarea.selectionStart;
		var end = <?php echo $name ?>_textarea.selectionEnd;
		var i;

		
        var sel = <?php echo $name ?>_textarea.value.substring(start, end);
	    //alert(sel);
		
		var list = sel.split('\n');
		
		for(i=0;i<list.length;i++) 
		{
		list[i] = '[*]' + list[i];
		}
		//alert(list.join("<br>"));
        
		
		var rep = tag1 + '\n' + list.join("\n") + '\n' +tag2;
		<?php echo $name ?>_textarea.value =  <?php echo $name ?>_textarea.value.substring(0,start) + rep + <?php echo $name ?>_textarea.value.substring(end,len);
		
		<?php echo $name ?>_textarea.scrollTop = <?php echo $name ?>_scrollTop;
		<?php echo $name ?>_textarea.scrollLeft = <?php echo $name ?>_scrollLeft;
	}
}
</script>