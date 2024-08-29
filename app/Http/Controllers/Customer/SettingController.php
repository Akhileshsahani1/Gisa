<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function getProfile(){
        $customer = Customer::find(Auth::user()->id);

       return view('customer.settings.my-account', compact('customer'));
    }
    public function getChangePassword(){

        return view('customer.settings.change-password');
    }
    public function updatePassword(Request $request){
         $id         = Auth::user()->id;

        $this->validate($request, [
            'current_password'      => 'required',
            'new_password'          => 'required|min:8|confirmed',

        ]);

        $customer                       = Customer::find($id);

        if (Hash::check($request->get('current_password'), $customer->password)) {

            $customer->password = Hash::make($request->new_password);
            $customer->save();

            return redirect()->route('customer.change-password')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('customer.change-password')->with('success', 'Password changed successfully');
    }
}
