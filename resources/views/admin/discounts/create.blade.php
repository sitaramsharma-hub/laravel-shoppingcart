@extends('admin.layouts.app')
@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon Code</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('category.list')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    
    <section class="content">
        <!-- Default box -->
        <form method="post" name="discountForm" id="discountForm">
            @csrf
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Code</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Coupon code">
                                <p></p>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Name</label>
                                <input type="text"  name="name" id="name" class="form-control" placeholder="Coupon code name">
                                <p></p>	
                            </div>
                        </div>									
                    </div>
             
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">                               
                                <label for="email">Description</label>
                                <textarea  name="description" id="description" class="form-control" placeholder="Description"></textarea>
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">                               
                                <label for="email">Max uses</label>
                                <input type="number"  name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">
                                
                            </div>
                        </div>
                    </div>

                   <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">                               
                            <label for="email">Max uses user</label>
                            <input type="number"  name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max Uses User">
                            
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value= "percent">Percent</option>
                                <option value= "fixed">Fixed</option>
                            </select> 	
                        </div>
                    </div>

                   </div>


                   <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">                               
                            <label for="email">Discount Amount</label>
                            <input type="text"  name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">
                            <p></p>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Min Amount</label>
                            <input type="text"  name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount">
                        </div>
                    </div>

                   </div>


                   <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">                               
                            <label for="email">Start at</label>
                            <input type="text"  name="start_at" id="start_at" class="form-control" placeholder="Start at">
                            <p></p>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Expire at</label>
                            <input type="text"  name="expire_at" id="expire_at" class="form-control" placeholder="Expire at">
                            <p></p>
                        </div>
                    </div>

                   </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value= "1">Active</option>
                                    <option value= "0">Block</option>
                                </select> 	
                            </div>
                        </div>

                      
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('category.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    @endsection

    @section('script')
       <script>

        $(document).ready(function(){
                $('#start_at').datetimepicker({
                    // options here
                    format:'Y-m-d H:i:s',
                });

                $('#expire_at').datetimepicker({
                    // options here
                    format:'Y-m-d H:i:s',
                });
            });


          $('#discountForm').submit(function(event){
            event.preventDefault();
            var element =  $(this);
            $('button[type="submit"]').prop('disabled',true);
            $.ajax({
            url: '{{ route("discount.store") }}',  // Verify the route name here
            type: 'POST',
            data: element.serializeArray(),
            dataType : 'json',
        success: function(response) {
            if(response['status']== false){
                $('button[type="submit"]').prop('disabled',false);
                var errors =  response['errors'];
                
                if(errors['code']){
                    $("#code").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['code']);
                }else{
                    $("#code").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                }

                if(errors['discount_amount']){
                    $("#discount_amount").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['discount_amount']);
                }else{
                    $("#discount_amount").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                }

                if(errors['starts_at']){
                    $("#start_at").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['starts_at']);
                }else{
                    $("#start_at").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                }

                if(errors['expire_at']){
                    $("#expire_at").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['expire_at']);
                }else{
                    $("#expire_at").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                }
             }
            else{
                window.location.href = "{{ route('discount.list')}}";
                $("#code").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");
                $("#discount_amount").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");
                $("#start_at").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    $("#expire_at").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");     

            }
           
           
        },
        error: function(xhr, exception) {
            console.log("Something went wrong");
        }
      })
  });

 

   
       </script>
     @endsection