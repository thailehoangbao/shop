<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.head')
</head>

<body>
    <section class="vh-100">
        <div class="container">
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endif
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">

                    <div class="px-5 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">Wellcome to forgot password</span>
                    </div>
                    @if(session('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                    @endif

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" action="" method="post" >

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Your email forgot?</h3>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" name="email" id="f-g-email" class="form-control form-control-lg" />
                                <label class="form-label" for="email" style="font-size: small;">Enter your email address</label>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit" >Send verify to your email!</button>
                            </div>
                            @csrf
                        </form>

                    </div>

                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
    @include('client.foot')

</body>

</html>
