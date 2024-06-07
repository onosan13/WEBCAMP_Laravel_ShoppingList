<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;

class AdminUserController extends Controller
{
    public function list(){
        $group_by_column = ['users.id', 'users.name'];
        $list = UserModel::select($group_by_column)
            ->selectRaw('count(completed_shopping_lists.id) AS shopping_num')
            ->leftJoin('completed_shopping_lists', 'users.id', '=', 'completed_shopping_lists.user_id')
            ->groupBy($group_by_column)
            ->get();
        return view('admin.user_list', ['users'=>$list]);
    }
}
