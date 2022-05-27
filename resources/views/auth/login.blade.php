{{-- @extends('layouts.app') --}}

{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.site')

@section('content')
    <nav data-depth="1" class="breadcrumb-bg">
        <div class="container no-index">
            <div class="breadcrumb">

                <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{route('home')}}">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                </ol>
            </div>
        </div>
    </nav>
    <div class="container no-index">
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="main">
                    <div class="page-header">
                        <h1 class="page-title hidden-xs-up">
                            Log in to your account
                        </h1>
                    </div>
                    <section id="content" class="page-content">
                        <section class="login-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <section>
                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5 ">
                                            Mobile :
                                        </label>
                                        <div class="col-md-6">

                                            <input class="form-control" name="mobile" value="{{ old('mobile') }}"
                                                   type="text" >
                                            @error('mobile')
                                            <span  class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 form-control-comment right">
                                        </div>
                                    </div>
                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5">
                                            Password :
                                        </label>
                                        <div class="col-md-6">

                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password"
                                                       name="password" type="password" value="" pattern=".{5,}"
                                                       >
                                                <span class="input-group-btn">
            <button class="btn" type="button" data-action="show-password" data-text-show="Show" data-text-hide="Hide">
              Show
            </button>
          </span>
                                            </div>
                                            @error('password')
                                            <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 form-control-comment right">
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-md-10 offset-md-2">
                                            <div class="forgot-password">
                                                <a href="password-recovery.html" rel="nofollow">
                                                    Forgot your password?
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <footer class="form-footer clearfix">
                                    <div class="row no-gutters">
                                        <div class="col-md-10 offset-md-2">
                                            <input type="hidden" name="submitLogin" value="1">
                                            <button class="btn btn-primary" data-link-action="sign-in" type="submit"
                                                    class="form-control-submit">
                                                Sign in
                                            </button>
                                        </div>
                                    </div>
                                </footer>
                            </form>
                        </section>
                        <div class="row no-gutters">
                            <div class="col-md-10 offset-md-2">
                                <div class="no-account">
                                    <a href="{{route('register')}}" data-link-action="display-register-form">
                                        No account? Create one here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="page-footer">
                        <!-- Footer content -->
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <br>
@stop
