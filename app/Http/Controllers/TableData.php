<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelEnso\Tables\app\Traits\Data;
use LaravelEnso\Permissions\app\Tables\Builders\PermissionTable;

class TableData extends Controller
{
    use Data;

    protected $tableClass = PermissionTable::class;
}
