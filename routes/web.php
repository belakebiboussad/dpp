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
Route::group(['middleware' => 'revalidate'], function()
{          
    Auth::routes(); 
    Route::get('/', 'Auth\LoginController@showLoginForm');  /* Route::get('/', function () { return view('auth/login');  });*/
});//ressources
Route::resource('listeadmiscolloque','listeadmisColloqueController');
Route::resource('colloque','ColloqueController');
Route::resource('admission','AdmissionController');
Route::resource('hommeConfiance','HommeConfianceController');
Route::resource('role','RolesController');
Route::resource('ticket','ticketController');
Route::resource('service','ServiceController');
Route::resource('exmbio','ExamenbioController');
Route::resource('hospitalisation','HospitalisationController');
Route::resource('salle','SalleController');
Route::resource('ordonnace','OrdonnanceController');
Route::resource('lit','LitsController');
Route::resource('demandehosp','DemandeHospitalisationController');
Route::resource('consultations','ConsultationsController');
Route::resource('users','UsersController');
Route::resource('employs','EmployeController');
Route::resource('rdv','RDVController');
Route::resource('employe','EmployeController');
Route::resource('patient','PatientController');
Route::resource('assur','AssurController');
Route::resource('atcd','AntecedantsController');
Route::resource('medicaments','MedicamentsController');
Route::resource('demandeproduit','demandeprodController');
Route::resource('rdvHospi','RdvHospiController');
Route::resource('demandeexb','DemandeExbController');
Route::resource('demandeexr','DemandeExamenRadio');
Route::resource('visites','VisiteController'); 
Route::resource('acte','ActeController');
Route::resource('traitement','TraitementController');
Route::resource('surveillance','SurveillanceController');
Route::resource('reservation','BedReservationController');
route::get('/home_admin',function (){
    $users = App\User::all();
    return view('home.home_admin',compact('users'));
})->name('home_admin');
route::get('/home_reception',function (){
    return view('home.home_recep');
})->name('home_rec');
route::get('/home_reception','HomeController@index');
route::get('/home_dele','HomeController@index');
route::get('/home_admission','AdmissionController@index')->name('home_admission');
Route::get('/sortiesAdmission','AdmissionController@sortir')->name('admission.sortieAdm');
Route::get('/getSortiesAdmissions','AdmissionController@getSortiesAdmissions');//Route::get('/admission/create/{id}','AdmissionController@create');//a commenter
Route::get('sortiePatient/{id}','AdmissionController@updateAdm');
route::get('/demandeproduit/run/{id}','demandeprodController@run')->name('runDemande');
route::post('/demandeproduit/valider/{id}','demandeprodController@valider')->name('demandeproduit.valider');
Route::post('user/credentials','UsersController@credentials');
Route::post('user/updatepro','UsersController@updatepro');
Route::get('/atcd/store','AntecedantsController@storeatcd');
Route::get('/demandehosp/create/{id}','DemandeHospitalisationController@create');
Route::post('/demandehosp/valider','DemandeHospitalisationController@valider');
Route::post('/demandehosp/invalider','DemandeHospitalisationController@invalider');
Route::get('/demandehosp/listedemandes/{type}','DemandeHospitalisationController@listedemandes');
Route::get('/salle/create/{id}','SalleController@create');
Route::get('/lit/create/{id}','LitsController@create');
Route::get('/ordonnace/create/{id}','OrdonnanceController@create');
Route::post('/ordonnaces/print','OrdonnanceController@print');
Route::get('/consultations/detailcons/{id}','ConsultationsController@detailcons')->name('consultDetails');
Route::get('detailConsXHR/{id}','ConsultationsController@detailconsXHR')->name('consultdetailsXHR');
Route::get('/consultations/create/{id}','ConsultationsController@create');
Route::get('getConsultations/{id}','ConsultationsController@listecons');
Route::get('/createConsultation','ConsultationsController@choix');
Route::get('/choixpat','ConsultationsController@choix');
Route::get('/getConsultations','ConsultationsController@getConsultations');
Route::post('/colloque/store/{id}','ColloqueController@store');// a revoir
Route::put('/colloque/{membres,id_demh}', 'ColloqueController@store');// a revoir
Route::get('/listecolloques/{type}','ColloqueController@index');
Route::get('/listecolloquesCloture/{type}','ColloqueController@getClosedColoques');
Route::get('/runcolloque/{id}','ColloqueController@run');
Route::get('/endcolloque/{id}','ColloqueController@cloture');
Route::post('/savecolloque/{id}','ColloqueController@save');
Route::get('/getRdvs/{date}','RdvHospiController@getRdvs')->name('rdvHospi.dayRdvsHosp');
Route::get('/getUrgdemande/{date}','DemandeHospitalisationController@getUrgDemanades')->name('demandehosp.urg');
Route::get('/listeRDVs', 'RdvHospiController@getlisteRDVs');
Route::post('/hospitalisation/{id}','HospitalisationController@update');
Route::get('/getHospitalisations','HospitalisationController@getHospitalisations');
Route::post('users/changePassword', 'UsersController@changePassword');
Route::post('/users/store/','UsersController@store');
Route::get('/searchAssure','AssurController@search');
route::get('/getsalles','SalleController@getsalles');
Route::get('/atcd/create/{id}','AntecedantsController@create');
Route::get('/atcd/index/{id}','AntecedantsController@index');
Route::post('/atcd/store/{id}','AntecedantsController@store');
Route::get('/rdv/create/{id}','RDVController@create');
Route::post('/createRDV','RDVController@AddRDV');
Route::get('/rdv/valider/{id}','RDVController@valider');
Route::get('/rdv/reporter/{id}','RDVController@reporter');
Route::post('/rdv/reporte/{id}','RDVController@storereporte');
Route::get('rdvprint/{id}','rdvController@print');
Route::get('rdvHospi/create/{id}','RdvHospiController@create')->name('rdvHospi.create');
Route::get('/rdvHospi/imprimer/{rdv}', ['as' => 'admission.pdf', 'uses' => 'RdvHospiController@print']);
Route::get('/choixpatient','RDVController@choixpatient');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reportprint','HomeController@print');
route::get('/getAddEditRemoveColumnData','UsersController@getAddEditRemoveColumnData');
route::get('/getrdv','RDVController@getRDV');
route::get('/getpatient','PatientController@getpatient');
route::get('/getpatientcons','PatientController@getpatientconsult');
route::get('/getpatientrdv','PatientController@getpatientrdv');
route::get('/getpatientatcd','PatientController@getpatientatcd');
route::get('/getproduits/{idgamme}/{idspec}','demandeprodController@get_produit');
route::get('/createsalle','SalleController@createsalle');
Route::post('/exmbio/store/{id}','ExamenbioController@store');
route::get('/createlit','LitsController@createlit');
route::get('/getmedicaments','MedicamentsController@getmedicaments');
route::get('/getmedicamentsPCH','MedicamentsController@getmedicamentsPCH');
route::get('/getdispositifsPCH','MedicamentsController@getdispositifsPCH');
route::get('/getreactifsPCH','MedicamentsController@getreactifsPCH');
route::get('/getmed/{id}','MedicamentsController@getmed');
route::get('/setting/{id}', 'UsersController@setting');
Route::get('/ticket/{ticket}', ['as' => 'ticket.pdf', 'uses' => 'ticketController@ticketPdf']);

