<?php
$CSS_DOP = Array("css/additional_styles.css");

include('php/header.php');
?>

<section class="main-content">
	<div class="main-top"><b>REDIRECT TO HOME</b></div>
	<div class="main-center">
		<div class="main-cnt-text"><b>Script for redirecting to ahother page</b></div>
		<div>You will redirected to home page in <span  id="countdown">3</span>...</div>
</section>

<script>
	<?php require_once("js/redirection.js"); ?>
</script>

<?php
include('php/footer.php');
?>