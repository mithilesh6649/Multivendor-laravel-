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
            <h4 class="card-title">Categories</h4>
            <a style="background-color: blue;padding:5px;text-decoration:none;color:wheat;max-width:150px ; float: right;display:inline-block" href="{{url('admin/add-edit-category')}}">Add category </a>

            <div class="table-responsive pt-3">
                <table class="table table-bordered"  id="category_table">
                    <thead>
                        <tr>
                            <th>
                               ID
                            </th>
                            <th>
                                 Category
                            </th>

                            <th>
                                 Parent Category
                            </th>

                            <th>
                                 Section
                            </th>

                            <th>
                                 URL
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
                        @foreach($categories as $category)
                         
                        @if(isset($category['parentcategory']['category_name']) && !empty($category['parentcategory']['category_name']))
                          @php $parent_category = $category['parentcategory']['category_name'];  @endphp
                        @else
                          @php $parent_category = "Root" ; @endphp
                           
                        @endif
                          
                        <tr>
                            <td>
                            <!--   @php
                              $x = json_encode($category, JSON_PRETTY_PRINT);
                              echo $x;
                              @endphp -->

                              {{ $category['id']}}
                            </td>
                            <td>
                                {{ ucfirst($category['category_name'])}}
                            </td>

                            

                            <td>
                             {{$parent_category}}   
                            </td>

                            <td>
                                {{ ucfirst($category['section']['name'])}}
                            </td>

                            <td>
                                {{ ucfirst($category['url'])}}
                            </td>




                              <td>
                                @if($category['status'] == 1)
                                   <a class="updateCategoryStatus" id="category-{{$category['id']}}" category_id="{{$category['id']}}" href="javascript:void(0);">
                                   <i style="font-size:25px;" class="mdi mdi-bookmark-check" status="Active"></i>
                                   </a>
                                @else
                                <a class="updateCategoryStatus" id="category-{{$category['id']}}" category_id="{{$category['id']}}" href="javascript:void(0);">
                                  <i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                </a>
                                 @endif

                            </td>

                            <td>
                            <a href="{{url('admin/add-edit-category/'.$category['id'])}}"><i style="font-size:25px;" class="mdi mdi-pencil-box"></i> </a>

                            <a title="category" class="confirmDelete" href="{{url('admin/delete-category/'.$category['id'])}}"><i style="font-size:25px;" class="mdi mdi-file-excel-box"></i> </a>

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
