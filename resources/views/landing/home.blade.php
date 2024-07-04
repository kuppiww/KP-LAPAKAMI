@extends('layouts.app')

@section('content')
<!-- Hero -->
<div class="hero bg-light">
	<div class="container bg-hero">
		<div class="row">
			<div class="col-md-6 text-left">
				<h1 class="text-dark fw-bold">Layanan Publik Kecamatan Kelurahan Kota Cimahi</h1>
				<p class="text-muted lead">Memberikan kemudahan pelayanan masyarakat Kota Cimahi secara online.</p>
				<a href="{{ url('daftar') }}" class="btn btn-lg btn-primary rounded-pill px-4 mt-3">Daftar Sekarang</a>
			</div>
		</div>
	</div>
</div>
<!-- End Hero -->

<!-- Service -->
<div class="pt-6">
	<div class="container">
		<div class="">
            <div class="splide">

            	<div class="row mb-5">
            		<div class="col-md-6 text-center text-md-start">
            			<h2 class="fw-bold text-dark">Layanan Tersedia</h2>
						<p class="text-muted mb-0">Layanan yang dapat diakses oleh masyarakat</p>
            		</div>
            		<div class="col-md-6 d-none d-md-block">
            			<div class="splide__arrows text-end h-100">
							<button class="splide__arrow splide__arrow--prev d-inline-block me-5">
								<i class="ri-arrow-left-s-line"></i>
							</button>
							<button class="splide__arrow splide__arrow--next d-inline-block">
								<i class="ri-arrow-right-s-line"></i>
							</button>
					  </div>

            		</div>
            	</div>

                <div class="row splide__track">
                    <div class="splide__list">

                    	@if(sizeof($services) > 0)

                    		@foreach($services as $service)

                    			<div class="col-md-3 splide__slide text-center">
		                        	<a href="{{ url('layanan/'. $service->slug) }}">
										<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
											<div class="card-body">
												<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
													<img src="{{ url('storage/images/service/'. $service->service_icon) }}" height="42px" alt="{{ $service->service_name }}" />
												</div>
												<h5 class="mx-4 mt-4 mb-0">{{ $service->service_name }}</h5>
											</div>
										</div> 
									</a>
								</div>

                    		@endforeach

                    	@endif

                        <!-- <div class="col-md-3 splide__slide text-center">
                        	<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-marriage.png') }}" height="42px" alt="Belum Menikah" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Belum Menikah</h5>
									</div>
								</div> 
							</a>
						</div>
						<div class="col-md-3 splide__slide text-center">
							<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-poor.png') }}" height="42px" alt="Tidak Mampu" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Tidak Mampu</h5>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-3 splide__slide text-center">
							<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-divorced.png') }}" height="42px" alt="Janda Duda" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Janda Duda</h5>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-3 splide__slide text-center">
							<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-civil-right.png') }}" height="42px" alt="Bersih Diri" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Bersih Diri</h5>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-3 splide__slide text-center">
							<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-birth.png') }}" height="42px" alt="Kelahiran" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Kelahiran</h5>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-3 splide__slide text-center">
							<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-crowd.png') }}" height="42px" alt="Izin Keramaian" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Izin Keramaian</h5>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-3 splide__slide text-center">
							<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-house.png') }}" height="42px" alt="Belum Mimiliki Rumah" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Belum Memiliki Rumah</h5>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-3 splide__slide text-center">
							<a href="{{ url('layanan') }}">
								<div class="card border-0 rounded-4 service-card p-3 h-100 mx-3">
									<div class="card-body">
										<div class="service-icon-bg bg-white mx-auto d-flex align-items-center justify-content-center">
											<img src="{{ asset('assets/img/services/lapakami-icon-service-kaaba.png') }}" height="42px" alt="Domisili Ibadah Haji" />
										</div>
										<h5 class="mx-4 mt-4 mb-0">Surat Keterangan Domisili Ibadah Haji</h5>
									</div>
								</div>
							</a>
						</div> -->
                    </div>        
                </div>
           	</div>
        </div>

	</div>
</div>
<!-- End Service -->

