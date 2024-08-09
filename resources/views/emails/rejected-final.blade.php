<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lapakami Permohonan Diajukan</title>

	<style type="text/css">
		body{
			background: rgba(66, 133, 243, 0.08);
			font-family: 'Arial';
		}
		.background{
			background: rgba(66, 133, 243, 0.08) !important;
			margin: 0;
			padding: 30px 0;
			width: 100%;
			height: 100%;
		}
		.container{
			margin: 30px auto;
			max-width: 650px;
			width: 100%;
		}
		header{
			text-align: center;
			margin-bottom: 20px;
		}
		.title{
			color: #0B2956;
			margin-bottom: 30px;
			text-align: center;
		}
		.title h3{
			margin: 0;
			font-weight: 600;
			font-size: 17px;
		}
		.content{
			padding: 30px;
			background: #FFF;
			text-align: center;
		}
		p{
			font-size: 14px;
			color: #111;
			line-height: 1.5;
		}
		footer{
			text-align: center;
			margin-top: 25px;
		}
		footer p{
			color: #999;
		}
		.button{
			padding: 10px 25px;
			font-size: 14px;
			background: #4285f4;
			text-decoration: none;
			color: #FFF !important;
		}
		a{
			color: #4285f4;
		}
		table{
			width: 100%;
			border: 0;
		}
		table tr,
		table td{
			font-size: 13px;
			text-align: left;
			padding: 5px;
		}
		.note{
			background: #f2f2f2; 
			padding: 10px; 
			line-height: 1.8; 
			font-size: 13px;
		}
	</style>
</head>
<body>

<div class="background">
	<div class="container">
		<?php use App\Helpers\DateFormatHelper; ?>
		<header>
			<img src="{{env('APP_URL')}}/assets/img/lapakami-logo-text.png" class="Lapakami" height="60px" alt="Logo Lapakami">
		</header>
		<div class="title">
			<h3>Permohonan Layanan (Ditolak)</h3>
		</div>
		<div class="content">
			<p>Halo, <b>{{ $data['name'] }}</b></p>
			<p>Mohon maaf permohonan layanan yang anda ajukan melalui aplikasi Lapakami tidak dapat kami lanjutkan ke tahapan berikutnya, silahkan lengkapi atau perbaiki persyaratan dengan detail sebagai berikut.</p>
			<table style="margin-top: 25px;">
				<tbody>
					<tr>
						<th width="25%">Layanan</th>
						<td width="5%">:</td>
						<td>{{ $data['service_name'] }}</td>
					</tr>
					<tr>
						<th>Tanggal Permohonan</th>
						<td>:</td>
						<td>{{ DateFormatHelper::dateNumFull($data['time']) }}</td>
					</tr>
					<tr>
						<th>Status Permohonan</th>
						<td>:</td>
						<td>Ditolak</td>
					</tr>
					<tr>
						<th>Tanggal Status</th>
						<td>:</td>
						<td>{{ DateFormatHelper::dateNumFull($data['time']) }}</td>
					</tr>
				</tbody>
			</table>
			<p class="note">
				<b>Catatan:</b><br>
				{{$data['redaksi']}}
			</p>

			<p style="margin-top: 30px;">
				<a href="{{$data['url']}}" class="button">Lihat Permohonan</a>
			</p>
			<p style="margin-top: 30px;">
				<a href="{{$data['url']}}">{{$data['url']}}</a>
			</p>
		</div>
		<footer>
			<p>
				<small>Hak Cipta 2023. Lapakami</small> <br>
				<small>Pemerintah Daerah Kota Cimahi</small>
			</p>
		</footer>
	</div>
</div>

</body>
</html>