  <div class="row">
            <div class="col-md-12">

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Personal Information</h4>
                 
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
                 
                  <form class="forms-sample" action="{{url('admin/update-vendor-details/personal')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1">Vendor Username/Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>
                    

                  <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$vendorDetails['name']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                 

                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="mobile" name="mobile" class="form-control" id="mobile" placeholder="mobile" value="{{$vendorDetails['mobile']}}">
                    </div>

                       <div class="form-group">
                  <label for="name">Address</label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="name" value="{{$vendorDetails['address']}}">
                  <div class="name mt-2">
                  </div>
                </div>

                   <div class="form-group">
                  <label for="name">City</label>
                  <input type="text" name="city" class="form-control" id="city" placeholder="city" value="{{$vendorDetails['city']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                   <div class="form-group">
                  <label for="name">State</label>
                  <input type="text" name="state" class="form-control" id="state" placeholder="state" value="{{$vendorDetails['state']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                   <div class="form-group">
                  <label for="name">Country</label>
                  <input type="text" name="country" class="form-control" id="country" placeholder="country" value="{{$vendorDetails['country']}}">
                  <div class="country mt-2">
                   
                 </div>
                </div>
                   <div class="form-group">
                  <label for="name">Pincode</label>
                  <input type="text" name="pincode" class="form-control" id="pincode" placeholder="pincode" value="{{$vendorDetails['pincode']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>


                        <div class="form-group">
                      <label for="mobile">Vendor Photo</label>
                        <input name="image" type="file" class="dropify" data-height="100" @if(!empty(Auth::guard('admin')->user()->image)) 
                        data-default-file="{{asset('images/venodr/'.Auth::guard('admin')->user()->image)}}" @endif />
                    </div>
               
              
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>  
              
            </div>
         </div>
