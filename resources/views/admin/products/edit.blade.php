@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('product.list') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <form method="post" name="productEditForm" id="productEditForm">
        @csrf
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}" placeholder="Title">
                                    <p class="error"></p>		
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title">Slug</label>
                                    <input type="text" readonly name="slug" id="slug" class="form-control" value="{{ $product->slug }}" placeholder="Slug">
                                    <p class="error"></p>	
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{ $product->description }}</textarea>
                                </div>
                            </div>                                            
                        </div>
                    </div>	                                                                      
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Media</h2>								
                        <div id="image" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">    
                                <br>Drop files here or click to upload.<br><br>                                            
                            </div>
                        </div>
                    </div>	                                                                      
                </div>

                <div class="row" id="product-gallery">
                  @if($productImage->isNotEmpty())
                     @foreach($productImage as $image)
                     <div class="col-md-3" id="image-row-{{ $image->id }}"><div class="card">
                        <input type ="hidden" name="image_array[]" value="{{ $image->id }}">
                      <img class="card-img-top" src="{{ asset('uploads/product/small/'.$image->image) }}" alt="Card image cap">
                      <div class="card-body">
                      
                          <a href="javascript:void()" onclick="deleteImage({{ $image->id }})" class="btn btn-danger">Delete</a>
                      </div>
                 </div></div>
                     @endforeach
                  @endif
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Pricing</h2>								
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}" placeholder="Price">
                                    <p class="error"></p>	
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="compare_price">Compare at Price</label>
                                    <input type="text" name="compare_price" id="compare_price" class="form-control" value="{{ $product->compare_price }}" placeholder="Compare Price">
                                    <p class="text-muted mt-3">
                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                    </p>	
                                </div>
                            </div>                                            
                        </div>
                    </div>	                                                                      
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Inventory</h2>								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                    <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}"  placeholder="sku">
                                    <p class="error"></p>	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" id="barcode" class="form-control" value="{{ $product->barcode }}" placeholder="Barcode">	
                                </div>
                            </div>   
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type ="hidden" name="track_qty" value="No">
                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes" {{$product->track_qty=='Yes'?'checked' : '' }}>
                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="number" min="0" name="qty" id="qty" class="form-control" value="{{ $product->qty }}"  placeholder="Qty">
                                    <p class="error"></p>		
                                </div>
                            </div>                                         
                        </div>
                    </div>	                                                                      
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">	
                        <h2 class="h4 mb-3">Product status</h2>
                        <div class="mb-3">
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $product->status ==1 ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $product->status ==0 ? 'selected': '' }}>Block</option>
                            </select>
                        </div>
                    </div>
                </div> 
                <div class="card">
                    <div class="card-body">	
                        <h2 class="h4  mb-3">Product category</h2>
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select</option>
                                @foreach($categories as $category )
                                <option value="{{ $category->id }}" {{$product->category_id == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                               @endforeach
                            </select>
                            <p class="error"></p>
                        </div>
                        <div class="mb-3">
                            <label for="category">Sub category</label>
                            <select name="sub_category" id="sub_category" class="form-control">
                                <option value="">Select</option>
                                @foreach($subCategories as $subcatgory )
                                <option value="{{ $subcatgory->id }}" {{$product->sub_category_id== $subcatgory->id? 'selected':'' }}>{{ $subcatgory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> 
             
                <div class="card mb-3">
                    <div class="card-body">	
                        <h2 class="h4 mb-3">Featured product</h2>
                        <div class="mb-3">
                            <select name="is_featured" id="is_featured" class="form-control">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>                                                
                            </select>
                            <p class="error"></p>
                        </div>
                    </div>
                </div>  
                
                <div class="card mb-3">
                    <div class="card-body">	
                        <h2 class="h4 mb-3">Related Products</h2>
                        <div class="mb-3">
                            <select multiple name="related_products[]" id="related_products" class="related-product form-control w100">
                                @if(!empty($relatdProducts))
                                @foreach($relatdProducts as $relProduct)
                                    <option selected value="{{ $relProduct->id }}">{{ $relProduct->title }}</option>
                                @endforeach                                
                                @endif
                            </select>
                            <p class="error"></p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('product.list') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </div>
</form>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('script')
<script>

$('.related-product').select2({
    ajax: {
        url: '{{ route("product.getProducts") }}',
        dataType: 'json',
        tags: true,
        multiple: true,
        minimumInputLength: 3,
        processResults: function (data) {
            return {
                results: data.tags
            };
        }
    }
});  

$("#title").change(function(){
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

   $('#category').change(function(){
    var element = $(this);
    $.ajax({
           url: '{{ route("product-subcategories.index") }}',  // Verify the route name here
           type: 'GET',
           data: { category_id : element.val()},
           dataType : 'json',
           success: function(response) {
                console.log(response);
                   if(response['status'] == true){
                       $('#sub_category').find("option").not(":first").remove();
                       $.each(response['subCategories'],function(key,item){
                           $("#sub_category").append(`<option value='${item.id}'>${item.name}</option>`);
                       });
                   }
              },
              error: function(xhr, exception) {
               console.log("Something went wrong");
              }
           })
   });

   $('#productEditForm').submit(function(event){
            event.preventDefault();
            var element =  $(this);
            $('button[type="submit"]').prop('disabled',true);
            $.ajax({
            url: '{{ route("product.update", $product->id) }}',  // Verify the route name here
            type: 'PUT',
            data: element.serializeArray(),
            dataType : 'json',
        success: function(response) {
            if(response['status']== true){
                $('button[type="submit"]').prop('disabled',false);
                  window.location.href = "{{ route('product.list') }}"
             }
            else{
                $('button[type="submit"]').prop('disabled',false);
                var errors =  response['errors'];
                $('.error').removeClass('invalid-feedback').html('');
                $('input[type="text"], select,input[type="number"]').removeClass('is-invalid');
                $.each(errors,function(key,value){
                 $(`#${key}`).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                }) 

            }
           
           
        },
        error: function(xhr, exception) {
            console.log("Something went wrong");
        }
      })
  });


  Dropzone.autoDiscover = false;    
const dropzone = $("#image").dropzone({ 

    url:  "{{ route('product-images.update') }}",
    maxFiles: 10,
    paramName: 'image',
    params : {'product_id' : '{{ $product->id }}'},
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        //$("#image_id").val(response.image_id);
        console.log(response);

       var html = `<div class="col-md-3" id="image-row-${response.image_id}"><div class="card">
                  <input type ="hidden" name="image_array[]" value="${response.image_id}">
                <img class="card-img-top" src="${response.ImagePath}" alt="Card image cap">
                <div class="card-body">
                
                    <a href="javascript:void()" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                </div>
           </div></div>`;
         $("#product-gallery").append(html);  
    },
    complete: function(file){
        this.removeFile(file);
    }
});

function deleteImage(id){
    $('#image-row-'+id).remove();
    if(confirm("Are you sure want to delete")) {
    $.ajax({
       url: '{{ route("product-image.delete") }}',
       type : 'delete',
       data : {'id' : id },
       success: function(response){
           if(response.status == true){
             alert(respose.message);
           }else{
            alert(respose.message);
           }
       }

    });
  }
}
   </script>
@endsection