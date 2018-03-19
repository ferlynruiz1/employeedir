<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
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
    return View::make('auth.login');
});

Route::get('logout', function(){
	 Auth::logout();
	 return redirect('/login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/invalid', ['as' => 'admin-invalid', 'uses' => function(){
	return view('error.notadmin');
}]);

Auth::routes();
Route::middleware(['auth'])->group(function(){
	Route::get('employees', 'EmployeeInfoController@employees');
	Route::get('profile/{id}', 'EmployeeInfoController@profile');
	Route::get('myprofile', 'EmployeeInfoController@myprofile');

Route::middleware(['admin'])->group(function () {
	Route::get('dashboard', 'HomeController@dashboard');
	Route::resource('department', 'DepartmentController');
	Route::resource('employee_info', 'EmployeeInfoController');
	Route::get('employee/{id}/changepassword', 'EmployeeInfoController@changepassword');
});
	Route::post('employee/{id}/savepassword', 'EmployeeInfoController@savepassword');
});

// /routes/web.php
Route::get('excel', function () {
    $address = './public/excel/test.xlsx';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( $address );
 	$worksheet = $spreadsheet->getActiveSheet();
	$rows = [];

	foreach ($worksheet->getRowIterator() AS $row) {
	    $cellIterator = $row->getCellIterator();
	    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
	    $cells = [];
	    foreach ($cellIterator as $cell) {
	        $cells[] = $cell->getValue();
	    }

	    $rows[] = $cells;
	    // Check if document is valid 
	    if(count($rows) == 1){

	    	if(strtolower($cells[1]) != strtolower("EID")){
	    		echo('EID checked');
	    	}

	    	if(strtolower($cells[2]) != strtolower("EXT")){
	    		echo('EXT checked');
	    	}
	    	if(strtolower($cells[3]) != strtolower("Phone/Pen Names")){
	    		echo('Phone/Pen Names checked');
	    	}
	    	if(strtolower($cells[4]) != strtolower("CRMID")){
	    		echo('CRMID checked');
	    	}
	    	if(strtolower($cells[5]) != strtolower("Last Name")){
	    		echo('Last Name checked');
	    	}
	    	if(strtolower($cells[6]) != strtolower("First Name")){
	    		echo('First Name checked');
	    	}
	    	if(strtolower($cells[7]) != strtolower("Name")){
	    		echo('Name checked');
	    	}
	    	if(strtolower($cells[8]) != strtolower("Sup")){
	    		echo('Sup checked');
	    	}
	    	if(strtolower($cells[9]) != strtolower("Mng")){
	    		echo('Mng checked');
	    	}
	    	if(strtolower($cells[10]) != strtolower("Dept")){
	    		echo('Dept checked');
	    	}

	    	if(strtolower($cells[11]) != strtolower("Dept Code")){
	    		echo('Dept Code checked');
	    	}
	    	if(strtolower($cells[12]) != strtolower("Division")){
	    		echo('Division checked');
	    	}
	    	if(strtolower($cells[13]) != strtolower("Role")){
	    		echo('Role checked');
	    	}
	    	if(strtolower($cells[14]) != strtolower("Account")){
	    		echo('Account checked');
	    	}
	    	if(strtolower($cells[15]) != strtolower("Prod Date")){
	    		echo('Prod Date checked');
	    	}
	    	if(strtolower($cells[16]) != strtolower("Status")){
	    		echo('Status checked');
	    	}
	    	if(strtolower($cells[17]) != strtolower("Hire Date")){
	    		echo('Hire Date checked');
	    	}
	    	if(strtolower($cells[18]) != strtolower("Wave")){
	    		echo('Wave checked');
	    	}
	    }else{
	    	// SQL saving of data
	    	dd($cells);
	    	$employee = new User; // USER : EMPLOYEE
	    	$employee->eid = $cells[1];
	    }
	}
});

Route::get('excel-download', function () {
	$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
	
    // header('Content-Type: application/vnd.ms-excel');
    // header('Content-Disposition: attachment; filename="file.xls"');
    $worksheet = $spreadsheet->getActiveSheet();

    $employees = User::all();


    $worksheet->getCell(getNameFromNumber(1) . 1 )->setValue('Count');
    $worksheet->getCell(getNameFromNumber(2) . 1 )->setValue('EID');
    $worksheet->getCell(getNameFromNumber(3) . 1 )->setValue('EXT');
    $worksheet->getCell(getNameFromNumber(4) . 1 )->setValue('Phone/Pen Names');
    $worksheet->getCell(getNameFromNumber(5) . 1 )->setValue('CRMID');
    $worksheet->getCell(getNameFromNumber(6) . 1 )->setValue('Last Name');
    $worksheet->getCell(getNameFromNumber(7) . 1 )->setValue('First Name');
    $worksheet->getCell(getNameFromNumber(8) . 1 )->setValue('Name');
    $worksheet->getCell(getNameFromNumber(9) . 1 )->setValue('Sup');
    $worksheet->getCell(getNameFromNumber(10) . 1 )->setValue('Mng');
    $worksheet->getCell(getNameFromNumber(11) . 1 )->setValue('Dept');
    $worksheet->getCell(getNameFromNumber(12) . 1 )->setValue('Dept Code');
    $worksheet->getCell(getNameFromNumber(13) . 1 )->setValue('Division');
    $worksheet->getCell(getNameFromNumber(14) . 1 )->setValue('Role');
    $worksheet->getCell(getNameFromNumber(15) . 1 )->setValue('Account');
    $worksheet->getCell(getNameFromNumber(16) . 1 )->setValue('Prod Date');
    $worksheet->getCell(getNameFromNumber(17) . 1 )->setValue('Status');
    $worksheet->getCell(getNameFromNumber(18) . 1 )->setValue('Hire Date');
    $worksheet->getCell(getNameFromNumber(19) . 1 )->setValue('Wave');








    $row = 2;
    foreach ($employees as $index => $value) {
    	$worksheet->getCell(getNameFromNumber(1) . $row )->setValue( $index );
	    $worksheet->getCell(getNameFromNumber(2) . $row )->setValue($value->eid);
	    $worksheet->getCell(getNameFromNumber(3) . $row )->setValue('EXT');
	    $worksheet->getCell(getNameFromNumber(4) . $row )->setValue($value->alias);
	    $worksheet->getCell(getNameFromNumber(5) . $row )->setValue('CRMID');
	    $worksheet->getCell(getNameFromNumber(6) . $row )->setValue($value->last_name);
	    $worksheet->getCell(getNameFromNumber(7) . $row )->setValue($value->first_name);
	    $worksheet->getCell(getNameFromNumber(8) . $row )->setValue($value->fullname());
	    $worksheet->getCell(getNameFromNumber(9) . $row )->setValue($value->supervisor->fullname());
	    $worksheet->getCell(getNameFromNumber(10) . $row )->setValue(isset($value->manager) ? $value->manager->fullname() : '');
	    $worksheet->getCell(getNameFromNumber(11) . $row )->setValue($value->team_name);
	    $worksheet->getCell(getNameFromNumber(12) . $row )->setValue('Dept Code');
	    $worksheet->getCell(getNameFromNumber(13) . $row )->setValue('Division');
	    $worksheet->getCell(getNameFromNumber(14) . $row )->setValue($value->position_name);
	    $worksheet->getCell(getNameFromNumber(15) . $row )->setValue($value->account->account_name);
	    $worksheet->getCell(getNameFromNumber(16) . $row )->setValue('Prod Date');
	    $worksheet->getCell(getNameFromNumber(17) . $row )->setValue($value->status);
	    $worksheet->getCell(getNameFromNumber(18) . $row )->setValue($value->hired_date);
	    $worksheet->getCell(getNameFromNumber(19) . $row )->setValue('Wave');
	  	$row++;
    }
	// $worksheet->getCell(getNameFromNumber('1') . 5 )->setValue('Smith');


	 $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
   	 $writer->save("./public/excel/write.xlsx");

   	 return "<a href='". asset('/public/excel/write.xlsx') ."' >Download</a>";

});

function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}