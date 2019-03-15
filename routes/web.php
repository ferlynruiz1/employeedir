
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

/*
 *
 * Redirection
 */

Route::get('/', function () {
    // Check if user is logged in
	if(Auth::check()){
	    // if user is admin redirect to dashboard
		if(Auth::user()->isAdmin()){
			return redirect('/dashboard');
		}else{
			return redirect('/home');		
		}
	}else{
    	return redirect('/home');	
	}
});

/*
 *
 * Normal User Routes
 */
Route::get('/home', 'HomeController@index')->name('home');
Route::get('employees', 'EmployeeInfoController@employees');
Route::get('profile/{id}', 'EmployeeInfoController@profile');

/*
 *
 * Normal User: JSON Results
 */
Route::get('newhires', 'HomeController@newhires');



/*
 *
 * Custom Auth Routes
 */
Route::get('logout', function(){
	 Auth::logout();
	 return redirect('/');
})->name('logout');

Route::post('login', 'EmployeeInfoController@login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
/*
 *
 * Resource Controller
 */

Route::resource('referral', 'ReferralController');

/*
 *
 * Error routes
 */

Route::get('403', 'ErrorController@forbidden')->name('403');
Route::get('404', 'ErrorController@notfound')->name('404');



Route::middleware(['auth'])->group(function(){

	Route::middleware(['admin'])->group(function () {
		Route::get('dashboard', 'HomeController@dashboard');
		Route::resource('department', 'DepartmentController');
		Route::resource('employee_info', 'EmployeeInfoController');
		Route::resource('activities', 'ActivityController');
		Route::resource('posts', 'PostController');
		Route::get('employee/{id}/changepassword', 'EmployeeInfoController@changepassword');
		Route::get('employees/separated', 'EmployeeInfoController@separatedEmployees');

		Route::get('hierarchy', 'HierarchyController@hierarchy');
		Route::post('hierarchy', 'HierarchyController@updateHierarchy');

	});

	Route::resource('leave', 'LeaveController');
	Route::post('leave/recommend', 'LeaveController@recommend');
	Route::post('leave/approve', 'LeaveController@approve');
	Route::post('leave/noted', 'LeaveController@noted');

	Route::get('myprofile', 'EmployeeInfoController@myprofile');
	Route::post('employee/{id}/savepassword', 'EmployeeInfoController@savepassword');

	Route::get('exportdownload', 'EmployeeInfoController@exportdownload');
	Route::get('employees/sync', function(){
		return view('employee.sync');
	});
});

Route::get('showactivities/{id}', 'ActivityController@show');
Route::post('import/birthdays', "EmployeeInfoController@importbday");

Route::post('api/login', 'EmployeeInfoController@loginAPI');
Route::post('api/v2/login', 'EmployeeInfoController@loginAPIv2');
Route::get('api/session', 'EmployeeInfoController@session');