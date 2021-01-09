<!DOCTYPE html>
<html>
<head>
	<title>Subdomain Finder</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Find Subdomain">
</head>
<body>
	<h1>Subdomain Scanner</h1>
	<form method="POST">
		<table>
			<td>Site</td>
			<td>:</td>
			<td><input type="text" name="domain"></td>
			<td><button type="submit">submit</button></td>
		</table>
	</form>
</body>
</html>
<?php
function curl($url)
{
    $setopt = array(
        CURLOPT_URL => 'https://osint.sh/subdomain/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => "domain=$url",
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36",
        CURLOPT_TIMEOUT => 60,
        CURLOPT_CONNECTTIMEOUT => 60
    );
    $ch = curl_init();
    curl_setopt_array($ch, $setopt);
    $exe = curl_exec($ch);
    curl_close($ch);
    return $exe;
}
if (!empty($_POST['domain']))
{
	$domain = htmlspecialchars($_POST['domain']);
	$subdomain = curl($domain);
	$scrap = preg_match_all("/<a href=\"(.*?)\" target=\"_blank\">www.(.*?)<\/a>/i", $subdomain, $subdo);
	echo '<textarea cols="60" rows="10">';
	foreach ($subdo[2] as $key) {
		echo "$key\n";
	}
	echo '</textarea>';
}
?>