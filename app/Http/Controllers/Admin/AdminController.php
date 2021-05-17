<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\AdminInterface;
use App\Models\Admin;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use App\Http\Requests\ChangePasswordRequest;

class AdminController extends Controller
{
    protected $adminRP;

    public function __construct(AdminInterface $adminInterface)
    {
        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete|admin-show', ['only' => ['index','store']]);
        $this->middleware('permission:admin-create', ['only' => ['create','store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
        $this->middleware('permission:admin-show', ['only' => ['show']]);
        $this->adminRP = $adminInterface;
    }

    public function index()
    {
    	$admins = $this->adminRP->getAll();
    	return view('admin.admin.index', compact('admins'));
    }

    public function show($id)
    {
        $admin = $this->adminRP->find($id);
        return view('admin.admin.detail', compact('admin'));
    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.admin.create',compact('roles'));
    }

    public function store(Request $request)
    {

        $datapass = Hash::make($request->password);
        
        $data = new Admin([
            'email' => $request->email,
            'name'=> $request->name,
            'password' => bcrypt($request->password),
            'isdeleted' => false,
        ]);
        $result = $this->adminRP->create($data->toArray());
        $result->assignRole($request->roles);
        if ($result){

            return redirect()->route('admin.index')->with('message', trans('message.success-create'));
        }else{
            return back()->with('message', trans('message.save_error'));
        }
    }
    public function edit($id)
    {
        $user = $this->adminRP->find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.admin.edit',compact('user','roles','userRole'));
    }


    public function update(Request $request, $id)
    {
        
        $user = $this->adminRP->find($id);
        $user->email = $request->email;
        $user->name = $request->name;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $result = $this->adminRP->update($id, $user->toArray());
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $result->assignRole($request->roles);
        if ($result){
            return redirect()->route('admin.index')->with('message', trans('message.success-edit'));
        }else{
            return back()->with('message',trans('message.update_error'));
        }
        
    }


    public function destroy(Request $request)
    {
        $admin = $this->adminRP->find($request->id);
        $admin->isdeleted = true;

        $result = $this->adminRP->update($admin->id, $admin->toArray());
        if ($result) { 
            return back()->with('message', trans('message.success-delete'));
        } else {
            return back()->with('message',trans('message.delete_failse'));
        }
    }

    public function adminProfile($id){
        $admin =$this->adminRP->find(Auth::id());
        return view('admin.admin.profile',compact('admin'));
    }

    public function postchange(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::guard('admin')->user()->password))) {
             $notification1 = array(
            'message' => trans('allclient.changepassword'),
            'alert-type' => 'info'
            );
            return redirect()->back()->with($notification1);
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            $notification2 = array(
            'message' => trans('allclient.samepassword'),
            'alert-type' => 'info'
            );
            return redirect()->back()->with($notification2);
        }

        $user = Auth::guard('admin')->user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        $notification3 = array(
            'message' => trans('allclient.success'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification3);
    }
}
