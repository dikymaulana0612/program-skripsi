<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Registrasi | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ env('APP_NAME') }}" name="description" />
    <meta content="{{ env('APP_AUTHOR') }}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('hybrix') }}/assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{ asset('hybrix') }}/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('hybrix') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('hybrix') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('hybrix') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('hybrix') }}/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <section
        class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="col-lg-5">
                                    <div
                                        class="card auth-card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden mb-0">
                                        <div class="card-body p-4 d-flex justify-content-between flex-column">
                                            <div class="auth-image mb-3">
                                                <img src="{{ asset('img/logo.png') }}" alt=""
                                                    style="width: 100%;max-width: 300px;" />
                                                <img src="{{ asset('hybrix') }}/assets/images/effect-pattern/auth-effect-2.png"
                                                    alt="" class="auth-effect-2" />
                                                <img src="{{ asset('hybrix') }}/assets/images/effect-pattern/auth-effect.png"
                                                    alt="" class="auth-effect" />
                                                <img src="{{ asset('hybrix') }}/assets/images/effect-pattern/auth-effect.png"
                                                    alt="" class="auth-effect-3" />
                                            </div>

                                            <div>
                                                <h3 class="text-white">{{ env('APP_NAME') }}.</h3>
                                                <p class="text-white-75 fs-15">Silakan registrasi di halaman ini untuk
                                                    membuat akun</p>
                                            </div>
                                            <div class="text-center text-white-75">
                                                <p class="mb-0">&copy;
                                                    2023 {{ env('APP_NAME') }}. Dibuat oleh {{ env('APP_AUTHOR') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-7">
                                    <div class="card mb-0 border-0 shadow-none">
                                        <div class="card-body px-0 p-sm-5 m-lg-4">
                                            <div class="text-center mt-2">
                                                <h5 class="text-primary fs-20">Registrasi</h5>
                                                <p class="text-muted">Silahkan registrasi pada form dibawah ini.</p>
                                            </div>
                                            @include('components.flash_messages')
                                            <div class="p-2 mt-5">
                                                <form action="{{ route('register') }}" method="POST">
                                                    @csrf

                                                    <div class="mb-3">
                                                        <label class="form-label">Registrasi Sebagai</label>
                                                        <select name="role" id="role" class="form-control">
                                                            <option value="pengelola">Pengelola Aset</option>
                                                            <option value="pengunjung">Pengunjung</option>
                                                        </select>
                                                    </div>
                                                    <hr>

                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Akun</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ old('name') }}"
                                                            placeholder="Masukkan nama akun">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <input type="text" class="form-control" id="alamat"
                                                            alamat="alamat" value="{{ old('alamat') }}"
                                                            placeholder="Masukkan alamat">
                                                    </div>
                                                    <div class="mb-3 div_pengelola">
                                                        <label class="form-label">Penanggung Jawab</label>
                                                        <input type="text" class="form-control" id="penanggung_jawab"
                                                            name="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
                                                            placeholder="Masukkan penanggung jawab">
                                                    </div>

                                                    {{-- Element untuk pengunjung --}}
                                                    <div class="mb-3 div_pengunjung" style="display: none">
                                                        <label class="form-label">Nama Instansi</label>
                                                        <input type="text" class="form-control" id="instansi"
                                                            name="instansi" value="{{ old('instansi') }}"
                                                            placeholder="Masukkan instansi">
                                                    </div>
                                                    <div class="mb-3 div_pengunjung" style="display: none">
                                                        <label class="form-label">Asal</label>
                                                        <input type="text" class="form-control" id="asal"
                                                            name="asal" value="{{ old('asal') }}"
                                                            placeholder="Masukkan asal">
                                                    </div>
                                                    <div class="mb-3 div_pengunjung" style="display: none">
                                                        <label class="form-label">Status Pengunjung</label>
                                                        <select name="status_pengunjung" id="status_pengunjung" class="form-control">
                                                            <option value="Mahasiswa">Mahasiswa</option>
                                                            <option value="Dosen">Dosen</option>
                                                            <option value="Umum">Umum</option>
                                                            <option value="Peneliti">Peneliti</option>
                                                            <option value="Lembaga/Instansi">Lembaga/Instansi</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email"
                                                            name="email" value="{{ old('email') }}"
                                                            placeholder="Masukkan email">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label" for="password-input">Password</label>
                                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                                            <input type="password"
                                                                class="form-control pe-5 password-input"
                                                                placeholder="Masukkan password" name="password"
                                                                id="password-input">
                                                            <button
                                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"type="button"
                                                                id="password-addon"><i
                                                                    class="ri-eye-fill align-middle"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-100"
                                                            type="submit">Registrasi</button>
                                                        <br><br>
                                                        Sudah punya akun? <a href="{{ route('login') }}"
                                                            class="">Login </a>

                                                        <br><br><br>
                                                        <hr>
                                                        <a href="{{ route('landing') }}">Ke Halaman Depan</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('hybrix/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('hybrix') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('hybrix') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('hybrix') }}/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ asset('hybrix') }}/assets/js/plugins.js"></script>

    <script src="{{ asset('hybrix') }}/assets/js/pages/password-addon.init.js"></script>

    <script>
        $(document).ready(function() {
            $('#role').change(function() {
                var role = $('#role').val();
                if (role == 'pengunjung') {
                    $('.div_pengunjung').fadeIn();
                    $('.div_pengelola').fadeOut();
                } else {
                    $('.div_pengunjung').fadeOut();
                    $('.div_pengelola').fadeIn();
                }
            })
        })
    </script>
</body>

</html>
