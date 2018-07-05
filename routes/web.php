<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return redirect()->route('home');
});

Route::get('medico/{id}/medico_register_new_patient','medicoController@medico_register_new_patient')->name('medico_register_new_patient');
//plans
////////////////////////////////////Bloquear los botones para configurar a losq  no tienen plan
Route::post('patient/medico/calification/comentaries','patientController@calification_medic_show_patient')->name('calification_medic_show_patient');
//////////
Route::get('autocomplete_specialty','HomeController@autocomplete_specialty')->name('autocomplete_specialty');

Route::post('medico/plan/set','plansController@set_plan')->name('set_plan');

Route::get('medico/{id}/plan/agenda/contract','plansController@plan_agenda_contract')->name('plan_agenda_contract');

Route::get('medico/{id}/plan/profesional/contract','plansController@plan_profesional_contract')->name('plan_profesional_contract');

Route::get('medico/{id}/plans/contract_basic','plansController@contract_basic')->name('contract_basic');
////////////
Route::post('compare/hours/{id}','medico_diaryController@compare_hours')->name('compare_hours');

Route::get('medico/{id}/diary/event','medico_diaryController@medico_diary_events')->name('medico_diary_events');
// Route::get('event_agenda','medico_diaryController@event_agenda')->name('event_agenda');

Route::post('medico/{id}/diary/events2','medico_diaryController@medico_diary_events2')->name('medico_diary_events2');
Route::resource('medico_diary','medico_diaryController');
Route::post('appoitment/store','medico_diaryController@appointment_store')->name('appointment_store');
Route::post('medico/update/event', 'medico_diaryController@update_event')->name('update_event');

Route::get('stipulate/{id}/appointment','medico_diaryController@stipulate_appointment')->name('stipulate_appointment');

// MIDLEWARE Autenticacion
Route::group(['middleware' => ['authenticate']], function (){
  Route::get('consulting_room/{id}/delete','consulting_roomController@consulting_room_delete')->name('consulting_room_delete');
});


//PLAN BASICO
Route::group(['middleware' => ['medic_plan_basic']], function (){


  Route::get('medico/{id}/add_image','medicoController@add_image')->name('add_image');

  Route::get('medico/{id}/medico_register_new_patient','medicoController@medico_register_new_patient')->name('medico_register_new_patient');
  Route::post('medico/{id}/medico_store_new_patient','medicoController@medico_store_new_patient')->name('medico_store_new_patient');
  Route::post('medico/add_patient_registered','medicoController@add_patient_registered')->name('add_patient_registered');

});
//PLAN AGENDA
Route::group(['middleware' => ['medic_plan_agenda']], function (){
  //REMINDER
    Route::post('reminder_delete','reminderController@reminder_delete')->name('reminder_delete');
    Route::post('reminder_alarm_update','reminderController@reminder_alarm_update')->name('reminder_alarm_update');

    Route::get('medico/{id}/reminder_calendar','reminderController@reminder_calendar')->name('reminder_calendar');
    Route::post('reminder_store','reminderController@reminder_store')->name('reminder_store');

    Route::get('medico/{id}/patients_registered','medicoController@patients_registered')->name('patients_registered');

    Route::get('search_patients_registered','medicoController@search_patients_registered')->name('search_patients_registered');

    Route::get('search_patients','medicoController@search_patients')->name('search_patients');
    Route::post('search_patients_diary','medico_diaryController@search_patients_diary')->name('search_patients_diary');
    Route::post('verify_change_date','medico_diaryController@verify_change_date')->name('verify_change_date');
    Route::get('medico/confirmed/payment/appointment/','medico_diaryController@confirmed_payment_app')->name('confirmed_payment_app');
    Route::get('medico/confirmed/appointment/completed','medico_diaryController@confirmed_completed_app')->name('confirmed_completed_app');
    Route::post('medico/patient/appointment/{app_id}/cancel','medico_diaryController@appointment_cancel')->name('appointment_cancel');
    Route::get('medico/appointment/{id}/confirm','medico_diaryController@appointment_confirm')->name('appointment_confirm');
    Route::post('medico/appointment/confirm','medico_diaryController@appointment_confirm_ajax')->name('appointment_confirm_ajax');
    Route::get('medico/{m_id}/patient/{p_id}/appointment/{app_id}/details','medico_diaryController@medico_app_details')->name('medico_app_details');
    Route::post('medico/patient/cancel/appointment/','medico_diaryController@cancel_appointment')->name('cancel_appointment');
    Route::post('medico/event/personal','medico_diaryController@event_personal_store')->name('event_personal_store');
    Route::get('check/{id}/notification','medicoController@marcar_como_vista')->name('marcar_como_vista');
    Route::get('Medico/{m_id}/patient/{p_id}/appointment/{app_id}/marcar_como_vista','medicoController@marcar_como_vista_redirect')->name('marcar_como_vista_redirect');
    Route::get('medico/{id}/business/hours','medico_diaryController@medico_business_hours')->name('medico_business_hours');
    Route::post('medico/business/hours/edit','medico_diaryController@medico_business_hours_update')->name('medico_business_hours_update');
    Route::post('delete/event','medico_diaryController@delete_event')->name('delete_event');
    Route::get('delete/{id}/event2','medico_diaryController@delete_event2')->name('delete_event2');
    Route::get('medico/{id}/panel/diary', 'medico_diaryController@medico_diary')->name('medico_diary');
    Route::get('medico/{id}/panel/schedule', 'medico_diaryController@medico_schedule')->name('medico_schedule');
    Route::post('medico/{id}/schedule/store','medico_diaryController@medico_schedule_store')->name('medico_schedule_store');

    Route::get('medico/{id}/delete/schedule','medico_diaryController@medico_schedule_delete')->name('medico_schedule_delete');
});

