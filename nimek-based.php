<!DOCTYPE html>
<html>
<head>
	<title>Kusonime Anime Scrapper</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="card">
				<h5 class="text-center font-italic">Kusonime<span class="text-primary"> Anime</span></h5>
				<div class="card-body">
					<form method="POST" class="form-inline">
						<div class="form-group">
							<label for="judul" class="p-1">Judul Anime:</label>
							<input type="text" name="nimek" id="judul" class="form-control" required="true">
							<button type="submit" class="btn btn-outline-primary">Cari!!</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
		if (isset($_POST['nimek']) && !empty($_POST['nimek'])) {
			$filter = htmlspecialchars($_POST['nimek']);
			$rep = preg_replace("/ /", "%20", $filter);
			$api = file_get_contents("https://arugaz.herokuapp.com/api/kuso?q=$rep");
			$json = json_decode($api, true);
			if ($json['status'] == 200) {
				$judul = $json['title'];
				$info = nl2br($json['info']);
				$gambar = $json['thumb'];
				$download = nl2br($json['link_dl']);
				echo "<br>
				<img class='img-fluid img-thumbnail float-left p-3' width='500' src='$gambar' alt='thumbnail'>
				<h5 class='text-center font-italic'>Judul : <span class='text-primary'>$judul</h5>
				<div class='font-italic text-center'>
					$info
				</div>
				<div class='table-responsive'>
					<table class='table table-bordered table-striped table-hover'>
						<thead>
							<tr>
								<th class='text-center'>Link Download</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>$download</td>
							</tr>
						</tbody>
					</table>
				</div>";
			}
			else {
				echo "<h5 class='text-center text-danger'>Judul Anime Tidak Temukan!!!</h5>";
			}
		}
		?>
	</div>
</body>
</html>