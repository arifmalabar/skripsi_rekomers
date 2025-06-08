@extends('login/layoutLogin')

@section('content')
<div class="row justify-content-center align-items-center vh-100" style="background-image: url('{{ asset('assets/dist/img/bglogin.jpg') }}'); 
    background-size: cover; 
    background-position: center;">
    >
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('assets/dist/img/login.png') }}" class="img-fluid h-100" alt="Side Image">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://smkn8malang.sch.id/img/logo.png" alt="Logo" class="brand-image"
                                style="width: 30px; height: 30px; margin-bottom: 10px;">
                            <h1 class="h6" style="color: rgb(6, 165, 157);">Welcome Back,</h1>
                            <h1 class="h4"
                                style="color: rgb(6, 165, 157); font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
                                <b>REKOMERS</b>
                            </h1>
                            <div class="alert alert-success alert-dismissible">
                                Untuk ujicoba sistem kebutuhan semhas gunakan <b>Username : login</b> dan <b>Password :
                                    login</b>
                            </div>
                        </div>
                        <form action="{{ route('login-proses') }}" method="post">
                            @csrf

                            @error('email')
                            <small>{{ $message }}</small>
                            @enderror
                            <div class="mb-3">
                                <label for="" style="color:grey">Username:</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                            </div>

                            @error('password')
                            <small>{{ $message }}</small>
                            @enderror
                            <div class="mb-3 position-relative">
                                <label for="" style="color:grey">Password:</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Masukan password">

                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-danger w-100"><i class="fa fa-sign-in"></i><i
                                        class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($message = Session::get('success'))
<script>
    Swal.fire({
                position: "justify-content-center",
                icon: "success",
                title: '{{ $message }}',
                showConfirmButton: false,
                timer: 1500
            });
</script>
@endif

@if ($message = Session::get('failed'))
<script>
    Swal.fire({
                icon: "error",
                title: "Oops...",
                text: '{{ $message }}',
            });
</script>
@endif

{{-- JavaScript untuk Show/Unshow Password --}}
<script>
    function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            togglePasswordIcon.classList.toggle('fa-eye-slash', !isPassword);
            togglePasswordIcon.classList.toggle('fa-eye', isPassword);
        }
</script>
@endsection