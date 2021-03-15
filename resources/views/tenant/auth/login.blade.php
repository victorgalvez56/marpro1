@extends('tenant.layouts.auth')

@section('content')
<section class="sign-in-page">
            <div class="container bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <h1 class="mb-0">Sign in</h1>
                            <p>Enter your email address and password to access admin panel.</p>
                            <form method="POST" action="{{ route('login') }}" class="mt-4">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <label class="error">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <a href="#" class="float-right">Forgot password?</a>
                                    <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <label class="error">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </label>
                                    @endif
                                </div>
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1"  {{ old('remember') ? 'checked' : '' }}>Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Sign in</button>
                                </div>
                                <div class="sign-info {{ $errors->has('password') ? ' error' : '' }}">
                                    <span class="dark-color d-inline-block line-height-2">Don't have an account? <a href="#">Sign up</a></span>
                                    <ul class="iq-social-media">
                                        <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="#"><img src="images/logo-white.png" class="img-fluid" alt="logo"></a>
                            <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- <section class="body-sign">
        <div class="center-sign">
            <div class="card">
                <div class="card card-header card-primary" style="background:#0088CC">
                    <p class="card-title text-center">Acceso al Sistema</p>
                    <h1 class="display-3 position-absolute text-left font-weight-bold" style="left: 90%; margin-top: -35px; color: rgba(255,255,255,.1);">3</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Correo electrónico</label>
                            <div class="input-group">
                                <input id="email" type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}">
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </span>
                            </div>
                            @if ($errors->has('email'))
                                <label class="error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </label>
                            @endif
                        </div>
                        <div class="form-group mb-3 {{ $errors->has('password') ? ' error' : '' }}">
                            <label>Contraseña</label>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control form-control-lg">
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </span>
                            </div>
                            @if ($errors->has('password'))
                                <label class="error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </label>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input name="remember" id="RememberMe" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="RememberMe">Recordarme</label>
                                </div>
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="submit" class="btn btn-primary mt-2">Iniciar sesión</button>
                            </div>
                        </div>
                    </form>
                </div>
            {{-- <p class="text-center text-muted mt-3 mb-3">&copy; Copyright {{ date('Y') }}. Todos los derechos reservados</p> --}}
        </div>
    </section> -->
@endsection
