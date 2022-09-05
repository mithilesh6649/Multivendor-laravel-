 

  <div class="row">
            <div class="col-md-12">

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Business Information</h4>
                 
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
                 
                  <form class="forms-sample" action="{{url('admin/update-vendor-details/business')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1">Vendor Username/Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>
                    

                  <div class="form-group">
                  <label for="name">Shop Name</label>
                  <input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="shop_name" value="{{$vendorDetails['shop_name']}}">
                  <div class="shop_name mt-2">
                   
                 </div>
                </div>

                 
 

                       <div class="form-group">
                  <label for="name">Shop Address</label>
                  <input type="text" name="shop_address" class="form-control" id="shop_address" placeholder="name" value="{{$vendorDetails['shop_address']}}">
                  <div class="name mt-2">
                  </div>
                </div>

                   <div class="form-group">
                  <label for="name">Shop City</label>
                  <input type="text" name="shop_city" class="form-control" id="shop_city" placeholder="city" value="{{$vendorDetails['shop_city']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                   <div class="form-group">
                  <label for="name">Shop State</label>
                  <input type="text" name="shop_state" class="form-control" id="shop_state" placeholder="state" value="{{$vendorDetails['shop_state']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                   <div class="form-group">
                  <label for="name">Shop Country</label>
                  <input type="text" name="shop_country" class="form-control" id="shop_country" placeholder="country" value="{{$vendorDetails['shop_country']}}">
                  <div class="country mt-2">
                   
                 </div>
                </div>
                  <div class="form-group">
                  <label for="shop_pincode">Shop Pincode</label>
                  <input type="text" name="shop_pincode" class="form-control" id="shop_pincode" placeholder="pincode" value="{{$vendorDetails['shop_pincode']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                  <div class="form-group">
                  <label for="shop_mobile">Shop Mobile</label>
                  <input type="text" name="shop_mobile" class="form-control" id="shop_mobile" placeholder="shop_mobile" value="{{$vendorDetails['shop_mobile']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>

                  <div class="form-group">
                  <label for="shop_website">Shop Pincode</label>
                  <input type="text" name="" class="form-control" id="shop_website" placeholder="shop_website" value="{{$vendorDetails['shop_website']}}">
                 
                </div>
              
                  <div class="form-group">
                  <label for="shop_email">Shop Email</label>
                  <input type="text" name="shop_email" class="form-control" id="" placeholder="shop_email" value="{{$vendorDetails['shop_email']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>
                 
                       <div class="form-group">
                  <label for="address_proof">Address Proof</label>
                  <select class="form-control">
                    <option>Passport</option>
                     <option>PAN</option>
                   <option>Driving License</option>
                    <option>Voting Card</option>
                    <option>Aadhar Card</option>
                  </select>
                </div>



                        <div class="form-group">
                      <label for="mobile">Address Proof Image</label>
                        <input name="address_proof_image" type="file" class="dropify" data-height="100" @if(!empty(Auth::guard('admin')->user()->image)) 
                        data-default-file="{{asset('images/venodr/'.Auth::guard('admin')->user()->image)}}" @endif />
                    </div>


                     <div class="form-group">
                  <label for="">Shop License Number</label>
                  <input type="text" name="business_license_number" class="form-control" id="" placeholder="business_license_number" value="{{$vendorDetails['business_license_number']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>
                  <div class="form-group">
                  <label for="gst_number">Shop GST Number </label>
                  <input type="text" name="gst_number" class="form-control" id="" placeholder="" value="{{$vendorDetails['gst_number']}}">
                  <div class="name mt-2">
                   
                 </div>
                </div>
                  <div class="form-group">
                  <label for="pan_number">Shop PAN Number</label>
                  <input type="text" name="pan_number" class="form-control" id="" placeholder="" value="{{$vendorDetails['pan_number']}}">
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
