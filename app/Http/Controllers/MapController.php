<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function take(){
        $maps = DB::table('maps')
            ->where('user_id', 1)
            ->get();
        return $maps;
    }
}
