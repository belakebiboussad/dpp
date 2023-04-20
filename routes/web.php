<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by th  e RouteServiceProvider within a group which
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
Route::resource('appreilExamClin','AppareilExamenCliniqueController');
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
route::resource('const','ConstanteController');
route::resource('acteExec','ActeExecController');
route::resource('orientLetter','LettreOrientationController');
route::resource('certifDescrip','CertificatDescriptifController');
route::resource('traitExec','TraitExecController');
Route::resource('bedAffectation','AffectationsController');
Route::resource('planning','PlanningController');
route::resource('allergie','AllergieController');
Route::resource('maladies','CimController');
Route::resource('vaccin','VaccinController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sortiesAdmission','AdmissionController@sortir')->name('admission.sortieAdm');
Route::get('/getSortiesAdmissions','AdmissionController@getSortiesAdmissions');
Route::get('sortiePatient/{id}','AdmissionController@updateAdm');
route::get('/demandeproduit/run/{id}','demandeprodController@run')->name('runDemande');
route::post('/demandeproduit/valider/{id}','demandeprodController@valider')->name('demandeproduit.valider');
route::get('/demandeproduit/rejeter/{id}/{motif}','demandeprodController@rejeter');
route::get('/products/list','demandeprodController@getProducts')->name('productsList');
Route::post('user/credentials','UsersController@credentials');
Route::post('user/updatepro','UsersController@updatepro');
Route::get('/demandehosp/create/{id}','DemandeHospitalisationController@create');
Route::post('/demande_validating','DemandeHospitalisationController@valider')->name('demande_validate');
Route::post('/demande_invalidating','DemandeHospitalisationController@invalider')->name('demande_invalidate');
Route::get('/consultations/detailcons/{id}','ConsultationsController@detailcons')->name('consultDetails');
Route::get('/consultations/create/{id}','ConsultationsController@create');
Route::get('/getConsultations','ConsultationsController@getConsultations');Route::get('/getRdvs','RdvHospiController@getRdvs');
Route::post('/colloque/store/{id}','ColloqueController@store');// a revoir
Route::put('/colloque/{membres,id_demh}', 'ColloqueController@store');// a revoir
Route::get('/listecolloques','ColloqueController@index');
Route::get('/runcolloque/{id}','ColloqueController@run');
Route::get('/endcolloque/{id}','ColloqueController@cloture');
Route::post('/savecolloque/{id}','ColloqueController@save');
Route::get('/getUrgdemande/{date}','DemandeHospitalisationController@getUrgDemanades')->name('demandehosp.urg');
Route::get('/listeRDVs', 'RdvHospiController@getlisteRDVs');
Route::get('detailHospXHR/{id}','HospitalisationController@detailHospXHR')->name('hospdetailsXHR');
Route::get('/barreCodeprint', ['as' => 'barreCode.print', 'uses' => 'HospitalisationController@codebarrePrint']);
// teste
 Route::post('/user/password','UsersController@changePassword')->name('user.change.password');
