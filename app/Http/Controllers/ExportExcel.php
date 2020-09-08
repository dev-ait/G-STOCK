<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelEnso\Tables\app\Traits\Excel;
use LaravelEnso\Permissions\app\Tables\Builders\PermissionTable;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = PermissionTable::class;
}
