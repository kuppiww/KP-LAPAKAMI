<style>
	@page {
        header: page-header;
        footer: page-footer;
    }

    body {
        font-family: "Arial";
        font-weight: regular;
		font-size : 15;
    }

	div {
		line-height: {{ config('pdf.line_height') }};
	}

    div.paragraph {
        text-align: justify;
		text-indent: 40px;
		margin-left: 40px;
		margin-right: 40px;
        margin-bottom: 5px;
    }

	hr.one {
        margin-top: 3px;
		padding: 0;
		border-top: 2px solid #000;
		color: #000;
		height: 3px;
		width: 666px;
	}

	hr.two {
		margin-top: 5px;
		border: 1px solid #000;
		color: #000;
	}

    div.main {
       margin: 0 auto;
    }

    div.row {
        padding-left: 5px;
    }

    .sec1_col1 {
        float:left;padding-left: 75px; width: 150px; text-align: left;
    }

    .sec1_col2 {
        float:left;text-indent: 232px; width: 20px; text-align: left;
    }
	
    .sec1_col3 {
		float:left; width: 423px; text-align: justify;
    }

	.sec1_col10 {
		float: left; width: 34px; text-align: left;
	}

	.sec1_col6 {
        float: left; height: 8%; width: 297px; text-align: left;
    }

	.sec2_col6 {
        float: right; height: 8%; width: 296px; text-align: left;
    }
</style>

