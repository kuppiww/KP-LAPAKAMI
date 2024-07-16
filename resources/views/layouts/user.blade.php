<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (View::hasSection('title'))
            @yield('title') -
        @endif

        Lapakami Pemerintah Daerah Kota Cimahi
    </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/lapakami-favicon.png') }}">

    <!-- Bootstap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Splide js -->
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css">

    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

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
            <button class="btn btn-icon btn-primary rounded-circle py-1 d-inline d-md-none" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <i class="ri-menu-line"></i>
            </button>
            <!-- End Off Canvas Button -->

            <!-- User Nav -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="btn btn-icon bg-light rounded-circle me-3 text-primary"><i
                                    class="ri-user-line fs-5"></i></div><span
                                class="me-1">{{ Auth::user()->user_nama }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ url('user/profil/') }}">
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
                    <a class="nav-link @if (Request::segment(2) == 'beranda') active @endif"
                        href="{{ url('user/beranda') }}">
                        <i class="ri-home-3-line me-2 fs-5"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2) == 'layanan') active @endif"
                        href="{{ url('user/layanan') }}">
                        <i class="ri-stack-line me-2 fs-5"></i> Layanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2) == 'pemberitahuan') active @endif"
                        href="{{ url('user/pemberitahuan') }}">
                        <i class="ri-notification-2-line me-2 fs-5"></i> Pemberitahuan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2) == 'bantuan') active @endif"
                        href="{{ url('user/bantuan') }}">
                        <i class="ri-question-line me-2 fs-5"></i> Bantuan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2) == 'pengaturan') active @endif"
                        href="{{ url('user/pengaturan') }}">
                        <i class="ri-settings-5-line me-2 fs-5"></i> Pengaturan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2) == 'setting') active @endif"
                        href="{{ url('user/setting') }}">
                        <i class="ri-user-5-line me-2 fs-5"></i> Akun Masyarakat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(1) == 'verification') active @endif"
                        href="{{ url('verification') }}">
                        <i class="ri-file-line me-2 fs-5"></i> Verifikasi
                    </a>
                </li>
            </ul>
            <p class="text-dark mt-5 mb-3 ms-3 fw-semibold">Menu Lainnya</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2) == 'profil') active @endif"
                        href="{{ url('user/profil') }}">
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
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    <!-- SideMenu -->
                    <p class="text-dark mb-3 ms-3 fw-semibold">Menu Utama</p>
                    <ul class="nav flex-column nav-user">
                        <li class="nav-item">
                            <a class="nav-link @if (Request::segment(2) == 'beranda') active @endif"
                                href="{{ url('user/beranda') }}">
                                <i class="ri-home-3-line me-2 fs-5"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::segment(2) == 'layanan') active @endif"
                                href="{{ url('user/layanan') }}">
                                <i class="ri-stack-line me-2 fs-5"></i> Layanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::segment(2) == 'pemberitahuan') active @endif"
                                href="{{ url('user/pemberitahuan') }}">
                                <i class="ri-notification-2-line me-2 fs-5 position-relative">
                                    @if ($notif_unread)
                                        <span
                                            class="position-absolute top-0 start-50 p-1 bg-danger border border-light rounded-circle">
                                            <span class="visually-hidden">New notif</span>
                                        </span>
                                    @endif

                                </i>
                                Pemberitahuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::segment(2) == 'bantuan') active @endif"
                                href="{{ url('user/bantuan') }}">
                                <i class="ri-question-line me-2 fs-5"></i> Bantuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::segment(2) == 'pengaturan') active @endif"
                                href="{{ url('user/pengaturan') }}">
                                <i class="ri-settings-5-line me-2 fs-5"></i> Pengaturan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::segment(2) == 'setting') active @endif"
                                href="{{ url('user/setting') }}">
                                <i class="ri-user-5-line me-2 fs-5"></i> Akun Masyarakat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::segment(1) == 'verification') active @endif"
                                href="{{ url('verification') }}">
                                <i class="ri-file-line me-2 fs-5"></i> Verifikasi
                            </a>
                        </li>
                    </ul>
                    <!-- End SideMenu -->

                    <!-- Footer -->
                    <div class="mt-5">
                        <p class="mb-0"><small>Hak Cipta 2023 Lapakami.</small></p>
                        <p class="mb-0"><small>Pemerintah Daerah Kota Cimahi</small></p>
                    </div>
                    <!-- End Footer -->
                </div>
                <div class="col-md-9">
                    <!-- Content -->
                    <div class="ms-md-5">@yield('content')</div>
                    <!-- End Content -->

                    <!-- Footer Mobile -->
                    <div class="mt-5 d-block d-md-none text-center">
                        <p class="mb-0"><small>Hak Cipta 2023 Lapakami.</small></p>
                        <p class="mb-0"><small>Pemerintah Daerah Kota Cimahi</small></p>
                    </div>
                    <!-- End Footer Mobile -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Main -->

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

    <!-- Datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js">
    </script>

    <!-- Jquery Validation -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/additional-methods.min.js') }}">
    </script>

    <!-- Datepicker -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>

    <!-- Sweatalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language: {
                    "url": "{{ url('assets/json/datatable-id.json') }}",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>',
                        previous: '<i class="ri-arrow-left-s-line"></i>'
                    }
                }
            });

            jQuery.validator.addMethod("alphanumeric", function(value, element) {
                return this.optional(element) || /^[\w.\%\-\_\&\(\)\s\,\?\!]+$/i.test(value);
            }, "Letters, numbers, and underscores only please");

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
                format: "hh:mm A"
            });

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                tooltipTriggerEl));

            $('.btnLogout').click(function() {
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
                        window.location = "{{ url('logout') }}";
                    }
                })
            });

        });
    </script>
    <!-- Script -->
    @yield('script')
    <!-- End Script -->

</body>

</html>
