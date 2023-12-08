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