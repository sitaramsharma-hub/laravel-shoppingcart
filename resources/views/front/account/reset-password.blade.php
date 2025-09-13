@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        @if(Session::has('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-danger">
          {{ Session::get('error') }}
        </div>
      @endif
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item">Forgot Password</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-10">
    <div class="container">
        <div class="login-form">    
            <form action="{{ route('front.processResetPassword')}}" name="resetPassswordForm" method="post">
                @csrf
                <h4 class="modal-title">Reset Password</h4>
                <div class="mb-3">               
                    <label for="name">New Password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control @error('new_password') is-invalid @enderror">
                    @error('new_password')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">               
                    <label for="name">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" class="form-control @error('confirm_password') is-invalid @enderror">
                    @error('confirm_password')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <input type ="hidden" name="token" value="{{ $token }}">
                <input type="submit" class="btn btn-dark btn-block btn-lg" value="Submit">              
            </form>			
            <div class="text-center small">Don't have an account? <a href="{{route('account.register')}}">Sign up</a></div>
        </div>
    </div>
</section>
@endsection