<?php
$CSS_DOP = Array("css/additional_styles.css");

include('php/header.php');
?>

<section class="main-content">
	<div class="main-top"><b>SERVER VARIABLE INFO</b></div>
	<div class="main-center">
		<div class="main-cnt-text"><b>Outputing the variable info</b></div>
		<div class="variables-info">
			<?php
			echo nl2br('$_SERVER:' . "\n");
			foreach ($_SERVER as $key => $val) {
				echo nl2br($key . ":\n" . $val . "\n");
			}
			echo nl2br("\n" . '$_GET:' . "\n");
			foreach ($_GET as $key => $val) {
				echo nl2br($key . ":\n" . $val . "\n");
			}
			echo nl2br("\n" . '$_POST:' . "\n");
			foreach ($_POST as $key => $val) {
				echo nl2br($key . ":\n" . $val . "\n");
			} ?>
		</div>
</section>

<?php
include('php/footer.php');
?>