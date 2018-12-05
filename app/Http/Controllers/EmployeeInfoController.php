<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use App\EmployeeDepartment;
use App\ElinkAccount;
use App\ElinkDivision;
use App\User;
use App\EmployeeAttrition;
use Response;
use File;
use DB;

class EmployeeInfoController extends Controller
{
    public function login(Request $request)
    {   
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::whereEmail($request->email);
            if ($user->count() > 0) {
                Auth::login($user->first());
                return redirect('/');
            }
         }

         if (Auth::attempt(['email2' => $request->email, 'password' => $request->password])) {
           $user = User::where('email2' ,'=', $request->email);

            if ($user->count() > 0) {
                Auth::login($user->first());
                return redirect('/');
            }
          }

         if (Auth::attempt(['email3' => $request->email, 'password' => $request->password])) {
           $user = User::where('email3' ,'=', $request->email);

            if ($user->count() > 0) {
                Auth::login($user->first());
                return redirect('/');
            }
         }

        return redirect('/login')->withErrors(['email' => "Incorrect email and password combination!"]);

    }
    public function loginAPI(Request $request){
        $param = "";
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::whereEmail($request->email);
            if ($user->count() > 0) {
                Auth::login($user->first());
                $param = '?id=' . Auth::user()->id . '&first_name=' . Auth::user()->first_name . '&last_name=' . Auth::user()->last_name;
            }
         }

         if (Auth::attempt(['email2' => $request->email, 'password' => $request->password])) {
           $user = User::where('email2' ,'=', $request->email);

            if ($user->count() > 0) {
                Auth::login($user->first());
                $param = '?id=' . Auth::user()->id . '&first_name=' . Auth::user()->first_name . '&last_name=' . Auth::user()->last_name;
            } 
         }

         if (Auth::attempt(['email3' => $request->email, 'password' => $request->password])) {
           $user = User::where('email3' ,'=', $request->email);

            if ($user->count() > 0) {
                Auth::login($user->first());
                $param = '?id=' . Auth::user()->id . '&first_name=' . Auth::user()->first_name . '&last_name=' . Auth::user()->last_name;
            }
         }
         return redirect($request->redirect_url . $param);
    }
    public function session(Request $request){
        if (Auth::check() && isset($request->redirect_url)) {
            header('Location: ' . $request->redirect_url . '?user_id=' . Auth::user()->id);
        } else {
            header('Location: ' . $request->redirect_url . '?user_id=0');
        }
        die();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create')->with('supervisors', User::all())->with('departments', EmployeeDepartment::all())->with('accounts', ElinkAccount::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new User();
        $employee->eid = $request->eid;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->alias = $request->alias;
        $employee->position_name = $request->position_name;
        $employee->supervisor_name = $request->supervisor_name;
        $employee->team_name = $request->team_name;
        $employee->gender = $request->gender_id;
        $employee->manager_name = $request->manager_name;
        $employee->account_id = $request->account_id;
        $employee->status = $request->status_id;
        
        if ($request->has('employee_type')) {
            $employee->usertype = $request->employee_type;
        }

        /* all access field */
        if ($request->has('all_access')) {
            $employee->all_access = 1;
        } else {
            $employee->all_access = 0;
        }

        $datetime = new DateTime();
        $hired_date = $datetime->createFromFormat('m/d/Y', $request->hired_date)->format("Y-m-d H:i:s");
        $birth_date = $datetime->createFromFormat('m/d/Y', $request->birth_date)->format("Y-m-d H:i:s");
        $prod_date = $datetime->createFromFormat('m/d/Y', $request->prod_date)->format("Y-m-d H:i:s");
        $employee->hired_date = $hired_date;
        $employee->birth_date = $birth_date;
        $employee->prod_date = $prod_date;
        $employee->email = $request->email;
        $employee->email2 = $request->email2;
        $employee->email3 = $request->email3;
        $employee->ext = $request->ext;
        $employee->wave = $request->wave;

        $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'qwe123!@#$'));
        $employee->save();

        /* saving photo : TODO : optimize saving of image to save space */
        if ($request->hasFile("profile_image")) {
            $extension = $request->file('profile_image')->guessExtension();
            $path = $request->profile_image->storeAs('images/'.$employee->id, $employee->id . '.' . $extension);
            $employee->profile_img = asset('storage/app/'.$path);
            $employee->save();
        }

        return redirect('dashboard')->with('success', "Successfully created Employee");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::find($id);
        
        if (isset($employee)) {
            return view('employee.view')->with('employee', $employee);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $employee = User::find($id);

        if (isset($employee)) {
            return view('employee.edit')->with('employee', $employee)->with('supervisors', User::all())->with('departments', EmployeeDepartment::all())->with('accounts', ElinkAccount::all());
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = User::find($id);
        $employee->eid = $request->eid;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->email2 = $request->email2;
        $employee->email3 = $request->email3;
        $employee->alias = $request->alias;
        $employee->team_name = $request->team_name;
        $employee->position_name = $request->position_name;
        $employee->supervisor_name = $request->supervisor_name;

        if ($request->has('gender_id')) {
            $employee->gender = $request->gender_id;
        }

        if ($request->has('employee_type')) {
            $employee->usertype = $request->employee_type;
        }

        $employee->manager_name = $request->manager_name;
        $employee->account_id = $request->account_id;
        $employee->status = $request->status_id;

        if ($request->has('all_access')) {
            $employee->all_access = 1;
        } else {
            $employee->all_access = 0;
        }

        $datetime = new DateTime();

        if ($request->has('birth_date') && $request->birth_date) {
            $birth_date = $datetime->createFromFormat('m/d/Y', $request->birth_date)->format("Y-m-d H:i:s");
            $employee->birth_date = $birth_date;
        }

        if ($request->has('hired_date') && $request->hired_date){
            $hired_date = $datetime->createFromFormat('m/d/Y', $request->hired_date)->format("Y-m-d H:i:s");
            $employee->hired_date = $hired_date;
        }

        if ($request->has('prod_date') && $request->prod_date){
            $prod_date = $datetime->createFromFormat('m/d/Y', $request->prod_date)->format("Y-m-d H:i:s");
            $employee->prod_date = $prod_date;
        }
        
        if ($request->hasFile("profile_image")) {
            $extension = $request->file('profile_image')->guessExtension();
            $path = $request->profile_image->storeAs('images/'.$employee->id, $employee->id . '.' . $extension);
            $employee->profile_img = asset('storage/app/'.$path);
        }

        $employee->save();

        return redirect()->back()->with('success', "Successfully updated employee information");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = User::find($id);
        $employee->delete();

        return redirect()->back()->with('success', "Successfully deleted employee record");
    }
    public function changepassword(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            if (Auth::user()->id == $id){
                return view('employee.changepassword')->with('id', $id);
            } else {
                return abort(404);
            }
        }
        return view('employee.changepassword')->with('id', $id);
    }
    public function savepassword(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->new_password == "" && $request->old_password == "" && $request->confirm_password == "") {
            return redirect()->back()->withErrors(array('message' => 'all field are required!', 'status' => 'error'));
        }

        if(!Auth::user()->isAdmin()){
            if (Hash::check($request->old_password, $user->password)) {
                // Do nothing
            } else {
                return redirect()->back()->withErrors(array('message' => 'incorrect old password', 'status' => 'error'));
            }  
        }

        if ($request->new_password == $request->confirm_password) {
            $user->password = Hash::make($request->new_password);
            if ($user->save()) {
                return redirect()->back()->withErrors(array('message' => 'Password successfully changed!', 'status' => 'success'));
            } else {
                return redirect()->back()->withErrors(array('message' => 'error saving !', 'status' => 'error'));
            }
        } else {
            return redirect()->back()->withErrors(array('message' => 'new password don\'t match', 'status' => 'error'));
        }
        
    }
    public function employees(Request $request)
    {
        if(Auth::check()) {
            if (Auth::user()->isAdmin()) {
                $employees = new User;

                if ($request->has('department') && $request->get('department') != "") {
                    $employees = $employees->where('team_name', 'LIKE', $request->get('department'));
                }

                if ($request->has('position') && $request->get('position') != "") {
                    $employees = $employees->where('position_name', 'LIKE', '%' . $request->get('position') . '%');
                }

                if ($request->has('no_profile_images') && $request->get('no_profile_images') == 'true'){
                    $employees = $employees->where(function($query) use($request){
                        $query->where('profile_img', 'LIKE', 'http://dir.elink.corp/public/img/nobody_m.original.jpg')
                        ->orWhere('profile_img', 'LIKE', 'http://dir.elink.corp/public/img/nobody_f.original.jpg')
                        ->orWhere('profile_img', '=', 'NULL');
                    });
                }

                if ($request->has('inactive') && $request->get('inactive') != "") {
                    $employees = $employees->onlyTrashed()->orWhere('status', '=', '2');
                }

                if ($request->has('birthmonth') && $request->get('birthmonth') != "") {
                    $employees = $employees->whereRaw('MONTH(birth_date) = '. $request->get('birthmonth'));
                }

                if ($request->has('invalid_birth_date') && $request->get('invalid_birth_date') != "") {
                    $employees = $employees->where(function($query) use ($request){
                        $query->whereRaw('YEAR(birth_date) > ' . (date('Y') - 16) . ' OR YEAR(birth_date) <' . (date('Y') - 70))
                        ->orWhereNull('birth_date');
                    });
                }

                $employees = $employees->where('id', '<>', 1)->orderBy('last_name', 'ASC')->get();
                $departments = EmployeeDepartment::all();

                $positions = User::allExceptSuperAdmin()->select('position_name')->distinct()->get();

                return view('employee.employees')->with('employees', $employees)->with('request', $request)->with('departments', $departments)->with('positions', $positions);
            }
        }
        
        $employees = new User;
        $query = array();
        if ($request->has('keyword') && $request->get('keyword') != "") {
            $employees = $employees->where(function($query) use($request)
            {
                $query->where('first_name', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('last_name', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('middle_name', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere(DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('email', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('email2', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('email3', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('alias', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('team_name', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('dept_code', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('position_name', 'LIKE', '%'.$request->get('keyword').'%')
                    ->orWhere('ext', 'LIKE', '%'.$request->get('keyword').'%');
            });
        }

        if ($request->has('alphabet') && $request->get('alphabet') != "") {
            $employees = $employees->where(function($query) use($request)
            {
                $query->where('first_name', 'LIKE', $request->get('alphabet').'%')
                    ->orWhere('last_name', 'LIKE', $request->get('alphabet').'%');
            });
        }
        if ($request->has('department') && $request->get('department') != "") {
            $employees = $employees->where('team_name', 'LIKE', $request->get('department'));
        }

        if ($request->has('position') && $request->get('position') != "") {
            $employees = $employees->where('position_name', 'LIKE', '%' . $request->get('position') . '%');
        }

        if ($request->has('birthmonth') && $request->get('birthmonth') != "") {
            $employees = $employees->whereRaw('MONTH(birth_date) = '. $request->get('birthmonth'));
        }

        $employees = $employees->where('id', '<>', 1)->orderBy('last_name', 'ASC')->paginate(10);

        $departments = EmployeeDepartment::all();
        $positions = User::allExceptSuperAdmin()->select('position_name')->distinct()->get();
        return view('guest.employees')->with('employees', $employees )->with('request', $request)->with('departments', $departments)->with('positions', $positions);
    }
    public function profile (Request $request, $id)
    {
        return view('auth.profile.view')->with('employee', User::find($id));
    }
    public function myprofile(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('employee.view')->with('employee', Auth::user());
        }
        return view('auth.profile.view')->with('employee', Auth::user());
    }

    public function import(Request $request)
    {
        return view('employee.import');
    }
    public function importsave(Request $request)
    {
        $num_inserts = 0;
        $num_updates = 0;
        $updates = array();
        $inserts = array();
        $employees = array();
        $invalid_emails = array();

        $COUNT = 0;
        $EID = 1;
        $EXT = 2;
        $ALIAS = 3;
        $LAST_NAME = 4;
        $FIRST_NAME = 5;
        $FULLNAME = 6;
        $SUPERVISOR = 7;
        $MANAGER = 8;
        $DEPT = 9;
        $DEPT_CODE = 10;
        $DIVISION = 11;
        $ROLE = 12;
        $ACCOUNT = 13;
        $PROD_DATE = 14;
        $STATUS = 15;
        $HIRED_DATE = 16;
        $WAVE = 17;
        $EMAIL = 18;
        $GENDER = 19;
        $BDAY = 20;

        if ($request->hasFile("dump_file")) {
            $path = $request->dump_file->storeAs('/public/temp/'.Auth::user()->id, 'dump_file.'. \File::extension($request->dump_file->getClientOriginalName()));
        }


        $address = './storage/app/'. $path;
        
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( $address );

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];

        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); 
            $cells = [];

            foreach ($cellIterator as $cell) {
                $cellValue = $cell->getValue();
                if($cell == "--"){
                    $cellValue = "";
                }
                $cells[] = $cellValue;
            }
            $rows[] = $cells;
            // Check if document is valid 
            if (count($rows) == 1) {
                
                // 
                // TODO Trapping for excel column placing
                //

            } else {
                $cells[$EMAIL] = trim($cells[$EMAIL]);
                $cells[$EID] = trim($cells[$EID]);
                $emp = User::withTrashed()->where('eid','LIKE','%'.$cells[$EID].'%');

                if (!$cells[$EMAIL] || !filter_var($cells[$EMAIL], FILTER_VALIDATE_EMAIL)) {
                    // list invalid email
                    if($cells[$EMAIL] != "" && $cells[$EMAIL] != null){
                        array_push($invalid_emails, $cells[$FIRST_NAME]);
                    }
                    
                    continue;
                }

                if ($cells[$ACCOUNT]) {
                    $account = ElinkAccount::where('account_name', 'LIKE', $cells[$ACCOUNT]);
                    if ($account->count() == 0) {
                        ElinkAccount::insert([
                            'account_name' => $cells[$ACCOUNT]
                        ]);
                    }
                }

                if ($cells[$DIVISION]) {
                    $division = ElinkDivision::where('division_name','LIKE', $cells[$DIVISION]);
                    if ($division->count() == 0) {
                        ElinkDivision::insert([
                            'division_name' => $cells[$DIVISION]
                        ]);
                    }
                }

                if ($cells[$DEPT]) {
                    $department = EmployeeDepartment::where('department_name', 'LIKE', $cells[$DEPT]);
                    if ($department->count() == 0) {  
                        if($cells[$ACCOUNT]) {
                            $dept_account = ElinkAccount::where('account_name', 'LIKE', $cells[$ACCOUNT]);
                            if ($dept_account->count() > 0) {
                                if ($cells[$DIVISION]) {
                                    $dept_division = ElinkDivision::where('division_name','LIKE', $cells[$DIVISION]);
                                    if ($dept_division->count() > 0) {
                                        EmployeeDepartment::insert([
                                            'department_name' => $cells[$DEPT],
                                            'department_code' => $cells[$DEPT_CODE],
                                            'division_id' => $dept_division->first()->id,
                                            'account_id' => $dept_account->first()->id
                                        ]);
                                    }
                                }  
                            }
                        }
                    }
                }

                $account = ElinkAccount::where('account_name','LIKE' , '%'.trim($cells[$ACCOUNT]).'%')->get();
                
                if ($emp->count() >= 1) {
                    // Update 
                    $employee = array(
                        'eid' => trim($cells[$EID]),
                        'alias' => trim($cells[$ALIAS]),
                        'last_name' => trim($cells[$LAST_NAME]),
                        'first_name' => trim($cells[$FIRST_NAME]),
                        'supervisor_name' =>  trim($cells[$SUPERVISOR]),
                        'manager_name' => trim($cells[$MANAGER]),
                        'team_name' => trim($cells[$DEPT]),
                        'dept_code' => trim($cells[$DEPT_CODE]),
                        'position_name' => trim($cells[$ROLE]),
                        'gender' => genderValue(trim($cells[$GENDER])),
                        'division_name' => trim($cells[$DIVISION]),
                        'ext' => trim($cells[$EXT]),
                        'wave' => trim($cells[$WAVE]),
                    );

                    if (count($account) > 0) {
                        $employee['account_id'] = $account->first()->id;
                    } else {
                        $employee['account_id'] = 0;
                    }
                    if (strtolower($cells[$STATUS]) == strtolower('Active')) {
                        $employee['status'] = 1;
                    } else {
                        $employee['status'] = 2;
                    }
                    if ($cells[$HIRED_DATE]) {
                        if (is_numeric($cells[$HIRED_DATE])) {
                            $UNIX_DATE = ($cells[$HIRED_DATE] - 25569) * 86400;
                            $employee['hired_date'] = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$BDAY]) {
                        if (is_numeric($cells[$BDAY])) {
                            $UNIX_DATE = ($cells[$BDAY] - 25569) * 86400;
                            $employee['birth_date'] = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$PROD_DATE]) {
                        if (is_numeric($cells[$PROD_DATE])) {
                            $UNIX_DATE = ($cells[$PROD_DATE] - 25569) * 86400;
                            $employee['prod_date'] = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }

                    if ($emp->update($employee)) {
                        array_push($updates, $cells[$EMAIL]);
                        $num_updates ++;
                    }
                } else {
                    // SQL saving of data
                    $employee = new User; // USER : EMPLOYEE
                    $employee->eid = trim($cells[$EID]);
                    $employee->first_name = trim($cells[$FIRST_NAME]);
                    $employee->middle_name = '';
                    $employee->last_name = trim($cells[$LAST_NAME]);
                    $employee->email = trim($cells[$EMAIL]);
                    $employee->alias = trim($cells[$ALIAS]);
                    $employee->team_name = trim($cells[$DEPT]);
                    $employee->dept_code = trim($cells[$DEPT_CODE]);
                    $employee->position_name = trim($cells[$ROLE]);
                    $employee->supervisor_name = trim($cells[$SUPERVISOR]);
                    $employee->gender = genderValue(trim($cells[$GENDER]));
                    $employee->usertype = 1;
                    $employee->manager_name = trim($cells[$MANAGER]);
                    $employee->division_name = trim($cells[$DIVISION]);
                    $employee->all_access = 1;
                    $employee->ext = trim($cells[$EXT]);
                    $employee->wave = trim($cells[$WAVE]);
                    $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'qwe123!@#$'));
                    
                    $account = ElinkAccount::where('account_name','LIKE' , '%'.$cells[$ACCOUNT].'%')->get();
                    
                    if (count($account) > 0) {
                        $employee->account_id = $account->first()->id;
                    } else {
                        $employee->account_id = 0;
                    }
                    if (strtolower($cells[$STATUS]) == strtolower('Active')) {
                        $employee->status = 1;
                    } else {
                        $employee->status = 2;
                    }
                    if ($cells[$HIRED_DATE]) {
                        if (is_numeric($cells[$HIRED_DATE])) {
                            $UNIX_DATE = ($cells[$HIRED_DATE] - 25569) * 86400;
                            $employee->hired_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$BDAY]) {
                        if (is_numeric($cells[$BDAY])) {
                            $UNIX_DATE = ($cells[$BDAY] - 25569) * 86400;
                            $employee->birth_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$PROD_DATE]) {
                        if (is_numeric($cells[$PROD_DATE])) {
                            $UNIX_DATE = ($cells[$PROD_DATE] - 25569) * 86400;
                            $employee->prod_date = gmdate("Y-m-d H:i:s", (int)$UNIX_DATE);
                        }
                    }
                    if ($employee->gender == 1) {
                        $employee->profile_img = asset('public/img/nobody_m.original.jpg');
                    } else {
                        $employee->profile_img = asset('public/img/nobody_f.original.jpg');
                    }

                    $employee->save();
                    $num_inserts ++;

                    array_push($inserts, $employee);
                }
            }
        }
        return view('employee.import')
                ->with('num_inserts', $num_inserts)
                ->with('inserts', $inserts)
                ->with('invalid_emails', $invalid_emails);
    }
    /* EXPORT */
    public function exportdownload() {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $employees = User::allExceptSuperAdmin()->get();
        $COUNT = 0;
        $EID = 1;
        $EXT = 2;
        $ALIAS = 3;
        $LAST_NAME = 4;
        $FIRST_NAME = 5;
        $FULLNAME = 6;
        $SUPERVISOR = 7;
        $MANAGER = 8;
        $DEPT = 9;
        $DEPT_CODE = 10;
        $DIVISION = 11;
        $ROLE = 12;
        $ACCOUNT = 13;
        $PROD_DATE = 14;
        $STATUS = 15;
        $HIRED_DATE = 16;
        $WAVE = 17;
        $EMAIL = 18;
        $GENDER = 19;
        $BDAY = 20;

        $worksheet->getCell(getNameFromNumber($COUNT + 1) . 1 )->setValue('Count'); 
        $worksheet->getCell(getNameFromNumber($EID + 1) . 1 )->setValue('EID');
        $worksheet->getCell(getNameFromNumber($EXT + 1) . 1 )->setValue('EXT');
        $worksheet->getCell(getNameFromNumber($ALIAS + 1) . 1 )->setValue('Phone/Pen Names');
        $worksheet->getCell(getNameFromNumber($LAST_NAME + 1) . 1 )->setValue('Last Name');
        $worksheet->getCell(getNameFromNumber($FIRST_NAME + 1) . 1 )->setValue('First Name');
        $worksheet->getCell(getNameFromNumber($FULLNAME + 1) . 1 )->setValue('Name');
        $worksheet->getCell(getNameFromNumber($SUPERVISOR + 1) . 1 )->setValue('Sup');
        $worksheet->getCell(getNameFromNumber($MANAGER + 1) . 1 )->setValue('Mng');
        $worksheet->getCell(getNameFromNumber($DEPT + 1) . 1 )->setValue('Dept');
        $worksheet->getCell(getNameFromNumber($DEPT_CODE + 1) . 1 )->setValue('Dept Code');
        $worksheet->getCell(getNameFromNumber($DIVISION + 1) . 1 )->setValue('Division');
        $worksheet->getCell(getNameFromNumber($ROLE + 1) . 1 )->setValue('Role');
        $worksheet->getCell(getNameFromNumber($ACCOUNT + 1) . 1 )->setValue('Account');
        $worksheet->getCell(getNameFromNumber($PROD_DATE + 1) . 1 )->setValue('Prod Date');
        $worksheet->getCell(getNameFromNumber($STATUS + 1) . 1 )->setValue('Status');
        $worksheet->getCell(getNameFromNumber($HIRED_DATE + 1) . 1 )->setValue('Hire Date');
        $worksheet->getCell(getNameFromNumber($WAVE + 1) . 1 )->setValue('Wave');
        $worksheet->getCell(getNameFromNumber($EMAIL + 1) . 1 )->setValue('Email');
        $worksheet->getCell(getNameFromNumber($GENDER + 1 ) . 1 )->setValue('Gender');
        $worksheet->getCell(getNameFromNumber($BDAY + 1) . 1 )->setValue('Bday');

        $worksheet->getColumnDimension(getNameFromNumber($COUNT + 1))->setWidth(7);
        $worksheet->getColumnDimension(getNameFromNumber($EID + 1))->setWidth(20);
        $worksheet->getColumnDimension(getNameFromNumber($EXT + 1))->setWidth(5);
        $worksheet->getColumnDimension(getNameFromNumber($ALIAS + 1))->setWidth(30);
        $worksheet->getColumnDimension(getNameFromNumber($LAST_NAME + 1))->setWidth(20);
        $worksheet->getColumnDimension(getNameFromNumber($FIRST_NAME + 1))->setWidth(20);
        $worksheet->getColumnDimension(getNameFromNumber($FULLNAME + 1))->setWidth(40);
        $worksheet->getColumnDimension(getNameFromNumber($SUPERVISOR + 1))->setWidth(30);
        $worksheet->getColumnDimension(getNameFromNumber($MANAGER + 1))->setWidth(30);
        $worksheet->getColumnDimension(getNameFromNumber($DEPT + 1))->setWidth(25);
        $worksheet->getColumnDimension(getNameFromNumber($DEPT_CODE + 1))->setWidth(15);
        $worksheet->getColumnDimension(getNameFromNumber($DIVISION + 1))->setWidth(15);
        $worksheet->getColumnDimension(getNameFromNumber($ROLE + 1))->setWidth(30);
        $worksheet->getColumnDimension(getNameFromNumber($ACCOUNT + 1))->setWidth(15);
        $worksheet->getColumnDimension(getNameFromNumber($PROD_DATE + 1))->setWidth(15);
        $worksheet->getColumnDimension(getNameFromNumber($STATUS + 1))->setWidth(10);
        $worksheet->getColumnDimension(getNameFromNumber($HIRED_DATE + 1))->setWidth(10);
        $worksheet->getColumnDimension(getNameFromNumber($WAVE + 1))->setWidth(8);
        $worksheet->getColumnDimension(getNameFromNumber($EMAIL + 1))->setWidth(30);
        $worksheet->getColumnDimension(getNameFromNumber($GENDER + 1))->setWidth(10);
        $worksheet->getColumnDimension(getNameFromNumber($BDAY + 1))->setWidth(10);

        $row = 2;
        foreach ($employees as $index => $value) {

            $worksheet->getCell(getNameFromNumber($COUNT + 1) . $row )->setValue($row-1);
            $worksheet->getCell(getNameFromNumber($EID + 1) . $row )->setValue($value->eid);
            $worksheet->getCell(getNameFromNumber($EXT + 1) . $row )->setValue($value->ext);
            $worksheet->getCell(getNameFromNumber($ALIAS + 1) . $row )->setValue($value->alias);
            $worksheet->getCell(getNameFromNumber($LAST_NAME + 1) . $row )->setValue($value->last_name);
            $worksheet->getCell(getNameFromNumber($FIRST_NAME + 1) . $row )->setValue($value->first_name);
            $worksheet->getCell(getNameFromNumber($FULLNAME + 1) . $row )->setValue($value->fullname());
            $worksheet->getCell(getNameFromNumber($SUPERVISOR + 1) . $row )->setValue($value->supervisor_name);
            $worksheet->getCell(getNameFromNumber($MANAGER + 1) . $row )->setValue($value->manager_name);
            $worksheet->getCell(getNameFromNumber($DEPT + 1) . $row )->setValue($value->team_name);
            $worksheet->getCell(getNameFromNumber($DEPT_CODE + 1) . $row )->setValue($value->dept_code);
            $worksheet->getCell(getNameFromNumber($DIVISION + 1) . $row )->setValue($value->division_name);
            $worksheet->getCell(getNameFromNumber($ROLE + 1) . $row )->setValue($value->position_name);

            $account = ElinkAccount::find($value->account_id);
            if ($account) 
            {
                $worksheet->getCell(getNameFromNumber($ACCOUNT + 1) . $row )->setValue($account->account_name);
            }

            $worksheet->getCell(getNameFromNumber($PROD_DATE + 1) . $row )->setValue($value->prodDate());
            $worksheet->getCell(getNameFromNumber($STATUS + 1) . $row )->setValue($value->status == 1 ? 'Active' : 'Inactive');
            $worksheet->getCell(getNameFromNumber($HIRED_DATE + 1) . $row )->setValue($value->dateHired());
            $worksheet->getCell(getNameFromNumber($WAVE + 1) . $row )->setValue($value->wave);
            $worksheet->getCell(getNameFromNumber($EMAIL + 1) . $row )->setValue($value->email);
            $worksheet->getCell(getNameFromNumber($GENDER + 1) . $row )->setValue(genderStringValue($value->gender));
            $worksheet->getCell(getNameFromNumber($BDAY + 1) . $row )->setValue($value->birthDate());

            $row++;
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $timestamp = date('m_d_Y_G_i');
        $writer->save("./public/excel/report/report". $timestamp . ".xlsx");

        $file_name = 'report'.$timestamp.'.xlsx';

        return redirect('public/excel/report/' . $file_name);
    }


    public function importbday(Request $request) {
        $num_inserts = 0;
        $num_updates = 0;
        $updates = array();
        $inserts = array();
        $employees = array();
        $invalid_emails = array();

        $COUNT = 0;
        $EID = 1;
        $BDAY = 7;
        
        
        if ($request->hasFile("dump_file")) {
            $path = $request->dump_file->storeAs('/public/temp/'.Auth::user()->id, 'dump_file.'. \File::extension($request->dump_file->getClientOriginalName()));
        }

        $address = './storage/app/'. $path;
        
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( $address );

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];
        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); 
            $cells = [];

            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
            if (count($rows) == 1) {
               

            } else {
                // return json_encode($cells);
                $employee = User::where("eid", "LIKE", "%".$cells[$EID]."%");
                if ($employee->count() == 1) {
                    if ($cells[$BDAY]) {
                        if (is_numeric($cells[$BDAY])) {
                            $UNIX_DATE = ($cells[$BDAY] - 25569) * 86400;
                            $employee->update([
                                'birth_date' => gmdate("Y-m-d H:i:s", (int) $UNIX_DATE)
                            ]);
                            $num_updates ++;
                        } else {
                            $employee->update([
                                'birth_date' => gmdate("Y-m-d H:i:s", strtotime(str_replace('-','/',$cells[$BDAY])))
                            ]);
                            $num_updates ++;
                        }
                    }
                }
            }
        }
        return "num_updates: " . $num_updates;
    }
    public function checklatest() {
        $path = "/var/www/uploads/masterlist"; 

        $latest_ctime = 0;
        $latest_filename = '';    

        $d  = array_diff(scandir($path), array('.', '..'));
        foreach ($d as $entry) {
            $filepath = "{$path}/{$entry}";
            // could do also other checks than just checking whether the entry is a file
            if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
                $latest_ctime = filectime($filepath);
                $latest_filename = $entry;
            }
        }

        $num_inserts = 0;
        $num_updates = 0;
        $updates = array();
        $inserts = array();
        $employees = array();
        $invalid_emails = array();

        $COUNT = 0;
        $EID = 1;
        $EXT = 2;
        $ALIAS = 3;
        $LAST_NAME = 4;
        $FIRST_NAME = 5;
        $FULLNAME = 6;
        $SUPERVISOR = 7;
        $MANAGER = 8;
        $DEPT = 9;
        $DEPT_CODE = 10;
        $DIVISION = 11;
        $ROLE = 12;
        $ACCOUNT = 13;
        $PROD_DATE = 14;
        $STATUS = 15;
        $HIRED_DATE = 16;
        $WAVE = 17;
        $EMAIL = 18;
        $GENDER = 19;
        $BDAY = 20;

        $address = $filepath;
        
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( $address );

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];

        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); 
            $cells = [];

            foreach ($cellIterator as $cell) {
                $cellValue = $cell->getValue();
                if($cell == "--"){
                    $cellValue = "";
                }
                $cells[] = $cellValue;
            }
            $rows[] = $cells;
            // Check if document is valid 
            if (count($rows) == 1) {
            
                // 
                // TODO Trapping for excel column placing
                //

            } else {
                
                $cells[$EMAIL] = trim($cells[$EMAIL]);
                $cells[$EID] = trim($cells[$EID]);
                $emp = User::withTrashed()->where('eid', 'LIKE', '%'.$cells[$EID].'%');

                if (!$cells[$EMAIL] || !filter_var($cells[$EMAIL], FILTER_VALIDATE_EMAIL)) {
                    // list invalid email
                    if($cells[$FULLNAME] != null){
                        array_push($invalid_emails, $cells[$FIRST_NAME] . " " . $cells[$LAST_NAME]);
                    }
                    
                    continue;
                }

                if ($cells[$ACCOUNT]) {
                    $account = ElinkAccount::where('account_name', 'LIKE', $cells[$ACCOUNT]);
                    if ($account->count() == 0) {
                        ElinkAccount::insert([
                            'account_name' => $cells[$ACCOUNT]
                        ]);
                    }
                }

                if ($cells[$DIVISION]) {
                    $division = ElinkDivision::where('division_name','LIKE', $cells[$DIVISION]);
                    if ($division->count() == 0) {
                        ElinkDivision::insert([
                            'division_name' => $cells[$DIVISION]
                        ]);
                    }
                }

                if ($cells[$DEPT]) {
                    $department = EmployeeDepartment::where('department_name', 'LIKE', $cells[$DEPT]);
                    if ($department->count() == 0) {  
                        if($cells[$ACCOUNT]) {
                            $dept_account = ElinkAccount::where('account_name', 'LIKE', $cells[$ACCOUNT]);
                            if ($dept_account->count() > 0) {
                                if ($cells[$DIVISION]) {
                                    $dept_division = ElinkDivision::where('division_name','LIKE', $cells[$DIVISION]);
                                    if ($dept_division->count() > 0) {
                                        EmployeeDepartment::insert([
                                            'department_name' => $cells[$DEPT],
                                            'department_code' => $cells[$DEPT_CODE],
                                            'division_id' => $dept_division->first()->id,
                                            'account_id' => $dept_account->first()->id
                                        ]);
                                    }
                                }  
                            }
                        }
                    }
                }

                $account = ElinkAccount::where('account_name','LIKE' , '%'.trim($cells[$ACCOUNT]).'%')->get();
                
                if ($emp->count() >= 1) {
                    // Update 
                    $employee = array(
                        'eid' => trim($cells[$EID]),
                        'alias' => trim($cells[$ALIAS]),
                        'last_name' => trim($cells[$LAST_NAME]),
                        'first_name' => trim($cells[$FIRST_NAME]),
                        'supervisor_name' =>  trim($cells[$SUPERVISOR]),
                        'manager_name' => trim($cells[$MANAGER]),
                        'team_name' => trim($cells[$DEPT]),
                        'dept_code' => trim($cells[$DEPT_CODE]),
                        'position_name' => trim($cells[$ROLE]),
                        'gender' => genderValue(trim($cells[$GENDER])),
                        'division_name' => trim($cells[$DIVISION]),
                        'ext' => trim($cells[$EXT]),
                        'wave' => trim($cells[$WAVE]),
                    );

                    if (count($account) > 0) {
                        $employee['account_id'] = $account->first()->id;
                    } else {
                        $employee['account_id'] = 0;
                    }
                    if (strtolower($cells[$STATUS]) == strtolower('Active')) {
                        $employee['status'] = 1;
                    } else {
                        $employee['status'] = 2;
                    }
                    if ($cells[$HIRED_DATE]) {
                        if (is_numeric($cells[$HIRED_DATE])) {
                            $UNIX_DATE = ($cells[$HIRED_DATE] - 25569) * 86400;
                            $employee['hired_date'] = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$BDAY]) {
                        if (is_numeric($cells[$BDAY])) {
                            $UNIX_DATE = ($cells[$BDAY] - 25569) * 86400;
                            $employee['birth_date'] = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$PROD_DATE]) {
                        if (is_numeric($cells[$PROD_DATE])) {
                            $UNIX_DATE = ($cells[$PROD_DATE] - 25569) * 86400;
                            $employee['prod_date'] = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }

                    if ($emp->update($employee)) {
                        array_push($updates, $cells[$FIRST_NAME] . ' ' . $cells[$LAST_NAME]);
                        $num_updates ++;
                    }
                } else {
                    // SQL saving of data
                    $employee = new User; // USER : EMPLOYEE
                    $employee->eid = trim($cells[$EID]);
                    $employee->first_name = trim($cells[$FIRST_NAME]);
                    $employee->middle_name = '';
                    $employee->last_name = trim($cells[$LAST_NAME]);
                    $employee->email = trim($cells[$EMAIL]);
                    $employee->alias = trim($cells[$ALIAS]);
                    $employee->team_name = trim($cells[$DEPT]);
                    $employee->dept_code = trim($cells[$DEPT_CODE]);
                    $employee->position_name = trim($cells[$ROLE]);
                    $employee->supervisor_name = trim($cells[$SUPERVISOR]);
                    $employee->gender = genderValue(trim($cells[$GENDER]));
                    $employee->usertype = 1;
                    $employee->manager_name = trim($cells[$MANAGER]);
                    $employee->division_name = trim($cells[$DIVISION]);
                    $employee->all_access = 1;
                    $employee->ext = trim($cells[$EXT]);
                    $employee->wave = trim($cells[$WAVE]);
                    $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'qwe123!@#$'));
                    
                    $account = ElinkAccount::where('account_name','LIKE' , '%'.$cells[$ACCOUNT].'%')->get();
                    
                    if (count($account) > 0) {
                        $employee->account_id = $account->first()->id;
                    } else {
                        $employee->account_id = 0;
                    }
                    if (strtolower($cells[$STATUS]) == strtolower('Active')) {
                        $employee->status = 1;
                    } else {
                        $employee->status = 2;
                    }
                    if ($cells[$HIRED_DATE]) {
                        if (is_numeric($cells[$HIRED_DATE])) {
                            $UNIX_DATE = ($cells[$HIRED_DATE] - 25569) * 86400;
                            $employee->hired_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$BDAY]) {
                        if (is_numeric($cells[$BDAY])) {
                            $UNIX_DATE = ($cells[$BDAY] - 25569) * 86400;
                            $employee->birth_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                        }
                    }
                    if ($cells[$PROD_DATE]) {
                        if (is_numeric($cells[$PROD_DATE])) {
                            $UNIX_DATE = ($cells[$PROD_DATE] - 25569) * 86400;
                            $employee->prod_date = gmdate("Y-m-d H:i:s", (int)$UNIX_DATE);
                        }
                    }
                    if ($employee->gender == 1) {
                        $employee->profile_img = asset('public/img/nobody_m.original.jpg');
                    } else {
                        $employee->profile_img = asset('public/img/nobody_f.original.jpg');
                    }

                    $employee->save();
                    $num_inserts ++;

                    array_push($inserts, $cells[$FIRST_NAME] . " " . $cells[$LAST_NAME]);
                }
            }
        }

        // DELETE
        $result = json_encode(['Number of Inserts' => $num_inserts, 'Inserted' => $inserts, 'Number Of Updates' => $num_updates, 'Updated' => $updates, 'Invalid Entry' => $invalid_emails]);

        $bytes_written = File::put('./storage/logs/cron_masterlist.txt', $result);

        if ($bytes_written === false) {
            echo "Error writing to file";
        }
        return $result;
    }
    public function attrition(Request $request) {
        $path = "/var/www/uploads/attrition"; 

        $latest_ctime = 0;
        $latest_filename = '';    

        $d  = array_diff(scandir($path), array('.', '..'));
        foreach ($d as $entry) {
            $filepath = "{$path}/{$entry}";
            // could do also other checks than just checking whether the entry is a file
            if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
                $latest_ctime = filectime($filepath);
                $latest_filename = $entry;
            }
        }
        $to_be_deleted = array();
        $num_inserts = 0;
        $num_updates = 0;
        $updates = array();
        $inserts = array();
        $employees = array();
        $invalid_emails = array();

        $COUNT = 0;
        $EID = 1;
        $FULLNAME = 2;
        $START_DATE = 3;
        $LAST_DATE = 4;
        $EMPLOYEE_TYPE = 5;
        $PARTICULARS = 6;
        $ALIAS = 7;
        $IT_STATUS = 8;
        $RA_STATUS = 9;

        $address = $filepath;
        
        //
        // Read the excel file
        //
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( $address );

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];

        // loop excel rows
        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); 
            $cells = [];

            // storing the row value to $cells
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }

            // concat / add to array $rows : use $rows in the last part to get all rows
            $rows[] = $cells;

            if (count($rows) <= 2) {
               

            } else {

                if ($cells[$EID] && $cells[$EID] != "") {
                    $employee = User::where("eid", "LIKE", "%".trim($cells[$EID])."%");

                    if ($employee->count() == 1) {
                        $employee = $employee->first();
                        $num_updates ++;
                        
                        // display attrition employee name
                        array_push($to_be_deleted, ucwords(strtolower($cells[$FULLNAME])));

                        // store in attrition list
                        $attrition = EmployeeAttrition::where('employee_id', '=', '%' . $cells[$EID] . '%');
                            // check if employee exist in database
                            if ($attrition->count() == 0) {
                                
                                // create a record in employee attrition table
                                $newAttrition = new EmployeeAttrition;
                                $newAttrition->employee_id = $cells[$EID];
                                $newAttrition->employee_name = ucwords(strtolower($cells[$FULLNAME]));

                                $datetime = new DateTime();
                                // start date
                                if ($cells[$START_DATE] != "" && $cells[$START_DATE]) {
                                    if (is_numeric($cells[$START_DATE])) {
                                        $UNIX_DATE = ($cells[$START_DATE] - 25569) * 86400;
                                        $newAttrition->start_work_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                                    } else {
                                        $start_work_date = $datetime->createFromFormat('Y-m-d', $cells[$START_DATE])->format("Y-m-d H:i:s");
                                        $newAttrition->start_work_date = $start_work_date;
                                    }
                                }

                                // last date
                                if ($cells[$LAST_DATE] != "" && $cells[$LAST_DATE]) {
                                    if (is_numeric($cells[$LAST_DATE])) {
                                        $UNIX_DATE = ($cells[$LAST_DATE] - 25569) * 86400;
                                        $employee->last_work_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
                                    }else{
                                         $last_work_date = $datetime->createFromFormat('Y-m-d', $cells[$LAST_DATE])->format("Y-m-d H:i:s");
                                         $newAttrition->last_work_date = $last_work_date;
                                    }
                                }

                                $newAttrition->employee_type = $cells[$EMPLOYEE_TYPE];
                                $newAttrition->particulars = $cells[$PARTICULARS];
                                $newAttrition->alias = $cells[$ALIAS];
                                $newAttrition->it_status = $cells[$IT_STATUS];
                                $newAttrition->ra_status = $cells[$RA_STATUS];
                                $newAttrition->save();

                                // change status to deleted ..  
                                $employee->status = 2;
                                $employee->save();
                            }

                        // delete employee from database
                        $employee->delete();
                    }
                }
            }
        }
        $result = json_encode(["deleted" => $to_be_deleted, "number_employees_deleted" =>  $num_updates]);


        $bytes_written = File::put('./storage/logs/cron_attrition.txt', $result);

        if ($bytes_written === false) {
            echo "Error writing to file";
        }
        return $result;
    }
}
