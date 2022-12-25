@extends('layouts.app')

@section('content')
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="{{ asset('assets/img/blog-index.png')}}"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <h3 class="mb-5">{{ __('LOGIN') }}</h3>
            <div class="form-outline mb-4">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-outline mb-4">
                  <label class="form-label" for="Email">{{ __('Email Address') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="Password">{{ __('Password') }}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <!-- Checkbox -->
                <div class="form-outline mb-4">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                </div>
                <!-- Submit -->
                <div class="row mb-0">
                  <div class="col-md-8">
                    <button type="submit" class="btn btn-dark">
                      {{ __('Login') }}
                    </button>
                        @if (Route::has('password.request'))
                          <a class="btn btn-link link-dark" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                          </a>
                        @endif
                  </div>
                </div>
              </form>
    </div>
  </div>
@endsection
