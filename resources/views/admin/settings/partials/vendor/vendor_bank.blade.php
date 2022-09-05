 

  <div class="row">
            <div class="col-md-12">

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Bank Information</h4>
                 
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
                 
                  <form class="forms-sample" action="{{url('admin/update-vendor-details/bank')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1">Vendor Username/Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>
                    

                  <div class="form-group">
                  <label for="account_holder_name">Account Holder Name</label>
                  <input type="text" name="account_holder_name" class="form-control" id="account_holder_name" placeholder="account_holder_name" value="{{$vendorDetails['account_holder_name']}}">
                  <div class="account_holder_name mt-2">
                   
                 </div>
                </div>

                    <div class="form-group">
                  <label for="name">Bank Name</label>
                  <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="bank_name" value="{{$vendorDetails['bank_name']}}">
                  <div class="bank_name mt-2">
                   
                 </div>
                </div>


                 
 

                       <div class="form-group">
                  <label for="name">Account Number</label>
                  <input type="text" name="account_number" class="form-control" id="account_number" placeholder="name" value="{{$vendorDetails['account_number']}}">
                  <div class="name mt-2">
                  </div>
                </div>


                       <div class="form-group">
                  <label for="bank_ifsc_code">Bank IFSC Code</label>
                  <input type="text" name="bank_ifsc_code" class="form-control" id="bank_ifsc_code" placeholder="name" value="{{$vendorDetails['bank_ifsc_code']}}">
                  <div class="name mt-2">
                  </div>
                </div>

                   
               
              
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>  
              
            </div>
         </div>
