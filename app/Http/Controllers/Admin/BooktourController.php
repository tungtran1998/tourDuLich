<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\BookTour\BookTourInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\booktour;
use App\Models\booktourDetail;
use App\Models\booktour_Cost;
use App\Exports\BooktoursExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;



class BooktourController extends Controller
{

    protected $booktourRP;

    public function __construct(BookTourInterface $booktourInterface)
    {
        $this->middleware('permission:booktour-list|booktour-edit|booktour-export', ['only' => ['index']]);
        $this->middleware('permission:booktour-export', ['only' => ['index','export']]);
        $this->middleware('permission:booktour-edit', ['only' => ['show','update']]);

        $this->booktourRP = $booktourInterface;
    }

    public function index()
    {
        $booktour = $this->booktourRP->getAllBookTour();
        return view('admin.booktour.index',compact('booktour'));
    }

    public function indexCheckout()
    {
       
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {

        $book_tour = $this->booktourRP->find($id);
     
        return view('admin.booktour.detail', compact('book_tour'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $book_tour = $this->booktourRP->find($id);
        $book_tour->status = $request->status;
        $result = $this->booktourRP->update($book_tour->id, $book_tour->toArray());

        if ($result) { 
            return back()->with('message', trans('message.success-edit'));
        } else {
             return back()->with('message',trans('message.update_error'));
        }
        
    }


    public function destroy(Request $request)
    {
        
    }

    public function export() 
    {
        return Excel::download(new BooktoursExport, 'booktours.xlsx');
    }
}
