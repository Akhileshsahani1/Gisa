<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function companyDetailsForm()
    {
        $company        = Company::find(1);
        $company->logo  = isset($company->logo) ? asset('storage/uploads/company/' . $company->logo) : URL::to('assets/images/gisa-logo.png');
        return view('admin.settings.company-details', compact('company'));
    }

    public function companyDetails(Request $request)
    {

        $this->validate($request, [
            'company'           => 'required',
            'email'             => 'required',
            'phone'             => 'required',
            'whats_app'         => 'required',
            'address_line_1'    => 'required',
            'city'              => 'required',
            'zipcode'           => 'required',
            'state'             => 'required',
            'country'           => 'required',
            'gstin'             => 'required',
        ]);

        Company::find(1)->update([
            'company'                    => $request->company,
            'email'                      => $request->email,
            'dialcode'                   => $request->dialcode,
            'phone'                      => $request->phone,
            'whats_app_dialcode'         => $request->whats_app_dialcode,
            'whats_app'                  => $request->whats_app,
            'address_line_1'             => $request->address_line_1,
            'address_line_2'             => $request->address_line_2,
            'city'                       => $request->city,
            'zipcode'                    => $request->zipcode,
            'state'                      => $request->state,
            'iso2'                       => $request->country,
            'gstin'                      => $request->gstin,
        ]);

        if ($request->hasfile('logo')) {

            $image      = $request->file('logo');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/company/', $name, 'public');

            if (isset(Company::find(1)->logo)) {

                $path   = 'public/uploads/company/' . Company::find(1)->logo;

                Storage::delete($path);
            }

            Company::find(1)->update(['logo' => $name]);
        }


        return redirect()->route('admin.company-details.form')->with('success', 'Company details updated successfully');
    }

    public function usersList(Request $request)
    {
        $users = Administrator::where('id', '!=', 1)->paginate(10);
        if (isset($users)) {
            foreach ($users as $user) {
                $user->avatar = !is_null($user->avatar) ? asset('storage/uploads/users/' . $user->id . '/' . $user->avatar) : asset('assets/images/users/avatar.png');
            }
        }
        return view('admin.settings.team.team', compact('users'));
    }
    public function userEdit($id)
    {
        $admin = Administrator::find($id);
        $admin->avatar = !is_null($admin->avatar) ? asset('storage/uploads/users/' . $admin->id . '/' . $admin->avatar) : asset('assets/images/users/avatar.png');
        return view('admin.settings.team.edit', compact('admin'));
    }
    public function userUpdate(Request $request, $id)
    {

        $admin = Administrator::find($id);
        $admin->firstname = $request->firstname;
        $admin->lastname  = $request->lastname;
        $admin->status    = $request->status;
        $admin->phone     = $request->phone;
        $admin->email     = $request->email;

        if ($request->hasfile('avatar')) {

            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $file->storeAs('uploads/users/' . $admin->id, $name, 'public');
            $admin->avatar = $name;
        }
        $admin->save();

        return redirect()->route('admin.users.list')->with('success', 'User updated successfully');
    }
    public function deleteUser(Request $request)
    {
        Administrator::find($request->id)->delete();

        return redirect()->route('admin.users.list')->with('success', 'User deleted successfully');
    }
    public function createUserForm(Request $request)
    {
        return view('admin.settings.team.create');
    }
    public function createUser(Request $request)
    {

        $admin = new Administrator();
        $admin->firstname  = $request->firstname;
        $admin->lastname  = $request->lastname;
        $admin->status    = $request->status;
        $admin->phone     = $request->phone;
        $admin->email     = $request->email;
        $admin->save();

        if ($request->hasfile('avatar')) {

            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $file->storeAs('uploads/users/' . $admin->id, $name, 'public');

           Administrator::where('id',$admin->id)->update(['avatar'=>$name]);

        }

        return redirect()->route('admin.users.list')->with('success', 'User created successfully');
    }
}
