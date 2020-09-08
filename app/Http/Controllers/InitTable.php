<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelEnso\Tables\app\Traits\Init;
use LaravelEnso\Permissions\app\Tables\Builders\PermissionTable;

class InitTable extends Controller
{
    use Init;
    protected $tableClass = PermissionTable::class;
}
