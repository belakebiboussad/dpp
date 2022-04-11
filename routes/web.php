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
  Route::get('/', 'Auth\LoginController@showLoginForm');
});//ressources
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
Route::resource('etablissement','EtablissementControler');
Route::resource('crrs','CRRControler');
Route::resource('stat','StatistiqusController');
Route::resource('params','paramController');
Route::resource('soins','SoinsController');
route::resource('/const','ConstanteController');
route::resource('acteExec','ActeExecController');
route::resource('traitExec','TraitExecsController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sortiesAdmission','AdmissionController@sortir')->name('admission.sortieAdm');
Route::get('/getSortiesAdmissions','AdmissionController@getSortiesAdmissions');
Route::get('sortiePatient/{id}','AdmissionController@updateAdm');
Route::get('/admdetail/{id}', 'AdmissionController@getDetails');
route::get('/demandeproduit/run/{id}','demandeprodController@run')->name('runDemande');
route::post('/demandeproduit/valider/{id}','demandeprodController@valider')->name('demandeproduit.valider');
route::get('/demandeproduit/rejeter/{id}/{motif}','demandeprodController@rejeter');
route::get('/products/list','demandeprodController@getProducts')->name('productsList');
route::get('/searchProductsRequests','demandeprodController@search')->name('demandeProducts.search');
Route::post('user/credentials','UsersController@credentials');
Route::post('user/updatepro','UsersController@updatepro');//Route::get('/atcd/store','AntecedantsController@storeatcd');
Route::get('/demandehosp/create/{id}','DemandeHospitalisationController@create');
Route::post('/demandehosp/valider','DemandeHospitalisationController@valider');
Route::post('/demandehosp/invalider','DemandeHospitalisationController@invalider');
Route::get('/demandehosp/listedemandes/{type}','DemandeHospitalisationController@listedemandes');
Route::post('/ordonnaces/print','OrdonnanceController@print');
Route::get('/consultations/detailcons/{id}','ConsultationsController@detailcons')->name('consultDetails');
Route::get('detailConsXHR/{id}','ConsultationsController@detailconsXHR')->name('consultdetailsXHR');
Route::get('/consultations/create/{id}','ConsultationsController@create');
Route::get('getConsultations/{id}','ConsultationsController@listecons');
Route::get('/createConsultation','ConsultationsController@choix');
Route::get('/choixpat','ConsultationsController@choix');
Route::get('/getConsultations','ConsultationsController@getConsultations');
Route::get('/getRdvs/{date}','RdvHospiController@getRdvs');
Route::get('/getRdvs','RdvHospiController@getRdvs');
Route::post('/colloque/store/{id}','ColloqueController@store');// a revoir
Route::put('/colloque/{membres,id_demh}', 'ColloqueController@store');// a revoir
Route::get('/listecolloques/{type}','ColloqueController@index');
Route::get('/listecolloquesCloture/{type}','ColloqueController@getClosedColoques');
Route::get('/runcolloque/{id}','ColloqueController@run');
Route::get('/endcolloque/{id}','ColloqueController@cloture');
Route::post('/savecolloque/{id}','ColloqueController@save');
Route::get('/getUrgdemande/{date}','DemandeHospitalisationController@getUrgDemanades')->name('demandehosp.urg');
Route::get('/listeRDVs', 'RdvHospiController@getlisteRDVs');
Route::post('/hospitalisation/{id}','HospitalisationController@update');
Route::get('/getHospitalisations','HospitalisationController@getHospitalisations');
Route::get('detailHospXHR/{id}','HospitalisationController@detailHospXHR')->name('hospdetailsXHR');
Route::get('/barreCodeprint', ['as' => 'barreCode.print', 'uses' => 'HospitalisationController@codebarrePrint']);
Route::post('users/changePassword', 'UsersController@changePassword');
Route::post('/users/store/','UsersController@store');
Route::get('/searchAssure','AssurController@search');
Route::get('/atcd/create/{id}','AntecedantsController@create');
Route::get('/atcd/index/{id}','AntecedantsController@index');
Route::post('/atcd/store/{id}','AntecedantsController@store');
Route::get('/rdv/create/{id}','RDVController@create');
Route::get('/rdv/valider/{id}','RDVController@valider');
Route::get('/rdv/reporter/{id}','RDVController@reporter');
Route::post('/rdv/reporte/{id}','RDVController@storereporte');
Route::get('rdvprint/{id}', ['as' => 'rdv.print', 'uses' => 'rdvController@print']);
Route::get('rdvHospi/create/{id}','RdvHospiController@create')->name('rdvHospi.create');
Route::get('/rdvHospi/imprimer/{rdv}', ['as' => 'admission.pdf', 'uses' => 'RdvHospiController@print']);
Route::get('rdvHospi/ticketPrint/{id}','RdvHospiController@ticketPrint');
Route::get('/choixpatient','RDVController@choixpatient');
Route::get('/reportprint','HomeController@print');
route::get('/getAddEditRemoveColumnData','UsersController@getAddEditRemoveColumnData');
route::get('/getrdv','RDVController@getRDV');
route::get('/getpatient','PatientController@getpatient');
route::get('/getpatientcons','PatientController@getpatientconsult');
route::get('/getproduits/{idgamme}/{idspec}','demandeprodController@get_produit');
route::get('/getsalles','SalleController@getsalles');
route::get('/salles/{id}','ServiceController@getsalles');
Route::post('/exmbio/store/{id}','ExamenbioController@store');
route::get('/getmedicaments','MedicamentsController@getmedicaments');
route::get('/getmedicamentsPCH','MedicamentsController@getmedicamentsPCH');
route::get('/getdispositifsPCH','MedicamentsController@getdispositifsPCH');
route::get('/getreactifsPCH','MedicamentsController@getreactifsPCH');
route::get('/getmed/{id}','MedicamentsController@getmed');//route::get('/setting/{id}', 'UsersController@setting');
Route::get('/ticket/{ticket}', ['as' => 'ticket.pdf', 'uses' => 'ticketController@ticketPdf']);
Route::group(['as' => 'user.'], function() {
Route::any('/profile/{userId}', [
        'as'    => 'profile',
        'uses'  => 'UsersController@viewProfile'
    ]);
});
Route::get('/role/show/{userId}','RolesController@show');
Route::post('AddANTCD','AntecedantsController@createATCDAjax');
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
Route::get('/getlits','LitsController@getlits');//Route::post('/get-all-events','RDVController@checkFullCalendar');
route::get('/showordonnance/{id}','OrdonnanceController@show_ordonnance')->name('ordonnancePdf');
Route::post('lit/affecter','LitsController@affecterLit')->name('lit.affecter');
Route::get('/bedAffectation','LitsController@affecter');//route::get('/demandeexbio/{id}','DemandeExbController@createexb');
route::get('/dbToPDF/{id}','DemandeExbController@print');
route::get('/searchBioRequests','DemandeExbController@search');
route::get('/detailsdemandeexb/{id}','DemandeExbController@detailsdemandeexb');
route::post('/uploadresultat','DemandeExbController@uploadresultat');
route::get('/details_exr/{id}','DemandeExamenRadio@details');
Route::post('store-file', 'DemandeExamenRadio@upload');
Route::post('delete-file', 'DemandeExamenRadio@delResult');
Route::post('cancel-exam', 'DemandeExamenRadio@examCancel');
route::get('/examRadioDel/{id}', 'DemandeExamenRadio@examDestroy')->name('examRad.destroy');
route::get('/drToPDF/{id}','DemandeExamenRadio@print');
route::get('/searchImgRequests','DemandeExamenRadio@search');
Route::get('assur/patientAssuree/{NSS}/{Type}/{Prenom}','PatientController@create');
Route::post('/addpatientAssure','PatientController@storePatient');
Route::get('assur/patientAedit/{id}/{idA}','PatientController@edit');
Route::post('/surveillances/store/{id}','SurveillanceController@store');
route::get('/getpatientvisite','PatientController@getpatientvisite');
route::get('/getpatientconsigne','PatientController@getpatientconsigne');
Route::get('/delVisite/{id}', 'VisiteController@destroy')->name('visite.destroy');
Route::get('/visite/create/{id}','VisiteController@create');
Route::post('/visite/store/{id}','VisiteController@store');//route::post('/saveActe','ActeController@store');
route::get('/acte/run/{id}','ActeController@run')->name('runActe');
route::get('/schapitres','CimController@getChapters');
route::get('/maladies','CimController@getdiseases');
Route::get('/crrs/download/{id}', 'CRRControler@download')->name('crrs.download');
Route::get('/crbs/download/{id}', 'DemandeExbController@downloadcrb')->name('crbs.download');
Route::post('/createTicket','ticketController@store');
Route::get('/listRdvs','RDVController@listeRdvs');
Route::get('/soins/index/{id}','SoinsController@index');
Route::get('/404', function () {
    return view('errors.404');
});
route::post('/storeconstantes','HospitalisationController@storeconstantes');
route::get('/getpoids/{id}', 'HospitalisationController@get_poids');
route::get('/getdayspoids/{id}', 'HospitalisationController@get_days_poids');
route::get('/gettaille/{id}', 'HospitalisationController@get_taille');
route::get('/getpas/{id}', 'HospitalisationController@get_pas');
route::get('/getpad/{id}', 'HospitalisationController@get_pad');
route::get('/getpouls/{id}', 'HospitalisationController@get_pouls');
route::get('/gettemp/{id}', 'HospitalisationController@get_temp');
route::get('/getglycemie/{id}', 'HospitalisationController@get_glycemie');
route::get('/getcholest/{id}','HospitalisationController@get_cholest');
route::post('/storeprescriptionconstantes','HospitalisationController@store_prescription_constantes');
Route::post('/admin/password/reset','UsersController@passwordReset');
Route::get('/traitdetails/{id}', 'TraitementController@getTraitDetails')->name('traits.details');