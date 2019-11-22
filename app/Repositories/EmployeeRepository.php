<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\EmployeeDepartment;
use DateTime;
use Illuminate\Support\Facades\Hash;
use DB; 

class EmployeeRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function store(Request $request){

        $manager = User::find($request->manager_id);
        $supervisor = User::find($request->supervisor_id);

        $employee = new User();
        $employee->eid = $request->eid;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->alias = $request->alias;
        $employee->position_name = $request->position_name;

        $employee->supervisor_id = $request->supervisor_id;
        $employee->manager_id = $request->manager_id;

        if($supervisor){
            $employee->supervisor_name = $supervisor->fullName();
        }
        
        if($manager){
            $employee->manager_name = $manager->fullName();
        }

        $employee->team_name = $request->team_name;
        $employee->gender = $request->gender_id;
        $employee->address = $request->address;
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

        /* access type */
        if ($request->has('is_admin')) {
            $employee->is_admin = 1;
        } else {
            $employee->is_admin = 0;
        }
        if ($request->has('is_hr')) {
            $employee->is_hr = 1;
        } else {
            $employee->is_hr = 0;
        }
        if ($request->has('is_erp')) {
            $employee->is_erp = 1;
        } else {
            $employee->is_erp = 0;
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

        $employee->email = $request->email;
        $employee->email2 = $request->email2;
        $employee->email3 = $request->email3;
        $employee->ext = $request->ext;
        $employee->wave = $request->wave;
        $employee->sss = $request->sss;
        $employee->pagibig = $request->pagibig;
        $employee->philhealth = $request->philhealth;
        $employee->tin = $request->tin;

        $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'qwe123!@#$'));
        $employee->save();

        /* saving photo : TODO : optimize saving of image to save space */
        if ($request->hasFile("profile_image")) {
            $extension = $request->file('profile_image')->guessExtension();
            $path = $request->profile_image->storeAs('images/'.$employee->id, $employee->id . '.' . $extension);
            $employee->profile_img = asset(' /app/'.$path);
            $employee->save();
        }

        return redirect('employee_info/' . $employee->id)->with('success', "Successfully created Employee");
    }

    public function updateEmployee(Request $request, $id){
        
        $employee = User::find($id);
        $employee->eid = $request->eid;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->alias = $request->alias;
        $employee->position_name = $request->position_name;
        $employee->supervisor_id = $request->supervisor_id;
        
        if($supervisor = User::find($request->supervisor_id)){
            $employee->supervisor_name = $supervisor->fullName();
        }

        $employee->team_name = $request->team_name;
        $employee->address = $request->address;
        $employee->manager_id = $request->manager_id;

        if($manager = User::find($request->manager_id)){
            $employee->manager_name = $manager->fullName();
        }
        
        $employee->account_id = $request->account_id;
        $employee->status = $request->status_id;
        
        if ($request->has('gender_id')) {
            $employee->gender = $request->gender_id;
        }

        if ($request->has('employee_type')) {
            $employee->usertype = $request->employee_type;
        }

        $employee->email = $request->email;
        $employee->email2 = $request->email2;
        $employee->email3 = $request->email3;
        $employee->ext = $request->ext;
        $employee->wave = $request->wave;
        $employee->sss = $request->sss;
        $employee->pagibig = $request->pagibig;
        $employee->philhealth = $request->philhealth;
        $employee->tin = $request->tin;

        if ($request->has('all_access')) {
            $employee->all_access = 1;
        } else {
            $employee->all_access = 0;
        }
        
        /* access type */
        if ($request->has('is_admin')) {
            $employee->is_admin = 1;
        } else {
            $employee->is_admin = 0;
        }
        if ($request->has('is_hr')) {
            $employee->is_hr = 1;
        } else {
            $employee->is_hr = 0;
        }
        if ($request->has('is_erp')) {
            $employee->is_erp = 1;
        } else {
            $employee->is_erp = 0;
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

    public function employees(Request $request){

        $departments = EmployeeDepartment::all();
        $positions = User::allExceptSuperAdmin()->select('position_name')->distinct()->get();

        if(Auth::check()) {
            if (Auth::user()->isAdmin()) {
                $employees = new User;

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
                    
                    $employees = $employees->where('id', '<>', 1)->orderBy('last_name', 'ASC')->paginate(10);

                    return view('guest.employees')->with('employees', $employees )->with('request', $request)->with('departments', $departments)->with('positions', $positions);
                }

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

                if ($request->has('alphabet') && $request->get('alphabet') != "") {
                $employees = $employees->where(function($query) use($request)
                {
                    $query->where('first_name', 'LIKE', $request->get('alphabet').'%')
                        ->orWhere('last_name', 'LIKE', $request->get('alphabet').'%');
                    });
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

                $employees = $employees->where('id', '<>', 1)->orderBy('last_name', 'ASC')->paginate(10);

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
            
            $employees = $employees->where('id', '<>', 1)->orderBy('last_name', 'ASC')->paginate(10);

            return view('guest.employees')->with('employees', $employees )->with('request', $request)->with('departments', $departments)->with('positions', $positions);
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

        
        return view('guest.employees')->with('employees', $employees )->with('request', $request)->with('departments', $departments)->with('positions', $positions);
    }
}