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
Route::group(['middleware' => 'revalidate'], function()
{          
        Auth::routes();     
         Route::get('/', function () {
              return view('auth/login');
        });
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
route::get('/home_reception','HomeController@index');
route::get('/home_dele','HomeController@index');
route::get('/home_admission','AdmissionController@index')->name('home_admission');
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
// Auth::routes();
route::get('/detailsdemande/{id}','demandeprodController@details_demande');
route::get('/listedemandes','demandeprodController@liste_demande');
route::get('/traiterdemande/{id}','demandeprodController@traiter_demande');
Route::post('user/credentials','UsersController@credentials');
Route::post('user/updatepro','UsersController@updatepro');
Route::get('/atcd/store66/{message}','AntecedantsController@storeatcd');
Route::get('/demandehosp/create/{id}','DemandeHospitalisationController@create');
Route::get('/demandehosp/listedemandes/{type}','DemandeHospitalisationController@listedemandes');
Route::get('/salle/create/{id}','SalleController@create');
Route::get('/lit/create/{id}','LitsController@create');
Route::get('/hospitalisation/create/{id}','HospitalisationController@create');
Route::get('/ordonnace/create/{id}','OrdonnanceController@create');
Route::get('/consultations/detailcons/{id}','ConsultationsController@detailcons')->name('consultDetails');
Route::get('/consultations/detailConsXHR','ConsultationsController@detailconsXHR')->name('consultdetailsXHR');
Route::get('/consultations/demandeExm/{id_cons}','ConsultationsController@demandeExm');
Route::resource('listeadmiscolloque','listeadmisColloqueController');
Route::post('/colloque/store/{id}','ColloqueController@store');// a revoir
Route::put('/colloque/{membres,id_demh}', 'ColloqueController@store');// a revoir
Route::resource('colloque','ColloqueController');
Route::get('/listecolloques/{type}','ColloqueController@index');
Route::get('/listecolloquesCloture/{type}','ColloqueController@getClosedColoques');
Route::resource('admission','AdmissionController');
route::get('/annullerRDV/{id}','AdmissionController@annulerRDV');
Route::get('/getAdmissions/{date}','AdmissionController@getAdmissions');//->name('admissionsXHR')

//Route::post('/hommeConfiance/save','HommeConfianceController@save');

Route::post('/hommeConfiance/save',function(Request $request){
          return("ff");
});
Route::resource('hommeConfiance','HommeConfianceController');


Route::resource('role','RolesController');
Route::resource('ticket','ticketController');
Route::resource('service','ServiceController');
Route::resource('exmbio','ExamenbioController');
Route::resource('exmimg','ExmImgrieController');
Route::get('hospitalisation/listeRDVs', 'HospitalisationController@getlisteRDVs');
Route::get('hospitalisation/addRDV', 'HospitalisationController@ajouterRDV');
Route::resource('hospitalisation','HospitalisationController');
Route::resource('salle','SalleController');
Route::resource('ordonnace','OrdonnanceController');
Route::resource('lit','LitsController');
Route::resource('demandehosp','DemandeHospitalisationController');
Route::resource('consultations','ConsultationsController');
Route::post('users/changePassword', 'UsersController@changePassword');
//Route::get('users/create','UsersController@create');
Route::resource('users','UsersController');
Route::post('/users/store/','UsersController@store');
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
Route::post('/exclinique/store/{id}','ExamenCliniqueController@store');
Route::get('/consultations/create/{id}','ConsultationsController@create');
Route::get('/listcons','ConsultationsController@listecons');
Route::get('/consultations/index/{id}','ConsultationsController@index');
Route::get('/patient/listerdv/{id}','PatientController@listerdv');
Route::get('/atcd/create/{id}','AntecedantsController@create');
Route::get('/atcd/index/{id}','AntecedantsController@index');
Route::get('/admission/create/{id}','AdmissionController@create');
Route::post('/admission/reporter/{id}','AdmissionController@reporterRDV');
Route::get('/admission/create/{id}{bool}',function(){
        // 'as'    => 'id',
        // 'uses'  => 'AdmissionController@AdmissionController'
   
});
Route::post('/atcd/store/{id}','AntecedantsController@store');
Route::get('/rdv/create/{id}','RDVController@create');
Route::post('/createRDV','RDVController@AddRDV');
Route::get('/rdv/valider/{id}','RDVController@valider');
Route::get('/rdv/reporter/{id}','RDVController@reporter');
Route::post('/rdv/reporte/{id}','RDVController@storereporte');
//ici
Route::get('/admission/imprimer/{rdv}', ['as' => 'admission.pdf', 'uses' => 'AdmissionController@print']);
Route::get('/choixpatient','RDVController@choixpatient');
Route::get('/home', 'HomeController@index')->name('home');
route::get('/getAddEditRemoveColumnData','UsersController@getAddEditRemoveColumnData');
route::get('/getrdv','RDVController@getRDV');
route::get('/getpatient','PatientController@getpatient');
route::get('/getpatientcons','PatientController@getpatientconsult');
route::get('/getpatientrdv','PatientController@getpatientrdv');
route::get('/getpatientatcd','PatientController@getpatientatcd');
route::get('/choixpat','ConsultationsController@choix');
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
Route::get('/home', 'HomeController@index')->name('home');
Route::post('AddANTCD','AntecedantsController@createATCDAjax');
Route::get('/searchUser','UsersController@search');
Route::get('/searchPatient','PatientController@search');
Route::get('/getPatients','PatientController@getPatientsArray');
Route::get('/getlits/{id}','LitsController@getlits');
Route::get('/user/find', 'UsersController@AutoCompleteUsername');
Route::get('/userdetail', 'UsersController@getUserDetails');
Route::get('/patients/find', 'PatientController@AutoCompletePatientname');
Route::get('/patients/findprenom','PatientController@AutoCompletePatientPrenom');
Route::get('/patients/findcom','PatientController@AutoCompleteCommune');
Route::get('/patientdetail/{id}', 'PatientController@getPatientDetails');
Route::get('/serviceRooms', 'ServiceController@getRooms');
Route::get('/getPatientsToMerge','PatientController@patientsToMerege');
Route::post('/patient/merge','PatientController@merge');
Route::get("flash","HomeController@flash");
route::get('/home_reception',function (){
    return view('home.home_recep');
})->name('home_rec');
Route::post('/get-all-events','RDVController@checkFullCalendar');
route::get('/showordonnance/{id}','OrdonnanceController@show_ordonnance');
Route::resource('demandeexb','DemandeExbController');
route::get('/demandeexbio/{id}','DemandeExbController@createexb');
route::get('/showdemandeexb/{id}','DemandeExbController@show_demande_exb'); 
Route::resource('demandeexr','DemandeExamenRadio'); 
route::get('/showdemandeexr/{id}','DemandeExamenRadio@show_demande_exr');
route::get('/affecterLit','AdmissionController@affecterLit');
///laborontin
route::get('/detailsdemandeexb/{id}','DemandeExbController@detailsdemandeexb');
route::post('/uploadresultat','DemandeExbController@uploadresultat');
route::get('/homelaboexb',function(){
    $demandesexb = App\modeles\demandeexb::where('etat','E')->get();
    return view('home.home_laboanalyses', compact('demandesexb'));
})->name('homelaboexb');
///radiologue
route::get('/details_exr/{id}','DemandeExamenRadio@details_exr');
route::post('/uploadexr','DemandeExamenRadio@upload_exr');
route::get('/homeradiologue',function(){
    $demandesexr = App\modeles\demandeexr::where('etat','E')->get();
    return view('home.home_radiologue', compact('demandesexr'));
})->name('homeradiologue');
// route with optonnel parameter
Route::get('rendezVous/create/{id?}','RDVController@index');
/************partie viste d'hospitalisation**************/
Route::resource('consigne','ConsigneController');
Route::resource('surveillance','SurveillanceController');
Route::get('/visite/create/{id}','VisiteController@create');
Route::get('/patient/listecons/{id}','PatientController@listecons');
Route::post('/visite/store/{id}','VisiteController@store');
Route::post('/surveillances/store/{id}','SurveillanceController@store');
route::get('/getpatientvisite','PatientController@getpatientvisite');
route::get('/getpatientconsigne','PatientController@getpatientconsigne');
route::get('/choixpatvisite','VisiteController@choixpatvisite');
route::get('/choixhospconsigne','ConsigneController@choixhospconsigne');
route::get('/consigne','ConsigneController@choixhospconsigne');
/**************************/
// telechargement
route::get('/download/{filename}', function($filename)
{
    return Storage::download($filename);
});