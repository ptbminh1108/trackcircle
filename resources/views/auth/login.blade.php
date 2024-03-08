@extends('layouts.app')

@section('content')

<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email-input">{{Lang::get('auth.email_title')}}</label>
                                        <input type="email" name='email' id="email-input" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter a valid email address" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="input-password">{{Lang::get('auth.password_title')}}</label>
                                        <input type="password" name='password' id="input-password" class="form-control form-control-lg  @error('password') is-invalid @enderror" placeholder="Enter password" />
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Checkbox -->
                                        <div class="form-check mb-0">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label" for="form2Example3">
                                                {{Lang::get('auth.remember')}}
                                            </label>
                                        </div>
                                        <a href="{{url('forgot-password')}}" class="text-body"> {{Lang::get('auth.forgot_password')}}</a>
                                    </div>

                                    <div class="text-center text-lg-start mt-4 pt-2">
                                        <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem">
                                            {{Lang::get('auth.login')}}
                                        </button>
                                        <p class="small fw-bold mt-2 pt-1 mb-0">
                                            {{Lang::get('auth.dont_have_account')}}
                                            <a href="{{ url('register') }}" class="link-danger">{{Lang::get('auth.register')}}</a>
                                        </p>
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
@endsection