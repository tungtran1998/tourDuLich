<?php

namespace App\Exports;

use App\Models\Booktour;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BooktoursExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.exports.booktours', [
            'booktours' => Booktour::all()
        ]);
    }
}
