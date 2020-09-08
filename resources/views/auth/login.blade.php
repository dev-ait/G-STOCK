@extends('layouts.app_login')

@section('content')

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}" >
                
                @csrf

                <span class="login100-form-title p-b-49">
                    <img src="images/logo-v1.png" alt="" class="w-50">
                </span>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Username est obligatoire">
                    <span class="label-input100">Username</span>

                    <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Typez email" required autocomplete="email" >
                         
                            

                  
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

               

                <div class="wrap-input100 validate-input" data-validate="Password est obligatoire">
                    <span class="label-input100">Password</span>
                    <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Typez password">

                   

                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

               
                
                <div class="text-right p-t-10 p-b-20 mt-2">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Souviens moi
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            Se connecter
                        </button>

                       

                    </div>
                </div>

        

                <div class="flex-col-c pt-3">

                    @error('email')
                    <span class="invalid-feedback  mb-3" role="alert">
                         <strong>Mauvais nom d’utilisateur ou mauvais mot de passe…</strong>
                     </span>
                        @enderror   

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong> Mauvais nom d’utilisateur ou mauvais mot de passe… </strong>
                         </span>
                        @enderror
        
                 

                    <a href="{{ route('register') }}" class="txt2 pt-5">
                        S'INSCRIRE
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

@endsection
