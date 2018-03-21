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
date_default_timezone_set('Asia/Manila');

Route::get('/', function () {
	if(Auth::check()){
		if(Auth::user()->isAdmin()){
			return redirect('/dashboard');
		}else{
			return redirect('/home');		
		}
	}else{
    	return View::make('auth.login');
	}
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
	Route::get('employees/import', 'EmployeeInfoController@import');
	Route::post('employees/import', 'EmployeeInfoController@importsave');
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
Route::get('export', function(){
	
	$files = File::allFiles('./public/excel/report');

	return view('employee.export')->with('files', $files);
});


Route::get('exportdownload', 'EmployeeInfoController@exportdownload');

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