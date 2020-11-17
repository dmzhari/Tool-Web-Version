<!DOCTYPE html>
<html>
<head>
	<title>Reverse Ip Lookup</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Reverse Ip Based Tool">
</head>
<body>
	<h1>Reverse Ip</h1>
	<form method="POST">
		Site Or Ip : <input type="text" name="url">
		<input type="submit" value="Reverse!!">
	</form>
</body>
</html>
<?php
function curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://domains.yougetsignal.com/domains.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$url&key=&_=");
	curl_setopt($ch, CURLOPT_POST, 1);
	$exe = curl_exec($ch);
	curl_close($ch);
	return $exe;
}
	if (isset($_POST['url']) && !empty($_POST['url'])) {
		$filter = htmlspecialchars($_POST['url']);
		if (!preg_match('#^http(s)?://#',$filter)) {
			$site = $filter;
		}
		else {
			$site = preg_replace("#^http(s)?://#", "", $filter);
		}
		echo "<textarea cols='60' rows='10'>";
		$reverse = curl($site);
		$json = json_decode($reverse, true);
		foreach ($json['domainArray'] as $key) {
			echo $key[0]."\n";
		}
		echo "</textarea>";
	}
?>
