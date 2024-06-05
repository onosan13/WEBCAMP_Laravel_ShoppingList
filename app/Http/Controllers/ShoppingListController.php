<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Models\shopping_list as shopping_listModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Completed_shopping_lists as CompletedModel;
use Illuminate\Support\Facades\DB;

class ShoppingListController extends Controller
{
    public function list(){
        $per_page = 5;
        $list = shopping_listModel::where('user_id', Auth::id())
            ->orderBY('created_at', 'ASC')
            ->paginate($per_page);
        return view('shopping_list.list',['lists'=>$list]);
    }

    public function register(StoreRequest $request){
        $datum = $request->validated();
        $datum['user_id'] = Auth::id();
        try{
            $r = shopping_listModel::create($datum);
        }catch(\Throwable $e){
            echo $e->getMessage();
            exit;
        }
        $request->session()->flash('list_register_success', true);
        return redirect('/shopping_list/list');
    }

    public function delete(Request $request, $shopping_list_id){
        $list_item = $this->getShoppingListModel($shopping_list_id);
        if($list_item !== null){
            $list_item->delete();
            $request->session()->flash('shopping_list_delete', true);
        }
        return redirect('/shopping_list/list');
    }

    public function complete(Request $request, $shopping_list_id){
        try{
            DB::beginTransaction();
            $list_item = $this->getShoppingListModel($shopping_list_id);
            if($list_item === null){
                throw new \Exception('');
            }
            $list_item->delete();
            $list_array = $list_item->toArray();
            unset($dask_datum['created_at']);
            unset($dask_datum['updated_at']);
            $r = CompletedModel::create($list_array);
            if($r === null){
                throw new \Exception('');
            }
            DB::commit();
            $request->session()->flash('shopping_complete_succes', true);
        }catch(\Throwable $e){
            DB::rollBack();
            $request->session()->flash('shopping_complete_false', true);
        }
        return redirect('/shopping_list/list');
    }

    /**
     * 単一のレコードのモデルを取得
     */
    protected function getShoppingListModel($shopping_list_id){
        $list_item = shopping_listModel::find($shopping_list_id);
        if(!$list_item){
            return null;
        }
        if($list_item->user_id !== Auth::id()){
            return null;
        }
        return $list_item;
    }

    /**
     * 単一のレコードを表示
     */
    protected function singleShoppingRender($shopping_list_id, $template_name){
        $list_item = $this->getShoppingListModel($shopping_list_id);
        if($list_item === null){
            return redirect('/shopping_list/list');
        }
        return view($template_name, ['list_item'=>$list_item]);
    }
}
