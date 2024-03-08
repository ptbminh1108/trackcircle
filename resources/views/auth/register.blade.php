@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<section class="content content justify-content-center d-flex" id="register-header-step">
    <div class="row  form-register">
        <div class="col-sm-4" id="header-step-1">
            <div class="row">
                <div class="col-sm-2">
                    <div class="round-cirle">1</div>
                </div>
                <div class="col-sm-8">
                    <div class="header-step-title">Declaration</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" id="header-step-2">
            <div class="row">
                <div class="col-sm-2">
                    <div class="round-cirle">2</div>
                </div>
                <div class="col-sm-8">
                    <div class="header-step-title">Personal Details</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" id="header-step-3">
            <div class="row">
                <div class="col-sm-2">
                    <div class="round-cirle">3</div>
                </div>
                <div class="col-sm-8">
                    <div class="header-step-title final">Confirmation</div>
                </div>
            </div>
        </div>

</section>

<section class="content justify-content-center d-flex" id='register-form'>


    <form method="POST" action="{{ url('register') }}">
    @csrf
        <div class="row" id="step-1">
            <div class="col-sm-12">
                <!-- Default card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h2 class="card-title ">{{ Lang::get('auth.register_step_1_title') }}</h2>
                    </div>
                    <div class="card-body">
                        Once you’re setup you’ll be able to:

                        <ul>
                            <li>Support the business internally</li>

                            <li>To get more order as higher possibilities</li>

                            <li>To analysis the cost from the supplier</li>

                            <li>To analysis the price offer to the customer</li>

                            <li>To create, print and send estimate, sales order and invoice</li>

                            <li>To create, print and send purchase order and bill</li>

                            <li>To track every task and deal by automation.</li>
                        </ul>


                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->



            </div>

        </div>



        <div class="row" id='step-2'>
            <div class="col-sm-12">
                <!-- Default card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h2 class="card-title ">{{ Lang::get('auth.register_step_2_title') }}</h2>
                    </div>
                    <div class="card-body">

                        <!-- Name -->
                        <div class="form-group">
                            <label for="formClient-Name">{{ Lang::get('auth.user_name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('email') }}" id="formClient-Name" required autofocus />
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Name -->

                        <!-- Phone number -->
                        <div class="form-group">
                            <label for="formClient-Contact">{{ Lang::get('auth.phone_number') }}</label>
                            <input type="text" class="form-control" name="phone" id="formClient-Contact" />
                        </div>
                        <!-- Phone number -->

                        <!-- Phone Email -->
                        <div class="form-group">
                            <label for="formClient-Email">{{ Lang::get('auth.user_email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" data-msg-remote="{{ Lang::get('auth.user_email_exists') }}" id="formClient-Email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Phone Email -->


                        <!-- Address  -->
                        <div class="form-group">
                            <label for="formClient-Address">{{ Lang::get('auth.user_address') }}</label>
                            <textarea type="text" class="form-control" name="address" id="formClient-Address" rows="3"></textarea>
                        </div>
                        <!-- Address  -->
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->



            </div>

        </div>

        <div class="row" id='step-3'>
            <div class="col-sm-12">
                <!-- Default card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h2 class="card-title ">{{ Lang::get('auth.register_step_3_title') }}</h2>
                    </div>
                    <div class="card-body">
                        <!-- Password -->
                        <div class="form-group">
                            <label for="formClient-Password">{{ Lang::get('auth.user_password') }}</label>
                            <input type="password" class="form-control @error('email') is-invalid @enderror" name="password" minlength="6" id="formClient-Password" required placeholder="{{ Lang::get('auth.user_password') }}">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Password -->
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="formClient-ConfirmPassword">{{ Lang::get('auth.user_password_confirm') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" equalTo="#formClient-Password" id="formClient-ConfirmPassword" required placeholder="{{ Lang::get('auth.user_password_confirm') }}">
                        </div>

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->



            </div>

        </div>

        <!-- Default card -->
        <div class="card">
            <div class="card-footer">
                <div class="row" id="button-step-1">
                    <div class="col-sm-6">
                        <div class="col text-center"><button type="button" onclick={getStartedClick()} class="btn btn-flat btn-get-started">{{ Lang::get('auth.register_get_started') }}</button></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col text-center"><button type="button" class="btn btn-flat btn-cancel">{{ Lang::get('auth.register_cancel') }}</button></div>
                    </div>
                </div>
                <div class="row" id="button-step-2">
                    <div class="col-sm-6">
                        <div class="col text-center"><button type="button" onclick={backStep1Click()} class="btn btn-flat btn-get-started">{{ Lang::get('auth.register_back') }}</button></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col text-center"><button type="button" onclick={moveStep3Click()} class="btn btn-flat btn-cancel">{{ Lang::get('auth.register_next') }}</button></div>
                    </div>
                </div>
                <div class="row" id="button-step-3">
                    <div class="col-sm-6">
                        <div class="col text-center"><button type="button" onclick={backStep2Click()} class="btn btn-flat btn-get-started">{{ Lang::get('auth.register_back') }}</button></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col text-center"><button type="submit" class="btn btn-flat btn-cancel">{{ Lang::get('auth.register_submit') }}</button></div>
                    </div>
                </div>
            </div>
            <!-- /.card-footer-->

        </div>
        <!-- /.card -->
    </form>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#step-2").addClass("hidden");
        $("#step-3").addClass("hidden");
        $("#button-step-2").addClass("hidden");
        $("#button-step-3").addClass("hidden");
    })

    function getStartedClick() {
        $("#step-1").addClass("hidden");
        $("#step-2").removeClass("hidden");
        $("#button-step-1").addClass("hidden");
        $("#button-step-2").removeClass("hidden");

        $("#header-step-1 .round-cirle").html(` <i   class="align-middle" data-feather="check" style="color:rgb(65 209 106)"></i>`);

        feather.replace()
    }

    function backStep1Click() {
        $("#step-2").addClass("hidden");
        $("#step-1").removeClass("hidden");
        $("#button-step-2").addClass("hidden");
        $("#button-step-1").removeClass("hidden");

        $("#header-step-1 .round-cirle").html(`1`);

    }

    function backStep2Click() {
        $("#step-3").addClass("hidden");
        $("#step-2").removeClass("hidden");
        $("#button-step-3").addClass("hidden");
        $("#button-step-2").removeClass("hidden");
        $("#header-step-2 .round-cirle").html(`2`);

    }

    function moveStep3Click() {
        $("#step-2").addClass("hidden");
        $("#step-3").removeClass("hidden");
        $("#button-step-2").addClass("hidden");
        $("#button-step-3").removeClass("hidden");

        $("#header-step-2 .round-cirle").html(` <i  class="align-middle" data-feather="check" style="color:rgb(65 209 106)"></i>`);
        feather.replace()
    }
</script>
<style>
    .form-register {
        width: 1200px;
    }

    #register-form .card-title {
        font-size: 28px;
        width: 1200px;
    }

    #register-form .btn-get-started {
        font-weight: bold;
        font-size: 18px;
        width: 200px;
        background-color: black;
        color: white;
    }

    #register-form .btn-cancel {
        font-weight: bold;
        font-size: 18px;
        width: 200px;
        background-color: white;
        color: black;
        border: solid 1px black;
    }

    #register-form .hidden {
        display: none;
    }

    .round-cirle {
        width: 50px;
        height: 50px;
        background-color: rgb(216 228 238);
        font-size: 20px;
        color: black;
        text-align: center;
        border-radius: 100%;
        padding: 23%
    }

    .header-step-title {
        line-height: 3;
        border-right: 2px solid rgb(216 228 238);
    }

    .header-step-title.final {
        line-height: 3;
        border-right: none !important;
    }

    #register-header-step {
        margin-bottom: 40px;
        margin-top: 40px;
    }

    .round-cirle svg {
        width: 30px;
        height: 30px;
    }
</style>
@endsection