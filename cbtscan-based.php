<!DOCTYPE html>
<html>
<head>
	<title>Cbt Exploit</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Scanning Exploit CBT">
</head>
<body>
	<h1>CBT Exploit Scanner</h1>
	<form method="POST">
		Site => <input type="text" name="url" placeholder="https://example.com">
		<input type="submit" value="Scan Exploit Candy CBT" name="cbtcandy">
		<input type="submit" value="Scan Exploit Beesmart CBT" name="cbtbeesmart">
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
	$candy = array('/plugins/uploadfile/demo/uploads/demo.html', '/plugins/uploadfile/demo/uploads/upload.php','/admin/filesoal.php','/admin/restore.php','/admin/soal/import_file.php','/admin/ifm.php');
	$beesmart = array('/panel/pages/upload-file.php','/panel/pages/upload-logo.php','/panel/pages/upload_audio.php','/panel/pages/upload_video.php','/panel/pages/upload_gambar.php','/panel/pages/upload-fotosiswa.php','/panel/pages/upload-banner.php','/panel/pages/upload_jawab7.php','/panel/pages/upload_jawab6.php','/panel/pages/upload_jawab5.php','/panel/pages/upload_jawab2.php','/panel/pages/upload_jawab1.php');
	if (isset($_POST['cbtcandy'])) {
		if (curl($web."/admin/login.php") == "200") {
			foreach ($candy as $key) {
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
		else if(curl($web."/x-panel/login.php") == "200") {
			if(curl($exp6) == "302"){
				echo "Sql Injection With Sqlmap : <a href='$exp6' target='_blank'>$exp6</a><br>";
				echo "Tutorial : <a href='https://ecchiexploit.blogspot.com/2020/09/sql-injection-in-new-candy-cbt-v28-rev.html' target='_blank'> Klick Here </a>";
			}
			else {
				echo "Not Injection : $exp6";
			}
		}
		else {
			echo "Not Candy CBT";
		}
	}
	else if (isset($_POST['cbtbeesmart'])) {
		if (curl($web."/panel/pages/login.php") == "200") {
			foreach ($beesmart as $key) {
				$site = $web.$key;
				if (curl($site) == "200") {
					echo "Found : <a href='$site' target='_blank'>$site</a><br>";
				}
				else {
					echo "Not Found : $site<br>";
				}
			}
		}
		else {
			echo "Not Beesmart CBT";
		}
	}
}
?>
