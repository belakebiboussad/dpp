<?php

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
// Route::group(['middleware' => ['web']], function () {});
    //
Route::get('/', function () {
    return view('auth/login');
});
route::get('/home_chef', function(){
    $meds = App\modeles\medcamte::all();
    $dispositifs = App\modeles\dispositif::all();
    $reactifs = App\modeles\reactif::all();
    return view('home.home_chef_ser', compact('meds','dispositifs','reactifs'));
});
route::get('/home_phar', function(){
    $meds = App\modeles\medcamte::all();
    $dispositifs = App\modeles\dispositif::all();
    $reactifs = App\modeles\reactif::all();
    return view('home.home_pharmacien', compact('meds','dispositifs','reactifs'));
});
route::get('/home_admin',function (){
    $users = App\User::all();
    return view('home.home_admin',compact('users'));
})->name('home_admin');
route::get('/home_medcine',function (){
    $patients = App\modeles\patient::all();
    $employ = App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first();
    $date = Date::Now()->toDateString();
    $rdvs = App\modeles\ticket::where("specialite",$employ->Specialite_Emploiye)
                    ->where("date",$date)->get();
    return view('home.home_med', compact('patients','rdvs'));
})->name('home_med');
route::get('/home_reception',function (){
    return view('home.home_recep');
})->name('home_rec');
route::get('/home_sur',function (){
$d=App\modeles\admission::select('id_demande')->get();
     $demandes= App\modeles\colloque::join('dem_colloques','colloques.id','=','dem_colloques.id_colloque')->join('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->select('demandehospitalisations.id as id_demande','demandehospitalisations.*','colloques.id as id_colloque','colloques.*','patients.Nom','patients.Prenom','dem_colloques.ordre_priorite','dem_colloques.observation')->whereNotIn('demandehospitalisations.id',$d)->get();
    return view('home.home_surv_med', compact('demandes'));

});
route::get('/home_dele',function (){
    $demandes = App\modeles\consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                                        ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                                                        ->select('demandehospitalisations.*','demandehospitalisations.id as ident','consultations.Employe_ID_Employe','consultations.Date_Consultation','patients.Nom','patients.Prenom','patients.Dat_Naissance')
                                                        ->get();
                                                        //dd($demandes);
        $colloques= App\modeles\colloque::join('membres','colloques.id','=','membres.id_colloque')->join('employs','membres.id_employ','=','employs.id')->join('dem_colloques','colloques.id','=','dem_colloques.id_colloque')->join('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->select('demandehospitalisations.id','demandehospitalisations.Date_demande','colloques.id as id_colloque','colloques.*','employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom')->get();
        //dd($colloques);
    return view('home.home_dele_coll', compact('demandes','colloques'));

});
Route::get('exbio/{filename}', function ($filename)
{
    // im not 100% sure about the $path thingy, you need to fiddle with this one around.
    $path = storage_path() . '\\app\\' . $filename;
    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
Auth::routes();
route::get('/detailsdemande/{id}','demandeprodController@details_demande');
route::get('/listedemandes','demandeprodController@liste_demande');
route::get('/traiterdemande/{id}','demandeprodController@traiter_demande');
Route::post('user/credentials','UsersController@credentials');
Route::post('user/updatepro','UsersController@updatepro');
Route::get('/atcd/store66/{message}','AntecedantsController@storeatcd');
Route::get('/demandehosp/create/{id}','DemandeHospitalisationController@create');
Route::get('/salle/create/{id}','SalleController@create');
Route::get('/lit/create/{id}','LitsController@create');
Route::get('/hospitalisation/create/{id}','HospitalisationController@create');
Route::get('/ordonnace/create/{id}','OrdonnanceController@create');
Route::get('/consultations/detailcons/{id}','ConsultationsController@detailcons')->name('consultDetails');
Route::get('/consultations/demandeExm/{id_cons}','ConsultationsController@demandeExm');
Route::resource('listeadmiscolloque','listeadmisColloqueController');
Route::post('/colloque/store/{id}','ColloqueController@store');// a revoir
Route::put('/colloque/{membres,id_demh}', 'ColloqueController@store');// a revoir
//Route::get('/colloque/new/{id_colloque}','ColloqueController@new');
Route::resource('colloque','ColloqueController');
Route::resource('admission','AdmissionController');
Route::resource('role','RolesController');
Route::resource('ticket','ticketController');
Route::resource('service','ServiceController');
Route::resource('exmbio','ExamenbioController');
Route::resource('exmimg','ExmImgrieController');
Route::resource('hospitalisation','HospitalisationController');
Route::resource('salle','SalleController');
Route::resource('ordonnace','OrdonnanceController');
Route::resource('lit','LitsController');
Route::resource('demandehosp','DemandeHospitalisationController');
Route::resource('consultations','ConsultationsController');
Route::post('users/changePassword', 'UsersController@changePassword');
Route::resource('users','UsersController');
Route::resource('employs','EmployeController');
Route::resource('rdv','RDVController');
Route::resource('employe','EmployeController');
Route::resource('patient','PatientController');
Route::resource('assur','AssurController');
Route::resource('atcd','AntecedantsController');
Route::resource('medicaments','MedicamentsController');
Route::resource('exclinique','ExamenCliniqueController');
Route::resource('demandeproduit','demandeprodController');
route::get('/getsalles/{id}','SalleController@getsalles');
Route::post('/consultations/store/{id}','ConsultationsController@store');
Route::post('/exclinique/store/{id}','ExamenCliniqueController@store');
Route::get('/consultations/create/{id}','ConsultationsController@create');
Route::get('/listcons','ConsultationsController@listecons');
Route::get('/consultations/index/{id}','ConsultationsController@index');
Route::get('/patient/listerdv/{id}','PatientController@listerdv');
Route::get('/atcd/create/{id}','AntecedantsController@create');
Route::get('/atcd/index/{id}','AntecedantsController@index');
Route::get('/admission/create/{id}','AdmissionController@create');
// Route::get('/store1','AntecedantsController@store1');
Route::post('/atcd/store/{id}','AntecedantsController@store');
Route::get('/rdv/create/{id}','RDVController@create');
Route::get('/rdv/valider/{id}','RDVController@valider');
Route::get('/rdv/reporter/{id}','RDVController@reporter');
Route::post('/rdv/storereporte/{id}','RDVController@storereporte');
Route::get('/choixpatient','RDVController@choixpatient');
Route::get('/home', 'HomeController@index')->name('home');
route::get('/getAddEditRemoveColumnData','UsersController@getAddEditRemoveColumnData');
route::get('/getrdv','RDVController@getRDV');
route::get('/getpatient','PatientController@getpatient');
route::get('/getpatientcons','PatientController@getpatientconsult');
route::get('/getpatientrdv','PatientController@getpatientrdv');
route::get('/getpatientatcd','PatientController@getpatientatcd');
route::get('/choixpat','ConsultationsController@choix');
// route::get('/choixpat','PatientController@index');
route::get('/choixpatatcd','AntecedantsController@choixpatatcd');
route::get('/getspecialite/{id}','demandeprodController@get_specialite');
route::get('/getproduits/{idgamme}/{idspec}','demandeprodController@get_produit');
route::get('/createsalle','SalleController@createsalle');
Route::post('/exmbio/store/{id}','ExamenbioController@store');
Route::post('/exmimg/store/{id}','ExmImgrieController@store');
route::get('/createlit','LitsController@createlit');
route::get('/getmedicaments','MedicamentsController@getmedicaments');
route::get('/getmed/{id}','MedicamentsController@getmed');
route::get('/setting/{id}', 'UsersController@setting');
Route::get('/pdf/{order}', ['as' => 'order.pdf', 'uses' => 'rdvController@orderPdf']);
Route::get('/ticket/{ticket}', ['as' => 'ticket.pdf', 'uses' => 'ticketController@ticketPdf']);
Route::group(['as' => 'user.'], function() {
Route::any('/profile/{userId}', [
        'as'    => 'profile',
        'uses'  => 'UsersController@viewProfile'
    ]);
});
Route::get('/role/show/{userId}','RolesController@show');
Route::get('/role/show/{userId}','RolesController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('AddANTCD','AntecedantsController@createATCDAjax');

// Route::get('/pdf', function () {
//     return view('pdf');
// });

