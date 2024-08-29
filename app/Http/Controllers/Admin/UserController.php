<?php

namespace App\Http\Controllers\Admin;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter                = [];
        $filter['name']        = $request->name;
        $filter['email']       = $request->email;
        $filter['phone']       = $request->phone;
        $filter['created_at']  = $request->created_at;

        $users                 = Administrator::with('roles');
       /* $users                 = isset($filter['name']) ? $users->where('name', 'LIKE', '%'.$filter['name'].'%') : $users;
        $users                 = isset($filter['email']) ? $users->where('email', 'LIKE', '%'.$filter['email'].'%') : $users;
        $users                 = isset($filter['phone']) ? $users->where('phone', 'LIKE', '%'.$filter['phone'].'%') : $users;
        $users                 = isset($filter['created_at']) ? $users->whereDate('created_at', $filter['created_at']) : $users;*/
        $users                 = $users->orderBy('id', 'desc')->paginate(20);

        return view('admin.user-management.users.list', compact('users'));
    }

    public function onlineUsers(Request $request)
    {

        $filterOnlineStatus = $request->filter_online_status ?? null;
    
        if ($filterOnlineStatus === 'online') {
            $users = Administrator::where(function ($query) {
                $query->whereNotNull('last_seen')
                    ->where('last_seen', '>', now()->subMinutes(15));
            })->latest()->get();
        } elseif ($filterOnlineStatus === 'offline') {
            $users = Administrator::where(function ($query) {
                $query->whereNull('last_seen')
                    ->orWhere('last_seen', '<=', now()->subMinutes(15));
            })->latest()->get();
        } else {
            $users = Administrator::latest()->get();
        }                                   
    
        return view('admin.user-management.users.online-list', compact('users','filterOnlineStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(['id', 'name']);
        return view('admin.user-management.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = Administrator::create($input);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('admin.users.index')->with('success', 'User saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $user)
    {
        $roles = Role::get(['id', 'name']);
        return view('admin.user-management.users.edit', compact('roles', $user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrator $user)
    {              
        $roles = Role::get(['id', 'name']);              
        return view('admin.user-management.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrator $user)
    {                            
        $this->validate($request,[
            'firstname' => 'required',
            'email' => 'required|email|unique:administrators,email,'.$user->id,
            'roles' => 'required'
        ]);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
              
        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated Successfully');
    }

    public function toggleStatus(Request $request){
        Administrator::where('id', $request->user_id)->update(['is_active' => $request->is_active]);
        return response()->json(['message', 'Status upated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted Successfully');
    }
}
