<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class InventarController extends Controller
{
    public function postItem(Request $request)
    {
        $item = new Item();
        $item->barcode = $request->input('barcode');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->type = $request->input('type');
        $item->room = $request->input('room');
        $item->status = $request->input('status');
        $item->annotation = $request->input('annotation');
        $item->image = $request->input('image');
        $item->lend = $request->input('lend');
        $item->manufactor = $request->input('manufactor');
        $item->save();
        return response()->json($item, 201);

    }

    public function getItems(){
        $items = Item::all();
        $response = [
             'items' => $items
        ];
        return response()->json($response,200);
    }

    public function putItem(Request $request, $barcode){
        $item = Item::find("IN SH " . $barcode);
        if(!$item){
            return response()->json(['message'=>'Document not found Barcode: '.$barcode], 400);

        }
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->type = $request->input('type');
        $item->room = $request->input('room');
        $item->status = $request->input('status');
        $item->annotation = $request->input('annotation');
        $item->image = $request->input('image');
        $item->lend = $request->input('lend');
        $item->manufactor = $request->input('manufactor');
        $item->save();
        return response()->json(['item' => $item], 200);
    }

    public function deleteItem($item){
        $item = Item::find("IN SH " . $item);
        $item->delete();
        return response()->json(['message' => 'Deleted'],200);

    }


}
