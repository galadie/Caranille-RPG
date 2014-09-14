function pop(div) {
	window.scrollTo(0,0);
	document.getElementById(div).style.display='block';
	return false;
}
function hide(div) {
	document.getElementById(div).style.display='none';
	return false;
}
/**
var elements_pop = document.getElementsByClassName('parentDisable')

for (var i = 0; i < elements_pop.length; i++) {
    elements_pop[i].addEventListener('click', function(i){
	
		alert('capture event');
			
		return function() {
			
			var id = this.id;
			alert("This object's ID attribute is set to \"" + id + "\"."); 
			hide(id);
		}
	}(i),false);
}
**/

/**
window.onload = addListeners;

function addListeners(){
 var elements_pop = document.getElementsByClassName('parentDisable');

	for (var i = 0; i < elements_pop.length; i++) {
	  elements_pop[i].addEventListener('mousedown', mouseDown, false);
		window.addEventListener('mouseup', mouseUp, false);
	}
}

function mouseUp()
{
    window.removeEventListener('mousemove', divMove, true);
}

function mouseDown(e){
  window.addEventListener('mousemove', divMove, true);
}

function divMove(e){
    var div = document.getElementById('dxy');
  div.style.position = 'absolute';
  div.style.top = e.clientY + 'px';
  div.style.left = e.clientX + 'px';
}
**/