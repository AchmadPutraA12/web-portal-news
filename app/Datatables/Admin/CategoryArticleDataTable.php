<?php

namespace App\Datatables\Admin;

use Yajra\DataTables\DataTables;

class CategoryArticleDataTable
{
    public static function make($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }
}
