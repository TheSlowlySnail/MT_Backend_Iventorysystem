<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function postPerson(Request $request)
    {
        $person = new Person();

        $person->personid = $request->input('personid');
        $person->firstname = $request->input('firstname');
        $person->lastname = $request->input('lastname');
        $person->annotion = $request->input('anotation');
        $person->email = $request->input('email');


        $person->save();
        return response()->json(['qutoe' => $person], 201);

    }

    public function getPersons(){
        $persons = Person::all();
        $response = [
            'persons' => $persons
        ];
        return response()->json($response,200);
    }

    public function putPerson(Request $request, $personid){
        $person = Person::find($personid);
        if(!$person){
            return response()->json(['message'=>'Document not found'], 400);

        }
        $person->firstname = $request->input('firstname');
        $person->lastname = $request->input('lastname');
        $person->annotion = $request->input('anotation');
        $person->email = $request->input('email');
        $person->save();
        return response()->json(['person' => $person], 200);
    }

    public function deletePerson($personid){
        $person = Person::find($personid);
        $person->delete();
        return response()->json(['message' => 'Person Deleted'],200);

    }
}