Route::group(['as' => 'user.'], function() {
Route::any('/profile/{userId}', [
        'as'    => 'profile',
        'uses'  => 'UsersController@viewProfile'
    ]);
});

Route::get('/role/show/{userId}','RolesController@show');// Route::get('/home', 'HomeController@index')->name('home');
Route::post('AddANTCD','AntecedantsController@createATCDAjax');
Route::get('/DocorsSearch','EmployeController@searchBySpececialite');
Route::get('/searchPatient','PatientController@search')->name('patients.search');
Route::post('/updatePatient/{id}','PatientController@updateP')->name('patients.Update');
Route::get('/getPatients','PatientController@getPatientsArray');
Route::post('/user/find', 'UsersController@AutoCompleteField')->name('users.autoField');
Route::get('/searchUser','UsersController@search');
Route::get('/userdetail', 'UsersController@getUserDetails');
Route::post('/patients/autoField', 'PatientController@AutoCompletePatientField')->name('patients.autoField');
Route::post('/findCom','CommuneController@AutoCompleteCommune')->name('commune.getCommunes');
Route::get('/patientdetail/{id}', 'PatientController@getPatientDetails');
Route::get('/patientsToMerge','PatientController@patientsToMerege');
Route::post('/patient/merge','PatientController@merge');
Route::get("flash","HomeController@flash");
Route::get('/getlits','LitsController@getlits');
Route::get('/serviceRooms', 'ServiceController@getRooms');
Route::get('/salleRooms', 'SalleController@getRooms');
route::get('/home_reception',function (){
    return view('home.home_recep');
})->name('home_rec');
Route::post('/get-all-events','RDVController@checkFullCalendar');
route::get('/showordonnance/{id}','OrdonnanceController@show_ordonnance')->name('ordonnancePdf');
route::get('/demandeexbio/{id}','DemandeExbController@createexb');
route::get('/showdemandeexb/{id}','DemandeExbController@print');
route::get('/showdemandeexr/{id}','DemandeExamenRadio@print');
Route::post('lit/affecter','LitsController@affecterLit')->name('lit.affecter');
Route::get('/bedAffectation','LitsController@affecter');

