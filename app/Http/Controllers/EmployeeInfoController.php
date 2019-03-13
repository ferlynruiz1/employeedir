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
use App\Employee;
use App\EmployeeAttrition;
use App\LeaveRequest;
use Response;
use File;
use DB;

class EmployeeInfoController extends Controller
{

    public function login(Request $request)
    {   
        return $this->authModel->login($request);
    }

    public function loginAPIv2(Request $request)
    {
        
        return $this->authModel->loginAPIv2($request);
    }

    public function loginAPI(Request $request)
    {
        return $this->authModel->loginAPI($request);
    }

   public function session(Request $request)
   {
        return $this->authModel->session($request);
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
        return view('employee.create')
        ->with('managers', User::allExceptSuperAdmin()->orderBy('last_name')->get())
        ->with('supervisors', User::allExceptSuperAdmin()->orderBy('last_name')->get())
        ->with('departments', EmployeeDepartment::all())->with('accounts', ElinkAccount::all())
        ->with('positions', User::select('position_name')->groupBy('position_name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->model->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::withTrashed()->find($id);
        
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
        return $this->model->updateEmployee($request, $id);
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

    // 
    // change password : only admin can view this
    //
    public function changepassword(Request $request, $id)
    {
        return $this->authModel->changepassword($request, $id);
    }

    // 
    // change password : only admin can change
    //
    public function savepassword(Request $request, $id)
    {
        return $this->authModel->savepassword($request, $id);
        
    }
    // 
    // employees dashboard : only admin can view
    //
    public function employees(Request $request)
    {
        return $this->model->employees($request);
    }

    public function profile (Request $request, $id)
    {
        return view('auth.profile.view')->with('employee', User::withTrashed()->find($id));
    }

    public function myprofile(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('employee.view')->with('employee', Auth::user());
        }
        return view('auth.profile.view')->with('employee', Auth::user())
            ->with('my_requests', LeaveRequest::where('filed_by_id', Auth::user()->id)->get());
    }

    public function import(Request $request)
    {
        return view('employee.import');
    }

    public function importsave(Request $request)
    {
        return $this->excelModel->importsave($request);
    }
    /* EXPORT */
    public function exportdownload() 
    {
       return $this->excelModel->exportdownload();
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

    public function separatedEmployees(){

        $employees = User::onlyTrashed()->orWhere('status', '=', '2')->get();
       
        return view('employee.separated')->with('employees', $employees);
    }

}
