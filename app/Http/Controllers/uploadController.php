<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class uploadController extends Controller
{
    public function store(request $request){
        //
        $image = $request->file('image');
        $destinationPath = public_path('/images');
        $image->move($destinationPath,$image->getClientOriginalName());
        //return $request->file('image')->move(public_path('images'));

    }

    public function storeExcelTable(request $request){
        //

        $excelController = new ExcelController();

        $image = $request->file('file');
        $destinationPath = public_path('/table');
        $image->move($destinationPath,'barcode.xlsx');

        $excelController->insertItemsInDatabase();
        //return $request->file('image')->move(public_path('images'));

    }
}