//PLAN Profesional
Route::group(['middleware' => ['medic_plan_profesional']], function (){
//calification_medic//b
    Route::get('medico/{m_id}/stipulate/appointment/patient/{p_id}','medico_diaryController@medico_stipulate_appointment')->name('medico_stipulate_appointment');

    Route::get('medico/{m_id}/calification','medicoController@calification_medic')->name('calification_medic');
    Route::get('medico/{m_id}/calification/viewed','medicoController@calification_medic_viewed')->name('calification_medic_viewed');
    Route::get('mark_all_see/{id}','medicoController@mark_all_see')->name('mark_all_see');
    Route::post('calification/show_comentary','medicoController@show_comentary')->name('show_comentary');
    Route::post('calification/hide_comentary','medicoController@hide_comentary')->name('hide_comentary');
    Route::post('calification/checked_comentary','medicoController@checked_comentary')->name('checked_comentary');
    Route::get('show_all_comentary_default/{id}','medicoController@show_all_comentary_default')->name('show_all_comentary_default');
    Route::get('hide_all_comentary_default/{id}','medicoController@hide_all_comentary_default')->name('hide_all_comentary_default');
    Route::get('show_all_comentary/{id}','medicoController@show_all_comentary')->name('show_all_comentary');
    Route::get('hide_all_comentary/{id}','medicoController@hide_all_comentary')->name('hide_all_comentary');

    Route::get('show_all_comentary_new/{id}','medicoController@show_all_comentary_new')->name('show_all_comentary_new');
    Route::get('hide_all_comentary_new/{id}','medicoController@hide_all_comentary_new')->name('hide_all_comentary_new');
////////
});

