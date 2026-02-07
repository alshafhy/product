@extends('layouts/auth')

@section('title', 'Login Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-1">
      <label class="form-label" for="username">{{ __('Username') }}</label>
      <input class="form-control @error('username') is-invalid @enderror" id="username" type="text" name="username"
        placeholder="{{ __('Username') }}" value="{{ old('username') }}" aria-describedby="login-email" autofocus=""
        tabindex="1" required />
      @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="mb-1">
      <div class="d-flex justify-content-between">
        <label class="form-label" for="login-password">{{ __('Password') }}</label>
        {{-- <a href="{{url(" auth/forgot-password-cover")}}">
          <small>Forgot Password?</small>
        </a> --}}
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
        @endif
      </div>
      <div class="input-group input-group-merge form-password-toggle">
        <input class="form-control form-control-merge  @error('password') is-invalid @enderror" id="password"
          type="password" name="password" placeholder="*********" aria-describedby="login-password" tabindex="2" required
          autocomplete="current-password" />
        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>

        {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
          name="password" required autocomplete="current-password"> --}}

        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="mb-1">
      <div class="form-check">
        <input class="form-check-input" name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} tabindex="3" />
        <label class="form-check-label" for="remember"> {{ __('Remember Me') }}</label>
      </div>
    </div>


    {{-- <div class="form-group row">
      <div class="col-md-6 offset-md-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked'
            : '' }}>

          <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
          </label>
        </div>
      </div>
    </div> --}}
    {{-- <button class="btn btn-primary w-100" tabindex="4">Sign in</button> --}}
    <button type="submit" class="btn btn-primary  w-100">
      {{ __('Login') }}
    </button>
    <div class="divider my-2">
      <div class="divider-text">or</div>
    </div>

    <button type="button" id="webauthn-login" class="btn btn-outline-primary w-100 mb-1">
      <i data-feather="key"></i> Login with Passkey
    </button>

  </form>
@endsection

@section('vendor-script')
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
  <script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
  <script src="{{ asset('js/vendor/webauthn/webauthn.js') }}"></script>
  <script>
    const webauthn = new WebAuthn();

    const loginButton = document.getElementById('webauthn-login');

    if (WebAuthn.doesntSupportWebAuthn()) {
      loginButton.disabled = true;
      loginButton.innerText = 'Passkey not supported';
    }

    loginButton.addEventListener('click', () => {
      const username = document.getElementById('username').value;

      if (!username) {
        alert('Please enter your username first.');
        return;
      }

      webauthn.login({
        username: username
      })
        .then(response => {
          window.location.href = '/home';
        })
        .catch(error => {
          console.error('WebAuthn Login Error:', error);
          if (error instanceof Response) {
            error.json().then(data => {
              console.error('WebAuthn Login API Error Details:', data);
              alert('Error: ' + (data.message || data.error || 'Unknown API error during login. Check console for details.'));
            });
          } else {
            console.error('WebAuthn Login Client-side Error:', error);
            alert('WebAuthn login failed. Please ensure you have registered this device and your browser supports passkeys. Check console for details.');
          }
        });
    });
  </script>
@endsection