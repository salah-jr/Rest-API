<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Validator;
class ItemController extends Controller
{
   
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

   

    
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'text' => 'required'
       ]);
       if($validator->fails()){
           $response = array('response' => $validator->messages(), 'success' => false);
           return $response;
       }
       else{
           $item = new Item;
           $item->text = $request->input('text');
           $item->body = $request->input('body');
           $item->save();
           return response()->json($item);
       }
    }

    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

  


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'text' => 'required'
       ]);
       if($validator->fails()){
           $response = array('response' => $validator->messages(), 'success' => false);
           return $response;
       }
       else{
           $item = Item::find($id);
           $item->text = $request->input('text');
           $item->body = $request->input('body');
           $item->save();
           return response()->json($item);
       }
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
    }
}
