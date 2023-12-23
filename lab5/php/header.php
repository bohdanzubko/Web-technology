<html lang="en">
<head>
	<meta charset="utf-8">
	<title>lab-5</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<?php
	if (isset($CSS_DOP) && count($CSS_DOP) > 0){
		foreach($CSS_DOP as $css_file){
			echo '<link rel="stylesheet" href="css/additional_styles.css">';
		}
	}
	?>
	<script src="js/script.js"></script>
</head>
<body>
<div class="wrapper">
	<header>
		<div class="header-left">
			<div class="header-logo"><a href="index.php"><img src="img/tooth-logo.png" alt="Tooth logo" id="animated-logo"></a></div>
			<div class="header-center">
				<div class="header-title"><img src="img/title.png" alt="Dental Health"></div>
				<div class="header-intro">
					These innovations have served to enable us to <br>
					better live our mission; "To build partnerships <br>
					that improve our customers' earnings by co-managing <br>
					their supply, equipment and practice management needs". 
				</div>
				<div id="header-date">Wednesday, October 23, 2002</div>
			</div>
		</div>
		<div class="header-right">
			<div class="header-buttons">
				<a href="#" class="a-help"><span>help</span></a>
				<a href="#" class="a-about-us"><span>about us</span></a>
				<a href="#" class="a-contact"><span>contact</span></a>
			</div>
			<div class="head-search">
				<div class="search-text">SEARCH:</div>
				<div><input type="text" class="search-input"></div>
				<div><button class="search-button">ok</button></a>
			</div>
		</div>
	</header>
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
			<li><a href="file_manager.php">File manager</a></li>
			</ul>
		</menu>
		<div class="no-adv-body" id="animated-ad">
			<div class="no-adv-title">
				<a href="#">Spotlight Features</a>
			</div>
			<div>
				<img class="no-adv-pic" src="img/medicine.jpg" alt="Medicine photo">
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