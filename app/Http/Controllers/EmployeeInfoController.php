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
use App\User;

class EmployeeInfoController extends Controller
{
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
        $employee->supervisor_id = $request->supervisor_id;
        $employee->team_name = $request->team_name;
        $employee->gender = $request->gender_id;
        $employee->manager_id = $request->manager_id;
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
        $employee->hired_date = $hired_date;
        $employee->birth_date = $birth_date;
        $employee->email = $request->email;
        $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'qwe123!@#$'));
        $employee->save();

        /* saving photo : TODO : optimize saving of image to save space */
        if ($request->hasFile("profile_image")) {
            $path = $request->profile_image->store('images/'.$employee->id);
            $employee->profile_img = asset('storage/app/'.$path);
            $employee->save();
        }

        return redirect('home')->with('success', "Successfully created Employee");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('employee.view')->with('employee', User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employee.edit')->with('employee', User::find($id))->with('supervisors', User::all())->with('departments', EmployeeDepartment::all());
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
        $employee->alias = $request->alias;
        $employee->team_name = $request->team_name;
        $employee->position_name = $request->position_name;
        $employee->supervisor_id = $request->supervisor_id;

        if ($request->has('gender_id')) {
            $employee->gender = $request->gender_id;
        }

        if ($request->has('employee_type')) {
            if ($request->employee_type == 4) {
                $employee->is_admin = 1;
            } else {
                $employee->is_admin = 0;
            }
        }

        $employee->manager_id = $request->manager_id;
        $employee->account_id = $request->account_id;
        $employee->status = $request->status_id;

        if ($request->has('all_access')) {
            $employee->all_access = 1;
        } else {
            $employee->all_access = 0;
        }

        $datetime = new DateTime();
        $hired_date = $datetime->createFromFormat('m/d/Y', $request->hired_date)->format("Y-m-d H:i:s");
        $birth_date = $datetime->createFromFormat('m/d/Y', $request->birth_date)->format("Y-m-d H:i:s");
        $employee->hired_date = $hired_date;
        $employee->birth_date = $birth_date;

        if ($request->hasFile("profile_image")) {
            $path = $request->profile_image->store('images/'.$employee->id);
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

        return redirect()->back()->with('success', "Successfully deleted employee record");;
    }
    public function changepassword(Request $request, $id)
    {
        return view('employee.changepassword')->with('id', $id);
    }
    public function savepassword(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->new_password == "" && $request->old_password == "" && $request->confirm_password == "") {
            return redirect()->back()->withErrors(array('message' => 'all field are required!', 'status' => 'error'));
        }
        
        if (Hash::check($request->old_password, $user->password)) {
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
        } else {
            return redirect()->back()->withErrors(array('message' => 'incorrect old password', 'status' => 'error'));
        }
    }
    public function employees(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('employee.employees')->with('employees', User::all());
        }

        $employees = new User;
        if ($request->has('keyword')) {
            $employees = $employees->where('first_name', 'LIKE', '%'.$request->get('keyword').'%')->orWhere('last_name', 'LIKE', '%'.$request->get('keyword').'%');
        } else if($request->has('alphabet')) {
            $employees = $employees->where('last_name', 'LIKE', $request->get('alphabet').'%')->orWhere('first_name', 'LIKE', $request->get('alphabet').'%');
        }
        $employees = $employees->orderBy('last_name', 'ASC')->paginate(10);

        return view('guest.employees')->with('employees', $employees )->with('request', $request);
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

    public function import(Request $request){
        return view('employee.import');
    }
    public function importsave(Request $request){
        $employees = array();
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
        $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
        $cells = [];
        foreach ($cellIterator as $cell) {
            $cells[] = $cell->getValue();
        }

        $rows[] = $cells;
        // Check if document is valid 
        if(count($rows) == 1){
            if(strtolower($cells[$EID]) != strtolower("EID")){
                echo ('EID wrong');
            }
            if(strtolower($cells[$EXT]) != strtolower("EXT")){
                echo('EXT wrong');
            }
            if(strtolower($cells[$ALIAS]) != strtolower("Phone/Pen Names")){
                echo('Phone/Pen Names wrong');
            }
            if(strtolower($cells[$LAST_NAME]) != strtolower("Last Name")){
                echo('Last Name wrong');
            }
            if(strtolower($cells[$FIRST_NAME]) != strtolower("First Name")){
                echo('First Name wrong');
            }
            if(strtolower($cells[$FULLNAME]) != strtolower("Name")){
                echo('Name wrong');
            }
            if(strtolower($cells[$SUPERVISOR]) != strtolower("Sup")){
                echo('Sup wrong');
            }
            if(strtolower($cells[$MANAGER]) != strtolower("Mng")){
                echo('Mng wrong');
            }
            if(strtolower($cells[$DEPT]) != strtolower("Dept")){
                echo('Dept wrong');
            }

            if(strtolower($cells[$DEPT_CODE]) != strtolower("Dept Code")){
                echo('Dept Code wrong');
            }
            if(strtolower($cells[$DIVISION]) != strtolower("Division")){
                echo('Division wrong');
            }
            if(strtolower($cells[$ROLE]) != strtolower("Role")){
                echo('Role wrong');
            }
            if(strtolower($cells[$ACCOUNT]) != strtolower("Account")){
                echo('Account wrong');
            }
            if(strtolower($cells[$PROD_DATE]) != strtolower("Prod Date")){
                echo('Prod Date wrong');
            }
            if(strtolower($cells[$STATUS]) != strtolower("Status")){
                echo('Status wrong');
            }
            if(strtolower($cells[$HIRED_DATE]) != strtolower("Hire Date")){
                echo('Hire Date wrong');
            }
            if(strtolower($cells[$WAVE]) != strtolower("Wave")){
                echo('Wave wrong');
            }

            if(strtolower($cells[$EMAIL]) != strtolower("Email") && strtolower($cells[$EMAIL]) != strtolower("Email Address")){
                echo('Email wrong');
            }
            if(strtolower($cells[$GENDER]) != strtolower("gender")){
                echo('Wave wrong');
            }
            if(strtolower($cells[$BDAY]) != strtolower("bday")){
                echo('Wave wrong');
            }


           

        }else{
            // UPDATE

            $emp = User::whereEmail($cells[$EMAIL]);
            if(!$cells[$EMAIL] || !filter_var($cells[$EMAIL], FILTER_VALIDATE_EMAIL)){
                continue;
            }
            if($emp->count() >= 1){
                $employee = array(
                    'eid' => $cells[$EID],
                    'alias' => $cells[$ALIAS],
                    'last_name' => $cells[$LAST_NAME],
                    'first_name' => $cells[$FIRST_NAME],
                    // 'supervisor_id' => '',
                    // 'manager_id' => '',
                    'team_name' => $cells[$DEPT],
                    'position_name' => $cells[$ROLE],
                    'prod_date' => gmdate("Y-m-d H:i:s", (int)(($cells[$PROD_DATE] - 25569) * 86400)),
                    'status' => $cells[$STATUS] == 'ACTIVE' ? 1 : 0 ,
                    'hired_date' => gmdate("Y-m-d H:i:s", (int)(($cells[$HIRED_DATE] - 25569) * 86400)),
                    'wave' => $cells[$WAVE],
                    'email' => $cells[$EMAIL],
                    'gender' => $cells[$GENDER],
                    'birth_date' => $cells[$BDAY],
                     );
                $emp->update($employee);
                array_push($employees, "update");

            }else{

            // SQL saving of data
            $employee = new User; // USER : EMPLOYEE

            $employee->eid = $cells[$EID];

            $employee->first_name = $cells[$FIRST_NAME];

            $employee->middle_name = '';
            $employee->last_name = $cells[$FIRST_NAME];
            $employee->email = $cells[$EMAIL];
            $employee->alias = $cells[$ALIAS];
            $employee->team_name = $cells[$DEPT];
            // TODO DEPARTCODE

            $employee->position_name = $cells[$ROLE];
            // SUPERVISOR search by name
            // $employee->supervisor_id = '';

            $employee->gender = $cells[$GENDER];

            $employee->usertype = 1;

            // $employee->manager_id = '';
            // $employee->account_id = '';

            if(strtolower($cells[$STATUS]) == strtolower('active')){
                 $employee->status = 1;
            }else{
                 $employee->status = 2;
            }

            $employee->all_access = 1;
            $employee->ext = $cells[$EXT];
            $employee->wave = $cells[$WAVE];
            $employee->wave = $cells[$WAVE];
            // ALL ACCESS
            // if ($request->has('all_access')) {
            //     $employee->all_access = 1;
            // } else {
            //     $employee->all_access = 0;
            // }

            $datetime = new DateTime();
            if($cells[$HIRED_DATE]){
                $UNIX_DATE = ($cells[$HIRED_DATE] - 25569) * 86400;
                $employee->hired_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);

            }
            if($cells[$BDAY]){
                $UNIX_DATE = ($cells[$BDAY] - 25569) * 86400;
                 $employee->birth_date = gmdate("Y-m-d H:i:s", (int) $UNIX_DATE);
            }
            if($cells[$PROD_DATE]){
                $UNIX_DATE = ($cells[$PROD_DATE] - 25569) * 86400;
                $employee->prod_date = gmdate("Y-m-d H:i:s", (int)$UNIX_DATE);
            }
            // no image
            // if ($request->hasFile("profile_image")) {
            //     $path = $request->profile_image->store('images/'.$employee->id);
            //     $employee->profile_img = asset('storage/app/'.$path);
            // }

            $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'qwe123!@#$'));
        
            array_push($employees, "insert");
            $employee->save();
            }
        }
    }
        return json_encode($employees);

    }
}