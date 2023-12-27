<?php
$cars_arr = array();

function parse_params($node)
{
    $params = array();
    foreach ($node->childNodes as $param) {
        if ($param->nodeType === XML_ELEMENT_NODE && $param->nodeName === 'param') {
            $pname = $param->getAttribute('pname');
            $pvalue = $param->nodeValue;
            $params["$pname"] = $pvalue;
        }
    }
    return $params;
}

$domxml = new DOMDocument;
$domxml->load("products/cars.xml", LIBXML_NOBLANKS);
$xmlIsValidate = false;

if ($domxml->validate()) {
	$xmlIsValidate = true;
	$list = $domxml->getElementsByTagName('car');
	foreach ($list as $car) {
		$product = array(
			"id" => $car->getAttribute('id'),
			"name" => $car->getElementsByTagName('name')->item(0)->nodeValue,
			"group" => $car->getElementsByTagName('group')->item(0)->nodeValue,
			"price" => $car->getElementsByTagName('price')->item(0)->nodeValue,
			"number" => $car->getElementsByTagName('serialNumber')->item(0)->nodeValue,
			"year" => $car->getElementsByTagName('yearOfIssue')->item(0)->nodeValue,
			"image" => $car->getElementsByTagName('image')->item(0)->nodeValue,
			"params" => parse_params($car->getElementsByTagName('params')->item(0)),
		);

		$cars_arr[] = $product;
	}
}
$CSS_DOP = Array("css/additional_styles.css");

include('php/header.php');
?>

<section class="main-content">
	<div class="main-top"><b>CARS CATALOG</b></div>
	<div class="main-center">
		<div class="main-cnt-text"><b>Outputting the car shop catalog.</b></div>
		<div class="main-cnt-text">
		<?php
		if ($xmlIsValidate) {
		?>
		<table id="fm-table" style="font-size: 10px; border-collapse: collapse;" border=1>
			<tr style="font-size: 13px;">
				<th>ID</th>
				<th>Car </th>
				<th>Image</th>
				<th>Parameters</th>
			</tr>
			<?php foreach ($cars_arr as $product) : ?>
			<tr>
				<td><?= $product["id"] ?></td>
				<td>Model: <?= $product["name"] ?><br>
					Type: <?= $product["group"] ?><br>
					Price: <?= $product["price"] ?><br>
					Number: <?= $product["number"] ?><br>
					Year: <?= $product["year"] ?>
				</td>
				<td><img height="100" src="<?= $product["image"] ?>"></td>
				<td>
					<?php
					$paramsOutput = [];
					foreach ($product["params"] as $pname => $pvalue) {
						$paramsOutput[] = "$pname: $pvalue";
					}
					echo implode('<br>', $paramsOutput);
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php
		}
		?>
		</div>
	</div>
</section>

<?php
include('php/footer.php');
?>