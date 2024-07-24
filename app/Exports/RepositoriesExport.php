<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RepositoriesExport implements  FromView
{
    protected $repositories;
    function __construct($repositories)
    {
        $this->repositories = $repositories;
    }
    public function view(): View
{
    return view('repositories._export', [
        'repositories' => $this->repositories
    ]);
}
}
