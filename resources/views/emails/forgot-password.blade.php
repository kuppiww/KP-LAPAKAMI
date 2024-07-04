<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lapakami Lupa Kata Sandi</title>

	<style type="text/css">
		body{
			background: rgba(66, 133, 243, 0.08) !important;
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
			<img src="{{$data['url']}}/assets/img/lapakami-logo-text.png" class="Lapakami" height="60px">
		</header>
		<div class="title">
			<h3>Lupa Kata Sandi Akun Lapakami</h3>
		</div>
		<div class="content">
			<p>Halo, <b>{{$data['name']}}</b></p>
			<p>Anda telah membuat permohonan untuk pengaturan ulang kata sandi pada akun Lapakami Anda, silahkan menuju tautan dibawah untuk proses perubahan kata sandi anda.</p>
			<p style="margin-top: 30px;">
				<a href="{{$data['url']}}/reset-sandi/{{$data['id']}}/{{$data['token']}}" class="button">Reset Kata Sandi</a>
			</p>
			<p style="margin-top: 30px;">
				<a href="{{$data['url']}}/reset-sandi/{{$data['id']}}/{{$data['token']}}">{{$data['url']}}/user/reset-sandi/{{$data['id']}}/{{$data['token']}}</a>
			</p>
		</div>
		<footer>
			<p>
				<small>Copyright 2023 Lapakami. All right reserved.</small> <br>
				<small>Pemerintah Daerah Kota Cimahi</small>
			</p>
		</footer>
	</div>
</div>

</body>
</html>