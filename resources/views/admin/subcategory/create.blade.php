@extends('admin.layouts.app')
@section('content')
	<!-- Content Header (Page header) -->
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Sub Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('subcategory.list') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <form method="post" name="subCategoryForm" id="subCategoryForm">
        @csrf
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select</option>
                                @foreach($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                               @endforeach
                            </select>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            <p></p>	
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                            <p></p>	
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

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Show on home</label>
                            <select class="form-control" name="showHome" id="showHome">
                                <option value= "Yes">Yes</option>
                                <option value= "No">No</option>
                            </select> 	
                        </div>
                    </div>

                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="subcategory.html" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </div>
</form>
    <!-- /.card -->
</section>
<!-- /.content -->
    @endsection

    @section('script')
       <script>
          $('#subCategoryForm').submit(function(event){
            event.preventDefault();
            var element =  $(this);
            $('button[type="submit"]').prop('disabled',true);
            $.ajax({
            url: '{{ route("subcategory.store") }}',  // Verify the route name here
            type: 'POST',
            data: element.serializeArray(),
            dataType : 'json',
        success: function(response) {
            if(response['status']== true){
                $('button[type="submit"]').prop('disabled',false);
                window.location.href = "{{ route('subcategory.list') }}"
                $("#name").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");

                $("#slug").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");

                $("#name").val("");
                $("#slug").val("");
             }
            else{
                var errors =  response['errors'];

                if(errors['category']){
                    $("#category").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                }else{
                    $("#category").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                }
                
                if(errors['name']){
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                }else{
                    $("#name").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                }

                if(errors['slug']){
                    $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
                }else{
                    $("#slug").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                }

            }
           
           
        },
        error: function(xhr, exception) {
            console.log("Something went wrong");
        }
      })
  });

  $("#name").change(function(){
     var element = $(this);
    $.ajax({
            url: '{{ route("getSlug") }}',  // Verify the route name here
            type: 'GET',
            data: { title : element.val()},
            dataType : 'json',
            success: function(response) {
                    if(response['status'] == true){
                        $("#slug").val(response['slug'] )
                    }
               }
            });
    });

   
       </script>
     @endsection