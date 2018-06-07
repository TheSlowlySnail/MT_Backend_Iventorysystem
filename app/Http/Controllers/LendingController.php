<?php

namespace App\Http\Controllers;

use App\Lend;
use Illuminate\Http\Request;

class LendingController extends Controller
{

    public function postLend(Request $request)
    {
        $lend = new Lend();
        $lend->barcode = $request->input('barcode');
        $lend->personid = $request->input('personid');
        $lend->personid = $request->input('annotation');
        $lend->startdate = $request->input('startdate');
        $lend->enddate = $request->input('enddate');

        $lend->save();
        return response()->json(['quote' => $lend], 201);

    }

    public function getLends(){
        $lends = Lend::all();
        $response = [
            'lends' => $lends
        ];
        return response()->json($response,200);
    }

    public function putLend(Request $request, $id){
        $lend = Lend::find($id);
        if(!$lend){
            return response()->json(['message'=>'Document not found'], 400);

        }
        $lend->personid = $request->input('personid');
        $lend->startdate = $request->input('startdate');
        $lend->enddate = $request->input('enddate');
        $lend->save();
        return response()->json(['lend' => $lend], 200);
    }

    public function deleteLend($id){
        $lend = Lend::find($id);
        $lend->delete();
        return response()->json(['message' => 'Deleted'],200);

    }
    //
}
