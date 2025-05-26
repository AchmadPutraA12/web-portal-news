<?php

namespace App\Datatables\Admin;

use Yajra\DataTables\DataTables;

class ArticleDataTable
{
    public static function make($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('is_verified', function ($row) {
                return $row->is_verified
                    ? '<span class="badge bg-success">Disetujui</span>'
                    : '<span class="badge bg-secondary">Belum Disetujui</span>';
            })
            ->rawColumns(['is_verified'])
            ->make(true);
    }
}