{{-- @foreach ($data as $d) --}}
	<div style="text-align: center">
		<strong>
			{!! $ReportHelper::setHeader($data->tgl_surat ?? date('Y-m-d'), $pengajuan->sub_district, $pengajuan->district, $pengajuan->kd_kel, $service->service_is_kec) !!}
		</strong>

		{{-- <hr class="two" /> --}}
		<hr class="one" />
	</div>

	<div style="text-align: center;line-height: 1.2;margin-top:15px;">
		<u><strong>{{ $title }}</strong></u><br />
	</div>

    {{-- @if ($pengajuan->request_status_id == 'APPROVED')
        <p style="margin-top: 0px;text-align:center;">
            Nomor : {{ $data->no_surat ?? '{nomor_surat}' }}
        </p>
    @else
    @endif --}}
    <p style="margin-top: 0px;text-align:center;{{ ($pengajuan->request_status_id == 'APPROVED') ? '' : 'color:red;' }}">
        Nomor : {{ $data->no_surat ?? '${nomor_surat}' }}
    </p>

    {{-- <div class="row" style="padding-left: 223px;margin-top:0px;">
        <div style="float:left;width: 55px; text-align: left;">Nomor :</div>
        <div style="float:left;width: 218px; text-align: left;">{{ $data->no_surat ?? '{nomor_surat}' }}</div>
    </div> --}}

	<br />
	@php
		if ($service->service_is_kec) {
			$redaksi_ttd = 'Camat '.$pengajuan->district;
		} else {
			$redaksi_ttd = 'Lurah '.$pengajuan->sub_district.' Kecamatan '.$pengajuan->district;
		}
	@endphp
	<div class="paragraph">
		Yang bertanda tangan di bawah ini, {{$redaksi_ttd}} Kota Cimahi, dengan ini menerangkan bahwa :
	</div>

	<div class="row">
        <div class="sec1_col1">Nama</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->nama_warga }}</div>
    </div>
    <div class="row">
        <div class="sec1_col1">Tempat Tanggal Lahir</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->tmp_lahir }}, {{ $DateTime::getSimpleDate($pengajuan->tgl_lahir) }}</div>
    </div>
    <div class="row">
        <div class="sec1_col1">Jenis Kelamin</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->gender }}</div>
    </div>
    <div class="row">
        <div class="sec1_col1">Pekerjaan</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->pekerjaan }}</div>
    </div>
    <div class="row">
        <div class="sec1_col1">Agama</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->religion }}</div>
    </div>
    <div class="row">
        <div class="sec1_col1">Alamat</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->user_alamat }}</div>
    </div>
	<div class="row">
        <div class="sec1_col1">NIK</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->nik }}</div>
    </div>
	<div class="row">
        <div class="sec1_col1">No. KK</div>
        <div class="sec1_col2">:</div>
        <div class="sec1_col3">{{ $pengajuan->no_kk }}</div>
    </div>

	<div class="paragraph">
		Berdasarkan Surat Keterangan dari Ketua RT.{{ substr('00' . $pengajuan->rt, -2) }} RW.{{ substr('00' . $pengajuan->rw, -2) }} Nomor : {{ $pengajuan->no_surat_pengantar }} tanggal {{ $DateTime::getSimpleDate($pengajuan->tgl_surat_pengantar) }} keadaan ekonominya termasuk masyarakat tidak mampu.
		

		@if (trim($data->no_jamkesmas) != '' && ! is_null($data->no_jamkesmas) && $data->no_jamkesmas != 0)
			dan mendapat jaminan kesehatan dengan No. Jamkesmas {{ $data->no_jamkesmas == '01/01/1970' ? '...' : $data->no_jamkesmas }}.
		@endif
	</div>

	<div class="paragraph">
		Surat keterangan ini berlaku sampai dengan tanggal {{ ($data->masa_berlaku == null) ? '${masa_berlaku}' : $DateTime::getSimpleDate($data->masa_berlaku) }} dan diberikan untuk pengajuan mendapatkan keringanan biaya pelayanan kesehatan

		@if ($data->id_rumkit != 12)
			@if ($data->id_hub_kel == null)
				ke {{ $data->name }}.
			@else
				ke {{ $data->name }}, atas nama :
				{{-- <div style="padding-left: 40px;border:1;"> --}}
					
				{{-- </div> --}}
			@endif
		@endif
	</div>
	@if ($data->id_rumkit != 12)
		@if ($data->id_hub_kel != null)
			<div class="row">
				<div class="sec1_col1">Nama Pasien</div>
				<div class="sec1_col2">:</div>
				<div class="sec1_col3">{{ $data->nama_pasien }}</div>
			</div>
			<div class="row">
				<div class="sec1_col1" >Tempat Tanggal Lahir</div>
				<div class="sec1_col2">:</div>
				<div class="sec1_col3">{{ $data->tmp_lahir_pasien }}, {{ $DateTime::getSimpleDate($data->tgl_lahir_pasien) }}</div>
			</div>
			<div class="row">
				<div class="sec1_col1" >Hubungan Keluarga</div>
				<div class="sec1_col2">:</div>
				<div class="sec1_col3">{{ $data->nama_hub }}</div>
			</div>
		@endif
	@endif

	<div class="paragraph">
		Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
	</div>

	<br />
	@php
		// $ttd = str_replace(chr(13), ',', $data->l_ttd);
		// $stringan = (substr($d->l_kec_ttd,20,20)) == '' ? '' : ','.substr($d->l_kec_ttd,20,20);
        // $ttdkec = substr($d->l_kec_ttd,0,20).''.$stringan;

		// $exp = explode(",", $ttd);
		// $expkec = explode(",", $ttdkec);
		// if (count($exp) <= 1) {
		// 	$ttd_l = $exp[0];
		// } else {
		// 	$ttd_l = $exp[1];
		// }

		// if (count($expkec) <= 1) {
        //     $ttd_l_kec = $expkec[0];
        // } else {
        //     $ttd_l_kec = $expkec[1];
        // }

        $ttd = str_replace(chr(13), ',', $l_ttd);
		$exp = explode(",", $ttd);
		if (count($exp) <= 1) {
			$ttd_l = $exp[0];
		} else {
			$ttd_l = $exp[1];
		}
		// $nama_singkat_ttd = $d->nama_singkat_ttd === null ? $d->nama_ttd : $d->nama_singkat_ttd
		$nama_singkat_ttd = $ttdRequest->ttd_name ?? 'null';//$d->nama_singkat_ttd === null ? $d->nama_ttd : $d->nama_singkat_ttd
	@endphp
	{{-- <div class="row" style="margin-right: 40px;margin-left: 40px;">
		@if ($service->service_is_kec)
            {!! $ReportHelper::ttehead($pengajuan->sub_district, $data->tgl_surat ?? date('Y-m-d'), $data->f_ttd, $data->l_ttd ?? '{ttd_l}', true, 'l_kec_ttd', 'f_kec_ttd') !!}
        @else
            {!! $ReportHelper::ttehead($pengajuan->sub_district, $data->tgl_surat ?? date('Y-m-d'), $data->f_ttd, $data->l_ttd) !!}
        @endif
	</div> --}}
    <div class="row" style="margin-right: 40px;margin-left: 40px;">
		@if ($service->service_is_kec)
            {!! $ReportHelper::tte_v2(
                $pengajuan->sub_district, $data->tgl_surat ?? date('Y-m-d'),
                $f_ttd,
                $l_ttd,
                $service->service_code ?: '', 
                $pengajuan->request_status_id,
                $nama_singkat_ttd
            ) !!}
        @else
            {!! $ReportHelper::tte_v2(
                $pengajuan->sub_district, $data->tgl_surat ?? date('Y-m-d'),
                $f_ttd,
                $l_ttd,
                $service->service_code ?: '', 
                $pengajuan->request_status_id,
                $nama_singkat_ttd
            ) !!}
        @endif
    </div>

    <htmlpagefooter name="page-footer">
        @if ($pengajuan->request_status_id == 'APPROVED')
            {!! $ReportHelper::setFooter('{id_surat}', $service->service_code ?: '') !!}
        @endif
    </htmlpagefooter>
{{-- @endforeach --}}