//PLAN PLATINO corregir plan profesional a platino
Route::group(['middleware' => ['medic_plan_platino']], function (){

    Route::get('medico/patient/notes/search','notesController@note_search')->name('note_search');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/edit','medicoController@medico_note_edit')->name('medico_note_edit');
    Route::post('medico/patient/note/config/store','notesController@note_config_store')->name('note_config_store');
    Route::get('medico/{m_id}/patient/{p_id}/edit/appointment/{app_id}','medico_diaryController@edit_appointment')->name('edit_appointment');
    ///////////////NOTES
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/view_preview','notesController@view_preview')->name('view_preview');
    Route::get('medico/{m_id}/patient/{p_id}/type_notes','notesController@type_notes')->name('type_notes');

    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/config','notesController@note_config')->name('note_config');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/ini_create','notesController@note_medic_ini_create')->name('note_medic_ini_create');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/ini_edit','notesController@note_ini_edit')->name('note_ini_edit');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/evo_edit','notesController@note_evo_edit')->name('note_evo_edit');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/inter_edit','notesController@note_inter_edit')->name('note_inter_edit');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/urgencias_edit','notesController@note_urgencias_edit')->name('note_urgencias_edit');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/egreso_edit','notesController@note_egreso_edit')->name('note_egreso_edit');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/referencia_edit','notesController@note_referencia_edit')->name('note_referencia_edit');

    Route::get('medico/{m_id}/patient/{p_id}/notes/','notesController@notes_patient')->name('notes_patient');
    Route::post('medico/patient/note/store','notesController@note_store')->name('note_store');
    Route::post('medico/patient/note/update/{id}','notesController@note_update')->name('note_update');

    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/referencia/create','notesController@note_referencia_create')->name('note_referencia_create');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/interconsulta_create','notesController@note_inter_create')->name('note_inter_create');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/urg_create','notesController@note_urgencias_create')->name('note_urgencias_create');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/egreso_create','notesController@note_egreso_create')->name('note_egreso_create');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/evo_create','notesController@note_evo_create')->name('note_evo_create');
});



Route::get('medico/{m_id}/patient/{p_id}/data', 'medicoController@data_patient')->name('data_patient');
Route::post('medico/patient/data/store', 'medicoController@data_patient_store')->name('data_patient_store');

Route::get('medico/{m_id}/patient/{p_id}/data/extract', 'medicoController@data_patient_extract_perfil')->name('data_patient_extract_perfil');
// income_medic
Route::get('medico/{id}/income','medicoController@income_medic')->name('income_medic');
Route::get('medico/{id}/income/without_pay','medicoController@income_medic_without_pay')->name('income_medic_without_pay');
//

Route::get('loginRedirect', 'Auth\LoginController@loginRedirect')->name('loginRedirect');
Route::post('video_store', 'medicoController@video_store')->name('video_store');
Route::post('verify/Session', 'Auth\LoginController@verifySession')->name('verifySession');
Route::get('home','HomeController@home')->name('home');
Route::post('login2','Auth\LoginController@login2')->name('login2');
Route::get('list/result2','HomeController@tolist2')->name('tolist2');

Route::get('list/result3','HomeController@tolist3')->name('tolist3');
Route::post('ajax/map','HomeController@ajax_map')->name('ajax_map');

Route::post('list/specialtyList1','HomeController@specialtyList1')->name('specialtyList1');
Route::post('list/specialtyList2','HomeController@specialtyList2')->name('specialtyList2');
Route::post('list/specialtyList3','HomeController@specialtyList3')->name('specialtyList3');
Route::post('list/specialtyList4','HomeController@specialtyList4')->name('specialtyList4');
Route::post('logout','Auth\LoginController@logout')->name('logout');

Route::get('medicalCenter/{id}/search/medico','medicalCenterController@search_medico_medical_center')->name('search_medico_medical_center');

Route::get('medicalCenter/{id}/search/medico/belongs','medicalCenterController@search_medico_belong_medical_center')->name('search_medico_belong_medical_center');
////midleware//
// Route::group(['middleware' => ['medicalCenterConfirm']], function () {

Route::post('patient/photo_profile/store','photoController@patient_image_profile')->name('patient_image_profile');

Route::get('patient/add/medic/{id}','patientController@patient_add_medic')->name('patient_add_medic');
Route::get('patient/{id}/edit','patientController@patient_edit_data')->name('patient_edit_data');
Route::post('patient/{id}/updates','patientController@patient_update')->name('patient_update');

Route::get('patient/{id}resend/mail/confirm','patientController@resend_mail_confirm_patient')->name('resend_mail_confirm_patient');
//event appoitment diary

/////////////////
Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}','medicoController@create_note_patient')->name('create_note_patient');

