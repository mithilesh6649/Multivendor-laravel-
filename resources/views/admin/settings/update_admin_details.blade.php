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



          <div class="row">
          	<div class="col-md-12">

          	<div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update admin password</h4>
                 
                 @if(Session::has('error_message'))
                   
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
   {{Session::get('error_message')}}  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> 
                 @endif

                       @if(Session::has('success_message'))
                   
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
   {{Session::get('success_message')}}  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> 
                 @endif

                  @if($errors->any())
                  {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                 
                  <form class="forms-sample" action="{{route('admin.update.details')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1">Admin Username/Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin Type</label>
                      <input type="text"  class="form-control" value="{{ Auth::guard('admin')->user()->type}}" name="type" readonly  >
                    </div>

                  <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{Auth::guard('admin')->user()->name}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                 

                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="mobile" name="mobile" class="form-control" id="mobile" placeholder="mobile" value="{{Auth::guard('admin')->user()->mobile}}">
                    </div>

                        <div class="form-group">
                      <label for="mobile">Admin Photo</label>
                        <input name="image" type="file" class="dropify" data-height="100" @if(!empty(Auth::guard('admin')->user()->image)) 
                        data-default-file="{{asset('images/admin/'.Auth::guard('admin')->user()->image)}}" @endif />
                    </div>
               
              
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    
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