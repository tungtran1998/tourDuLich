<?php

namespace App\Exports;

use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ToursExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.exports.tours', [
            'tours' => Tour::all()
        ]);
    }
}