Route::get('medico/{m_id}/admin/data/{p_id}/patient','medicoController@admin_data_patient')->name('admin_data_patient');
// Route::get('medico/{m_id}/admin/data/{p_id}/patient','patientController@admin_data_patient')->name('admin_data_patient');
Route::resource('city','cityController');
Route::resource('user','userController');
Route::resource('medico','medicoController');
Route::get('medico/{id}/perfil','medicoController@medico_perfil')->name('medico_perfil');

Route::post('medico/list/social_network','medicoController@social_network_list')->name('social_network_list');
Route::post('medicalCenter/list/social_network','medicalCenterController@medicalCenter_social_list')->name('medicalCenter_social_list');
Route::post('medico/list/services','medicoController@medico_service_list')->name('medico_service_list');

Route::post('medico/list/experience','medicoController@medico_experience_list')->name('medico_experience_list');

Route::post('medico_list_videos','medicoController@medico_list_videos')->name('medico_list_videos');
Route::post('delete_video','medicoController@delete_video')->name('delete_video');

Route::post('medicoBorrar','medicoController@medicoBorrar')->name('medicoBorrar');
Route::post('medico/experience/delete','medicoController@medico_experience_delete')->name('medico_experience_delete');
Route::post('medico/service/store','medicoController@service_medico_store')->name('service_medico_store');
Route::post('medic/experience/store','medicoController@medico_experience_store')->name('medico_experience_store');
Route::post('medic/social_network/store','medicoController@medico_social_network_store')->name('medico_social_network_store');

Route::get('medico/{id}/appointments/all', 'medicoController@appointments_all')->name('appointments_all');
Route::get('medico/{id}/appointments/past_collect', 'medicoController@appointments_past_collect')->name('appointments_past_collect');

Route::get('medico/{id}/appointments', 'medicoController@appointments')->name('appointments');
Route::get('medico/{id}/appointments/completed', 'medicoController@appointments_completed')->name('appointments_completed');

Route::get('medico/{id}/appointments/paid_and_pending', 'medicoController@appointments_paid_and_pending')->name('appointments_paid_and_pending');


Route::get('medico/{id}/appointments/confirmed', 'medicoController@appointments_confirmed')->name('appointments_confirmed');

Route::get('medico/{id}/appointments/canceled', 'medicoController@appointments_canceled')->name('appointments_canceled');


Route::post('medicalCenter/social/store','medicalCenterController@medicalCenter_social_store')->name('medicalCenter_social_store');
Route::post('borrar_social','medicoController@borrar_social')->name('borrar_social');


Route::get('medico/{id}/data/primordial/','medicoController@data_primordial_medico')->name('data_primordial_medico');

Route::get('medic/{id}/consulting_room/create','consulting_roomController@consulting_room_create')->name('consulting_room_create');
Route::post('medic/{id}/consulting_room/store','consulting_roomController@consulting_room_store')->name('consulting_room_store');
Route::get('medic/{id}/consulting_room/edit','consulting_roomController@consulting_room_edit')->name('consulting_room_edit');
Route::post('medic/{id}/consulting_room/update','consulting_roomController@consulting_room_update')->name('consulting_room_update');
Route::resource('patient','patientController');



Route::get('patient/{id}/profile','patientController@patient_profile')->name('patient_profile');

Route::post('store_rate_comentary','patientController@store_rate_comentary')->name('store_rate_comentary');

Route::get('patient/{id}/medicos','patientController@patient_medicos')->name('patient_medicos');
Route::get('patient/{id}/appoitment/rate','patientController@rate_appointment')->name('rate_appointment');

Route::get('patient/{id}/appoitment','patientController@patient_appointments')->name('patient_appointments');
Route::get('patient/{id}/appoitment/pending','patientController@patient_appointments_pending')->name('patient_appointments_pending');
Route::get('patient/{id}/appoitment/unrated','patientController@patient_appointments_unrated')->name('patient_appointments_unrated');




Route::get('patients/register','patientController@patient_register_view')->name('patient_register_view');
Route::post('patient/register/store','patientController@patient_register')->name('patient_register');
Route::get('confirm/patient/{id}/{code}','patientController@confirmPatient')->name('confirmPatient');
Route::resource('medicalCenter','medicalCenterController');

Route::post('medicalCenter/select/insurrances','medicalCenterController@select_insurrances')->name('select_insurrances');
Route::post('medicalCenter/select/insurrances/medico','medicoController@select_insurrances2')->name('select_insurrances2');

