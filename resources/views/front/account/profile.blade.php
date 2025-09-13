@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                <li class="breadcrumb-item">Settings</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('front.account.common.message')
            </div>  
            <div class="col-md-3">
             @include('front.account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method ="post" name="updateProfile" id="updateProfile">
                        <div class="row">
                            <div class="mb-3">               
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control" 
                                value="{{ $user->name }}">
                                <p></p>
                            </div>
                            <div class="mb-3">            
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control"
                                value= "{{ $user->email }}">
                                <p></p>
                            </div>
                            <div class="mb-3">                                    
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control"
                                value= "{{ $user->phone }}">
                            </div>

                            <div class="mb-3">                                    
                                <label for="phone">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address"></textarea>
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </form>  
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method ="post" name="updateProfile" id="updateProfile">
                        <div class="row">
                            <div class="mb-3">               
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control" 
                                value="{{ $user->name }}">
                                <p></p>
                            </div>
                            <div class="mb-3">            
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control"
                                value= "{{ $user->email }}">
                                <p></p>
                            </div>
                            <div class="mb-3">                                    
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control"
                                value= "{{ $user->phone }}">
                            </div>

                            <div class="mb-3">                                    
                                <label for="phone">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address"></textarea>
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </form>  
                    </div>
                </div>  

            </div>    
               
            
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $('#updateProfile').submit(function(event){
        event.preventDefault();
        var element =  $(this);
        $.ajax({
       url: '{{ route("account.updateProfile") }}',
       type : 'post',
       data : element.serializeArray(),
       dataType : 'json',
       success : function(response){
		if(response['status']== true){
        

        $("#name").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");

        $("#email").removeClass('is-invalid').siblings('p')
        .removeClass('invalid-feedback').html("");
        window.location.href= "{{ route('account.profile') }}";
			
		 }else{
            var errors =  response['errors'];
            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            if(errors['email']){
               $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
            }else{
                $("#email").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");  
            }
         }
       }
      });
    });    
</script>    
@endsection