<!-- Timeline Proccess -->
<div class="pt-6">
	<div class="container text-center">
		<h2 class="fw-bold text-dark">Alur Pelayanan</h2>
		<p class="text-muted mb-0">Alur proses pelayanan yang akan dilalui oleh masyarakat</p>
	</div>
	<!-- Timeline Large -->
    <section class="ps-timeline-sec d-none d-md-block">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                        <img src="{{ asset('assets/img/lapakami-icon-apply.png') }}"  alt="Pengajuan" />
                    </div>
                    <div class="ps-bot">
                    	<h5 class="text-start text-md-center text-dark fw-bold">Pengajuan</h5>
                        <p>Permohonan diajukan oleh pemohon melalui aplikasi Lapakami</p>
                    </div>
                    <span class="ps-sp-top">01</span>
                </li>
                <li>
                    <div class="img-handler-bot">
                        <img src="{{ asset('assets/img/lapakami-icon-verify.png') }}" alt="Verifikasi Berkas" />
                    </div>
                    <div class="ps-top">
                        <h5 class="text-start text-md-center text-dark fw-bold">Verifikasi Berkas</h5>
                        <p>Proses verifikasi berkas permohonan yang sudah dilampirkan</p>
                    </div>
                    <span class="ps-sp-bot">02</span>
                </li>
                <li>
                    <div class="img-handler-top">
                        <img src="{{ asset('assets/img/lapakami-icon-sign.png') }}" alt="Pembuatan Dokumen" />
                    </div>
                    <div class="ps-bot">
                        <h5 class="text-start text-md-center text-dark fw-bold">Pembuatan Dokumen</h5>
                        <p>Proses pembuatan dokumen permohonan oleh pihak terkait yang berwenang</p>
                    </div>
                    <span class="ps-sp-top">03</span>
                </li>
                <li>
                    <div class="img-handler-bot">
                        <img src="{{ asset('assets/img/lapakami-icon-send.png') }}" alt="Selesai" />
                    </div>
                    <div class="ps-top">
                        <h5 class="text-start text-md-center text-dark fw-bold">Selesai</h5>
                        <p>Dokumen permohonan akan dikirimkan melalui aplikasi Lapakami dan juga email pemohon</p>
                    </div>
                    <span class="ps-sp-bot">04</span>
                </li>
            </ol>
        </div>
    </section>
    <!-- End Timeline Large -->

    <!-- Timeline Mobile -->
    <section class="mt-4 d-block d-md-none">
    	<div class="container">
    		<div class="row align-items-center mb-3">
    			<div class="col-3 text-center">
    				<img src="{{ asset('assets/img/lapakami-icon-apply.png') }}"  alt="Pengajuan" height="50px" />
    			</div>
    			<div class="col-9">
    				<h5 class="text-start text-md-center text-dark fw-bold">1. Pengajuan</h5>
        			<p>Pemohonan diajukan oleh pemohon melalui aplikasi Lapakami</p>
    			</div>
    		</div>
    		
  			<div class="row align-items-center mb-3">
    			<div class="col-3 text-center">
	  				<img src="{{ asset('assets/img/lapakami-icon-verify.png') }}" alt="Verifikasi Berkas" height="50px" />
	  			</div>
    			<div class="col-9">
		    		<h5 class="text-start text-md-center text-dark fw-bold">2. Verifikasi Berkas</h5>
		            <p>Proses verifikasi berkas pemohonan yang sudah dilampirkan</p>
		        </div>
	        </div>

	        <div class="row align-items-center mb-3">
    			<div class="col-3 text-center">
	    			<img src="{{ asset('assets/img/lapakami-icon-sign.png') }}" alt="Pembuatan Dokumen" height="50px" />
	    		</div>
    			<div class="col-9">
		    		<h5 class="text-start text-md-center text-dark fw-bold">3. Pembuatan Dokumen</h5>
		            <p>Proses pembuatan dokumen pemohonan oleh pihak terkait yang berwenang</p>
		        </div>
	        </div>
    		
    		<div class="row align-items-center mb-3">
    			<div class="col-3 text-center">
	    			<img src="{{ asset('assets/img/lapakami-icon-send.png') }}" alt="Selesai" height="50px"/>
	    		</div>
    			<div class="col-9">
		    		<h5 class="text-start text-md-center text-dark fw-bold">4. Selesai</h5>
		            <p>Dokumen pemohonan akan dikirimkan melalui aplikasi Lapakami dan juga email pemohon</p>
		        </div>
	        </div>
    	</div>	
    </section>
    <!-- End Timeline Mobile -->
</div>
<!-- End Timeline Process -->


<!-- Area -->
<!-- <div class="py-6">
	<div class="container">
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<h2 class="fw-bold text-dark">Data Kewilayahan</h2>
				<p class="text-muted mb-4">Peraturan dan kodisi Kota Cimahi</p>
				
				<p>Kondisi wilayah Kota Cimahi diatur dalam Permendagri Republik Indonesia Nomor 14 Tahun 2017 tentang Batas Daerah Kota Bandung dengan Kota Cimahi, Kota Cimahi dengan Kabupaten Bandung Barat dan Kabupaten Bandung dengan Kota Cimahi Provinsi Jawa Barat.</p>

				<p>Peraturan lainnya yang mengatur wilayah Kota Cimahi yaitu Perwal Kota Cimahi Nomor 13 Tahun 2019 tentang Batas Wilayah Kelurahan Kota Cimahi, sehingga Kota Cimahi terbagi kedalam wilayah sebagai berikut.</p>

				<div class="row mt-4">
					<div class="col-md-6">
						<div class="card border-0 bg-primary text-white mx-4">
							<div class="card-body text-center">
								<span class="display-3">3</span>
								<h5>Kecamatan</h5>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card border-0 bg-primary text-white mx-4">
							<div class="card-body text-center">
								<span class="display-3">15</span>
								<h5>Kelurahan</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->
<!-- End Area -->
@endsection