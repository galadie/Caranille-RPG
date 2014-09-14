

<style type="text/css">
/**
.wysiwyg{position:relative;display:block}
.wysiwyg div{position:absolute;display:inline-block;clear:left;float:left}
**/
.<?php echo $name ?>_intLink { cursor: pointer; }
img.<?php echo $name ?>_intLink { border:1px solid #C0C0C0; }
img.<?php echo $name ?>_intLink:hover{background-color:#99CCFF;border:1px solid #808080;}

.<?php echo $name ?>_toolbar input[type=color]{background-color:#C0C0C0;border:none; width:24px;height:24px}
.<?php echo $name ?>_toolbar input[type=color]:hover{background-color:#99CCFF;border:1px solid #808080;}

#<?php echo $name ?>_toolBar1 select { font-size:10px; }
#<?php echo $name ?>_textBox {
  width: 545px;
  height: 150px;
  border: 1px #000000 solid;
  padding: 12px;
  overflow: auto;
  margin:auto;
}
.<?php echo $name ?>_toolbar {border-style: outset; border-width: 2px; background-color: #C0C0C0;width: 570px;  margin:auto;}
#<?php echo $name ?>_textBox #<?php echo $name ?>_sourceText {
  padding: 0;
  margin: 0;
  min-width: 498px;
  min-height: 200px;
}
.<?php echo $name ?>_toolbar label#<?php echo $name ?>_editMode { cursor: pointer;background-color: #C0C0C0; }
textarea#<?php echo $name ?>_input{display:none;width:0px;height:0px;margin:0px;padding:0px}
</style>

<div class="wysiwyg" id="<?php echo $name ?>-wysiwyg">

<div class='<?php echo $name ?>_toolbar' id="<?php echo $name ?>_toolBar1">
<select onchange="<?php echo $name ?>_formatDoc('formatblock',this[this.selectedIndex].value);this.selectedIndex=0;">
<option selected>- formatting -</option>
<option value="h1">Title 1 &lt;h1&gt;</option>
<option value="h2">Title 2 &lt;h2&gt;</option>
<option value="h3">Title 3 &lt;h3&gt;</option>
<option value="h4">Title 4 &lt;h4&gt;</option>
<option value="h5">Title 5 &lt;h5&gt;</option>
<option value="h6">Subtitle &lt;h6&gt;</option>
<option value="p">Paragraph &lt;p&gt;</option>
<option value="pre">Preformatted &lt;pre&gt;</option>
</select>
<select onchange="<?php echo $name ?>_formatDoc('fontname',this[this.selectedIndex].value);this.selectedIndex=0;">
<option class="heading" selected>- font -</option>
<option>Arial</option>
<option>Arial Black</option>
<option>Courier New</option>
<option>Times New Roman</option>
</select>
<select onchange="<?php echo $name ?>_formatDoc('fontsize',this[this.selectedIndex].value);this.selectedIndex=0;">
<option class="heading" selected>- size -</option>
<option value="1">Very small</option>
<option value="2">A bit small</option>
<option value="3">Normal</option>
<option value="4">Medium-large</option>
<option value="5">Big</option>
<option value="6">Very big</option>
<option value="7">Maximum</option>
</select>
<input alt='- color -' title="- color -" type='color' value='Fc' onchange="<?php echo $name ?>_formatDoc('forecolor',this.value);this.value='';" />
<input alt='- background -' title="- background -" type='color' value='Bc' onchange="<?php echo $name ?>_formatDoc('backcolor',this.value);this.value='';" />
</div>

<div class='<?php echo $name ?>_toolbar' id="<?php echo $name ?>_toolBar2">
<img class="<?php echo $name ?>_intLink" title="Clean" onclick="<?php echo $name ?>_cleanDoc();" src="data:image/gif;base64,R0lGODlhFgAWAIQbAD04KTRLYzFRjlldZl9vj1dusY14WYODhpWIbbSVFY6O7IOXw5qbms+wUbCztca0ccS4kdDQjdTLtMrL1O3YitHa7OPcsd/f4PfvrvDv8Pv5xv///////////////////yH5BAEKAB8ALAAAAAAWABYAAAV84CeOZGmeaKqubMteyzK547QoBcFWTm/jgsHq4rhMLoxFIehQQSAWR+Z4IAyaJ0kEgtFoLIzLwRE4oCQWrxoTOTAIhMCZ0tVgMBQKZHAYyFEWEV14eQ8IflhnEHmFDQkAiSkQCI2PDC4QBg+OAJc0ewadNCOgo6anqKkoIQA7" />
<img class="<?php echo $name ?>_intLink" title="Preview" onclick="<?php echo $name ?>_previewDoc();" src="data:image/gif;base64,R0lGODlhGAAYAHcAACH5BAEAAAAALAAAAAAYABgApwEAAP///+Hp7uTu8ghNe0F7njRfpRJWhO7y9e3z9TtlrO3y9bvK5GeUrCpokPr6+phHAA1OejJconSduH2lvu3w8jJaorlaAoOmvP//1Ofy9Lq6xVRVfoq661V8wsXU4hxeiRZahvb7/s3b4+3099///73O3DdjqqW42whHdjlkrOft9TNcpH8zCIapv/z7+oaovjpymomrvplAAzljq9by/IyuwIuswbvN28TF0E5enNPz+snZ40F7mXihvW+dtfqFBYmqwH6bx7Hr/3uhvJ64zoiGoniu7fz6+v//vV5fiv//y8vX4MpvBpS0y/z8/KLK66HE42WOpU59nNHX36XBzrfM2eP1/UBPfousxZW54MHQ2MbT2uXo6/+vTYm89+Do9LjO3EtLaPz//Mj6/m6UsVFTb6HF5o+uwbnl9unw+c3j9fH5+Pr8+sv///7//gdMeoatw9nk7OHo7mJpj6fG1d/1+2qYtFmGoDlkqtqzbHh8m9z9/8/b5VtbgLnd8bvd8S5HgvDx8+7z9fT1+ChHkqbL6nx4j5U6Aoipv4zF/0xoo1hmpIimxL6ARNvz+0iApF+R2Y2htX2ku+Lr8cLb8tTx+o+yyl54rv/6snOGuBRTf2CQ2y9WnKW/0dn//87//11vmmlyne+XIJa/52eZ5Mrq+V5jkdHz/Oj//36n1/Lw8LLX77LW6+/y9crZ4//IWOv7/+Dm72Zrl9zj7K/Y8Oz6/vz8+b3Q3j1BbK7S7dji6KXR7tDb45CVq6VOAr/h9Njf6MLT3vP69rDe6P//7IK79rK8yoG185qerR8jTur09ery8KPM6Pz//7K0vv/9uK/E18b0//+KBP+MBeTq7mpqgoa36Zq64N3y+o2Pqcbp+cLZ4359n5S55Hp8nLCvu+v8/fz89/+gGP+JAOf6/+f//5Wzxb3h88va40pFY5W2x7TM2nuivsrw+rnf87bK2iJHh7Xs/8zX52+Ztf//zubu8VyNp/v8/CBiiydljqbI6SpPlQhNfPT2+wAAAAj/AAEItHHDBQwXiYLcaEfhx70YAiNKHChAgD1aI4RZqeIkS4MeECdKlCEgQIA3hFbIYcIuWpweRAqIjEgyAJJhasDs6oUrzKUGW+jJnAmj5JMXIgZ1CTbvQ5EGA+bcGToRgwAGeWioOGGAhQUL8XwEGGBiAtWIVgOIe/CiDRsNlKrhECtoAJcJDiZOKnnrwYNVG75122NE0rlGFChA0jdxwlUVNBaJ8hDpiLFrmjh04ocDTb6JZUriqzCLUwderbSQGiLkkIkR60BMlFJyzAYPHdLw+QNsny43dI7J8iRbIp6rJ/yUglIiQCV07raVqBOoArwQE6eUJKEEWTNAa2rF4qphKRU3XwE+YJdYoGQCDoqiGGJVzs6jK86oaAvQ58DE9igokMsX3pxhCio1hCNCADkU4k86/rHnHjiYyIPNOztkY4tJOqwQAA8RRtReAAksoI4qoEjziTkcMjLKhyEKBKACNCoTCjFk7JADFqd4AUQTr8QIwIglLrDAM9aYIUYyGjgCSzHTXCCkA+4hYKWVrpCwDDMVXJBJBtT8MhGVDBhg5pkGSGCBBBKwMAM09ZAzg0SblGTSnXjiiUgSGYwDQUQRDCDooIQWOkALS+jxp0ARRNAPAZBGKimkcKSQQgt/BgQAOw=="/>
<!--<img class="<?php echo $name ?>_intLink" title="Print" onclick="<?php echo $name ?>_printDoc();" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oEBxcZFmGboiwAAAAIdEVYdENvbW1lbnQA9syWvwAAAuFJREFUOMvtlUtsjFEUx//n3nn0YdpBh1abRpt4LFqtqkc3jRKkNEIsiIRIBBEhJJpKlIVo4m1RRMKKjQiRMJRUqUdKPT71qpIpiRKPaqdF55tv5vvusZjQTjOlseUkd3Xu/3dPzusC/22wtu2wRn+jG5So/OCDh8ycMJDflehMlkJkVK7KUYN+ufzA/RttH76zaVocDptRxzQtNi3mRWuPc+6cKtlXZ/sddP2uu9uXlmYXZ6Qm8v4Tz8lhF1H+zDQXt7S8oLMXtbF4e8QaFHjj3kbP2MzkktHpiTjp9VH6iHiA+whtAsX5brpwueMGdONdf/2A4M7ukDs1JW662+XkqTkeUoqjKtOjm2h53YFL15pSJ04Zc94wdtibr26fXlC2mzRvBccEbz2kiRFD414tKMlEZbVGT33+qCoHgha81SWYsew0r1uzfNylmtpx80pngQQ91LwVk2JGvGnfvZG6YcYRAT16GFtW5kKKfo1EQLtfh5Q2etT0BIWF+aitq4fDbk+ImYo1OxvGF03waFJQvBCkvDffRyEtxQiFFYgAZTHS0zwAGD7fG5TNnYNTp8/FzvGwJOfmgG7GOx0SAKKgQgDMgKBI0NJGMEImpGDk5+WACEwEd0ywblhGUZ4Hw5OdUekRBLT7DTgdEgxACsIznx8zpmWh7k4rkpJcuHDxCul6MDsmmBXDlWCH2+XozSgBnzsNCEE4euYV4pwCpsWYPW0UHDYBKSWu1NYjENDReqtKjwn2+zvtTc1vMSTB/mvev/WEYSlASsLimcOhOBJxw+N3aP/SjefNL5GePZmpu4kG7OPr1+tOfPyUu3BecWYKcwQcDFmwFKAUo90fhKDInBCAmvqnyMgqUEagQwCoHBDc1rjv9pIlD8IbVkz6qYViIBQGTJPx4k0XpIgEZoRN1Da0cij4VfR0ta3WvBXH/rjdCufv6R2zPgPH/e4pxSBCpeatqPrjNiso203/5s/zA171Mv8+w1LOAAAAAElFTkSuQmCC">
-->
<img class="<?php echo $name ?>_intLink" title="Undo" onclick="<?php echo $name ?>_formatDoc('undo');" src="data:image/gif;base64,R0lGODlhFgAWAOMKADljwliE33mOrpGjuYKl8aezxqPD+7/I19DV3NHa7P///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARR8MlJq7046807TkaYeJJBnES4EeUJvIGapWYAC0CsocQ7SDlWJkAkCA6ToMYWIARGQF3mRQVIEjkkSVLIbSfEwhdRIH4fh/DZMICe3/C4nBQBADs=" />
<img class="<?php echo $name ?>_intLink" title="Redo" onclick="<?php echo $name ?>_formatDoc('redo');" src="data:image/gif;base64,R0lGODlhFgAWAMIHAB1ChDljwl9vj1iE34Kl8aPD+7/I1////yH5BAEKAAcALAAAAAAWABYAAANKeLrc/jDKSesyphi7SiEgsVXZEATDICqBVJjpqWZt9NaEDNbQK1wCQsxlYnxMAImhyDoFAElJasRRvAZVRqqQXUy7Cgx4TC6bswkAOw==" />
<img class="<?php echo $name ?>_intLink" title="Remove formatting" onclick="<?php echo $name ?>_formatDoc('removeFormat')" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAAd0SU1FB9oECQMCKPI8CIIAAAAIdEVYdENvbW1lbnQA9syWvwAAAuhJREFUOMtjYBgFxAB501ZWBvVaL2nHnlmk6mXCJbF69zU+Hz/9fB5O1lx+bg45qhl8/fYr5it3XrP/YWTUvvvk3VeqGXz70TvbJy8+Wv39+2/Hz19/mGwjZzuTYjALuoBv9jImaXHeyD3H7kU8fPj2ICML8z92dlbtMzdeiG3fco7J08foH1kurkm3E9iw54YvKwuTuom+LPt/BgbWf3//sf37/1/c02cCG1lB8f//f95DZx74MTMzshhoSm6szrQ/a6Ir/Z2RkfEjBxuLYFpDiDi6Af///2ckaHBp7+7wmavP5n76+P2ClrLIYl8H9W36auJCbCxM4szMTJac7Kza////R3H1w2cfWAgafPbqs5g7D95++/P1B4+ECK8tAwMDw/1H7159+/7r7ZcvPz4fOHbzEwMDwx8GBgaGnNatfHZx8zqrJ+4VJBh5CQEGOySEua/v3n7hXmqI8WUGBgYGL3vVG7fuPK3i5GD9/fja7ZsMDAzMG/Ze52mZeSj4yu1XEq/ff7W5dvfVAS1lsXc4Db7z8C3r8p7Qjf///2dnZGxlqJuyr3rPqQd/Hhyu7oSpYWScylDQsd3kzvnH738wMDzj5GBN1VIWW4c3KDon7VOvm7S3paB9u5qsU5/x5KUnlY+eexQbkLNsErK61+++VnAJcfkyMTIwffj0QwZbJDKjcETs1Y8evyd48toz8y/ffzv//vPP4veffxpX77z6l5JewHPu8MqTDAwMDLzyrjb/mZm0JcT5Lj+89+Ybm6zz95oMh7s4XbygN3Sluq4Mj5K8iKMgP4f0////fv77//8nLy+7MCcXmyYDAwODS9jM9tcvPypd35pne3ljdjvj26+H2dhYpuENikgfvQeXNmSl3tqepxXsqhXPyc666s+fv1fMdKR3TK72zpix8nTc7bdfhfkEeVbC9KhbK/9iYWHiErbu6MWbY/7//8/4//9/pgOnH6jGVazvFDRtq2VgiBIZrUTIBgCk+ivHvuEKwAAAAABJRU5ErkJggg==">
<img class="<?php echo $name ?>_intLink" title="Bold" onclick="<?php echo $name ?>_formatDoc('bold');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAInhI+pa+H9mJy0LhdgtrxzDG5WGFVk6aXqyk6Y9kXvKKNuLbb6zgMFADs=" />
<img class="<?php echo $name ?>_intLink" title="Italic" onclick="<?php echo $name ?>_formatDoc('italic');" src="data:image/gif;base64,R0lGODlhFgAWAKEDAAAAAF9vj5WIbf///yH5BAEAAAMALAAAAAAWABYAAAIjnI+py+0Po5x0gXvruEKHrF2BB1YiCWgbMFIYpsbyTNd2UwAAOw==" />
<img class="<?php echo $name ?>_intLink" title="Underline" onclick="<?php echo $name ?>_formatDoc('underline');" src="data:image/gif;base64,R0lGODlhFgAWAKECAAAAAF9vj////////yH5BAEAAAIALAAAAAAWABYAAAIrlI+py+0Po5zUgAsEzvEeL4Ea15EiJJ5PSqJmuwKBEKgxVuXWtun+DwxCCgA7" />
<img class="<?php echo $name ?>_intLink" title="Left align" onclick="<?php echo $name ?>_formatDoc('justifyleft');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JMGELkGYxo+qzl4nKyXAAAOw==" />
<img class="<?php echo $name ?>_intLink" title="Center align" onclick="<?php echo $name ?>_formatDoc('justifycenter');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIfhI+py+0Po5y02ouz3jL4D4JOGI7kaZ5Bqn4sycVbAQA7" />
<img class="<?php echo $name ?>_intLink" title="Right align" onclick="<?php echo $name ?>_formatDoc('justifyright');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JQGDLkGYxouqzl43JyVgAAOw==" />
<img class="<?php echo $name ?>_intLink" title="Numbered list" onclick="<?php echo $name ?>_formatDoc('insertorderedlist');" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAADljwliE35GjuaezxtHa7P///////yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKSespwjoRFvggCBUBoTFBeq6QIAysQnRHaEOzyaZ07Lu9lUBnC0UGQU1K52s6n5oEADs=" />
<img class="<?php echo $name ?>_intLink" title="Dotted list" onclick="<?php echo $name ?>_formatDoc('insertunorderedlist');" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAAB1ChF9vj1iE33mOrqezxv///////yH5BAEAAAcALAAAAAAWABYAAAMyeLrc/jDKSesppNhGRlBAKIZRERBbqm6YtnbfMY7lud64UwiuKnigGQliQuWOyKQykgAAOw==" />
<img class="<?php echo $name ?>_intLink" title="Quote" onclick="<?php echo $name ?>_formatDoc('formatblock','blockquote');" src="data:image/gif;base64,R0lGODlhFgAWAIQXAC1NqjFRjkBgmT9nqUJnsk9xrFJ7u2R9qmKBt1iGzHmOrm6Sz4OXw3Odz4Cl2ZSnw6KxyqO306K63bG70bTB0rDI3bvI4P///////////////////////////////////yH5BAEKAB8ALAAAAAAWABYAAAVP4CeOZGmeaKqubEs2CekkErvEI1zZuOgYFlakECEZFi0GgTGKEBATFmJAVXweVOoKEQgABB9IQDCmrLpjETrQQlhHjINrTq/b7/i8fp8PAQA7" />
<img class="<?php echo $name ?>_intLink" title="Add indentation" onclick="<?php echo $name ?>_formatDoc('outdent');" src="data:image/gif;base64,R0lGODlhFgAWAMIHAAAAADljwliE35GjuaezxtDV3NHa7P///yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKCQG9F2i7u8agQgyK1z2EIBil+TWqEMxhMczsYVJ3e4ahk+sFnAgtxSQDqWw6n5cEADs=" />
<img class="<?php echo $name ?>_intLink" title="Delete indentation" onclick="<?php echo $name ?>_formatDoc('indent');" src="data:image/gif;base64,R0lGODlhFgAWAOMIAAAAADljwl9vj1iE35GjuaezxtDV3NHa7P///////////////////////////////yH5BAEAAAgALAAAAAAWABYAAAQ7EMlJq704650B/x8gemMpgugwHJNZXodKsO5oqUOgo5KhBwWESyMQsCRDHu9VOyk5TM9zSpFSr9gsJwIAOw==" />
<img class="<?php echo $name ?>_intLink" title="Hyperlink" onclick="<?php echo $name ?>_linking();" src="data:image/gif;base64,R0lGODlhFgAWAOMKAB1ChDRLY19vj3mOrpGjuaezxrCztb/I19Ha7Pv8/f///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARY8MlJq7046827/2BYIQVhHg9pEgVGIklyDEUBy/RlE4FQF4dCj2AQXAiJQDCWQCAEBwIioEMQBgSAFhDAGghGi9XgHAhMNoSZgJkJei33UESv2+/4vD4TAQA7" />
<img class="<?php echo $name ?>_intLink" title="Cut" onclick="<?php echo $name ?>_formatDoc('cut');" src="data:image/gif;base64,R0lGODlhFgAWAIQSAB1ChBFNsRJTySJYwjljwkxwl19vj1dusYODhl6MnHmOrpqbmpGjuaezxrCztcDCxL/I18rL1P///////////////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAVu4CeOZGmeaKqubDs6TNnEbGNApNG0kbGMi5trwcA9GArXh+FAfBAw5UexUDAQESkRsfhJPwaH4YsEGAAJGisRGAQY7UCC9ZAXBB+74LGCRxIEHwAHdWooDgGJcwpxDisQBQRjIgkDCVlfmZqbmiEAOw==" />
<img class="<?php echo $name ?>_intLink" title="Copy" onclick="<?php echo $name ?>_formatDoc('copy');" src="data:image/gif;base64,R0lGODlhFgAWAIQcAB1ChBFNsTRLYyJYwjljwl9vj1iE31iGzF6MnHWX9HOdz5GjuYCl2YKl8ZOt4qezxqK63aK/9KPD+7DI3b/I17LM/MrL1MLY9NHa7OPs++bx/Pv8/f///////////////yH5BAEAAB8ALAAAAAAWABYAAAWG4CeOZGmeaKqubOum1SQ/kPVOW749BeVSus2CgrCxHptLBbOQxCSNCCaF1GUqwQbBd0JGJAyGJJiobE+LnCaDcXAaEoxhQACgNw0FQx9kP+wmaRgYFBQNeAoGihCAJQsCkJAKOhgXEw8BLQYciooHf5o7EA+kC40qBKkAAAGrpy+wsbKzIiEAOw==" />
<img class="<?php echo $name ?>_intLink" title="Paste" onclick="<?php echo $name ?>_formatDoc('paste');" src="data:image/gif;base64,R0lGODlhFgAWAIQUAD04KTRLY2tXQF9vj414WZWIbXmOrpqbmpGjudClFaezxsa0cb/I1+3YitHa7PrkIPHvbuPs+/fvrvv8/f///////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAWN4CeOZGmeaKqubGsusPvBSyFJjVDs6nJLB0khR4AkBCmfsCGBQAoCwjF5gwquVykSFbwZE+AwIBV0GhFog2EwIDchjwRiQo9E2Fx4XD5R+B0DDAEnBXBhBhN2DgwDAQFjJYVhCQYRfgoIDGiQJAWTCQMRiwwMfgicnVcAAAMOaK+bLAOrtLUyt7i5uiUhADs=" />
</div>


<div id="<?php echo $name ?>_textBox" contenteditable="true" onkeyup="<?php echo $name ?>_convert();" ><?php echo $content ?></div>
<textarea id="<?php echo $name ?>_input" name="<?php echo $name ?>" ><?php echo $content ?></textarea>
<div class='<?php echo $name ?>_toolbar' id="<?php echo $name ?>_toolBar3">
<input type="checkbox" name="<?php echo $name ?>_switchMode" id="<?php echo $name ?>_switchBox" onchange="<?php echo $name ?>_setDocMode(this.checked);" /> <label id="<?php echo $name ?>_editMode" for="switchBox">Show HTML</label>
</div>

<script language="javascript" type="text/javascript">

	//var <?php echo $name ?>_oDoc, <?php echo $name ?>_sDefTxt;
	var <?php echo $name ?>_oDoc = document.getElementById("<?php echo $name ?>_textBox");
	var <?php echo $name ?>_sDefTxt = <?php echo $name ?>_oDoc.innerHTML;
	var <?php echo $name ?>_switchMode = document.getElementById("<?php echo $name ?>_switchBox");
	var <?php echo $name ?>_input = document.getElementById("<?php echo $name ?>_input");

function <?php echo $name ?>_cleanDoc()
{
	if(confirm('Are you sure?'))//<?php echo $name ?>_validateMode()&&
	{
		<?php echo $name ?>_oDoc.innerHTML=<?php echo $name ?>_sDefTxt;
	}
}

function <?php echo $name ?>_linking()
{
	var sLnk=prompt('Write the URL here','http:\/\/');
	
	if(sLnk && sLnk!='' && sLnk!='http://')
	{
		<?php echo $name ?>_formatDoc('createlink',sLnk);
	}
}
  
function <?php echo $name ?>_convert(){

	//if(<?php echo $name ?>_validateMode())
	//{
		console.log(<?php echo $name ?>_oDoc.innerHTML);
		<?php echo $name ?>_input.value = <?php echo $name ?>_oDoc.innerHTML;
		return true;
	//}
	
	return false;

}

function <?php echo $name ?>_initDoc() 
{
	//<?php echo $name ?>_oDoc = document.getElementById("<?php echo $name ?>_textBox");
	//<?php echo $name ?>_sDefTxt = <?php echo $name ?>_oDoc.innerHTML;
	
	if (<?php echo $name ?>_switchMode.checked) 
	{ 
		<?php echo $name ?>_setDocMode(true); 
	}
}

function <?php echo $name ?>_formatDoc(sCmd, sValue) 
{
	//if (<?php echo $name ?>_validateMode()) 
	//{ 
		document.execCommand(sCmd, false, sValue); 
		<?php echo $name ?>_convert(); 
		<?php echo $name ?>_oDoc.focus(); 
	//}
}

function <?php echo $name ?>_validateMode() 
{
	if (!<?php echo $name ?>_switchMode.checked) 
	{ 
		return true ; 
	}
	//alert("Uncheck \"Show HTML\".");
	<?php echo $name ?>_convert();
	<?php echo $name ?>_oDoc.focus();
	return false;
}

function <?php echo $name ?>_setDocMode(bToSource) {
  var oContent;
  if (bToSource) {
    oContent = document.createTextNode(<?php echo $name ?>_oDoc.innerHTML);
    <?php echo $name ?>_oDoc.innerHTML = "";
    var oPre = document.createElement("pre");
    <?php echo $name ?>_oDoc.contentEditable = false;
    oPre.id = "<?php echo $name ?>_sourceText";
    oPre.contentEditable = true;
    oPre.appendChild(oContent);
    <?php echo $name ?>_oDoc.appendChild(oPre);
  } else {
    if (document.all) {
      <?php echo $name ?>_oDoc.innerHTML = <?php echo $name ?>_oDoc.innerText;
    } else {
      oContent = document.createRange();
      oContent.selectNodeContents(<?php echo $name ?>_oDoc.firstChild);
      <?php echo $name ?>_oDoc.innerHTML = oContent.toString();
    }
    <?php echo $name ?>_oDoc.contentEditable = true;
  }
  <?php echo $name ?>_convert();
  <?php echo $name ?>_oDoc.focus();
}

function <?php echo $name ?>_printDoc() {
  if (!<?php echo $name ?>_validateMode()) { return; }
  var oPrntWin = window.open("","_blank","width=450,height=470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
  oPrntWin.document.open();
  oPrntWin.document.write("<!doctype html><html><head><title>Print<\/title><\/head><body onload=\"print();\">" + <?php echo $name ?>_oDoc.innerHTML + "<\/body><\/html>");
  oPrntWin.document.close();
}

function <?php echo $name ?>_previewDoc() {
  if (!<?php echo $name ?>_validateMode()) { return; }
  var oPrvwWin = window.open("","_blank","width=450,height=470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
  oPrvwWin.document.open();
  oPrvwWin.document.write("<!doctype html><html><head><title>Print<\/title><\/head><body>" + <?php echo $name ?>_oDoc.innerHTML + "<\/body><\/html>");
  oPrvwWin.document.close();
}

<?php echo $name ?>_initDoc();

</script>

</div>