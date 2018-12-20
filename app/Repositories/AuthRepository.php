<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class AuthRepository implements RepositoryInterface
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
        return $this->model->create($data);
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

    //
    // 
    //

    public function login(Request $request){
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
    public function session(Request $request)
    {
        if (Auth::check() && isset($request->redirect_url)) {
            header('Location: ' . $request->redirect_url . '?user_id=' . Auth::user(  )->id);
        } else {
            header('Location: ' . $request->redirect_url . '?user_id=0');
        }
        die();
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
}