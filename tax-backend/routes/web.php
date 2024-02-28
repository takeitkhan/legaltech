<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Exports\ProductExport;
// use Maatwebsite\Excel\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'this is running';
});
// Route::get('/home',[ReportNinePointController::class,'excelReport']);

// Route::get('/', function () {
//     // $file = fopen('C:\Users\accountant\Downloads\Customs Tarriff.csv','r+');
//     $file_read = file('C:\Users\accountant\Downloads\Customs Tarriff-1.csv');
//     $csv = array_map('str_getcsv', $file_read);
//     // 0 => "HS Code"
//     // 1 => "Description"
//     // 2 => "UNIT"
//     // 3 => "CD"
//     // 4 => "SD"
//     // 5 => "VAT"
//     // 6 => "AIT"
//     // 7 => "RD"
//     // 8 => "ATV"
//     // 9 => "AT"
//    unset($csv[0]);
//     // dd($csv);
//     $keys = ['hs_code', 'title', 'unit', 'cd', 'sd_rate', 'vat_rate', 'ait', 'rd', 'atv', 'at'];
// //      $new_array = array_combine($keys, $csv);
// //    dd($new_array);
//     foreach($csv as $single_csv){
//         $single_csv[3] = (double) $single_csv[3];
//         $single_csv[4] = (double) $single_csv[4];
//         $single_csv[5] = (double) $single_csv[5];
//         $single_csv[7] = (double) $single_csv[7];
//         $single_csv[9] = (double) $single_csv[9];
//         $single_csv[8] =  trim($single_csv[8]) ;
//         $new_array = array_combine($keys,$single_csv);
//         // dd($new_array);
//         Product::create($new_array);
//         // $data = array(
//         //     'hs_code'    => $single_csv[0],
//         //     'title'      => $single_csv['Description'],
//         //     'unit'       => $single_csv['UNIT'],
//         //     'cd'         => $single_csv['CD'],
//         //     'sd_rate'    => $single_csv['SD'],
//         //     'vat_rate'   => $single_csv[''],
//         //     'ait'        => $single_csv[''],
//         //     'rd'         => $single_csv[''],
//         //     'atv'        => $single_csv[''],
//         //     'at'         =>
//         // );
//     }
//     return "done";

//     // `code`, `hs_code`, `title`, `details`, `unit`, `sd_rate`, `vat_rate`
//     // dd($csv);
//     // return view('welcome');
// });


// Route::get('/csv', function () {
//     // $file = fopen('C:\Users\accountant\Downloads\Customs Tarriff.csv','r+');
//     $file_read = file('C:\Users\accountant\Downloads\food.csv');
//     $csv = array_map('str_getcsv', $file_read);
//     // 0 => "HS Code"
//     // 1 => "Description"
//     // 2 => "UNIT"
//     // 3 => "CD"
//     // 4 => "SD"
//     // 5 => "VAT"
//     // 6 => "AIT"
//     // 7 => "RD"
//     // 8 => "ATV"
//     // 9 => "AT"
//    unset($csv[0]);
//     // dd($csv);
//     $keys = ['id', 'name', 'description', 'image', 'price', 'variations', 'add_ons', 'tax', 'available_time_starts', 'available_time_ends','status','created_at','updated_at','attributes','category_ids','choice_options','discount','discount_type','tax_type','set_menu','branch_id','colors'];
//     //set_menu,branch_id,colors not found
// //   $new_array = array_combine($keys, $csv);
// //    dd($new_array);
//     $array = [];
//     array_push($array,$keys);
//     $new_array =[];
//     foreach($csv as $single_csv){
//         // dd($single_csv);
//         if(!isset($single_csv[3])){
//           continue ;
//         }
//         $new_array[0] = $single_csv[0];
//         $new_array[1] = $single_csv[1];
//         $new_array[2] = $single_csv[2];
//         $new_array[3] = $single_csv[3];
//         $new_array[4] = $single_csv[10];
//         $new_array[5] = $single_csv[6];
//         $new_array[6] = $single_csv[7];
//         $new_array[7] = $single_csv[11];
//         $new_array[8] = $single_csv[15];
//         $new_array[9] = $single_csv[16];
//         $new_array[10] = $single_csv[18];
//         $new_array[11] = $single_csv[20];
//         $new_array[12] = $single_csv[21];
//         $new_array[13] = $single_csv[8];
//         $new_array[14] = $single_csv[4];
//         $new_array[15] = $single_csv[9];
//         $new_array[16] = $single_csv[13];
//         $new_array[17] = $single_csv[14];
//         $new_array[18] = $single_csv[12];//tax type
//         $new_array[19] = null;//set menu
//         $new_array[20] = null;//branch id
//         $new_array[21] = null;//colors
//         array_push($array,$new_array);
//         // dd($new_array);
//         // Product::create($new_array);
//         // $data = array(
//         //     'hs_code'    => $single_csv[0],
//         //     'title'      => $single_csv['Description'],
//         //     'unit'       => $single_csv['UNIT'],
//         //     'cd'         => $single_csv['CD'],
//         //     'sd_rate'    => $single_csv['SD'],
//         //     'vat_rate'   => $single_csv[''],
//         //     'ait'        => $single_csv[''],
//         //     'rd'         => $single_csv[''],
//         //     'atv'        => $single_csv[''],
//         //     'at'         =>
//         // );
//     }
//     // dd($array);

//     // $export = new ProductExport($array);

//     // return Excel::download($export, 'invoices.csv');
//     // new ProductExport($array);
//     // / Create an array of elements
//     $list = array(
//         ['Name', 'age', 'Gender'],
//         ['Bob', 20, 'Male'],
//         ['John', 25, 'Male'],
//         ['Jessica', 30, 'Female']
//     );

//     // Open a file in write mode ('w')
//     $fp = fopen('C:\Users\accountant\Downloads\newFood.csv', 'w+');

//     // Loop through file pointer and a line
//     foreach ($array as $fields) {
//         fputcsv($fp, $fields);
//     }

//     fclose($fp);

//     // `code`, `hs_code`, `title`, `details`, `unit`, `sd_rate`, `vat_rate`
//     // dd($csv);
//     // return view('welcome');
// });
