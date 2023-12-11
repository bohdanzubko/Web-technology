<?php
function getPostPar($name, $def = "")
{
	$val = $def;
	if (isset($_POST[$name])) {
		$val = $_POST[$name];
	}
	return $val;
}

$errorMsg = $resultMsg = "";

// Retrieve form data
$firstNum = getPostPar("first-num");
$secondNum = getPostPar("second-num");
$operation = getPostPar("math-op");
$isValid = true;

// Validate inputs
$firstNum = str_replace(',', '.', $firstNum);
$secondNum = str_replace(',', '.', $secondNum);

$numRegex = '/^(?:[+-]?\d+(\.\d+)?|)$/';

if (!preg_match($numRegex, $firstNum) || !preg_match($numRegex, $secondNum)) {
	$isValid = false;
}

if (isset($_POST["reset-btn"])){
	$firstNum = $secondNum = "";
	$operation = "sum";
}

if (isset($_POST["result-btn"])){
	if (isset($_POST["action"]) && ($_POST["action"] == "procrm")) {
		if($isValid == false){
			$errorMsg = "Fields must contain numbers only!";
			goto end;
		}
	
		$num1 = doubleval($firstNum);
		$num2 = doubleval($secondNum);
		
		// Perform calculations based on the selected operation
		switch ($operation) {
			case "sum":	$resultMsg = $num1 + $num2; break;
			case "sub":	$resultMsg = $num1 - $num2; break;
			case "mul":	$resultMsg = $num1 * $num2; break;
			case "div":
				if ($num2 == 0) {
					$errorMsg = "Cannot divide by zero!";
				} else {
					$resultMsg = $num1 / $num2;
				}
				break;
			case "pow":	$resultMsg = pow($num1, $num2); break;
			case "sqrt":
				if ($num1 < 0) {
					$errorMsg = "The number must be positive!";
				} elseif ($num2 != "0") {
					$errorMsg = "Second number is not used";
				} else {
					$resultMsg = sqrt($num1);
				}
				break;
			default: $errorMsg = "Invalid operation";
		}
		end:
	}
}
?>

<?php
$CSS_DOP = Array("css/additional_styles.css");

include('php/header.php');
?>

<section class="main-content">
	<div class="main-top"><b>Math operaions</b></div>
	<div class="main-center">
	<div class="main-cnt-text"><b>Form with script for checking input data</b></div>
	<form id="math-form" method="post" action="">
	<input type="hidden" name="action" value="procrm">
	<table id="math-form-tabel">
		<tr>
			<td><label for="first-num">First number: </label></td>
			<td><input placeholder="0" id="first-num" name="first-num" type="text" value="<?=$firstNum?>"></td>
		</tr>
		<tr>
			<td><label for="second-num">Second number: </label></td>
			<td><input placeholder="0" id="second-num" name="second-num" type="text" value="<?=$secondNum?>"></td>
		</tr>
		<tr>
			<td><label for="math-op">Math operation:</label></td>
			<td>
			<select id="math-op" name="math-op">
			<option <?=( $operation == "sum" ? "selected" : "")?>>sum</option>
			<option <?=( $operation == "sub" ? "selected" : "")?>>sub</option>
			<option <?=( $operation == "mul" ? "selected" : "")?>>mul</option>
			<option <?=( $operation == "div" ? "selected" : "")?>>div</option>
			<option <?=( $operation == "pow" ? "selected" : "")?>>pow</option>
			<option <?=( $operation == "sqrt" ? "selected" : "")?>>sqrt</option>
			</select>
			</td>
		</tr>
		<tr>
			<td><div id="error-msg" name="error-msg"><?=$errorMsg?></div></td>
			<td><div id="result-msg" name="result-msg"><?=$resultMsg?></div></td>
		</tr>
		<tr>
			<td class="centered-td"><input type="submit" id="reset-btn" name="reset-btn" value="Reset"></td>
			<td class="centered-td"><input type="submit" id="result-btn" name="result-btn" value="Get result"></td>
		</tr>
	</table>
	</form>
	</div>
</section>

<?php
include('php/footer.php');
?>