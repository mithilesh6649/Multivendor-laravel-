@extends('admin.layouts.layout')
@section('content')
 
<div class="main-panel">
        <div class="content-wrapper">



    <div class="col-lg-12 grid-margin stretch-card">




    <div class="card">
      @if(Session::has('success_message'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
{{Session::get('success_message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
     @endif

        <div class="card-body">
            <h4 class="card-title">Products</h4>
            <a style="background-color: blue;padding:5px;text-decoration:none;color:wheat;max-width:150px ; float: right;display:inline-block" href="{{url('admin/add-edit-product')}}">Add product </a>

            <div class="table-responsive pt-3">
                <table class="table table-bordered"  id="category_table">
                    <thead>
                        <tr>
                            <th>
                               ID
                            </th>
                            <th>
                                 Product Name
                            </th>

                            <th>
                                 Product Code
                            </th>

                            <th>
                                 Product Color
                            </th>

                            <th>
                                 Product Image
                            </th>

                            <th>
                                 Category
                            </th>


                            <th>
                                 Section
                            </th>


                            <th>
                                 Added by
                            </th>


                            <th>
                                Status
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                         
                        
                          
                        <tr>
                            <td>
                            

                              {{ $product['id']}}
                            </td>
                            <td>
                                {{ ucfirst($product['product_name'])}}
                            </td>

                             <td>
                                {{  $product['product_code'] }}
                             </td>
                              <td>
                                {{  $product['product_color'] }}
                             </td>

                              <td>
                                 @if(!empty($product['product_image']))
                                  <img src="{{asset('front/images/product_images/small/'.$product['product_image'])}}">
                                 @endif
                             </td>

                              <td>
                                {{  $product['category']['category_name'] }}
                             </td>

                              <td>
                                {{  $product['section']['name'] }}
                             </td>

                             <td>
                                @if($product['admin_type']=='vendor')
                                 <a target="_blank" href="{{url('admin/view-vendor-details/'.$product['admin_id'])}}">{{ucfirst($product['admin_type'])}}</a>
                                @else
                                 {{ucfirst($product['admin_type'])}}
                                @endif
 
                             </td>
                             

                              




                              <td>
                                @if($product['status'] == 1)
                                   <a class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}" href="javascript:void(0);">
                                   <i style="font-size:25px;" class="mdi mdi-bookmark-check" status="Active"></i>
                                   </a>
                                @else
                                <a class="updatepProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}" href="javascript:void(0);">
                                  <i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                </a>
                                 @endif

                            </td>

                            <td>
                            <a title="Add/Edit Product" href="{{url('admin/add-edit-product/'.$product['id'])}}"><i style="font-size:25px;" class="mdi mdi-pencil-box"></i> </a>

                            <a title="Add Attributes" href="{{url('admin/add-edit-attributes/'.$product['id'])}}"><i style="font-size:25px;" class="mdi mdi-plus-box"></i> </a>

                             <a title="Add   Images" href="{{url('admin/add-images/'.$product['id'])}}"><i style="font-size:25px;" class="mdi mdi-library-plus"></i> </a>

                            <a  title="Delete Products" title="product" class="confirmDelete" href="{{url('admin/delete-product/'.$product['id'])}}"><i style="font-size:25px;" class="mdi mdi-file-excel-box"></i> </a>

                           </td>





                        </tr>
                        @endforeach
                    </tbody>
                </table>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
//Update Admin Details

$(document).ready( function () {
    $('#category_table').DataTable();
} );

$(document).ready(function(){

  $(document).on('click','.updateCategoryStatus',function(){
     var status = $(this).children("i").attr("status");
     var category_id = $(this).attr('category_id');
    //  console.log(categoryid);

    $.ajax({
        type:"post",
        url:"{{route('update.category.status')}}",
        data:{ "_token": "{{ csrf_token() }}",status:status,category_id:category_id},
        beforeSend:function(){
         // alert('Before Send');
        },
        success:function(response){
          // console.log(response);
          if(response.status == 0){
           $('#category-'+category_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
          }else{
            $('#category-'+category_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check' status='Active'></i>");
          }
        },
        error:function(xhr,error,response){
           // alert('error')+
        }
    });

  });

});


 //confirmDelete


 $('.confirmDelete').click(function(){

  var title  = $(this).attr('title');
  if(confirm('Are you sure want to delete this category ?')){
     return true;
  }else{
    return false;
  }

 });

</script>

@endpush
