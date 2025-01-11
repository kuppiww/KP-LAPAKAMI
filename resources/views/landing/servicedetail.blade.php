@extends('layouts.app')
@section('title') {{ $service->service_name }} @endsection

@section('content')
<!-- Service Detail -->
<div class="pt-6">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="d-inline-block bg-light p-5 rounded-circle">
					<!-- <img src="{{ url('storage/images/service/'. $service->service_icon) }}" width="128px" alt="{{ $service->service_name }}" /> -->
					<img src="{{ asset('assets/img/services/' . $service->service_icon) }}" height="42px" alt="{{ $service->service_name }}" />
				</div>
			</div>
			<div class="col-md-8 ms-auto">

				<h2 class="fw-bold text-dark mb-1">{{ $service->service_name }}</h2>

				<!-- Status -->
				@if($service->is_online)
				<span class="badge bg-success">Online</span>
				@else
				<span class="badge bg-danger">Offline</span>
				@endif
				<!-- End Status -->

				<p class="mt-3">{{ $service->service_description }}</p>

				<p>Berikut persyaratan yang diperlukan untuk melakukan proses layanan.</p>

				@if(sizeof($requirements) > 0)

				@foreach($requirements as $requirement)
				<p class="mb-1">
					<i class="ri-checkbox-circle-line text-primary me-2"></i>
					{{ $requirement->service_requirement_name }}
					@if($requirement->is_required)
					<span class="text-danger">*</span>
					@endif

					@if(!empty($requirement->example_file))
					<a href="{{ url('storage/files/service/'. $requirement->example_file) }}" class="ms-2 px-3 py-1 rounded bg-light" download><i class="ri-file-download-line me-2"></i> <small>Unduh {{ $requirement->service_requirement_name }}</small> </a>
					@endif
				</p>
				@endforeach

				@endif

				@if(!empty($service->service_link))
				<a href="{{ $service->service_link }}" class="btn btn-primary rounded-pill px-3 mt-4">Buat Permohonan Layanan</a>
				@else
				@if($service->is_online)
				<a href="{{ url('user/layanan/'. $service->slug  .'/buat') }}" class="btn @if($service->is_active) btn-primary @else btn-light disabled @endif rounded-pill px-3 mt-4">Buat Permohonan Layanan</a>
				@endif
				@endif

			</div>
		</div>

	</div>
</div>
<!-- End Service Detail -->

<!-- Service -->
<div class="pt-6">
	<div class="container">
		<div class="">
			<div class="splide">

				<div class="row mb-5">
					<div class="col-md-6">
						<h2 class="fw-bold text-dark">Layanan Lainnya</h2>
						<p class="text-muted mb-0">Layanan yang dapat diakses oleh masyarakat</p>
					</div>
					<div class="col-md-6">
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
						<div class="col-md-3 splide__slide text-center">
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
										<h5 class="mx-4 mt-4 mb-0">PERCOBAAN</h5>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- End Service -->
@endsection