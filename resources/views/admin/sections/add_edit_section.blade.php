@extends('admin.layouts.layout')


@section('content')
  
@php
error_reporting(0);    
@endphp

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
                  <h4 class="card-title">{{$title}}</h4>
                 
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
                 
                  <form class="forms-sample" @if(empty($section['id']))  action="{{url('admin/add-edit-section')}}"  @else action="{{url('admin/add-edit-section/'.$section['id'])}}" @endif  method="post" >
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1">Admin Username/Email</label>
                     
                      <input type="text" class="form-control" id="section_name"   placeholder="Enter Section Name" name="section_name" @if(!empty($section['name'])) value="{{$section['name']}}" @else value="{{old('section_name')}}" @endif >
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