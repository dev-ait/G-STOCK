@extends('layouts.app_login')

@section('content')

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}" >
                
                @csrf

                <span class="login100-form-title p-b-30">
                    <img src="images/logo-v1.png" alt="" class="w-50">
                </span>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Username est obligatoire">
                    <span class="label-input100">Nom</span>
                    <input id="name" type="text" class="input100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" > 

                    <span class="focus-input100" data-symbol="&#xf203;"></span>
                </div>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

               

                <div class="wrap-input100 validate-input m-b-23" data-validate="Password est obligatoire">
                    <span class="label-input100">E-Mail Address</span>
                    <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                   

                    <span class="focus-input100" data-symbol="&#xf159;"></span>
                   
                </div>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                
                <div class="wrap-input100 validate-input m-b-23" data-validate="Password est obligatoire">
                    <span class="label-input100">Password</span>
                    <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                  
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <div class="wrap-input100 validate-input m-b-23" data-validate="Password est obligatoire">
                    <span class="label-input100">Confirm Password</span>
                    <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
               
                
             
                
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            enregister
                        </button>

                       

                    </div>
                </div>

        
                <div class="flex-col-c ">


                    <a href="{{ route('login') }}" class="txt2 pt-3  btn-send">
                        <i class="fa fa-arrow-left icon-effet"></i>  Retour
                    </a>
                </div>
            
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

@endsection
