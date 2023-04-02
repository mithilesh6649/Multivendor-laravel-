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
                                <h4 class="card-title">{{ $title }}</h4>

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
                                    @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}"  @else action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif
                                    method="post" enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Select Product</label>

                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach ($sections as $section)
                                                <optgroup label="{{ $section['name'] }}"></optgroup>
                                                @foreach ($section['categories'] as $category)
                                                    <option value="{{ $category['id'] }}">
                                                        &nbsp;&nbsp;--&nbsp;{{ $category['category_name'] }}</option>
                                                    @foreach ($category['subcategories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;{{ $subcategory['category_name'] }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach


                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Select Brand</label>

                                        <select name="brand_id" id="brand_id" class="form-control">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                            @endforeach


                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Name </label>
                                        <input type="text" class="form-control" id="product_name"
                                            placeholder="Enter product Name" name="product_name"
                                            @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Code </label>
                                        <input type="text" class="form-control" id="product_code"
                                            placeholder="Enter Product Code" name="product_code"
                                            @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Color </label>
                                        <input type="text" class="form-control" id="product_color"
                                            placeholder="Enter Product Color" name="product_color"
                                            @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product price </label>
                                        <input type="text" class="form-control" id="product_price"
                                            placeholder="Enter Product price" name="product_price"
                                            @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product discount (%) </label>
                                        <input type="text" class="form-control" id="product_discount"
                                            placeholder="Enter Product discount" name="product_discount"
                                            @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product weight </label>
                                        <input type="text" class="form-control" id="product_weight"
                                            placeholder="Enter Product weight" name="product_weight"
                                            @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                    </div>







                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Image ( Recommended Size : 1000 * 1000 ) </label>

                                        <input type="file" class="form-control" id="product_image"
                                            name="product_image">
                                        @if (!empty($product['product_image']))
                                            <a target="_blank"
                                                href="{{ url('front/images/product_images/large/' . $product['product_image']) }}">View
                                                Image</a>&nbsp;&nbsp;
                                            <a href="javascript:void(0)" id="removeImage" module="product-image"
                                                moduleId="{{$product['id']}}">Delete Image</a>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Video  Recommended Size : Less then 2 MB ) </label>

                                        <input type="file" class="form-control" id="product_video"
                                            name="product_video">
                                        @if (!empty($product['product_video']))
                                            <a target="_blank"
                                                href="{{ url('front/videos/product_videos/' . $product['product_video']) }}">View
                                                Video</a>&nbsp;&nbsp;
                                            <a href="javascript:void(0)" class="confirmDelete" module="product-video"
                                                moduleId="$product['id']">Delete Video</a>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product Description </label>
                                        <textarea name="description" class="form-control">{{$product['description']}}</textarea>

                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">URL</label>

                                        <input type="text" class="form-control" id="url"
                                            placeholder="Enter URL" name="url"
                                            @if (!empty($product['url'])) value="{{ $product['url'] }}" @else value="{{ old('url') }}" @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Meta Title</label>

                                        <input type="text" class="form-control" id="meta_title"
                                            placeholder="Enter meta_title" name="meta_title"
                                            @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Meta Description</label>

                                        <input type="text" class="form-control" id="meta_description"
                                            placeholder="Enter meta_description" name="meta_description"
                                            @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Meta Keywords</label>

                                        <input type="text" class="form-control" id="meta_keywords"
                                            placeholder="Enter meta_keywords" name="meta_keywords"
                                            @if (!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Featured Items</label>

                                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes"
                                            @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked="" @endif>
                                    </div>


                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>

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
@endpush
