@extends('admin.layouts.layout')


@section('content')
  



<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome Aamir</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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


    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{$title}}</h4>
            <p class="card-description">
                Add class <code>.table-bordered</code>
            </p>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                Admin ID
                            </th>
                            <th>
                                 Name
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Mobile
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Image
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
                        @foreach($admins as $admin)
                        <tr>
                            <td>
                            <!--   @php
                              $x = json_encode($admin, JSON_PRETTY_PRINT);
                              echo $x;
                              @endphp -->

                              {{ $admin['id']}}
                            </td>
                            <td>
                                {{ ucfirst($admin['name'])}}
                            </td>

                            <td>
                                {{ ucfirst($admin['type'])}}
                            </td>

                              <td>
                                {{ ucfirst($admin['mobile'])}}
                            </td>

                              <td>
                                {{ ucfirst($admin['email'])}}
                            </td>

                            <td>
                              <img src="{{asset('images/admin/'.$admin['image'])}}">     
                            </td>

                              <td>
                                @if($admin['status'])
                                   <i style="font-size:25px;" class="mdi mdi-bookmark"></i> 
                                @else 
                                  <i style="font-size:25px;" class="mdi mdi-bookmark-outline"></i> 
                                @endif    
                                  
                            </td>

                              <td>
                                 @if($admin['type'] == 'vendor' )
                                      <a href="{{ route('view.vendor.details',['id'=>$admin['id']]) }}">
                                        <i style="font-size:25px;" class="mdi mdi-file-document"></i> 
                                      </a>
                                  @else
                                      
                                        <i style="font-size:25px;" class="mdi mdi-file-document"></i> 
                                      
                                 @endif

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

<script>
 
 $('.dropify').dropify();
 
 $(document).ready(function(){
   
   $('#current_password').on('input',function(){
     let current_passowrd  = $(this).val();

      $.ajax({
          type:"post",
          url:"{{ route('admin.check.password')}}",
          data:{
              password :current_passowrd, 
              "_token": "{{ csrf_token() }}",
          },
          beforeSend:function(){
            $('.password_notice').html("<p class='text-danger'>Processing........</p>");
          },
          success:function(response){
             if(response.trim() == true){
                 $('.password_notice').html("<p class='text-success'>Success</p>");
             }
          },
          error:function(xhr,response,error){
        
          }
      });

   });  
     
 });



 

</script>

@endpush