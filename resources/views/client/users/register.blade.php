<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.head')
</head>

<body>
    <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                <form action="{{ route('client.register.store') }}" method="post" id="register-form">

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="name" id="r-name" class="form-control form-control-lg" />
                                        <label class="form-label" for="name">Your Name</label>
                                    </div>
                                    @if ($errors->has('name'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('name') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" name="email" id="r-email" class="form-control form-control-lg" />
                                        <label class="form-label" for="email">Your Email</label>
                                    </div>
                                    @if ($errors->has('email'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('email') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="r-password" class="form-control form-control-lg" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    @if ($errors->has('password'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('password') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <div data-mdb-input-init class="form-outline mb-4" hidden>
                                        <input type="number" name="role_id" value="1" id="r-role_id" class="form-control form-control-lg" />
                                        <label class="form-label" for="role">Roles</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4" hidden>
                                        <input type="number" name="status" value="0" id="r-status" class="form-control form-control-lg" />
                                        <label class="form-label" for="status">Status</label>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="remember" id="agreeTerms" value="agree">
                                            <label for="agreeTerms">
                                                I agree to the <a href="#">terms</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!" class="fw-bold text-body"><u>Login here</u></a></p>
                                    @csrf
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('client.foot')

</body>

</html>
