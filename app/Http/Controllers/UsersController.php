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
    public function index(Request $request)
    {
      if($request->ajax())  
      {
        $value = trim($request->value);
        $users = null;
        switch($request->field)
        {
          case "role_id"  :
                $users = User::with('role','employ.Service')->where($request->field,$value)->get(); 
                break; 
          case "username"  :
                $users = User::with('role','employ.Service')->where($request->field,'LIKE','%'.$value."%")->get();  
                break;
          case "service_id"  :
                $users = User::with('role','employ.Service')->whereHas('employ', function ($q) use ($value){
                                               $q->where('service_id',$value);
                                           })->get();
                break; 
          default:    
                break;          
        }
        return $users;
      }else
      {
        $roles = rol::all();
        $services = service::all();
        return view('user.index',compact('roles','services'));
      }
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
      return view('user.create', compact('roles','services','specialites'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        "username"=> "required|unique:utilisateurs",
        "password"=> "required",
        "role"=> "required",
        "nom"=> "required",
        "prenom"=> "required",
        "nss"=> "required",
        "dob"=> "required",// "lieunaissance"=> "required",
        "mobile"=> "required | regex:/[0][2345679][0-9]{8}/",// "mat"=> 
        "service"=> "required", 
      ]);
      if($validator->fails())
           return back()->withErrors($validator)->withInput();
      $employe = employ::firstOrCreate([
          "nom"=>$request->nom,"prenom"=>$request->prenom,
          "sexe"=>$request->sexe,"dob"=>$request->dob,
          "pob"=>$request->pob,"Adresse"=>$request->adresse,
          "phone"=>$request->fixe,
          "mob"=>$request->mobile,
          "specialite"=>$request->specialite,
          "service_id"=>$request->service,
          "matricule"=>$request->mat,
          "NSS"=>$request->nss,
      ]);
     
      $employe->User()->create([
        "username"=>$request->username,
        "password"=> Hash::make($request->password),
        "email"=>$request->email,
        "role_id"=>$request->role,
      ]);
      return redirect(Route('users.show',$employe->User->id));                 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    { 
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
    public function edit(User $user)
    {
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
    public function update(Request $request, User $user)
    {  
      $validator = Validator::make($request->all(), [
        "username"=> "required",// "mail"=> "required", "password"=> "required",
        "role"=> "required",
        "nom"=> "required",
        "prenom"=> "required",
        "dob"=> "required",// "lieunaissance"=> "required",
        "mobile"=> "required | regex:/[0][245679][0-9]{8}/",
      ]);
      if ($validator->fails())
        return back()->withInput($request->input())->withErrors($validator->errors());
      
      $user->employ->update([
        "nom"=>$request->nom, "prenom"=>$request->prenom,
        "sexe"=>$request->sexe, "dob"=>$request->dob,
        "pob"=>$request->pob,"Adresse"=>$request->adresse,
        "phone"=>$request->fixe, "mob"=>$request->mobile,
        "specialite"=>$request->specialite,"service_id"=>$request->service,
         "matricule"=>$request->matricule,"NSS"=>$request->nss,
      ]);
      $user->update([
        'username'=>$request->username,
        "role_id"=>$request->role,
        'active' =>$request->active
      ]);
      return redirect(Route('users.show', $user));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,  User $user)
    {
          $user->employ->delete();
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
    public function viewProfile($userId = null) {
        $user = null;      
        if($userId != null) {
            $user = User::find($userId);
            $employe = employ::FindOrFail($user->employe_id);
        } else {
            $user = User::find(Auth::user()->id);
            $employe = employ::FindOrFail($user->employe_id);
        }
        return view('user/profile', [
            'user' => $user,
            'employe' => $employe
        ]);
    }
    public function admin_credential_rules(array $data)
    {
      $messages = [
        'current-password.required' => 'Entrer le mot de passe actuel',
        'newPassword.required' => 'entrer le nouveau mot de passe SVP',
        'newPassword.different' => 'le nouveau mot de passe doit être differnt du mot de passe actuel',
        'password_again.same'=>'le mot de passe du confirmation doit correspondre au  nouveau mot de passe',

      ];
      $validator = Validator::make($data, [
        'current-password' =>  "required",
        'newPassword' => 'required|different:current-password',
        'password_again' => 'required|same:newPassword',     
      ], $messages);
      return $validator;
    }  
    public function changePassword(Request $request)//change password by user
    {   
      if(Auth::Check())
      {
        $request_data = $request->All();
        $validator = $this->admin_credential_rules($request_data);
        if($validator->fails())//pass cof error
          return response()->json(['errors'=>$validator->errors()->all()]);
        else
        {
          $password = Auth::User()->password;  
          if(Hash::check($request_data['current-password'], $password))
          {
            if(strcmp($request->get('current-password'), $request->get('newPassword')) == 0)
              return response()->json(['errors'=>$validator->errors()->all()]);
            else
            {
              Auth::user()->password = Hash::make($request_data['newPassword']);
              Auth::user()->save(); 
              return response()->json(['success'=>'mot de passe est changé avec succée']);
            }
          }else
            return response()->json(['errors'=>['Entrer le mot de passe actuel correct. essaie encore']]);
        }
      }
      return redirect()->to('/home');
    }//changer le mot de passe par l'administrateur
    public function resetPassword(Request $request)
    { 
      if(Auth::Check() && (Auth::user()->is(4)))
      {
        $request_data = $request->All();
        $validator = $this->admin_credential_rules($request_data);
        if ($validator->fails())
          return response()->json(['errors'=>$validator->errors()->all()]);
        $user = User::FindOrFail($request->id);
        $user->update([
           "password"=> Hash::make($request['newPassword']),
        ]);
        return response()->json(['success'=>'le mot de passe est changé avec succée']);
      } 
    }
    public function setting($id_user)
    {
      $user = User::FindOrFail($id_user);
      return view('user.settings', compact('user'));
    }    
    public function AutoCompleteField(Request $request)
    { 
      $response = []; $field = trim($request->field);$value = trim($request->q);
      if($field == "role_id")
        $users = User::whereHas('role', function ($q) use ($value){
                   $q->where('role','LIKE','%'.$value.'%');
                })->limit(2)->get();
      else
        $users = User::where($field, 'LIKE', '%'.$value.'%')->limit(15)->get();
      if($field == "role_id")
      {
        foreach($users as $user){
          $response[] = array("label"=>$user->role->nom);
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
     $employe = employ::FindOrFail($user->employe_id);
     $view = view("user.ajax_userdetail",compact('user','employe'))->render();
     return (['html'=>$view]);
    }
}
