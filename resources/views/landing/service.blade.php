@extends('layouts.app')
@section('title') Layanan @endsection

@section('content')
<!-- Title -->
<div class="pt-6">
	<div class="container">
		<div class="text-center">
			<h2 class="fw-bold text-dark">Layanan</h2>
			<p class="text-muted mb-0">Layanan yang tersedia pada aplikasi Lapakami</p>
		</div>
	</div>
</div>
<!-- End Title -->

<!-- Contact -->
<div class="py-6">
	<div class="container">
		<div class="row justify-content-center g-md-5 g-3">
			@if(sizeof($services) > 0)

                @foreach($services as $service)

                    <div class="col-md-3 text-center">
		                <a href="{{ url('layanan/'. $service->slug) }}">
							<div class="card border-0 rounded-4 service-card p-3 h-100">
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
		</div>
	</div>
</div>
<!-- End Contact -->
@endsection