Route::get('confirm/patient/{id}','patientController@successRegPatient')->name('successRegPatient');

Route::get('patient/{id}/edit/address','patientController@address_patient')->name('address_patient');

Route::post('patient/{id}/store/address','patientController@patient_store_address')->name('patient_store_address');

Route::get('patient/delete/{id}/medico','patientController@delete_patient_doctors')->name('delete_patient_doctors');

//
Route::get('medico/{id}/patients','medicoController@medico_patients')->name('medico_patients');

Route::get('medico/{m_id}/patient/{p_id}/appointments','medicoController@medico_appointments_patient')->name('medico_appointments_patient');

Route::get('medico/delete/{id}/patient','patientController@delete_medico_patients')->name('delete_medico_patients');
//
Route::post('medicalCenter/{id}/store/experience','medicalCenterController@medical_center_experience_store')->name('medical_center_experience_store');
Route::post('medicalCenter/{id}/store/specialty','medicalCenterController@medical_center_specialty_store')->name('medical_center_specialty_store');
Route::post('medicalCenter/{id}/list/specialty','medicalCenterController@medicalCenter_list_specialty')->name('medicalCenter_list_specialty');
Route::post('medicalCenter/{id}/list/experience','medicalCenterController@medicalCenter_list_experience')->name('medicalCenter_list_experience');

Route::post('medicalCenter/specialty/delete','medicalCenterController@medical_specialty_delete')->name('medical_specialty_delete');
Route::post('medicalCenter/experience/delete','medicalCenterController@medical_experience_delete')->name('medical_experience_delete');

Route::get('medicalCenter/{id}/create/add/insurrances','medicalCenterController@create_add_insurrances')->name('create_add_insurrances');
Route::post('medicalCenter/{id}/store/insurrances','medicalCenterController@medicalCenter_store_insurrances')->name('medicalCenter_store_insurrances');

Route::post('medico/{id}/store/insurrances','medicoController@medico_store_insurrances')->name('medico_store_insurrances');
Route::get('medico/{id}/create/add/insurrances','medicoController@medico_create_add_insurrances')->name('medico_create_add_insurrances');

Route::get('medicalCenter/insurance/{id}/delete','medicalCenterController@delete_insurance')->name('delete_insurance');


Route::get('medicalCenter/{id}/data/primordial/','medicalCenterController@data_primordial_medical_center')->name('data_primordial_medical_center');
Route::get('data/primordial/{id}/medical_center/address','medicalCenterController@data_primordial_medical_center2')->name('data_primordial_medical_center2');

Route::get('medical_center/{id}/panel','medicalCenterController@medical_center_panel')->name('medical_center_panel');

Route::resource('photo','photoController');

Route::get('medico/{id}/map/show','HomeController@detail_medic_map')->name('detail_medic_map');

Route::get('medicalCenter/image/delete/{id}','photoController@photo_medical_delete')->name('photo_medical_delete');
Route::get('medico/photo/delete/{id}','photoController@photo_delete')->name('photo_delete');

Route::post('image/medico/store','photoController@image_store')->name('image_store');
Route::post('image/medical_center/store','photoController@image_store_medical_center')->name('image_store_medical_center');

Route::resource('consulting_room','consulting_roomController');

Route::get('medico/{id}/info/create','medicoController@medico_specialty_create')->name('medico_specialty_create');
Route::get('medico/{id}/info/edit','medicoController@medico_specialty_edit')->name('medico_specialty_edit');
Route::post('medico/specialty/store','medicoController@medico_specialty_store')->name('medico_specialty_store');
Route::post('medico/specialty{id}/update','medicoController@medico_specialty_update')->name('medico_specialty_update');
Route::get('medico/specialty{id}/delete','medicoController@medico_specialty_delete')->name('medico_specialty_delete');

Route::post('inner/cities/select','medicoController@inner_cities_select')->name('inner_cities_select');
Route::post('inner/cities/select2','medicoController@inner_cities_select2')->name('inner_cities_select2');
Route::post('inner/cities/select3','medicoController@inner_cities_select3')->name('inner_cities_select3');

