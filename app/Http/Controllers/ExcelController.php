<?php



namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class MyReadFilter implements IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        // Read title row and rows 20 - 30
        if (($row >= 1 && $row <= 1000)) {
            if (in_array($column,range('A','G'))) {
                return true;
            }
        }
        return false;
    }
}

class ExcelController extends Controller
{
    //
    public function insertItemsInDatabase()
    {
        $inputFileName = public_path() . '\barcode.xlsx';
        $inputFileType = IOFactory::identify($inputFileName);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();


        //
        //
        $reader->setReadFilter(new MyReadFilter());


        $spreadsheet = $reader->load($inputFileName);

        //$spreadsheet = IOFactory::load($inputFileName);
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
                if($name == 'Artikel'){
                    continue;
                }


                $barcode = $row['B'];


                $description = $row['C'];


                switch ($row['D']){
                    case 'Living / Media':
                        $room = 'multimedia';
                        break;
                    case 'Küche':
                        $room = "kitchen";
                        break;
                    case  'Bad':
                        $room = "bath";
                        break;
                    default:
                        $room = $row['D'];
                        break;
                }


//                switch ($row['F']){
//                    case 'Zubehör':
//                        $type = 'equipment';
//                        break;
//                    case 'Lautsprecher':
//                        $type = "speaker";
//                        break;
//                    case  'Bedienelement':
//                        $type = "operating element";
//                        break;
//                    case  'Gerät':
//                        $type = "device";
//                        break;
//                    case  'Leuchtmittel':
//                        $type = "bulb";
//                        break;
//                    case  'Mikrofon':
//                        $type = "microphone";
//                        break;
//                    case  'Sensor':
//                        $type = "sensor";
//                        break;
//                    case  'Kamera':
//                        $type = "camera";
//                        break;
//                    case  'Steckdose':
//                        $type = "socket";
//                        break;
//                    case  'Buch':
//                        $type = "book";
//                        break;
//                    default:
//                        $type = $row['F'];
//                        break;
//                }


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
                else {
                    $type = $row['F'];
                }






                if($row['G'] == 'verbaut'){
                    $status = 'installed';
                }
                elseif ($row['G'] =='verpackt'){
                    $status = "packeged";
                }


            if (DB::table('items')->where('barcode', '=', $barcode)->count() > 0) {
                continue;

            }
            else{
                DB::table('items')->insert(
                    ['barcode'=> $barcode, 'name' => $name, 'description' => $description,
                        'type' => $type, 'room' => $room, 'status' => $status]
                );
            }



        }

        return response()->json($sheetData, 200);

    }
}
