<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use Validator;
use DB;

class DashboardController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     */
    public function __construct()
    {
	
		   if(session('is_login')==false)
			{
				Redirect::to('login')->send();

			}
		

    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index()
    {
		return view('dashboard');
    }

	public function logout()
	{
		Session::put('is_login',false);
		Redirect::to('login')->send();
	}

   public function showUserForm()
    {     
        return view('users.user');

    }

    public function adduser(Request $request)
    {   
        //echo "welcome";
     $v=Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
   
        ]);
        if ($v->fails())
        {       

            return redirect()->back()->withErrors($v->errors());
        }

        /*$FileTemp = $_FILES['picture']['tmp_name'];
        $FileName = $_FILES['picture']['name'];
        $FileType = $_FILES['picture']['type'];
        $FilePath = base_path('public/images/').$FileName;
        $path='/'.config('app.name').'/public/images/'.$FileName;
        move_uploaded_file($FileTemp, $FilePath);*/
        $data=$request->all();

        

        DB::table('users')->insert([
            'email' => $data['email'],
            'firstName' => $data['firstname'],
            'lastName' => $data['lastname'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            //'image' => $path,
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'status' => '1',
            'role_id' => '2',
        ]);
        $request->session()->flash('addsuccess', 'User Added Successfully.');
        return redirect()->back();
    }

    public function listUserForm()
    { 
        $x=Session::get('email'); 
        $viewme=DB::table('users')->where('email','!=',$x)->get();
        return view('users.list',['viewme'=>$viewme]);
    }

    public function userdelete($id)
    {   
        DB::table('users')->delete($id);
        session()->flash('deleteuser', 'Deleted Successfully.');
        return redirect('list');

    }

    public function showuseredit($id)
    {

        $results = DB::select("select * from users where id = $id");

        return view('users.edit',['id'=>$id,'results'=>$results]);

    }

    public function updateuser(Request $request,$id)
    {   

        $v=Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
   
        ]);
        if ($v->fails())
        {       

            return redirect()->back()->withErrors($v->errors());
        }
        //if($_FILES['picture']['tmp_name']==NULL)
            //{

                $data=$request->all();

                  DB::table('users')
                    ->where('id', $id)
                        ->update([
            'email' => $data['email'],
            'firstName' => $data['firstname'],
            'lastName' => $data['lastname'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
        ]);
        
                          //echo "Updated";
                    $request->session()->flash('updatesuccess', 'Updated Successfully.');
                    return redirect('list');


              //}
                /*else
                    {

                        $data=$request->all();  
                        $FileTemp = $_FILES['picture']['tmp_name'];
                        $FileName = $_FILES['picture']['name'];
                        $FileType = $_FILES['picture']['type'];
                        $FilePath = base_path('public/images/').$FileName;
                        $path='/'.config('app.name').'/public/images/'.$FileName;
                        move_uploaded_file($FileTemp, $FilePath);
                         DB::table('users')
                            ->where('id', $id)
                            ->update([
                                    'name' => $data['fullname'],
                                    'email' => $data['email'],
                                    'firstName' => $data['firstname'],
                                    'lastName' => $data['lastname'],
                                    'password' => bcrypt($data['password']),
                                    'image' => $path,
                                    'address' => $data['address'],
                                    'city' => $data['city'],
                                    'country' => $data['country'],
                                ]);
                        $request->session()->flash('updatesuccess', 'Updated Successfully');
                        return redirect('list');
                   }*/

        }

    public function showChangePassword()
        {   
        //session()->forget('passwordpass');
        return view('users.cpassword');

        }

    public function savePassword(Request $request)
    { 
            $v=Validator::make($request->all(), [
            'current_password' => 'required|min:6',
            'password'=> 'required|min:6|confirmed',
            'password_confirmation'=> 'required|min:6',
   
        ]);
        if ($v->fails())
        {       

            return redirect()->back()->withErrors($v->errors());
        }
            $data=$request->all();

            $x=Session::get('email');   

        if(Auth::attempt(['email' => $x,'password'=>$data['current_password']]))
        {
            DB::table('users')
            ->where('email', $x)
            ->update(array('password' => bcrypt($data['password'])));
            $request->session()->flash('passwordpass', 'Password Changed Successfully');
            return redirect('changepassword');  
        }
        else
        {
            $request->session()->flash('passwordfail', 'Current Password Cannot Match');
            return redirect('changepassword');
            
        }
        

    }

    public function showViewProfile()
    {   
       $x=Session::get('email');   
        

       $user = DB::table('users')->where('email', $x)->get();

       return view('users.viewprofile',['user'=>$user]); 
    }

    public function showProfileedit($id)
    {

        $results = DB::select("select * from users where id = $id");

        return view('users.profileedit',['id'=>$id,'results'=>$results]);

    }

    public function updateprofile(Request $request,$id)
    {   

        $v=Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
   
        ]);
        if ($v->fails())
        {       

            return redirect()->back()->withErrors($v->errors());
        }
        //if($_FILES['picture']['tmp_name']==NULL)
            //{

                $data=$request->all();

                  DB::table('users')
                    ->where('id', $id)
                        ->update([
            'email' => $data['email'],
            'firstName' => $data['firstname'],
            'lastName' => $data['lastname'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
        ]);
        
                          //echo "Updated";
                    $request->session()->flash('updateprofilesuccess', 'Profile updated Successfully.');
                    return redirect('viewprofile');


              //}
                /*else
                    {

                        $data=$request->all();  
                        $FileTemp = $_FILES['picture']['tmp_name'];
                        $FileName = $_FILES['picture']['name'];
                        $FileType = $_FILES['picture']['type'];
                        $FilePath = base_path('public/images/').$FileName;
                        $path='/'.config('app.name').'/public/images/'.$FileName;
                        move_uploaded_file($FileTemp, $FilePath);
                         DB::table('users')
                            ->where('id', $id)
                            ->update([
                                    'name' => $data['fullname'],
                                    'email' => $data['email'],
                                    'firstName' => $data['firstname'],
                                    'lastName' => $data['lastname'],
                                    'password' => bcrypt($data['password']),
                                    'image' => $path,
                                    'address' => $data['address'],
                                    'city' => $data['city'],
                                    'country' => $data['country'],
                                ]);
                        $request->session()->flash('updatesuccess', 'Updated Successfully');
                        return redirect('list');
                   }*/

        }

}
