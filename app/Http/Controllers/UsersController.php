<?php

namespace App\Http\Controllers;

use App\User;//use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\modeles\service;
use App\modeles\employ;
use App\modeles\rol;
use App\modeles\Specialite;
use App\modeles\patient;
use Hash;
use View;//use Response;
class UsersController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $redirectTo = '/users/create'; 
    public function __construct()
    {
       $user = Auth::user();
    }
    public function index()
    {
      $roles = rol::all();
      $services = service::all();
      return view('user.index',compact('roles','services'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = rol::all();
      $services = service::all();
      $specialites = Specialite::all();
      return view('user.add', compact('roles','services','specialites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        "nom"=> "required",
        "prenom"=> "required",
        "datenaissance"=> "required",// "lieunaissance"=> "required",  //"adresse"=> "required",
        "mobile"=> "required",   //"fixe"=> "required",age // "mat"=> "required", ////"nss"=> "required",
        "username"=> "required",
        "password"=> "required",// "mail"=> "required",
        "role"=> "required",
      ]);
      $employe = employ::firstOrCreate([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "sexe"=>$request->sexe,
            "Date_Naiss"=>$request->datenaissance,
            "Lieu_Naissance"=>$request->lieunaissance,
            "Adresse"=>$request->adresse,
            "Tele_fixe"=>$request->fixe,
            "tele_mobile"=>$request->mobile,
            "specialite"=>$request->specialite,
            "service_id"=>$request->service,
            "Matricule_dgsn"=>$request->mat,
            "NSS"=>$request->nss,
      ]);/*$user = ["name"=>$request->username,"password"=>$request->password,"email"=>$request->mail,"employee_id"=>$employe->id,"role_id"=>$request->role, ]; event(new Registered($user = RegisterController::create($user)));//$this->guard()->login($user); return $this->registered($request, $user)?: redirect()->route('users.index');*/
      $user = User::firstOrCreate([
        "name"=>$request->username,// "password"=>$request->password,
        "password"=> Hash::make($request['password']),
        "email"=>$request->mail,
        "employee_id"=>$employe->id,
        "role_id"=>$request->role,
      ]);//return redirect(Route('employs.show',$employe->id)); 
      return redirect(Route('users.show',$user->id));                 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::FindOrFail($id);
      $roles = rol::all();
      $services=service::all();
      $specialites=specialite::all();
      return view('user.show',compact('user','roles','services','specialites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::FindOrFail($id);
      $roles = rol::all()->keyBy('id');
      $services=service::all()->keyBy('id');
      $specialites = Specialite::all()->keyBy('id');
      return view('user.edit',compact('user','roles','services','specialites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
      $rule = array(
            "username"=> "required",
            "email"=> "nullable|email",//|unique:utilisateurs
            "role"=> "required",
      );
      $messages = [
          "required"     => "Le champ :attribute est obligatoire.", // "NSSValide"    => 'le numéro du securite sociale est invalide ',
           "date"         => "Le champ :attribute n'est pas une date valide.",
      ];
      $validator = Validator::make($request->all(),$rule,$messages);  
      if ($validator->fails()) 
        return redirect()->back()->withInput($request->input())->withErrors($validator->errors());
      $user = User::FindOrFail($id);
      $activer = $user->active;
      if($user->active)
      {
        if(! isset($request->desactiveCompt))
          $activer= 0;      
      }else
      {
        if(isset($request->activeCompt))
          $activer=1;
      }
      $user->update([
              'name'=>$request->username,
              "password"=>$user->password,
              "email"=>$request->email,
              "employee_id"=>$user->employee_id,
              "role_id"=>$request->role,
              "active"=>$activer,   
     ]);  
     return redirect(Route('users.show',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    //public function destroy(User $user)
    public function destroy(Request $request , $id)
    {
      $user = User::FindOrFail($id);
      employ::destroy($user->employee_id);  
      User::destroy($id);
      return redirect()->route('users.index');
    }
    protected function guard()
    {
      return Auth::guard();
    }
    protected function registered(Request $request, $user)
    {
        redirect()->route('users.create');
    }
    public function getAddEditRemoveColumnData()
    {
      $users = User::select(['id', 'name', 'email', 'employee_id','role_id']);
      return Datatables::of($users)
          ->addColumn('action2', function ($user) {
              return '<span class="label label-sm label-success">'.rol::FindOrFail($user->role_id)->role.'</span>';
          })
          ->addColumn('action', function ($user) {
              return '<div class="hidden-sm hidden-xs action-buttons">
                  <a class="blue" href="/users/'.$user->id.'">
                      <i class="ace-icon fa fa-search-plus bigger-130"></i>
                  </a>
                  <a class="green" href="'.route('users.edit',$user->id).'">
                      <i class="ace-icon fa fa-pencil bigger-130"></i>
                  </a>
                  <a class="red" href="">
                      <i class="ace-icon fa fa-trash-o bigger-130"></i>
                  </a>
              </div>';
          })->rawColumns(['action1', 'action2','action'])->make(true);
    }
    public function viewProfile($userId = null) {
        $user = null;      
        if($userId != null) {
            $user = User::find($userId);
            $employe = employ::FindOrFail($user->employee_id);
        } else {
            $user = User::find(Auth::user()->id);
            $employe = employ::FindOrFail($user->employee_id);
        }
        return view('user/profile', [
            'user' => $user,
            'employe' => $employe
        ]);
    }
    public function admin_credential_rules(array $data)
    {
      $messages = [
        'current-password.required' => 'Entrer le mot de passe actuel correct',
        'newPassword.required' => 'entrer le nouveau mot de passe SVP', 
        'password_confirmation.required' => 'Entrer le  mot de passe de confiration SVP',
        'password_confirmation.same'=>'le mot de passe du confirmation doit correspondre au  nouveau mot de passe',
      ];// |same:newPassword
      $validator = Validator::make($data, [
          'curPassword' => 'required',
          'newPassword' => 'required',
          'password_confirmation' => 'required|same:newPassword', 
          // |confirmed 
      ], $messages); // dd($validator->getMessageBag()); 
      return $validator;
    }  
    public function changePassword(Request $request)
    {
      if(Auth::Check())
      {
        $request_data = $request->All();
        $validator = $this->admin_credential_rules($request_data);
        if($validator->fails())
          return   redirect(url()->previous() . '#edit-password')->with("error",$validator->getMessageBag());
        else
        {
          $password = Auth::User()->password;         
          if(Hash::check($request_data['curPassword'], $password))
          {       
            if(strcmp($request->get('curPassword'), $request->get('newPassword')) == 0)
            {
              return   redirect(url()->previous() . '#edit-password')->with("error","Nouveau mot de passe ne peut pas être le même que votre mot de passe actuel. essaie encore!");
            }else{
                $user_id = Auth::User()->id;       
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request_data['newPassword']);
                $obj_user->save(); 
                  return   redirect(url()->previous() . '#edit-password')->with("error","mot de passe change savec success !");
            }                            
          } 
          else
            return redirect(url()->previous() . '#edit-password')->with("error","Entrer le mot de passe actuel correct. essaie encore.!!!");
        }
      }else
        return redirect()->to('/home');
    }
    public function setting($id_user)
    {
      $user = User::FindOrFail($id_user);
      return view('user.settings', compact('user'));
    }//public function updatepro(Request $request) { dd($request); }
    public function search(Request $request)
    {
      $value = trim($request->value);
      $users = null;
      switch($request->field)
      {
        case "role_id"  :
              $users = User::with('role')->where($request->field,$value)->get(); 
              break; 
        case "name"  :
              $users = User::with('role')->where($request->field,'LIKE','%'.$value."%")->get();  
              break;
        case "service_id"  :
              $users = User::with('role')->whereHas('employ', function ($q) use ($value){
                                             $q->where('service_id',$value);
                                         })->get();
              break; 
        default:    
              break;          
      }
/*if($request->field == "role_id")//$users = User::with('role')->whereHas('role', function ($q) use ($value){$q->where('role','LIKE','%'.$value.'%');})->get();
$users = User::with('role')->where($request->field,$value)->get();else $users = User::with('role')->where($request->field,'LIKE','%'.$value."%")->get();*/
      return $users;
    }    
    public function AutoCompleteField(Request $request)
    { 
      $response = array();$field = trim($request->field);$value = trim($request->q);
      if($field == "role_id")
        $users = User::whereHas('role', function ($q) use ($value){
                   $q->where('role','LIKE','%'.$value.'%');
                })->limit(2)->get();
      else
        $users = User::where($field, 'LIKE', '%'.$value.'%')->limit(15)->get();
      if($field == "role_id")
      {
        foreach($users as $user){
          $response[] = array("label"=>$user->role->role);
        }
      }else
      {
        foreach($users as $user){
          $response[] = array("label"=>$user->$field);
        }
      }
      return $response;
    }
    public function getUserDetails(Request $request)
    {
     $user = User::FindOrFail($request->search);
     $employe = employ::FindOrFail($user->employee_id);
     $view = view("user.ajax_userdetail",compact('user','role','employe'))->render();
     return (['html'=>$view]);
    }
    public function passwordReset(Request $request)
    {
      if(Auth::Check() && (Auth::user()->is(4)))
      {
        $user = User::FindOrFail($request->id);
        $user->update([
           "password"=> Hash::make($request['password']),
        ]);
       
      }
    }
}