Route::get('confirm/MedicalCenter/{id}/{code}','medicalCenterController@confirmMedicalCenter')->name('confirmMedicalCenter');



Route::get('confirm/MedicalCenter/{id}/{code}','medicalCenterController@confirmMedicalCenter')->name('confirmMedicalCenter');
Route::get('confirm/medico/{id}/{code}','medicoController@confirmMedico')->name('confirmMedico');

Route::get('confirm/medico/{id}','medicoController@successRegMedico')->name('successRegMedico');
Route::get('confirm/assistant/{id}','assistantController@successRegAssistant')->name('successRegAssistant');


Route::get('confirm/MedicalCenter/{id}','medicalCenterController@successRegMedicalCenter')->name('successRegMedicalCenter');

Route::post('medicalCenter/{id}/description','medicalCenterController@medicalCenter_description_show')->name('medicalCenter_description_show');

Route::post('medicalCenter/{id}/description','medicalCenterController@medicalCenter_description_show')->name('medicalCenter_description_show');
Route::post('medicalCenter/{id}/description/update','medicalCenterController@medicalCenter_description_update')->name('medicalCenter_description_update');

Route::get('medicalCenter/{id}/manage/medicos','medicalCenterController@medical_center_manage_medicos')->name('medical_center_manage_medicos');


Route::get('medicalCenter/{id}/edit/data','medicalCenterController@medical_center_edit_data')->name('medical_center_edit_data');
Route::post('medicalCenter/{id}/edit/data/update','medicalCenterController@medical_center_edit_data_update')->name('medical_center_edit_data_update');
Route::post('medicalCenter/add/medico','medicalCenterController@medical_center_add_medico')->name('medical_center_add_medico');

Route::get('medicalCenter/{id}/edit/address','medicalCenterController@medical_center_edit_address')->name('medical_center_edit_address');

Route::get('medico/{id}/edit/address','medicoController@medico_edit_address')->name('medico_edit_address');

Route::post('medicalCenter/{id}/update/address','medicalCenterController@medical_center_update_address')->name('medical_center_update_address');
Route::post('medico/{id}/update/address','medicoController@medico_update_address')->name('medico_update_address');

Route::get('medicalCenter/{id}/edit/schedule','medicalCenterController@medical_center_edit_schedule')->name('medical_center_edit_schedule');

Route::post('medicalCenter/{id}/store/schedule','medicalCenterController@medical_center_store_schedule')->name('medical_center_store_schedule');



Route::get('medicalCenter/{id}/delete/schedule','medicalCenterController@medical_center_schedule_delete')->name('medical_center_schedule_delete');

Route::get('send_mail/medicalCenter/{id}/code_confirmded','medicalCenterController@resend_mail_medical_center')->name('resend_mail_medical_center');
Route::get('medicalCenter/{id}/profile','medicalCenterController@medicalCenter_profile')->name('medicalCenter_profile');

Route::get('medico/{id}/resend/mail/confirmation','medicoController@resendMailMedicoConfirm')->name('resendMailMedicoConfirm');

Route::get('list/result/','HomeController@tolist')->name('tolist');
/////////////////////////////////////////////////////////////////////////////////borar

/////////////////////////////////////////////////////////////////////////////////borrar
Route::post('map/medicalCenter','HomeController@map_medical_center_name')->name('map_medical_center_name');



Route::get('medical/centers/list','medicalCenterController@MedicalCenterList')->name('MedicalCenterList');

Route::get('medicos/list','medicoController@medicosList')->name('medicosList');

Route::get('category/{id}/specialty/delete','specialty_categoryController@specialtyC_delete')->name('specialtyC_delete');

Route::resource('specialty','specialtyController');
Route::resource('sub_specialty','sub_specialtyController');

Route::resource('assistant','assistantController');
Route::resource('administrators','administratorsController');
//plans
Route::resource('plans','plansController');
Route::get('planes','plansController@planes')->name('planes');
Route::get('medico/{id}/contract/plan','plansController@contract')->name('contract');

