<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		@if(View::hasSection('title'))
			@yield('title') - 
		@endif

		Lapakami Pemerintah Daerah Kota Cimahi
	</title>

	<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/lapakami-favicon.png') }}">

	<!-- Bootstap 5.3 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

	<!-- Remix Icon -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

	<!-- Datepicker -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Sweatalert2 -->
	<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">  

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-light">

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
	  	<div class="container">
	  		<!-- Brand -->
	  		<a class="navbar-brand" href="{{ url('') }}">
	  			<img src="{{ asset('assets/img/lapakami-logo-text.png') }}" height="50px" alt="Lapakami Logo" />
	  		</a>
	  		<!-- End Brand -->

		  	<!-- Off Canvas Button -->
	  		<button class="btn btn-icon btn-primary rounded-circle py-1 d-inline d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
			  	<i class="ri-menu-line"></i>
			</button>
	  		<!-- End Off Canvas Button -->

	  		<!-- User Nav -->
		  	<div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav ms-auto">
			      	<li class="nav-item dropdown">
			          	<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			            	<div class="btn btn-icon bg-light rounded-circle me-3 text-primary"><i class="ri-user-line fs-5"></i></div><span class="me-1">{{ Auth::user()->user_nama ?? Auth::guard('admin')->user()->user_name }}</span>
			          	</a>
			          	<ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
				            <li>
				            	<a class="dropdown-item" href="{{ url('user/profil') }}">
				            		<i class="ri-user-line me-2 fs-6 text-primary"></i> Profil
				            	</a>
				            </li>
				            <li>
				            	<a class="dropdown-item" href="{{ url('user/pengaturan') }}">
				            		<i class="ri-settings-5-line me-2 fs-6 text-primary"></i> Pengaturan
				            	</a>
				            </li>
				            <li>
				            	<a class="dropdown-item btnLogout" href="javascript:void(0)">
				            		<i class="ri-logout-box-r-line me-2 fs-6 text-primary"></i> Keluar
				            	</a>
				            </li>
				        </ul>
			        </li>
			    </ul>
			</div>
			<!-- End User Nav -->
	  	</div>
	</nav>
	<!-- End Navbar -->

	<!-- Off Canvas Nav -->
	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
	  	<div class="offcanvas-header">
	    	<a class="navbar-brand" href="{{ url('') }}">
	  			<img src="{{ asset('assets/img/lapakami-logo-text.png') }}" height="50px" alt="Lapakami Logo" />
	  		</a>
	    	<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	  	</div>
	  	<div class="offcanvas-body">
	  		<p class="text-dark mb-3 ms-3 fw-semibold">Menu Utama</p>
	    	<ul class="nav flex-column">
			  	<li class="nav-item">
					<a class="nav-link @if(Request::segment(2) == 'beranda') active @endif" href="{{ url('user/beranda') }}">
					    <i class="ri-home-3-line me-2 fs-5"></i> Beranda
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if(Request::segment(2) == 'layanan') active @endif" href="{{ url('user/layanan') }}">
					   	<i class="ri-stack-line me-2 fs-5"></i> Layanan
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if(Request::segment(2) == 'pemberitahuan') active @endif" href="{{ url('user/pemberitahuan') }}">
					   	<i class="ri-notification-2-line me-2 fs-5"></i> Pemberitahuan
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if(Request::segment(2) == 'bantuan') active @endif" href="{{ url('user/bantuan') }}">
					   	<i class="ri-question-line me-2 fs-5"></i> Bantuan
					</a>
				</li>
				<li class="nav-item" >
					<a class="nav-link @if(Request::segment(2) == 'pengaturan') active @endif" href="{{ url('user/pengaturan') }}">
					   	<i class="ri-settings-5-line me-2 fs-5"></i> Pengaturan
					</a>
				</li>
			</ul>
			<p class="text-dark mt-5 mb-3 ms-3 fw-semibold">Menu Lainnya</p>
	    	<ul class="nav flex-column">
			  	<li class="nav-item">
					<a class="nav-link @if(Request::segment(2) == 'profil') active @endif" href="{{ url('user/profil') }}">
					    <i class="ri-user-line  me-2 fs-5"></i> Profil
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btnLogout" href="javascript:void(0)">
					   	<i class="ri-logout-box-r-line me-2 fs-5"></i> Keluar
					</a>
				</li>
			</ul>
	  	</div>
	</div>
	<!-- Off Canvas Nav -->

	<!-- Main -->
	<section class="py-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<!-- Content -->
					@yield('content')
					<!-- End Content -->

					<!-- Footer -->
					<div class="row py-4">
						<div class="col-md-6 text-md-start text-center">
							<p class="mb-0"><small>Hak Cipta 2023 Lapakami.</small></p>
						</div>
						<div class="col-md-6 text-md-end text-center">
							<p class="mb-0"><small>Pemerintah Daerah Kota Cimahi</small></p>
						</div>
					</div>
					<!-- End Footer -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Main -->

	<!-- Modal -->
    <div class="modal fade" id="streamModal" tabindex="-1" aria-labelledby="streamModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="" class="modal-src" width="100%" height="400px"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

	<!-- Javascript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

	<script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/additional-methods.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/jquery-steps/jquery.steps.min.js') }}"></script>

	<script src="https://kit.fontawesome.com/09fe61f995.js" crossorigin="anonymous"></script>

	<!-- Sweatalert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			// Jquery Validate
	        $.validator.addMethod('filesize', function (value, element, param) {
	            return this.optional(element) || (element.files[0].size <= param)
	        }, 'File size must be less than {0}');

	        $.validator.addMethod("alphabet", function(value, element) {
	            return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
	        }, "Alphabet only please");

	        $.validator.addMethod('width', function(value, element, width) {
	            return $(element).data('imageWidth') == width;
	        }, "Your image's width not match");

	        $.validator.addMethod('height', function(value, element, height) {
	            return $(element).data('imageHeight') == height;
	        }, "Your image's height not match");

	        // Datepicker
		    $('.datepicker').datepicker({
		    	format: 'dd/mm/yyyy',
		    	uiLibrary: 'bootstrap5',
		    	startDate: '01/01/1900',
		    	endDate: '0d'
		    });

		    $('.datepicker_birth').datepicker({
                format: 'dd/mm/yyyy',
                uiLibrary: 'bootstrap5',
                startDate: '01/01/1900',
                endDate: '0d'
            });

		    $('.timepicker').datetimepicker({
	            useCurrent: false,
	            format: "HH:mm",
	            showClose: true,
	            showTodayButton: true,
    			showClear: true,
	            icons: {
			        time: "ri-time-line",
			        date: "ri-calendar-line",
			        up: "ri-arrow-up-s-line",
			        down: "ri-arrow-down-s-line",
			        previous: "ri-arrow-left-s-line",
			        next: "ri-arrow-right-s-line",
			        today: "ri-time-line",
			        clear: "ri-delete-bin-line"
			    }
	        });

		    // Logout button
	        $('.btnLogout').click(function(){
				Swal.fire({
				  title: 'Keluar Akun?',
				  text: "Anda yakin akan keluar dari akun Anda!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#ff2323',
				  confirmButtonText: 'Ya, keluar!',
				  cancelButtonText: 'Batal',
				}).then((result) => {
				  if (result.isConfirmed) {
				  	window.location = "{{ url('logout-admin') }}";
				  }
				})
			});

			// Number button
			$('.btn-number').click(function(e){
			    e.preventDefault();
			    
			    fieldName = $(this).attr('data-field');
			    type      = $(this).attr('data-type');
			    var input = $("input[name='"+fieldName+"']");
			    var currentVal = parseInt(input.val());
			    if (!isNaN(currentVal)) {
			        if(type == 'minus') {
			            
			            if(currentVal > input.attr('min')) {
			                input.val(currentVal - 1).change();
			            } 
			            if(parseInt(input.val()) == input.attr('min')) {
			                $(this).attr('disabled', true);
			            }

			        } else if(type == 'plus') {

			            if(currentVal < input.attr('max')) {
			                input.val(currentVal + 1).change();
			            }
			            if(parseInt(input.val()) == input.attr('max')) {
			                $(this).attr('disabled', true);
			            }

			        }
			    } else {
			        input.val(0);
			    }
			});
			
			$('.input-number').focusin(function(){
			   $(this).data('oldValue', $(this).val());
			});
			
			$('.input-number').change(function() {
			    
			    minValue =  parseInt($(this).attr('min'));
			    maxValue =  parseInt($(this).attr('max'));
			    valueCurrent = parseInt($(this).val());
			    
			    name = $(this).attr('name');
			    if(valueCurrent >= minValue) {
			        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
			    } else {
			        alert('Sorry, the minimum value was reached');
			        $(this).val($(this).data('oldValue'));
			    }
			    if(valueCurrent <= maxValue) {
			        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
			    } else {
			        alert('Sorry, the maximum value was reached');
			        $(this).val($(this).data('oldValue'));
			    }
			    
			    
			});

			// Cancel request button
	        $('.btnCancelReq').click(function(){
				Swal.fire({
				  title: 'Batalkan Permohonan?',
				  text: "Anda yakin akan membatalkannya!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#ff2323',
				  confirmButtonText: 'Ya, batalkan!',
				  cancelButtonText: 'Tutup',
				}).then((result) => {
				  if (result.isConfirmed) {
				  	window.location = $(this).attr('data-url');
				  }
				})
			});

			$('.btnStreamModal').click(function(){

                // Buffer
                $('#streamModal .modal-title').text('......');
                $('#streamModal .modal-src').attr('src', '');

                var title = $(this).attr('data-title');
                var src = $(this).attr('data-src');

                // Load stream
                $('#streamModal .modal-title').text(title);
                $('#streamModal .modal-src').attr('src', src);

                $('#streamModal').modal('show');

            });
		} );
	</script>

	@yield('script')
	<!-- End  Javascript -->
</body>
</html>