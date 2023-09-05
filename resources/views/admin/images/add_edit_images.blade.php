@extends('admin.layouts.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome Aamir</h3>
                            <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                    class="text-primary">3 unread alerts!</span></h6>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">January - March</a>
                                        <a class="dropdown-item" href="#">March - June</a>
                                        <a class="dropdown-item" href="#">June - August</a>
                                        <a class="dropdown-item" href="#">August - November</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Add Images </h4>

                                @if (Session::has('error_message'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                                @endif

                                <form class="forms-sample"
                                      action="{{ url('admin/add-edit-images/' . $product['id']) }}" 
                                    method="post" enctype="multipart/form-data">
                                    @csrf


                                  


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Name </label>
                                         &nbsp;{{ $product['product_name'] }}
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Code </label>
                                        &nbsp;{{ $product['product_code'] }}
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Color </label>
                                        &nbsp;{{ $product['product_color'] }}
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product price </label>
                                        &nbsp; {{ $product['product_price'] }}
                                    </div>


                                    
                                    <div class="form-group">
                                         
                                     @if(!empty($product['product_image']))
                                       <img style="width: 120px;" src="{{ url('front/images/product_images/small/' . $product['product_image']) }}">
                                       @else
                                        <img style="width: 120px;" src="{{ url('front/images/product_images/small/no-image.png') }}"> 
                                       @endif
                                    </div>


                <div class="form-group">
                <div class="field_wrapper">
                <div>
                    <input type="file" name="images[]" multiple='' id='images'>
                </div>
                </div>
                </div>

 

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>



                    <!--  -->
                     
            <div class="table-responsive pt-3">
                  
                        @csrf 
                <table class="table table-bordered"  id="category_table">
                    <thead>
                        <tr>
                            <th>
                               ID
                            </th>
                            <th>
                                 Image
                            </th>

                            

                            <th>
                                 Actions
                            </th>


                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product['images'] as $image)
                         
                       
                        <tr>
                            <td>
                            

                              {{ $image['id']}}
                            </td>
                            <td>
                               <img style="width: 120px;" src="{{ url('front/images/product_images/small/' . $image['image']) }}">
                            </td>

                             

                              <td>
                                @if($image['status'] == 1)
                                   <a class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0);">
                                   <i style="font-size:25px;" class="mdi mdi-bookmark-check" status="Active"></i>
                                   </a>
                                @else
                                <a class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0);">
                                  <i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                </a>
                                 @endif

                            </td>

                      




                        </tr>
                   
                        @endforeach
                    </tbody>
                </table>
                  
                  
            </div>  
                    <!--  -->

                </div>
            </div>



        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layouts.footer')
        <!-- partial -->
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function() {

            $('#current_password').on('input', function() {
                let current_passowrd = $(this).val();

                $.ajax({
                    type: "post",
                    url: "{{ route('admin.check.password') }}",
                    data: {
                        password: current_passowrd,
                        "_token": "{{ csrf_token() }}",
                    },
                    beforeSend: function() {
                        $('.password_notice').html(
                            "<p class='text-danger'>Processing........</p>");
                    },
                    success: function(response) {
                        if (response.trim() == true) {
                            $('.password_notice').html("<p class='text-success'>Success</p>");
                        }
                    },
                    error: function(xhr, response, error) {

                    }
                });

            });

        });


        //Append categories level

        $(document).ready(function() {
            $('#section_id').on('change', function() {
                var section_id = $(this).val();
                // alert(section_id);
                $.ajax({
                    type: "post",
                    url: "/admin/append-categories-level",
                    data: {
                        section_id: section_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // alert(response);
                        $('#appendCategoriesLevel').html(response);
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            });
        });


        //Delete Image

        $(document).ready(function(){
              //confirmDelete


         $('#removeImage').click(function(){

              var moduleId  = $(this).attr('moduleId');
              if(confirm('Are you sure want to delete this image ?')){
                alert(moduleId);
                 return true;
              }else{
                return false;
              }

             });
        });
    </script>

  

    <script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = `<div> <input type="text" name="size[]" placeholder="Size"  style="width: 120px;" required="" />
                 <input type="text" name="sku[]" placeholder="SKU"  style="width: 120px;" required="" />
                  <input type="text" name="price[]" placeholder="price"  style="width: 120px;" required="" />
                   <input type="text" name="stock[]" placeholder="stock"  style="width: 120px;" required="" /><a href="javascript:void(0);" class="remove_button">Remove</a></div>`; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});



// Change Status

$(document).ready(function(){

  $(document).on('click','.updateAttributeStatus',function(){
     
     var status = $(this).children("i").attr("status");
     var attribute_id = $(this).attr('attribute_id');
    //  console.log(attributeid);

    $.ajax({
        type:"post",
        url:"{{route('update.attribute.status')}}",
        data:{ "_token": "{{ csrf_token() }}",status:status,attribute_id:attribute_id},
        beforeSend:function(){
         // alert('Before Send');
        },
        success:function(response){
          // console.log(response);
          if(response.status == 0){
           $('#attribute-'+attribute_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
          }else{
            $('#attribute-'+attribute_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check' status='Active'></i>");
          }
        },
        error:function(xhr,error,response){
           // alert('error')+
        }
    });

  });

});
</script>
@endpush
