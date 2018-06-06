<?php



namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ExcelController extends Controller
{
    //
    public function insertItemsInDatabase()
    {
        $inputFileName = public_path() . '\barcode.xls';

        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $row){
            $name ="";
            $barcode ="";
            $description ="";
            $room ="";
            $status ="";
            $type ="";
            $annotation ="";
            $image ="";
            $lend ="";
            $manufactor ="";

                $name = $row['A'];


                $barcode = $row['B'];


                $description = $row['C'];



                if($row['D'] == 'Living / Media'){
                    $room = 'multimedia';
                }
                elseif ($row['D'] =='Küche'){
                    $room = "kitchen";
                }
                elseif ($row['D'] =='Bad'){
                    $room = "bath";
                }


                if($row['F'] == 'Zubehör'){
                    $type = 'equipment';
                }
                elseif ($row['F'] =='Lautsprecher'){
                    $type = "speaker";
                }
                elseif ($row['F'] =='Bedienelement'){
                    $type = "operating element";
                }
                elseif ($row['F'] =='Gerät'){
                    $type = "device";
                }
                elseif ($row['F'] =='Leuchtmittel'){
                    $type = "bulb";
                }
                elseif ($row['F'] =='Mikrofon'){
                    $type = "microphone";
                }
                elseif ($row['F'] =='Sensor'){
                    $type = "sensor";
                }
                elseif ($row['F'] =='Kamera'){
                    $type = "camera";
                }
                elseif ($row['F'] =='Steckdose'){
                    $type = "socket";
                }
                elseif ($row['F'] =='Buch'){
                    $type = "book";
                }






                if($row['G'] == 'verbaut'){
                    $type = 'installed';
                }
                elseif ($row['G'] =='verpackt'){
                    $type = "packeged";
                }


            DB::table('items')->insert(
                ['barcode'=> $barcode, 'name' => $name, 'description' => $description,
                    'type' => $type, 'room' => $room, 'status' => $status]
            );

        }

        return response()->json($sheetData, 200);

    }
}
