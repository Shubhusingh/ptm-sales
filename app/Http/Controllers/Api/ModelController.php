<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppModel;

class ModelController extends Controller
{
public function appmodel(){
$permission=AppModel::where('status',1)->get();
return response()->json(['modul'=>$permission]);
}

}
