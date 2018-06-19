<?php

namespace App\Http\Controllers;

use App\Lend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class LendingController extends Controller
{

    public function postLend(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'itemid' => 'required|numeric',
            'personid' => 'required|numeric',
            'annotation' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $lend = new Lend();
        $lend->itemid = $request->input('itemid');
        $lend->personid = $request->input('personid');
        $lend->annotation = $request->input('annotation');
//        $lend->startdate = $request->input('startdate');
//        $lend->enddate = $request->input('enddate');
        $startDOI = new \DateTime();

$lend->startdate = new Carbon($request->input('startdate'));
//var_dump($lend->startdate);
//$startimestamp =  $lend->startdate->getTimestamp();
//var_dump($lend->enddate);


$lend->enddate = new Carbon($request->input('enddate'));
$lend->enddate->addHours(3);

        $lend->save();
        return response()->json(['quote' => $lend], 201);

    }

    public function getLends(){
        $lends = DB::table('lending')->join('items', 'lending.itemid', '=', 'items.id' )
            ->join('users','lending.personid', '=' ,'users.personid')
            ->select('lending.*', 'items.barcode', 'items.name','users.firstname', 'users.lastname')->get();
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

    public function getLendsPerPersonId(){
//        $lends = DB::table('lending')->where('personid', '=', request()->pid)->get();
        $lends = DB::table('lending')->join('items', 'lending.itemid', '=', 'items.id' )
            ->select('lending.*', 'items.barcode', 'items.name')->where('personid', '=', request()->pid)->get();
        return response()->json($lends, 200);
    }
    //
}
