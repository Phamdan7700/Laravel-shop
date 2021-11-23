<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body style="background: url({{ asset('img/a-book-4133883.jpg') }}) 100% /cover">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xl-7">
                            <div class="card" style="border-radius: 1rem;">
                                <div class="row g-0">
                                    <div class="col-md-6 col-lg-5 d-none d-md-flex align-items-center justify-content-center">
                                        <img src="{{ asset('img/draw2.svg') }}" alt="login form" class="img-fluid"
                                            style="border-radius: 1rem 0 0 1rem;" />
                                    </div>
                                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                        <div class="card-body p-3 p-lg-3 text-black">

                                            <form method="POST" action="{{ route('admin.login') }}">
                                                @csrf
                                                <div class="d-flex justify-content-center mb-3 pb-1">
                                                   <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid w-50">
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="inputEmail">Email
                                                        address</label>
                                                    <input class="form-control" id="inputEmail" type="email"
                                                        name="email" value="{{ old('email') }}"
                                                        placeholder="name@example.com" required />
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="inputPassword">Password</label>
                                                    <input class="form-control" id="inputPassword" type="password"
                                                        name="password" placeholder="Password" required />
                                                    @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" id="inputRememberPassword"
                                                        type="checkbox" name="remember" value="" />
                                                    <label class="form-check-label" for="inputRememberPassword">Remember
                                                        Password</label>
                                                </div>

                                                <div class="pt-1 mb-4">
                                                    <button class="btn btn-dark btn-lg form-control"
                                                        type="submit">Login</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>
