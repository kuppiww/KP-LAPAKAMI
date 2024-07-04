<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lapakami Pendaftaran Akun Baru</title>

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
	</style>
</head>
<body>

<div class="background">
	<div class="container">
		<header>
			<img src="{{$data['url']}}/assets/img/lapakami-logo-text.png" class="Lapakami" height="60px" alt="Logo Lapakami">
		</header>
		<div class="title">
			<h3>Pendaftaran Akun Baru Lapakami</h3>
		</div>
		<div class="content">
			<p>Halo, {{ $data['name'] }}<b></b></p>
			<p>Selamat pendaftaran akun Lapakami anda sudah berhasil, silakan melakukan konfirmasi untuk aktivasi akun anda melalui tautan dibawah</p>
			<p style="margin-top: 30px;">
				<a href="{{$data['url']}}/user/activation/{{ $data['nik'] }}/{{ $data['token'] }}" class="button">Aktivasi Akun</a>
			</p>
			<p style="margin-top: 30px;">
				<a href="{{$data['url']}}/user/activation/{{ $data['nik'] }}/{{ $data['token'] }}">{{$data['url']}}/user/activation/{{ $data['nik'] }}/{{ $data['token'] }}</a>
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