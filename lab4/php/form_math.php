<?php
include('header.php');
?>

<link rel="stylesheet" href="../css/additional_styles.css">

<main>
	<div class="left-column">
		<menu>
			<ul>
			<li class="li-bt"><a href="#">Merchandise</a></li>
			<li><a href="#">Equipment</a></li>
			<li><a href="#">Service</a></li>
			<li><a href="#">Seminars</a></li>
			<li><a href="#">Practice Development</a></li>
			<li><a href="#">Painless Web</a></li>
			<li><a href="#">BluChips Rewards</a></li>
			<li><a href="#">Earnings Builders</a></li>
			<li><a href="#">Interlink</a></li>
			<li><a href="#">Featured Products</a></li>
			<li><a href="#">Partners</a></li>
			<li><a href="#">International</a></li>
			<li><a href="#">Government</a></li>
			<li><a href="#">Handpiece repairs</a></li>
			<li><a href="form_math.php">Math operations</a></li>
			<li><a href="redirect_to_index.php">Redirect to home</a></li>
			<li><a href="server_info.php">Server info</a></li>
			</ul>
		</menu>
		<div class="no-adv-body">
			<div class="no-adv-title">
				<a href="#">Spotlight Features</a>
			</div>
			<div>
				<img class="no-adv-pic" src="../img/medicine.jpg" alt="Medicine photo">
				<div class="no-adv-text">
					<b>Seminars in your area</b><br>
					Dates, topics, locations, <br>
					& prices. Save 10% when <br>
					3 or more sign-up! <br>
					<br>
					<b>Topics, Trends, <br>
					Techniques</b><br>
					Don't let your patients <br>
					give you the brush-off. <br>
					Increase patient <br>
					acceptance!
				</div>
			</div>
		</div>
	</div>
	<section class="main-content">
		<div class="main-top"><b>Math operaions</b></div>
		<div class="main-center">
		<div class="main-cnt-text"><b>Form with script for checking input data</b></div>
		<form id="math-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onreset="resetFields()" onsubmit="resetFields()">
		<table id="math-form-tabel">
			<tr>
				<td><label for="first-num">First number: </label></td>
				<td><input placeholder="0" id="first-num" name="first-num" type="text"/></td>
			</tr>
			<tr>
				<td><label for="second-num">Second number: </label></td>
				<td><input placeholder="0" id="second-num" name="second-num" type="text"/></td>
			</tr>
			<tr>
				<td><label for="math-op">Math operation:</label></td>
				<td>
				<select id="math-op" name="math-op">
				<option>sum</option>
				<option>sub</option>
				<option>mul</option>
				<option>div</option>
				<option>pow</option>
				<option>sqrt</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><div id="error-msg" name="error-msg"></div></td>
				<td><div id="result-msg" name="result-msg">
				<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// Retrieve form data
					$firstNum = $_POST["first-num"];
					$secondNum = $_POST["second-num"];
					$operation = $_POST["math-op"];

					// Validate inputs
					$firstNum = str_replace(',', '.', $firstNum);
					$secondNum = str_replace(',', '.', $secondNum);

					if ($firstNum == "") {
						$firstNum = "0";
					}

					if ($secondNum == "") {
						$secondNum = "0";
					}

					$numRegex = '/^[+-]?\d+(\.\d+)?$/';

					if (!preg_match($numRegex, $firstNum) || !preg_match($numRegex, $secondNum)) {
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
					if (isset($errorMsg)) {
						echo "<script>document.getElementById('error-msg').innerText = '" . $errorMsg . "';</script>";
					}
					else {
						echo $resultMsg;
					}
					echo "<script>if(". $firstNum ." != 0) document.getElementById('first-num').value = '" . $firstNum . "'</script>";
					echo "<script>if(". $secondNum ." != 0) document.getElementById('second-num').value = '" . $secondNum . "'</script>";
					echo "<script>document.getElementById('math-op').value = '" . $operation . "'</script>";
				}
				?>
				</div></td>
			</tr>
			<tr>
				<td class="centered-td"><input type="reset" id="reset-btn" name="reset-btn"></td>
				<td class="centered-td"><input type="submit" id="result-btn" name="result-btn" value="Get result"></td>
			</tr>
		</table>
		</form>
		</div>
	</section>
</main>

<?php
include('footer.php');
?>