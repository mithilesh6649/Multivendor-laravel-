<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;
use Session;

class AdminController extends Controller
{

    public function dashboard()
    {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request)
    {
        Session::put('page', 'updateAdminPassword');
        // dump($request->all());
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        if (\Request::isMethod('post')) {
            $this->validate($request, [
                'password' => 'min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            ]);

            if (Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {

                Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => Hash::make($request->password)]);

                return redirect()->back()->with('success_message', 'password has been updated successfully');

            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorret');
            }

            return $data = $request->all();
        }
        // dd(Auth::guard('admin')->user()->email);
        //  dd($adminDetails);
        return view('admin.settings.update_admin_password', compact('adminDetails'));

    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();

        if (Hash::check($data['password'], Auth::guard('admin')->user()->password)) {
            return true;
        }
    }

    //start update admin details coding

    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'updateAdminDetails');

        if ($request->isMethod('post')) {
            $data = $request->all();
            $imageName = Auth::guard('admin')->user()->image == null ? null : Auth::guard('admin')->user()->image;
            $rules = [
                'name' => 'required||regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|min:11|numeric',
            ];

            $customMessages = [
                'name.required' => 'Admin name is required',
                'name.regex' => 'Admin name is not valid',
            ];

            $this->validate($request, $rules, $customMessages);

            try {
                $result = DB::transaction(function () use ($request, $data, $imageName) {

                    //Upload Admin Photo

                    if (\Request::hasFile('image')) {

                        $image_tmp = $request->file('image');

                        if ($image_tmp->isValid()) {
                            //Get Image Extension
                            $extension = $image_tmp->getClientOriginalExtension();
                            //Generate New Image Name
                            $imageName = rand(11, 99999) . '.' . $extension;
                            $imagePath = 'images/admin/';
                            $request->file('image')->move($imagePath, $imageName);

                        }
                    }

                    //Update Admin Details

                    Admin::where('id', Auth::guard('admin')->user()->id)->first()->update(
                        [
                            'name' => $data['name'],
                            'mobile' => $data['mobile'],
                            'image' => $imageName,
                        ]);

                });
                // redirect the page
                return redirect()->back()->with('success_message', 'Admin details updated successfully !');

            } catch (\Exception$e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage() . $e->getLine()]);
            }

        }

        return view('admin.settings.update_admin_details');
    }

    //End update admin details coding

    //start update Vendor details coding

    public function updateVendorDetails($slug, Request $request)
    {

        if ($slug == 'personal') {
            Session::put('page', 'update_personal_details');
            if (\Request::isMethod('post')) {
                //  dd($request->all());
                $data = $request->all();
                $imageName = Auth::guard('admin')->user()->image == null ? null : Auth::guard('admin')->user()->image;
                $rules = [
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    // 'email'=>'required|email|unique:vendor',
                    'mobile' => 'required|min:11|numeric',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'pincode' => 'required',
                ];

                $customMessages = [
                    'name.required' => 'Vendor name is required',
                    'name.regex' => 'Vendor name is not valid',
                    'email.required' => "Venodr email is required",
                    'email.email' => 'Vendor email format is invalid',
                    'email.unique' => 'Vendor email is already register',
                    'address.required' => 'Vendor addres is required',
                ];
                $this->validate($request, $rules, $customMessages);

                try {
                    $result = DB::transaction(function () use ($request, $data, $imageName) {

                        //Upload Admin Photo

                        if (\Request::hasFile('image')) {

                            $image_tmp = $request->file('image');

                            if ($image_tmp->isValid()) {
                                //Get Image Extension
                                $extension = $image_tmp->getClientOriginalExtension();
                                //Generate New Image Name
                                $imageName = rand(11, 99999) . '.' . $extension;
                                $imagePath = 'images/venodr/';
                                $request->file('image')->move($imagePath, $imageName);

                            }
                        }

                        //Update in  Admin table vendor details  Details

                        Admin::where('id', Auth::guard('admin')->user()->id)->first()->update(
                            [
                                'name' => $data['name'],
                                'mobile' => $data['mobile'],
                                'image' => $imageName,
                            ]);

                        //Update in vendor table vendor details

                        Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->update([
                            'email' => $data['email'],
                            'name' => $data['name'],
                            'mobile' => $data['mobile'],
                            'address' => $data['address'],

                            'city' => $data['city'],
                            'state' => $data['state'],
                            'country' => $data['country'],
                            'pincode' => $data['pincode'],
                            // 'image'=>$imageName,
                        ]);

                    });
                    // redirect the page
                    return redirect()->back()->with('success_message', 'Vednor details updated successfully !');

                } catch (\Exception$e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage() . $e->getLine()]);
                }

            }

            //Send personal data in view
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            //dd($vendorDetails);

        } else if ($slug == 'business') {
            Session::put('page', 'update_business_details');

            if (\Request::isMethod('post')) {
                //dd($request->all());
                //  dd($request->all());
                $data = $request->all();
                // $imageName = Auth::guard('admin')->user()->image == null ? null :Auth::guard('admin')->user()->image ;
                $address_proof_image = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
                $address_proof_image = $address_proof_image['address_proof_image'] == null ? null : $address_proof_image['address_proof_image'];
                // dd($address_proof_image);
                $rules = [
                    'shop_name' => 'required',
                    'shop_address' => 'required',
                    // 'email'=>'required|email|unique:vendor',
                    'shop_mobile' => 'required|min:11|numeric',
                    'shop_address' => 'required',
                    'shop_city' => 'required',
                    'shop_state' => 'required',
                    'shop_country' => 'required',
                    'business_license_number' => 'required',
                    'pan_number' => 'required',
                ];

                $customMessages = [
                    'shop_name.required' => 'Shop name is required',
                    'shop_address.required' => 'Shop address is required',
                ];
                $this->validate($request, $rules, $customMessages);

                try {
                    $result = DB::transaction(function () use ($request, $data, $address_proof_image) {

                        //Upload Admin Photo

                        if (\Request::hasFile('address_proof_image')) {

                            $image_tmp = $request->file('address_proof_image');

                            if ($image_tmp->isValid()) {
                                //Get Image Extension
                                $extension = $image_tmp->getClientOriginalExtension();
                                //Generate New Image Name
                                $address_proof_image = rand(11, 99999) . '.' . $extension;
                                $imagePath = 'images/shop_images/';
                                $request->file('address_proof_image')->move($imagePath, $address_proof_image);

                            }
                        }

                        //Update in  Admin table vendor details  Details

                        VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->update(
                            [

                                'shop_name' => $data['shop_name'],
                                'shop_address' => $data['shop_address'],
                                'shop_city' => $data['shop_city'],
                                'shop_state' => $data['shop_state'],
                                'shop_country' => $data['shop_country'],
                                'shop_pincode' => $data['shop_pincode'],
                                'shop_mobile' => $data['shop_mobile'],
                                'shop_email' => $data['shop_email'],
                                'business_license_number' => $data['business_license_number'],
                                'gst_number' => $data['gst_number'],
                                'pan_number' => $data['pan_number'],
                                'address_proof_image' => $address_proof_image,
                            ]);

                    });
                    // redirect the page
                    return redirect()->back()->with('success_message', 'Vednor Business details has  been updated successfully !');

                } catch (\Exception$e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage() . $e->getLine()]);
                }

            }

            //Send business data in view
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            //dd($vendorDetails);
        } else if ($slug == 'bank') {
            Session::put('page', 'update_bank_details');

            if (\Request::isMethod('post')) {
                // dd($request->all());
                $data = $request->all();
                $rules = [
                    'account_holder_name' => 'required',
                    'bank_name' => 'required',
                    'account_number' => 'required',
                    'bank_ifsc_code' => 'required',
                ];

                $customMessages = [
                    'account_holder_name.required' => 'Account holder name is required',
                    'bank_name.required' => 'Bank named is required',
                    'account_number.required' => 'Account number is required',
                    'bank_ifsc_code.required' => ' Bank IFSC code is required',
                ];
                $this->validate($request, $rules, $customMessages);

                try {
                    $result = DB::transaction(function () use ($data) {
                        VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->update([
                            'account_holder_name' => $data['account_holder_name'],
                            'bank_name' => $data['bank_name'],
                            'account_number' => $data['account_number'],
                            'bank_ifsc_code' => $data['bank_ifsc_code'],
                        ]);

                        // redirect the page
                        return redirect()->back()->with('success_message', 'Vednor Bank details has  been updated successfully !');
                    });
                } catch (\Exception$e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage() . $e->getLine()]);
                }

            }

            //Send bank data in view
            $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            //dd($vendorDetails);
        }
         
        //fetch all countries name which status is active

         $countries  =  \DB::table('countries')->where('status',1)->get()->toArray();
        // dd($countries);

        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails','countries'));
    }

