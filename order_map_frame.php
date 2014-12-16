<?php
/*
*---------------------------------------------------------
*
*	CartET - Open Source Shopping Cart Software
*	http://www.cartet.org
*
*---------------------------------------------------------
*/

$o_id = $_GET['o_id'];
if ($o_id)
{
require (DIR_WS_CLASSES.'order.php');
$order = new order($o_id);

$street_address = (!isset($order->delivery["street_address"])) ? null : $order->delivery["street_address"];
$city = (!isset($order->delivery["city"])) ? null : $order->delivery["city"] . ', ';
$postcode = (!isset($order->delivery["postcode"])) ? null : $order->delivery["postcode"] . ', ';
$state = (!isset($order->delivery["state"])) ? null : $order->delivery["state"] . ', ';
$country = (!isset($order->delivery["country"])) ? null : $order->delivery["country"] . ', ';
$ship_address = $postcode . $city . $street_address;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link href="<?php echo _HTTP; ?>jscript/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo _HTTP; ?>jscript/bootstrap/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo _HTTP; ?>jscript/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo _HTTP; ?>jscript/bootstrap/css/bootstrap-modal.css" rel="stylesheet" />
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo _HTTP; ?>admin/themes/default/styles/style.css">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no, maximum-scale=1" />
<script type="text/javascript" src="<?php echo _HTTP; ?>jscript/jquery/jquery.js"></script>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"> </script>
<script type="text/javascript">
ymaps.ready(init);

function init() {
    ymaps.geocode('<?php echo $ship_address; ?>', { results: 1 }).then(function (res) {
        var firstGeoObject = res.geoObjects.get(0),

		myMap = new ymaps.Map("YMapsID", {
			center: firstGeoObject.geometry.getCoordinates(),
			zoom: 17
		});

        myMap.container.fitToViewport();

		var placemark = new ymaps.Placemark(myMap.getCenter(), {
			balloonContent: '<?php echo $ship_address; ?>'
		});
		myMap.geoObjects.add(placemark);

    }, function (err)
	{
        alert(err.message);
    });
}
</script>
</head>
<body>

<a href="http://maps.yandex.ru/?text=<?php echo $ship_address; ?>" target="_blank"><?php echo $ship_address; ?></a>

<div id="YMapsID" style="width:100%;height:700px"></div>

</body>
</html>
<?php } else { echo 'Не указан ID заказа'; } ?>