Route::get('planes/medic/{id}','plansController@planes_medic')->name('planes_medic');
//
Route::resource('promoters','promotersController');
Route::resource('specialty_category','specialty_categoryController');


Route::get('promoters/{id}/add/medic/invited','promotersController@add_medic')->name('add_medic');

Route::post('promoters/store/medic','promotersController@store_medic')->name('store_medic');

Route::get('promoters/{id}/add/medical_center/invited','promotersController@add_medical_center')->name('add_medical_center');

Route::get('promoter/{id}/list_medical_center_invited','promotersController@list_medical_center_invited')->name('list_medical_center_invited');

Route::get('promoter/{id}/list_client','promotersController@list_client')->name('list_client');
Route::post('promoter/{id}/list_client_activated','promotersController@list_client_activated')->name('list_client_activated');

Route::post('promoter/{id}/list_client_desactivated','promotersController@list_client_desactivated')->name('list_client_desactivated');

Route::get('promoter/{id}/panel_control','promotersController@panel_control_promoters')->name('panel_control_promoters');

Route::post('promoters/store/medical_center','promotersController@store_medical_center')->name('store_medical_center');

Route::get('cities/{id}/plan','plansController@citiesPlans')->name('citiesPlans');
Route::post('cities/plan/store','plansController@citiesPlansStore')->name('citiesPlansStore');
Route::get('cities/{id}/administrator','administratorsController@citiesAdmin')->name('citiesAdmin');
Route::post('cities/administrator/store','administratorsController@citiesAdminStore')->name('citiesAdminStore');

Route::get('delete/city/{id}/administrator','administratorsController@deleteCityAdmin')->name('deleteCityAdmin');
Route::get('delete/city/{id}/plan','plansController@deleteCityPlan')->name('deleteCityPlan');


Route::get('confirm/assistant/{id}/{code}','assistantController@confirmAssistant')->name('confirmAssistant');

Route::get('confirm/assistant/{id}/{code}','assistantController@confirmAssistant')->name('confirmAssistant');
Route::get('register/assistant/{id}/step4','assistantController@AvisoConfirmAccountAssistant')->name('AvisoConfirmAccountAssistant');

Route::resource('permissionSet','permissionSetController');
Route::get('permission/admin/{id}','permissionSetController@listPermissionSet')->name('listPermissionSet');
Route::get('permission/{id}/set/admin/','permissionSetController@PermissionSet')->name('PermissionSet');

Route::get('permissions/{id}/store/{id2}/','PermissionSetController@PermissionSetStore')->name('PermissionSetStore');
Route::get('clients/promoter/{id}','promotersController@clientsPromoter')->name('clientsPromoter');
//sRoute::get('edit/price/{id}/plan','plansController@PermissionSet')->name('editPrice');
Route::post('medicalCenter/{id}/coordinates/store','medicalCenterController@medicalCenter_store_coordinates')->name('medicalCenter_store_coordinates');
Route::post('medico/{id}/coordinates/store','medicoController@medico_store_coordinates')->name('medico_store_coordinates');

Route::get('patient/{p_id}/medico/{m_id}/
rate','patientController@patient_rate_medic')->name('patient_rate_medic');

Route::get('patient/{p_id}/medic/{m_id}/qualify/{app_id}','patientController@qualify_medic')->name('qualify_medic');



//config reminder

Route::post('reminder_time_alarm','reminderController@reminder_time_alarm')->name('reminder_time_alarm');
Route::post('config_acvtivate_reminder_alarm','reminderController@config_acvtivate_reminder_alarm')->name('config_acvtivate_reminder_alarm');
Route::post('reminder_switch_confirmed','reminderController@reminder_switch_confirmed')->name('reminder_switch_confirmed');
Route::post('reminder_time_confirmed','reminderController@reminder_time_confirmed')->name('reminder_time_confirmed');
Route::post('switch_payment_and_past','reminderController@switch_payment_and_past')->name('switch_payment_and_past');

Route::get('test','reminderController@test')->name('test');
//


//Recordatorios
Route::get('medico/{id}/reminders','reminderController@medico_reminders')->name('medico_reminders');

// pdf
Route::get('note/{id}/download_pdf','notesController@download_pdf')->name('download_pdf');
