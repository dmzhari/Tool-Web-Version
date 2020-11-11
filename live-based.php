<!DOCTYPE html>
<html>
<head>
	<title>Check Live Site</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Check Live Site Scanner By ./EcchiExploit">
</head>
<body>
	<h1>Check Live Scanner</h1>
	Note : <b> in the list must be example.com</b>
	<form method="POST">
		<textarea name="list" cols="60" rows="10"></textarea>
		<input type="submit" value="Submit!!">
	</form>
</body>
</html>
<?php
	function curl($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		$exe = curl_exec($curl);
		curl_close($curl);
		return $exe;
	}
	if (isset($_POST['list']) && !empty($_POST['list'])) {
		$filter = htmlspecialchars($_POST['list']);
		$exp = explode("\n", $filter);
		foreach ($exp as $key) {
			if (!preg_match('#^http(s)?://#',$key)) {
				$site = "http://".$key;
			}
			else {
				$site = $key;
			}
			$scan = curl($site);
			if (preg_match("/html|head|body/", $scan)) {
				echo "Live > $site<br>";
			}
			else {
				echo "Not Live > $site<br>";
			}
		}
	}
?>