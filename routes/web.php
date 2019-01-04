
<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

// *********** COSTUME METHOD ***********************************
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
function genderValue($gender)
{
	if ($gender == 'Female' || $gender == 'F' || $gender == 'FEMALE') {
		return 2;
	} else if ($gender == 'Male' || $gender == 'M' || $gender == 'MALE') {
		return 1;
	} else {
		return 0;
	}
}
function genderStringValue($gender)
{
	switch ($gender) {
		case '1':
			return "MALE";
		case 1:
			return "MALE";
		case '2';
			return "FEMALE";
		case 2:
			return "FEMALE";
		default:
			return "";
	}
}
function joinGrammar($prod_date)
{
	$prod_date_timestamp = strtotime($prod_date);
	$current_timestamp = time();

	if($prod_date_timestamp > $current_timestamp){
		return "Will join";
	}
	return "Joined";
}
function monthDay($prod_date)
{
	if (isset($prod_date)) {
        $dt = Carbon::parse($prod_date);
        return $dt->format('M d');
    } else {
        return "";
    } 
}
function slashedDate($prod_date)
{
	if (isset($prod_date)) {
        $dt = Carbon::parse($prod_date);
        return $dt->format('m/d/Y');
    } else {
        return "";
    } 
}

function truncate($string, $length, $html = true)
{
    if (strlen($string) > $length) {
        if ($html) {
            // Grabs the original and escapes any quotes
            $original = str_replace('"', '\"', $string);
        }

        // Truncates the string
        $string = substr($string, 0, $length);

        // Appends ellipses and optionally wraps in a hoverable span
        if ($html) {
            $string = '<span title="' . $original . '">' . $string . '&hellip;</span>';
        } else {
            $string .= '...';
        }
    }

    return $string;
}
function curl_get_contents($url)
{
	$ch = curl_init();
	$timeout = 5;

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$data = curl_exec($ch);

	curl_close($ch);

	return $data;
}

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
// date_default_timezone_set('Asia/Manila');

Route::get('cron/importlatest', 'EmployeeInfoController@checklatest');
Route::get('cron/attrition', 'EmployeeInfoController@attrition');

Route::get('/', function () {
	if(Auth::check()){
		if(Auth::user()->isAdmin()){
			return redirect('/dashboard');
		}else{
			return redirect('/home');		
		}
	}else{
    	return redirect('/home');	
	}
});

Route::get('logout', function(){
	 Auth::logout();
	 return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('employees', 'EmployeeInfoController@employees');
Route::get('profile/{id}', 'EmployeeInfoController@profile');

Route::get('admin/invalid', ['as' => 'admin-invalid', 'uses' => function(){
	return view('errors.notadmin');
}]);

Auth::routes();
Route::post('login', 'EmployeeInfoController@login');
Route::get('newhires', 'HomeController@newhires');
Route::middleware(['auth'])->group(function(){
	
	Route::get('myprofile', 'EmployeeInfoController@myprofile');

	Route::middleware(['admin'])->group(function () {
		Route::get('dashboard', 'HomeController@dashboard');
		Route::resource('department', 'DepartmentController');
		Route::resource('employee_info', 'EmployeeInfoController');
		Route::resource('activities', 'ActivityController');
		Route::get('employee/{id}/changepassword', 'EmployeeInfoController@changepassword');
		Route::get('employees/separated', 'EmployeeInfoController@separatedEmployees');
	});
	
	Route::post('employee/{id}/savepassword', 'EmployeeInfoController@savepassword');
	Route::get('employees/import', 'EmployeeInfoController@import');
	Route::post('employees/import', 'EmployeeInfoController@importsave');
	Route::get('employees/export', function(){
		try {
			$files = File::allFiles('./public/excel/report');
			$files = array_slice($files, 0, 5);
		} catch (Exception $e) {
			$files = array();
		}
		
		return view('employee.export')->with('files', $files);
	});
	Route::get('exportdownload', 'EmployeeInfoController@exportdownload');
	Route::get('employees/sync', function(){
		return view('employee.sync');
	});
});
Route::get('activities/{id}', 'ActivityController@show');
Route::post('import/birthdays', "EmployeeInfoController@importbday");

Route::get('import/birthdays', function(){
	return "<form enctype='multipart/form-data' method='POST' action='birthdays'><input type='file' name='dump_file'>
	<input type='submit' value='submit' />".csrf_field()." </form>";
});

Route::post('api/login', 'EmployeeInfoController@loginAPI');
Route::get('api/session', 'EmployeeInfoController@session');