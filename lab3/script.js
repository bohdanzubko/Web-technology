// Set current date
function setDate() {
	const daysOfWeek = ["Sunday", "Mondady", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	const months = ["January", "Fabuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

	const currentDate = new Date();

	const dayOfWeek = daysOfWeek[currentDate.getDay()];
	const dayOfMonth = currentDate.getDate();
	const month = months[currentDate.getMonth()];
	const year = currentDate.getFullYear();

	const formattedDate = `${dayOfWeek}, ${month} ${dayOfMonth}, ${year}`;

	document.getElementById("header-date").textContent = formattedDate;
}

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

// Current date and animations
document.addEventListener("DOMContentLoaded", function(){ 
	setDate();
	moveElement("animated-logo", "logo");
	moveElement("animated-ad", "ad");
});

// Math operations form
document.addEventListener("DOMContentLoaded", function () {
	var resultButton = document.getElementById("result-btn");
	var resetButton = document.getElementById("reset-btn");
	var errorMsg = document.getElementById("error-msg");
	var resultMsg = document.getElementById("result-msg");
	var firstNum, secondNum, operation;

	function clearMsgs(){
		errorMsg.innerText = "";
		resultMsg.innerText = "";
		errorMsg.style.color = "#e63e3e";
	}

	resetButton.addEventListener("click", function(){
		clearMsgs();
	});

	resultButton.addEventListener("click", function (event) {
		event.preventDefault();
		clearMsgs();

		firstNum = document.getElementById("first-num").value;
		secondNum = document.getElementById("second-num").value;
		let selectedOpElement = document.getElementById("math-op");
		operation = selectedOpElement.options[selectedOpElement.selectedIndex].value;
		
		firstNum = firstNum.replace(',', '.');
		secondNum = secondNum.replace(',', '.');

		if(firstNum == ""){
			firstNum = "0";
		}

		if(secondNum == ""){
			secondNum = "0";
		}

		let numRegex = /^[+-]?\d+(\.\d+)?$/;

		if(!numRegex.test(firstNum) || !numRegex.test(secondNum)){
			errorMsg.innerText = "Fields must contain numbers only!";
			return;
		}

		switch(operation){
			case "sum": resultMsg.innerText = parseFloat(firstNum) + parseFloat(secondNum);	break;
			case "sub": resultMsg.innerText = parseFloat(firstNum) - parseFloat(secondNum);	break;
			case "mul": resultMsg.innerText = parseFloat(firstNum) * parseFloat(secondNum);	break;
			case "div": 
				if (parseFloat(secondNum) == 0){
					errorMsg.innerText = "Cannot divide by zero!"
					return;
				}
				resultMsg.innerText = parseFloat(firstNum) / parseFloat(secondNum);	
				break;
			case "pow": resultMsg.innerText = Math.pow(parseFloat(firstNum), parseFloat(secondNum)); break;
			case "sqrt": 
				if (parseFloat(firstNum) < 0){
					errorMsg.innerText = "The number must be positive!";
					return;
				}
				if (secondNum != "0"){
					errorMsg.style.color = "orange";
					errorMsg.innerText = "Second number is not used";
				}
				resultMsg.innerText = Math.sqrt(parseFloat(firstNum));	
				break;
			default: errorMsg.innerText = "Invalid operation";
		}
	});
});

// Redireting to home page
document.addEventListener("DOMContentLoaded", function () {
	const countdownElement = document.getElementById('countdown');	
	let seconds = 3;
	
	function updateCountdown() {
		countdownElement.textContent = seconds;
		seconds--;

		if (seconds < 0) {
			window.location.href = 'main.html';
		} 
		else {
			setTimeout(updateCountdown, 1000);
		}
	}

	updateCountdown();
});