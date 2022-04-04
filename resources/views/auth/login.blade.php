@extends('layouts.auth')

@section('form')


  







  <div class="login-box">

<div class="card card-outline card-primary">
<div class="card-header text-center bg-dark">
        <a href="#" ><b style="font-weight:bold; color: #fff; font-size: 1.8em;">WAZEMI</b></a>
      </div>
<div class="card-body">
<p class="login-box-msg text-dark bg-gray-light pt-3" style="border-radius: 8px 8px 0 0; font-size: 1.3em;"><b>Connectez-vous maintenant</b></p>

<form style="margin: 0 auto; border-radius: 0 0 8px 8px ;" class="bg-gray-light p-3" method="POST" action="{{ route('login') }}" >
        @csrf
<div class="input-group mb-3">
<input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="row">
<!-- <div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="remember">
<label for="remember">
Remember Me
</label>
</div>
</div> -->

<!-- <div class="col-4"> -->
              <button type="submit" class="btn btn-primary btn-block">Login</button>            
<!-- </div> -->

</div>
</form>

<p class="mb-0">
<a href="{{ route('choice_type_register.index') }}" class=" mb-4 text-center"><b>Enregistrer vous</b></a>
</p>
</div>

</div>

</div>

@endsection
