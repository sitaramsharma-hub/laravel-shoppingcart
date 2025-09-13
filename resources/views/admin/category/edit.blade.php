@extends('admin.layouts.app')
@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
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
        <form method="post" name="categoryForm" id="categoryForm">
            @csrf
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" placeholder="Name">
                                <p></p>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control" value="{{ $category->slug }}" placeholder="Slug">
                                <p></p>	
                            </div>
                        </div>									
                    </div>
                 <input type ="hidden" name="image_id" id="image_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Image</label>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">    
                                        <br>Drop files here or click to upload.<br><br>                                            
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="">
                            <img width="250"  src="{{ asset('uploads/category/thumb/'.$category->image) }}">
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value= "1" {{ $category->status ==1 ? 'selected': '' }}>Active</option>
                                    <option value= "0" {{ $category->status ==0 ? 'selected': '' }}>Block</option>
                                </select> 	
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Show on home</label>
                                <select class="form-control" name="showHome" id="showHome">
                                    <option value= "Yes" {{ $category->showHome == 'Yes' ? 'selected': '' }}>Yes</option>
                                    <option value= "No" {{ $category->showHome == 'No' ? 'selected': '' }}>No</option>
                                </select> 	
                            </div>
                        </div>

                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
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
          $('#categoryForm').submit(function(event){
            event.preventDefault();
            var element =  $(this);
            $('button[type="submit"]').prop('disabled',true);
            $.ajax({
            url: '{{ route("category.update", $category->id) }}',  // Verify the route name here
            type: 'PUT',
            data: element.serializeArray(),
            dataType : 'json',
        success: function(response) {
            if(response['status']== true){
                $('button[type="submit"]').prop('disabled',false);
                window.location.href = "{{ route('category.list') }}"
                $("#name").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");

                $("#slug").removeClass('is-invalid').siblings('p')
                .removeClass('invalid-feedback').html("");

                $("#name").val("");
                $("#slug").val("");
             }
            else{
                if(response['notFound']==true){
                    window.location.href = "{{ route('category.list') }}";
                 }
                var errors =  response['errors'];               
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

    Dropzone.autoDiscover = false;    
const dropzone = $("#image").dropzone({ 
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url:  "{{ route('temp-images.create') }}",
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        $("#image_id").val(response.image_id);
        console.log(response);
    }
});
       </script>
     @endsection