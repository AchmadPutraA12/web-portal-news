<?php

namespace App\Datatables\Admin;

use Yajra\DataTables\DataTables;

class UserDataTable
{
    public static function make($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }
}