// fteste
Route::get('/atcd/create/{id}','AntecedantsController@create');
Route::get('/atcd/index/{id}','AntecedantsController@index');
Route::post('/atcd/store/{id}','AntecedantsController@store');
Route::get('/rdv/create/{id}','RDVController@create');
Route::get('/rdv/valider/{id}','RDVController@valider');
Route::get('rdvprint/{id}', ['as' => 'rdv.print', 'uses' => 'rdvController@print']);
Route::get('rdvHospi/create/{id}','RdvHospiController@create')->name('rdvHospi.create');
Route::get('/rdvHospi/imprimer/{rdv}', ['as' => 'admission.pdf', 'uses' => 'RdvHospiController@print']);
Route::get('rdvHospi/ticketPrint/{id}','RdvHospiController@ticketPrint');
Route::get('/gerReports/{type}','HomeController@getReports');
Route::get('/reportprint/{className}/{objId}/{stateId}','HomeController@print');
route::get('/getAddEditRemoveColumnData','UsersController@getAddEditRemoveColumnData');
route::get('/getrdv','RDVController@getRDV');
route::get('/getpatient','PatientController@getpatient');//
route::get('/getproduits/{idgamme}/{idspec}','demandeprodController@get_produit');
route::get('/getsalles','SalleController@getsalles');
route::get('/salles/{id}','ServiceController@getsalles');
route::get('/getmedicaments','MedicamentsController@getmedicaments');
route::get('/getmedicamentsPCH','MedicamentsController@getmedicamentsPCH');
route::get('/getdispositifsPCH','MedicamentsController@getdispositifsPCH');
route::get('/getreactifsPCH','MedicamentsController@getreactifsPCH');
route::get('/getmed/{id}','MedicamentsController@getmed');
Route::get('/ticket/{ticket}', ['as' => 'ticket.pdf', 'uses' => 'ticketController@ticketPdf']);
Route::group(['as' => 'user.'], function() {
Route::any('/profile/{userId}', [
        'as'    => 'profile',
        'uses'  => 'UsersController@viewProfile'
    ]);
});
Route::get('/role/show/{userId}','RolesController@show');
Route::post('AddANTCD','AntecedantsController@createATCDAjax');
Route::get('/getPatients','PatientController@getPatientsList');
Route::post('/user/find', 'UsersController@AutoCompleteField')->name('users.autoField');
Route::get('/userdetail', 'UsersController@getUserDetails');
Route::post('/patients/autoField','PatientController@AutoCompletePatientField')->name('patients.autoField');
Route::post('/findCom','CommuneController@AutoCompleteCommune')->name('commune.getCommunes');
Route::get('/patientdetail/{id}', 'PatientController@getPatientDetails');
Route::get('/patientsToMerge','PatientController@patientsToMerege');
Route::post('/patient/merge','PatientController@merge')->name('patients.merge');
Route::get("flash","HomeController@flash");
Route::get('/getNotResBeds','BedReservationController@getNoResBeds');
// del
Route::get('/getNotResBedsTeste','BedReservationController@getNoResBedsTeste');
// end del
route::get('/showordonnance/{id}','OrdonnanceController@print')->name('ordonnancePdf');
route::get('/dbToPDF/{id}','DemandeExbController@print');
route::get('/detailsdemandeexb/{id}','DemandeExbController@detailsdemandeexb');
route::post('/uploadresultat','DemandeExbController@uploadresultat')->name('uploadBioRes');
route::get('/details_exr/{id}','DemandeExamenRadio@details');
Route::post('store-res', 'DemandeExamenRadio@upload');
Route::post('delete-res', 'DemandeExamenRadio@delResult');
Route::post('cancel-exam', 'DemandeExamenRadio@examCancel');
route::post('exmRad', 'DemandeExamenRadio@exmStore')->name('exmRad.store');
route::delete('/exmRad/{id}', 'DemandeExamenRadio@exmDestroy')->name('exmRad.destroy');
route::get('/drToPDF/{id}','DemandeExamenRadio@print');
Route::get('assur/patientAssuree/{NSS}/{Type}/{Prenom}','PatientController@create');
Route::post('/addpatientAssure','PatientController@storePatient');
Route::get('assur/patientAedit/{id}/{idA}','PatientController@edit');
Route::post('/surveillances/store/{id}','SurveillanceController@store');
route::get('/getpatientvisite','PatientController@getpatientvisite');
route::get('/getpatientconsigne','PatientController@getpatientconsigne');
Route::get('/delVisite/{id}', 'VisiteController@destroy')->name('visite.destroy');
Route::get('/visite/create/{id}','VisiteController@create');
Route::post('/visite/store/{id}','VisiteController@store');
route::get('/acte/run/{id}','ActeController@run')->name('runActe');
route::get('/schapitres','CimController@getChapters');
Route::get('/crrs/download/{id}', 'CRRControler@download')->name('crrs.download');
Route::get('/crbs/download/{id}', 'DemandeExbController@downloadcrb')->name('crbs.download');
Route::post('/createTicket','ticketController@store');
Route::get('/listRdvs','RDVController@listeRdvs');
Route::get('/soins/index/{id}','SoinsController@index');
Route::get('/getconst','SoinsController@getConstData')->name('getConstData');
Route::post('reset_password_','UsersController@resetPassword');
Route::get('/printCertifDescrip/{id}','CertificatDescriptifController@print');
Route::get('/orientLetterPrint/{id}','LettreOrientationController@print')->name('orientLetToPDF');
Route::get('/etabExport', 'EtablissementControler@exportCsv');
Route::get('/searstat','StatistiqusController@searstat');
Route::get('/searchStat/{id}','StatistiqusController@search')->name('stats.search');
Route::get('/teste','VisiteController@teste');//to teste