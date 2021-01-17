<!DOCTYPE html>
<html>
<head>
	<title>Reverse Email</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="desctription" content="Whoislookup Reverse">
</head>
<body>
	<h1>Reverse From Email</h1>
	<form method="POST">
		<table>
			<tr>
				<td>Email :</td>
				<td><input type="text" name="email" placeholder="example@example.com"></td>
				<td><input type="submit" value="Reverse!!"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
function curl($mail)
{
	$setopt = array(
		CURLOPT_URL 			=> 'https://osint.sh/reversewhois/',
		CURLOPT_RETURNTRANSFER		=> true,
		CURLOPT_POST			=> true,
		CURLOPT_POSTFIELDS		=> "email=$mail",
		CURLOPT_USERAGENT		=> 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36',
		CURLOPT_CONNECTTIMEOUT		=> 60,
		CURLOPT_TIMEOUT 		=> 60,
		CURLOPT_HEADER			=> false
	);
	$ch = curl_init();
	curl_setopt_array($ch, $setopt);
	$exe = curl_exec($ch);
	curl_close($ch);
	return $exe;
}
if (!empty($_POST['email']))
{
	$email = htmlspecialchars($_POST['email']);
	$lookup = curl($key);
	$scrapt = preg_match_all("/<a href=\"https:\/\/(.*?)\">(.*?)<\/a>/i", $lookup, $domain);
	$url = preg_replace("/<i class=\"(.*?)\"><\/i>/", '', $domain[2]);
	$url = str_replace('Teguh Aprianto', '', $url);
	$filter = array_filter($url);
	if ($filter == null)
	{
		echo "No Result In This Email $key";
	}
	else
	{
		?>
		<table>
		<tr>
			<td>Result :</td>
		</tr>
		<tr>
			<td>
				<textarea cols="60" rows="10"><?php foreach ($filter as $domains){ echo "$domains\n"; } ?></textarea>
			</td>
		</tr>
		</table>
		<?php
	}
}
?>
