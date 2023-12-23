// Linear function
function deltaLinear(progress){
	return progress;
}

// EasyIn
function deltaAccel(progress){
	return Math.pow(progress, 2);
}

// EasyOut
function deltaAccelDown(progress){
	return ( 1 - deltaAccel(1 - progress));
}

// Bounce
function bounce(progress) {
	for (let a = 0, b = 1; 1; a += b, b /= 2) {
		if (progress >= (7 - 4 * a) / 11) {
			return -Math.pow((11 - 6 * a - 11 * progress) / 4, 2) + Math.pow(b, 2)
		}
	}
}

// Reverse
function makeEaseOut(timing) {
	return function(progress) {
		return 1 - timing(1 - progress);
	}
}

// Make animation for elements
function moveElement(objid, mode)
{
	var element = document.getElementById(objid);
	var from, to;

	switch(mode) {
		case "logo":
			from = -106;
			to = 0;
			break;
		case "ad":
			from = -500;
			to = 0;
	}
	var duration = 1500;
	var fps = 100;
	var fps_tick = (1000 / fps);
	var start = new Date().getTime();
	
	setTimeout(function() {
		var now = (new Date().getTime()) - start;
		
		var progress = now / duration;
		if( progress > 1 )
			progress = 1;

		var delta;
		var result;
		if (mode == "logo"){
			delta = makeEaseOut(bounce)(progress);
			result = (to - from) * delta + from;
			element.style.top = result + "px";
		}
		else if (mode == "ad"){
			delta = deltaAccelDown(progress);
			result = (to - from) * delta + from;
			element.style.left = result + "px";
		}

		if (progress < 1)
			setTimeout(arguments.callee, fps_tick);
	}, 10);
};

document.addEventListener("DOMContentLoaded", function(){ 
	moveElement("animated-logo", "logo");
	moveElement("animated-ad", "ad");
});