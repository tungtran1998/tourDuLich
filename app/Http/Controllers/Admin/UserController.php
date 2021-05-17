<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BookTour;
use Auth;



class UserController extends Controller
{
    protected $userRP;

    public function __construct(UserInterface $userInterface)
    {
        $this->middleware('permission:user-list|user-edit|user-delete|user-show|user-export', ['only' => ['index']]);
        $this->middleware('permission:user-export', ['only' => ['export']]);
        $this->middleware('permission:user-edit', ['only' => ['editStatus']]);
        $this->middleware('permission:user-show', ['only' => ['show']]);
        $this->userRP = $userInterface;
    }
    public function index()
    {
    	$users = $this->userRP->getAll();
    	return view('admin.user.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userRP->find($id);
        $tour = BookTour::where('user_id',$user->id)->where('isdeleted',0)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->get();
        return view('admin.user.detail', compact('user','tour'));
    }

    public function editStatus(Request $request, $id)
    {
        $user = $this->userRP->find($id);
        try {
            if ($request->status == 0) {
                $user->status = 0;
            } elseif ($request->status == 1) {
                $user->status = 1;
            }
            $user->update();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        $notification = array(
                'message' => trans('message.success-edit'),
                'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy(Request $request)
    {
    	
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
