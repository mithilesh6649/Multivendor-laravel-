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
            <h4 class="card-title">Sections</h4>
            <a style="background-color: blue;padding:2px;text-decoration:none;color:wheat;max-width:150px ; float: right;display:inline-block" href="{{url('admin/add-edit-section')}}">Add Section </a>
             
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                               ID
                            </th>
                            <th>
                                 Name
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
                        @foreach($sections as $section)
                        <tr>
                            <td>
                            <!--   @php
                              $x = json_encode($section, JSON_PRETTY_PRINT);
                              echo $x;
                              @endphp -->

                              {{ $section['id']}}
                            </td>
                            <td>
                                {{ ucfirst($section['name'])}}
                            </td>
 

                       

                              <td>
                                @if($section['status'] == 1)
                                   <a class="updateSectionStatus" id="section-{{$section['id']}}" section_id="{{$section['id']}}" href="javascript:void(0);">
                                   <i style="font-size:25px;" class="mdi mdi-bookmark-check" status="Active"></i>
                                   </a> 
                                @else 
                                <a class="updateSectionStatus" id="section-{{$section['id']}}" section_id="{{$section['id']}}" href="javascript:void(0);">
                                  <i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i> 
                                </a>
                                 @endif    
                                  
                            </td>

                            <td>
                            <a href="{{url('admin/add-edit-section/'.$section['id'])}}"><i style="font-size:25px;" class="mdi mdi-pencil-box"></i> </a>

                            <a title="section" class="confirmDelete" href="{{url('admin/delete-section/'.$section['id'])}}"><i style="font-size:25px;" class="mdi mdi-file-excel-box"></i> </a>

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
//Update Admin Details
 
$(document).ready(function(){ 
  
  $(document).on('click','.updateSectionStatus',function(){
     var status = $(this).children("i").attr("status");
     var section_id = $(this).attr('section_id');
    //  console.log(section_id);
     
    $.ajax({
        type:"post",
        url:"{{route('update.section.status')}}",
        data:{ "_token": "{{ csrf_token() }}",status:status,section_id:section_id},
        beforeSend:function(){
         // alert('Before Send'); 
        },
        success:function(response){
          // console.log(response);
          if(response.status == 0){
           $('#section-'+section_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
          }else{
            $('#section-'+section_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check' status='Active'></i>");
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
  if(confirm('Are you sure want to delete this Sections ?')){
     return true;
  }else{
    return false;
  }
   
 });

</script>

@endpush