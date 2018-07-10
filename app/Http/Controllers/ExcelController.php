<?php



namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $inputFileName = public_path() . '\table\barcode.xlsx';
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

    public function exportItemsInXml(){

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Artikel');
        $sheet->setCellValue('B1', 'Barcode');
        $sheet->setCellValue('C1', 'Bezeichnung');
        $sheet->setCellValue('C1', 'Bezeichnung');
        $sheet->setCellValue('D1', 'Einsatzbereich');
        $sheet->setCellValue('E1', 'Position');
        $sheet->setCellValue('F1', 'Kategorie');
        $sheet->setCellValue('G1', 'Status');

        $items = Item::all();

        $exportFileName = "barcode_export.xlsx";

        $index = 2;
        foreach ($items as $item){
            $sheet->setCellValue('A' . $index, $item->name);
            $sheet->setCellValue('B'  . $index, $item->barcode);
            $sheet->setCellValue('C' . $index, $item->description);

            $sheet->setCellValue('D' . $index, $item->room);
            $sheet->setCellValue('E' . $index, 'unknown');
            $sheet->setCellValue('F' . $index, $item->type);
            $sheet->setCellValue('G' . $index, $item->status);
            $index++;
        }

        $writer = new Xlsx($spreadsheet);


        unlink($exportFileName);
        $writer->save($exportFileName);

    }
}
