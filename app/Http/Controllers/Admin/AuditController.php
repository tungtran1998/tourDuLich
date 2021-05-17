<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Audit;

class AuditController extends Controller
{
    public function __construct(){
        $this->middleware('permission:audit-list|audit-show', ['only' => ['index']]);
        $this->middleware('permission:audit-show', ['only' => ['show']]);  
    }

    public function index()
    {
    	$audits = \OwenIt\Auditing\Models\Audit::with('user')->where('user_id','!=', null)
                ->orderBy('created_at', 'desc')     
                ->get();
    	return view('admin.audit.index',compact('audits'));
    }

    public function show($id)
    {
    	$audits = \OwenIt\Auditing\Models\Audit::where('id',$id)->get();
        return view('admin.audit.show',compact('audits'));
    }
}