route::get('/detailsdemandeexb/{id}','DemandeExbController@detailsdemandeexb');///laborontin
route::post('/uploadresultat','DemandeExbController@uploadresultat');
route::get('/homelaboexb',function(){
    $demandesexb = App\modeles\demandeexb::where('etat','E')->get();
    return view('home.home_laboanalyses', compact('demandesexb'));
})->name('homelaboexb');
route::get('/details_exr/{id}','DemandeExamenRadio@details_exr');///radiologue
route::post('/uploadexr','DemandeExamenRadio@upload_exr');
route::get('/homeradiologue',function(){
    $demandesexr = App\modeles\demandeexr::where('etat','E')->get();
    return view('home.home_radiologue', compact('demandesexr'));
})->name('homeradiologue');
// route with optonnel parameter
Route::get('rendezVous/create/{id?}','RDVController@create');
Route::get('/pdf/{order}', ['as' => 'rdv.pdf', 'uses' => 'rdvController@orderPdf']);
Route::get('assur/patientAssuree/{NSS}/{Type}/{Prenom}','PatientController@create');
Route::post('/addpatientAssure','PatientController@storePatient');
Route::get('assur/patientAedit/{id}/{idA}','PatientController@edit');
/************partie viste d'hospitalisation**************/
Route::get('/delVisite/{id}', 'VisiteController@destroy')->name('visite.destroy');
Route::get('/visite/create/{id}','VisiteController@create');
Route::post('/visite/store/{id}','VisiteController@store');
Route::post('/surveillances/store/{id}','SurveillanceController@store');
route::get('/getpatientvisite','PatientController@getpatientvisite');
route::get('/getpatientconsigne','PatientController@getpatientconsigne');
route::get('/choixpatvisite','VisiteController@choixpatvisite');
route::get('/choixhospconsigne','ActeController@choixhospconsigne');
route::get('/consigne','ActeController@choixhospconsigne');
route::post('/saveActe','ActeController@store');
route::get('/schapitres','CimController@getChapters');
route::get('/maladies','CimController@getdiseases');
Route::get('/404', function () {
    return view('errors.404');
});
/**************************/// telechargement
route::get('/download/{filename}', function($filename)
{
    return Storage::download($filename);
});