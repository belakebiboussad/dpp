<?php

namespace App\Http\Controllers;

use App\User;
use DB;
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
use View;
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
        $users = User::all();
        return view('user.listeusers',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = rol::all();
        return view('user.adduser', compact('roles'));
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
            "datenaissance"=> "required",
            "lieunaissance"=> "required",
            "adresse"=> "required",
            "mobile"=> "required",
            //"fixe"=> "required",age
           // "mat"=> "required",
            //"service"=> "required",
            "nss"=> "required",
            "username"=> "required",
            "password"=> "required",
            "mail"=> "required",
            "role"=> "required",
        ]);
        $employe = employ::firstOrCreate([
            "Nom_Employe"=>$request->nom,
            "Prenom_Employe"=>$request->prenom,
            "Sexe_Employe"=>$request->sexe,
            "Date_Naiss_Employe"=>$request->datenaissance,
            "Lieu_Naissance_Employe"=>$request->lieunaissance,
            "Adresse_Employe"=>$request->adresse,
            "Tele_fixe"=>$request->fixe,
            "tele_mobile"=>$request->mobile,
            "Specialite_Emploiye"=>$request->specialite,
            "Service_Employe"=>$request->service,
            "Matricule_dgsn"=>$request->mat,
            "NSS"=>$request->nss,
        ]);
        $usere = [
            "name"=>$request->username,
            "password"=>$request->password,
            "email"=>$request->mail,
            "employee_id"=>$employe->id,
            "role_id"=>$request->role,
        ];
         event(new Registered($user = RegisterController::create($usere)));
        //$this->guard()->login($user);
         return $this->registered($request, $user)
                        ?: redirect()->route('users.index');

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
        $employe = employ::FindOrFail($user->employee_id);
       $service = service::FindOrFail($employe->Service_Employe);
       $specialite= Specialite::FindOrFail($employe->Specialite_Emploiye);
       $roles = rol::all();
       $services=service::all();
       $specialites=specialite::all();
       return view('user.show_user',compact('user','employe','roles','service','specialite','services','specialites'));
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
          $employe = employ::FindOrFail($user->employee_id);
          $roles = rol::all()->keyBy('id');
           $services=service::all()->keyBy('id');
          $specialites = Specialite::all()->keyBy('id');
           return view('user.edit_user',compact('user','employe','roles','services','specialites'));
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

           $user = User::FindOrFail($id);
           $a=  $request->validate([
                  "username"=> "required",
                    "email"=> "nullable|email",//|unique:utilisateurs
                    "role"=> "required",
           ]); 
           $activer = $user->active;
           if($user->active)
           {
                     if(!isset($request->desactiveCompt))
                             $activer= 0;
           }else
           {
                     if(isset($request->activeCompt))
                            $activer=1;
           }
           //dd($activer);
           $userData = [
                    "name"=>$request->username,
                    "password"=>$user->password,
                    "email"=>$request->email,
                    "employee_id"=>$user->employee_id,
                    "role_id"=>$request->role,
                    "active"=>$activer,
           ];
        event(new Registered($user = RegisterController::update($user,$userData)));
        //$this->guard()->login($user);
         return $this->registered($request, $user)
                        ?: redirect()->route('users.edit',$id);
        // return redirect(Route('users.edit',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
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
            })
            ->rawColumns(['action1', 'action2','action'])
            ->make(true);
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
            ];
// |same:newPassword
            $validator = Validator::make($data, [
                'curPassword' => 'required',
                'newPassword' => 'required',
                'password_confirmation' => 'required|same:newPassword', 
                // |confirmed 
            ], $messages);
           // dd($validator->getMessageBag()); 
            return $validator;
        }  
    public function changePassword(Request $request){

        if(Auth::Check())
        {
             $request_data = $request->All();
             $validator = $this->admin_credential_rules($request_data);
             if($validator->fails())
            {

                  return   redirect(url()->previous() . '#edit-password')->with("error",$validator->getMessageBag());
            }else
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
                    {      
                          return   redirect(url()->previous() . '#edit-password')->with("error","Entrer le mot de passe actuel correct. essaie encore.!!!");
           
                    }
            }
        }else
        {
            return redirect()->to('/home');
        }
    }
    public function setting($id_user)
    {
        $user = User::FindOrFail($id_user);
        return view('user.settings', compact('user'));
    }
    public function updatepro(Request $request)
    {
        dd($request);
    }

      public function searchUser(Request $request)
        {
              if($request->ajax())  
             {
                        $output="";
                         //$users=DB::table('utilisateurs')->where('name','LIKE','%',$request->search."%")->get();
                         $users=DB::table('utilisateurs')->where('name','LIKE','%'.$request->search."%")->get();
                        if($users)
                        {
                                       $i=0;
                                       foreach ($users as $key => $user) {
                                                    $i++;
                                                    $compte='<span class="label label-sm label-danger">desactivé</span>';
                                                    if($user->active)
                                                                $compte='<span class="label label-sm label-success">active</span>';
                                                    //$role = rol
                                                    $role = rol::FindOrFail($user->role_id);          
                                                    $output.='<tr>'.
                                                     '<td >'.$i.'</td>'.
                                                     '<td hidden>'.$user->id.'</td>'.
                                                     // '<td><a href="/users/'.$user->id.'">'.$user->name.'</a></td>'.
                                                     '<td><a href="#" id ="'.$user->id.'" onclick ="getUserdetail('.$user->id.');">'.$user->name.'</a></td>'.
                                                     '<td>'.$user->email.'</td>'.
                                                     '<td>'.$role->role.'</td>'.
                                                     '<td>'.$compte.'</td>'.   
                                                     '<td>'.'<a href="/users/'.$user->id.'" class="'.'btn btn-white btn-sm"><i class="ace-icon fa fa-hand-o-up bigger-80"></i></a>'."&nbsp;&nbsp;".'<a href="/users/'.$user->id.'/edit" class="'.'btn btn-white btn-sm"><i class="fa fa-edit fa-lg" aria-hidden="true" style="font-size:16px;"></i></a>'.'</td>'.   
                                                     '</tr>';
                                       }
                          }
                          return Response($output)->withHeaders(['count' => $i]);
             }    
    }
    public function AutoCompleteUsername(Request $request)
    {
            return User::where('name', 'LIKE', '%'.trim($request->q).'%')->get();
    } 
    public function getUserDetails(Request $request)
    {
           $user = User::FindOrFail($request->search);
           $employe = employ::FindOrFail($user->employee_id);
           $view = view("user.ajax_userdetail",compact('user','role','employe'))->render();
           return response()->json(['html'=>$view]);
    }
    
}
