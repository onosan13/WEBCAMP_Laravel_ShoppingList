<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Completed_shopping_lists as CompletedModel;
use Illuminate\Support\Facades\Auth;



class CompletedShoppingListController extends Controller
{
    public function list(){
        $per_page = 5;
        $comp_list = CompletedModel::where('user_id', Auth::id())
            ->orderBy('name')
            ->orderBy('created_at')
            ->paginate($per_page);
        return view('shopping_list.completed_list', ['comp_lists'=>$comp_list]);
    }
}