//End update vendor details coding

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            //Add rules
            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ];

            //Add custom message
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
                'password.min' => 'Minimum Password 6 char is required',
            ];

            $this->validate($request, $rules, $customMessages);

            //  $this->validate($request, [
            // 'email'   => 'required|email',
            // 'password' => 'required|min:6'
            // ]);

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                return redirect()->intended('/admin/dashboard');

            }
            return back()->with('error', 'Invalid email or password !');

        }
        return view('admin.login');
    }

//20:- Start View admins / Subadmins / Vendors

    public function admins($type = null)
    {
        $admins = Admin::query();

        if (!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type) . 's';
            Session::put('page', 'view_' . strtolower($title));
            //dd($admins);
        } else {
            $title = 'All Admins/Subadmins/Vendors';
            Session::put('page', 'view_all');

        }
        $admins = $admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins', 'title'));
    }

//20:- End View admins / Subadmins / Vendors

//21 :- Start viewVendorDetails

    public function viewVendorDetails($id)
    {
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        // dd(json_encode($vendorDetails));
        $vendorDetails = json_decode(json_encode($vendorDetails), true);
        // dd($vendorDetails);
        return view('admin.admins.view_vedor_details')->with(compact('vendorDetails'));
    }

//21 :- End viewVendorDetails

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    /**
     * 22 : Update admin status
     */

    public function updatedAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;

            if ($data["status"] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Admin::where('id', $data['admin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'admin_id' => $data['admin_id']]);

        }
    }

}
