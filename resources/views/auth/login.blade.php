@extends('main')


@section('title',' Login')

@section('style')
<style>
.or{
    display: block;
    margin: 0 0 15px 0;
    padding: 30px 0 0;
    text-align: center;
    color: #999;
    cursor: default;
}
.or small{
    font-size: 14px;
    line-height: 1.4em;
}
.test button{
    
    background: none;
    border: 1px solid #999;
    border-radius: 50%;
    width: 91px;
    height: 91px;
    margin: 0 auto;
    padding: 15px;
    text-align: center;
    opacity: .5;
    -webkit-transition: all .2s ease;
    -moz-transition: all .2s ease;
    transition: all .2s ease;
}

.test button:hover{
    background: #fff;
    border-color: #666;
    text-decoration: none;
    opacity: 1;
}
.test button small{
    display:none;
    transition: all .2s ease;
}
.test button:hover small{
    display:block;
}
.card{
    height:400px;
}
</style>
@endsection


@section('content')
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

                        <!--<div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <!--<a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>-->
                                @endif
                                <a href="{{ url()->previous() }}" class="btn btn-danger"><< Back</a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <p class="or">
                    <small>or sign in with...</small>
                </p>

                <div class="text-center d-flex justify-content-center mb-4">
                    <div class="test mr-4">
                        <a href="{{ url('auth/facebook') }}">
                            <button class="auth-facebook-lnk" 
                                    title="Sign up with your Facebook account"
                                    type="submit">
                                <img src="{{ asset('img/facebook.svg')}}" width="32" height="32">
                                <small>Facebook</small>
                            </button>
                        </a>
                    </div>
                    <div class="test">
                        <button class="auth-facebook-lnk" 
                                title="Sign up with your Gmail account"
                                type="submit">
                            <img src="{{ asset('img/google.svg')}}" width="32" height="32">
                            <small>Google</small>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
