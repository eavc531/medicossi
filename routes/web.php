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

Route::get('autocomplete_diagnostic','notesController@autocomplete_diagnostic')->name('autocomplete_diagnostic');

Route::post('inner/cities/select','medicoController@inner_cities_select')->name('inner_cities_select');
Route::post('inner/cities/select2','medicoController@inner_cities_select2')->name('inner_cities_select2');
Route::post('inner/cities/select3','medicoController@inner_cities_select3')->name('inner_cities_select3');
//MAP MEDICAL CENTER
Route::post('map/medicalCenter','HomeController@map_medical_center_name')->name('map_medical_center_name');
//HOME
Route::get('medico/{id}/map/show','HomeController@detail_medic_map')->name('detail_medic_map');
Route::get('autocomplete_specialty','HomeController@autocomplete_specialty')->name('autocomplete_specialty');
////////////////Mantener fuera de midleaware verify_conultation_open///////
Route::post('medico/update/event', 'medico_diaryController@update_event')->name('update_event');
///////////////                                                ////////////////////
//VERIFICA SI AHI cita abiera y bloquea acceso a rutas ahsta cerrarla
Route::group(['middleware' => ['verify_conultation_open'],'except' => ['update_event']], function (){
    Route::get('home','HomeController@home')->name('home');
    //perfil medico
    Route::get('medico/{id}/data/primordial/','medicoController@data_primordial_medico')->name('data_primordial_medico');
    Route::get('medico/{id}/edit/address','medicoController@medico_edit_address')->name('medico_edit_address');
    /////////////HOME

    Route::get('iniciar/home','HomeController@inicar_home')->name('inicar_home');

    Route::post('verify/Session', 'Auth\LoginController@verifySession')->name('verifySession');

    Route::get('check_all_view/{id}','medicoController@check_all_view')->name('check_all_view');
    Route::get('check_all_view_show/{id}','medicoController@check_all_view_show')->name('check_all_view_show');

    Route::post('patient/medico/calification/comentaries','patientController@calification_medic_show_patient')->name('calification_medic_show_patient');
    Route::post('ajax/map','HomeController@ajax_map')->name('ajax_map');

    Route::post('medico/appointment/confirm','medico_diaryController@appointment_confirm_ajax')->name('appointment_confirm_ajax');
    Route::post('medico/list/social_network','medicoController@social_network_list')->name('social_network_list');
    Route::post('medicalCenter/list/social_network','medicalCenterController@medicalCenter_social_list')->name('medicalCenter_social_list');

    Route::post('medico/list/services','medicoController@medico_service_list')->name('medico_service_list');

    Route::post('medico/list/experience','medicoController@medico_experience_list')->name('medico_experience_list');
    Route::post('medicalCenter/select/insurrances/medico','medicoController@select_insurrances2')->name('select_insurrances2');
    Route::post('medico_list_videos','medicoController@medico_list_videos')->name('medico_list_videos');
    //
    //patient
    Route::get('patients/register','patientController@patient_register_view')->name('patient_register_view');
    Route::get('confirm/patient/{id}/{code}','patientController@confirmPatient')->name('confirmPatient');
    Route::post('patient/register/store','patientController@patient_register')->name('patient_register');
    //

    Route::get('restore_password','HomeController@restore_pass')->name('restore_pass');
    Route::post('restore_password_email','HomeController@restore_pass_send')->name('restore_pass_send');
    Route::get('success_send_restore_pass','HomeController@view_success_restore_pass')->name('view_success_restore_pass');
    Route::post('restore_pass_store','HomeController@restore_pass_store')->name('restore_pass_store');

    Route::get('user/{id}/confirm/{code}/restore_pass/','HomeController@confirm_restore_pass')->name('confirm_restore_pass');

    Route::get('confirmxx/restartxxx/{id}/pass/{$code}','HomeController@confirm_restart_pass')->name('confirm_restart_pass');


    Route::resource('medico','medicoController');
    Route::get('/', function(){
        return redirect()->route('home');
    });
    Route::get('confirm/medico/{id}/{code}','medicoController@confirmMedico')->name('confirmMedico');
    Route::get('loginRedirect', 'Auth\LoginController@loginRedirect')->name('loginRedirect');
    Route::get('medico/{id}/resend/mail/confirmation','medicoController@resendMailMedicoConfirm')->name('resendMailMedicoConfirm');
    Route::get('patient/{id}resend/mail/confirm','patientController@resend_mail_confirm_patient')->name('resend_mail_confirm_patient');
    Route::get('send_mail/medicalCenter/{id}/code_confirmded','medicalCenterController@resend_mail_medical_center')->name('resend_mail_medical_center');
    Route::get('confirm/patient/{id}','patientController@successRegPatient')->name('successRegPatient');
    Route::get('confirm/medico/{id}','medicoController@successRegMedico')->name('successRegMedico');
    Route::get('confirm/MedicalCenter/{id}','medicalCenterController@successRegMedicalCenter')->name('successRegMedicalCenter');
    Route::post('medico/add_patient_registered','medicoController@add_patient_registered')->name('add_patient_registered');
    Route::post('video_store', 'medicoController@video_store')->name('video_store');
    Route::post('login2','Auth\LoginController@login2')->name('login2');
    Route::get('list/result2','HomeController@tolist2')->name('tolist2');
    Route::get('list/result3','HomeController@tolist3')->name('tolist3');
    Route::post('list/specialtyList1','HomeController@specialtyList1')->name('specialtyList1');
    Route::post('list/specialtyList2','HomeController@specialtyList2')->name('specialtyList2');
    Route::post('list/specialtyList3','HomeController@specialtyList3')->name('specialtyList3');
    Route::post('list/specialtyList4','HomeController@specialtyList4')->name('specialtyList4');
    Route::post('logout','Auth\LoginController@logout')->name('logout');

    ////midleware//
    // Route::group(['middleware' => ['medicalCenterConfirm']], function () {
    Route::post('patient/photo_profile/store','photoController@patient_image_profile')->name('patient_image_profile');
    // middlaware authentica
    Route::group(['middleware' => ['authenticate']], function (){
        Route::get('medico/{m_id}/calification','medicoController@calification_medic')->name('calification_medic');
        Route::get('medico/{m_id}/calification/viewed','medicoController@calification_medic_viewed')->name('calification_medic_viewed');
        ////
        Route::post('llenar_especialidad','administratorsController@llenar_especialidad')->name('llenar_especialidad');

        Route::get('patient/{id}/edit/address','patientController@address_patient')->name('address_patient');
        Route::post('patient/{id}/store/address','patientController@patient_store_address')->name('patient_store_address');
        //MIDLEWARE PATIENT
        Route::group(['middleware' => ['patient_data_complete']], function (){
            Route::resource('patient','patientController');
            Route::get('stipulate/{id}/appointment','medico_diaryController@stipulate_appointment')->name('stipulate_appointment');
            Route::get('patient/add/medic/{id}','patientController@patient_add_medic')->name('patient_add_medic');
            Route::get('patient/{id}/edit/profile','patientController@patient_edit_data')->name('patient_edit_data');
            Route::post('patient/{id}/updates','patientController@patient_update')->name('patient_update');
            Route::get('patient/{id}/profile','patientController@patient_profile')->name('patient_profile');

            Route::post('store_rate_comentary','patientController@store_rate_comentary')->name('store_rate_comentary');

            Route::get('patient/{id}/medicos','patientController@patient_medicos')->name('patient_medicos');
            Route::get('patient/{id}/appoitment/rate','patientController@rate_appointment')->name('rate_appointment');

            Route::get('patient/{id}/appoitment','patientController@patient_appointments')->name('patient_appointments');
            Route::get('patient/{id}/appoitment/pending','patientController@patient_appointments_pending')->name('patient_appointments_pending');
            Route::get('patient/{id}/appoitment/unrated','patientController@patient_appointments_unrated')->name('patient_appointments_unrated');
            Route::get('patient/{id}/appoitment/pending_confirm','patientController@patient_pending_confirm')->name('patient_pending_confirm');

            Route::get('patient/delete/{id}/medico','patientController@delete_patient_doctors')->name('delete_patient_doctors');
            Route::get('medico/delete/{id}/patient','patientController@delete_medico_patients')->name('delete_medico_patients');
        });//END -MIDLEWARE PATIENT

        Route::get('medico/{id}/medico_register_new_patient','medicoController@medico_register_new_patient')->name('medico_register_new_patient');
        Route::get('administrator/control_panel','administratorsController@panel_control_administrator')->name('panel_control_administrator');
        //plans

        Route::post('medico/plan/set','plansController@set_plan')->name('set_plan');

        Route::get('medico/{id}/plan/agenda/contract','plansController@plan_agenda_contract')->name('plan_agenda_contract');

        Route::get('medico/{id}/plan/platino/contract','plansController@plan_platino_contract')->name('plan_platino_contract');

        Route::get('medico/{id}/plan/profesional/contract','plansController@plan_profesional_contract')->name('plan_profesional_contract');

        Route::get('medico/{id}/plans/contract_basic','plansController@contract_basic')->name('contract_basic');
        ////////////
        Route::post('compare/hours/{id}','medico_diaryController@compare_hours')->name('compare_hours');

        Route::get('medico/{id}/diary/event','medico_diaryController@medico_diary_events')->name('medico_diary_events');
        Route::get('patient/medico/{id}/diary/event','medico_diaryController@patient_medico_diary_events')->name('patient_medico_diary_events');

        // Route::get('event_agenda','medico_diaryController@event_agenda')->name('event_agenda');

        Route::post('medico/{id}/diary/events2','medico_diaryController@medico_diary_events2')->name('medico_diary_events2');
        Route::resource('medico_diary','medico_diaryController');
        Route::post('appoitment/store','medico_diaryController@appointment_store')->name('appointment_store');

        Route::post('medico/event_personal/update', 'medico_diaryController@event_personal_update')->name('event_personal_update');
        Route::post('medico/event_personal/delete', 'medico_diaryController@event_personal_delete')->name('event_personal_delete');


        // MIDLEWARE Autenticacion
        // Route::group(['middleware' => ['authenticate']], function (){
        //   Route::get('consulting_room/{id}/delete','consulting_roomController@consulting_room_delete')->name('consulting_room_delete');
        // });


        //PLAN BASICO
        Route::group(['middleware' => ['medic_plan_basic']], function (){
            Route::post('medico/{id}/update/address','medicoController@medico_update_address')->name('medico_update_address');
            Route::get('medico/{id}/add_image','medicoController@add_image')->name('add_image');

            Route::get('medico/{id}/medico_register_new_patient','medicoController@medico_register_new_patient')->name('medico_register_new_patient');
            Route::post('medico/{id}/medico_store_new_patient','medicoController@medico_store_new_patient')->name('medico_store_new_patient');

        });

    });

});// FIN MIDLEWARE verify_conultation_openmas abajo vuelve a abrir
//PLAN AGENDA
Route::group(['middleware' => ['medic_plan_agenda']], function (){
    ////////////<<<<manage_patient<<<<<<<<////////////
    Route::get('medico/{id}/appointments', 'medicoController@appointments')->name('appointments');
    Route::get('medico/{m_id}/patient/{p_id}/edit/appointment/{app_id}','medico_diaryController@edit_appointment')->name('edit_appointment');
    Route::get('medico/{m_id}/stipulate/appointment/patient/{p_id}','medico_diaryController@medico_stipulate_appointment')->name('medico_stipulate_appointment');

    Route::post('redierct_manage_patient', 'medicoController@redierct_manage_patient')->name('redierct_manage_patient');
    Route::get('medico/{m_id}/patient/{p_id}/manage', 'medicoController@manage_patient')->name('manage_patient');
    // MIDLEWARE verify_conultation_open2
    Route::group(['middleware' => ['verify_conultation_open'],'except' => ['index', 'show']], function (){
        Route::get('medico/{id}/patients','medicoController@medico_patients')->name('medico_patients');
        Route::get('medico/{id}/panel/diary', 'medico_diaryController@medico_diary')->name('medico_diary');
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
        Route::get('medico/{m_id}/patient/{p_id}/appointment/{app_id}/details','medico_diaryController@medico_app_details')->name('medico_app_details');
        Route::post('medico/event/personal','medico_diaryController@event_personal_store')->name('event_personal_store');
        Route::get('check/{id}/notification','medicoController@marcar_como_vista')->name('marcar_como_vista');
        Route::get('Medico/{m_id}/patient/{p_id}/appointment/{app_id}/marcar_como_vista','medicoController@marcar_como_vista_redirect')->name('marcar_como_vista_redirect');
        Route::get('medico/{id}/business/hours','medico_diaryController@medico_business_hours')->name('medico_business_hours');
        Route::post('medico/business/hours/edit','medico_diaryController@medico_business_hours_update')->name('medico_business_hours_update');
        Route::post('delete/event','medico_diaryController@delete_event')->name('delete_event');
        Route::get('delete/{id}/event2','medico_diaryController@delete_event2')->name('delete_event2');

        Route::get('medico/{id}/panel/schedule', 'medico_diaryController@medico_schedule')->name('medico_schedule');
        Route::post('medico/{id}/schedule/store','medico_diaryController@medico_schedule_store')->name('medico_schedule_store');

        Route::get('medico/{id}/delete/schedule','medico_diaryController@medico_schedule_delete')->name('medico_schedule_delete');
    }); //FIN MIDLEWARE verify_conultation_open2 mas abajo otro
    Route::post('medico/patient/cancel/appointment/','medico_diaryController@cancel_appointment')->name('cancel_appointment');
});
//PLAN Profesional
Route::group(['middleware' => ['medic_plan_profesional']], function (){
    //calification_medic//b
    // MIDLEWARE verify_conultation_open3

    Route::group(['middleware' => ['verify_conultation_open'],'except' => ['index', 'show']], function (){


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
    }); //END midleware consultation_open 3
});

//PLAN PLATINO corregir plan profesional a platino
Route::group(['middleware' => ['medic_plan_platino']], function (){
    // Route::get('medico/{m_id}/manage/patient/{p_id}','medicoController@medico_manage_patient')->name('medico_manage_patient');
    ///////<<<<<<FILES>>>>>>>/////////
    Route::get('medico/{m_id}/patient/{p_id}/ending/app/{app_id}','medico_diaryController@ending_appointment')->name('ending_appointment');
    Route::get('medico/{m_id}/patient/{p_id}/files','filesController@patient_files')->name('patient_files');
    Route::get('medico/file/{p_id}/delete','filesController@file_delete')->name('file_delete');
    Route::get('medico/file/{p_id}/delete_in_expedient','filesController@file_delete_expedient')->name('file_delete_expedient');

    Route::get('medico/file/{p_id}/download','filesController@file_download')->name('file_download');
    Route::post('medico/patient/file_store','filesController@patient_file_store')->name('patient_file_store');

    // Route::post('medico/patient/patient_file_store_in_expedient','filesController@patient_file_store_in_expedient')->name('patient_file_store_in_expedient');


    Route::get('medico/{m_id}/salubridad_reports','notesController@salubridad_reports')->name('salubridad_reports');
    ///////<<<<<<NOTES>>>>>>>/////////
    Route::get('medico/{m_id}/create_xml','notesController@create_xml')->name('create_xml');
    Route::get('medico/{m_id}/search_report','notesController@search_reports')->name('search_reports');
    Route::post('salubridad_reports_store_edit','notesController@salubridad_reports_store_edit')->name('salubridad_reports_store_edit');
    Route::get('medico/{m_id}/patient/{p_id}/create/edit/salubridad_report','notesController@create_edit_salubridad_report')->name('create_edit_salubridad_report');
    Route::post('store_report','notesController@store_report')->name('store_report');
    Route::post('salubridad_report_store','notesController@salubridad_report_store')->name('salubridad_report_store');
    Route::get('clinic_history_pdf/{id}','notesController@clinic_history_pdf')->name('clinic_history_pdf');
    Route::get('medico/patient/clinic_history/{id}/delete','notesController@clinic_history_delete')->name('clinic_history_delete');
    Route::get('medico/patient/clinic_history/{id}/note/delete','notesController@history_note_delete')->name('history_note_delete');
    Route::get('medico/{m_id}/patient/{p_id}/notes/clinic_history/{ch_id}/view_preview','notesController@clinic_history_view_preview')->name('clinic_history_view_preview');

    Route::get('medico/{m_id}/patient/{p_id}/notes/clinic_history/create','notesController@history_clinic_create')->name('history_clinic_create');
    Route::get('medico/{m_id}/patient/{p_id}/notes/clinic_histories','notesController@clinic_history')->name('clinic_history');

    Route::post('medico_vital_sign_store','notesController@medico_vital_sign_store')->name('medico_vital_sign_store');
    Route::post('medico_test_labs_store','notesController@medico_test_labs_store')->name('medico_test_labs_store');

    Route::post('test_lab_delete','notesController@test_lab_delete')->name('test_lab_delete');
    Route::post('vital_sign_delete','notesController@vital_sign_delete')->name('vital_sign_delete');

    Route::get('medico/{m_id}/patient/{p_id}/notes/{n_id}/test_labs','notesController@medico_test_labs')->name('medico_test_labs');

    Route::get('medico/{m_id}/patient/{p_id}notes/{n_id}/vital_signs','notesController@medico_vital_signs')->name('medico_vital_signs');
    Route::post('ajax_test_labs','notesController@ajax_test_labs')->name('ajax_test_labs');
    Route::post('test_labs_config','notesController@test_labs_config')->name('test_labs_config');
    Route::post('ajax_vital_sign_config','notesController@ajax_vital_sign_config')->name('ajax_vital_sign_config');
    Route::post('vital_sign_config_update','notesController@vital_sign_config_update')->name('vital_sign_config_update');
    Route::get('medico/patient/note/{id}/move','notesController@note_move')->name('note_move');
    Route::get('medico/patient/note/{n_id}/move/expedient/{ex_id}/store','notesController@note_move_store')->name('note_move_store');
    Route::post('medico/patient/expedient/{ex_id}/update','notesController@expedient_update')->name('expedient_update');
    Route::get('medico/patient/expedient/{ex_id}/preview','notesController@expedient_preview')->name('expedient_preview');
    Route::get('medico/patient/expedient/{ex_id}/print_pdf','notesController@download_expedient_pdf')->name('download_expedient_pdf');

    Route::get('medico/{m_id}/patient/{p_id}/expedient/{ex_id}/open','notesController@expedient_open')->name('expedient_open');
    Route::get('medico/patient/expedient/{id}/edit','notesController@expedient_edit')->name('expedient_edit');

    Route::get('medico/patient/note/{id}/delete','notesController@note_delete')->name('note_delete');

    Route::get('medico/patient/note/{id}/restart','notesController@note_restart')->name('note_restart');
    Route::get('medico/{m_id}/patient/{p_id}/note/paper_bin','notesController@note_paper_bin')->name('note_paper_bin');
    Route::get('medico/patient/expedient/{exp_id}/note/{n_id}/delete','notesController@expedient_note_delete')->name('expedient_note_delete');
    Route::get('medico/patient/expedient/{id}/delete','notesController@expedient_delete')->name('expedient_delete');

    Route::post('medico/patient/expedient/store','notesController@expedient_store')->name('expedient_store');

    Route::get('medico/{m_id}/patient/{p_id}/expedients','notesController@expedients_patient')->name('expedients_patient');

    Route::get('medico/patient/expedient/search','notesController@expedient_search')->name('expedient_search');
    Route::get('medico/patient/notes/search','notesController@note_search')->name('note_search');
    Route::post('medico/patient/note/config/store','notesController@note_config_store')->name('note_config_store');

    //NOTES
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/view_preview','notesController@view_preview')->name('view_preview');
    Route::get('medico/{m_id}/patient/{p_id}/type_notes','notesController@type_notes')->name('type_notes');

    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/config','notesController@note_config')->name('note_config');
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/edit','notesController@note_edit')->name('note_edit');
    Route::get('medico/{m_id}/patient/{p_id}/notes/','notesController@notes_patient')->name('notes_patient');
    Route::post('medico/patient/note/store','notesController@note_store')->name('note_store');
    Route::post('medico/patient/note/update/','notesController@note_update')->name('note_update');
    ///
    Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/create','notesController@note_create')->name('note_create');

    Route::get('note/{id}/download_pdf','notesController@download_pdf')->name('download_pdf');

    Route::post('check_input_notes','notesController@check_input_notes')->name('check_input_notes');







    Route::post('redirect_task_consultation','medico_diaryController@redirect_task_consultation')->name('redirect_task_consultation');

    Route::get('medico/{m_id}/patient/{p_id}/appointment/{app_id}/tasks','medico_diaryController@task_consultation')->name('task_consultation');

});
Route::get('admin/patient_list', 'administratorsController@admin_patient_list')->name('admin_patient_list');


//DATA_PATIENT
Route::get('medico/{m_id}/patient/{p_id}/data', 'medicoController@data_patient')->name('data_patient');
Route::post('medico/patient/data/store', 'medicoController@data_patient_store')->name('data_patient_store');

Route::get('medico/{m_id}/patient/{p_id}/data/extract', 'medicoController@data_patient_extract_perfil')->name('data_patient_extract_perfil');

Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}','medicoController@create_note_patient')->name('create_note_patient');

Route::get('medico/{m_id}/admin/data/{p_id}/patient','medicoController@admin_data_patient')->name('admin_data_patient');
// MIDLEWARE verify_conultation_open4
Route::group(['middleware' => ['verify_conultation_open'],'except' => ['index', 'show']], function (){
    // income_medic
    Route::get('medico/{id}/income','medicoController@income_medic')->name('income_medic');
    Route::get('medico/{id}/income/without_pay','medicoController@income_medic_without_pay')->name('income_medic_without_pay');
    //event appoitment diary
    Route::resource('city','cityController');
    Route::resource('user','userController');

    Route::get('medico/{id}/perfil','medicoController@medico_perfil')->name('medico_perfil');
    Route::post('delete_video','medicoController@delete_video')->name('delete_video');

    Route::post('medicoBorrar','medicoController@medicoBorrar')->name('medicoBorrar');
    Route::post('medico/experience/delete','medicoController@medico_experience_delete')->name('medico_experience_delete');
    Route::post('medico/service/store','medicoController@service_medico_store')->name('service_medico_store');
    Route::post('medic/experience/store','medicoController@medico_experience_store')->name('medico_experience_store');
    Route::post('medic/social_network/store','medicoController@medico_social_network_store')->name('medico_social_network_store');
    Route::post('ajax_data_edit_event_2','medico_diaryController@ajax_data_edit_event')->name('ajax_data_edit_event');
    Route::post('ajax_ending_event','medico_diaryController@ajax_ending_event')->name('ajax_ending_event');
    //// app patient
    Route::get('medico/{m_id}/patient/{p_id}/appointments/made_and_receivable','medicoController@patient_app_realizada_por_cobrar')->name('patient_app_realizada_por_cobrar');

    Route::get('medico/{m_id}/patient/{p_id}/appointments/confirmed','medicoController@patient_appointments_confirmed')->name('patient_appointments_confirmed');

    Route::get('medico/{m_id}/patient/{p_id}/appointments/no_confirmed','medicoController@patient_appointments_no_confirmed')->name('patient_appointments_no_confirmed');
    Route::get('medico/{m_id}/patient/{p_id}/appointments/all', 'medicoController@patient_appointments_all')->name('patient_appointments_all');
    Route::get('medico/{m_id}/patient/{p_id}/appointments/past_collect', 'medicoController@patient_appointments_past_collect')->name('patient_appointments_past_collect');

    Route::get('medico/{m_id}/patient/{p_id}/appointments/completed', 'medicoController@patient_appointments_completed')->name('patient_appointments_completed');

    Route::get('medico/{m_id}/patient/{p_id}/appointments/paid_and_pending', 'medicoController@patient_appointments_paid_and_pending')->name('patient_appointments_paid_and_pending');

    Route::get('medico/{m_id}/patient/{p_id}/appointments/canceled', 'medicoController@patient_appointments_canceled')->name('patient_appointments_canceled');
    //// app patient end
    Route::get('medico/{id}/appointments/made_and_receivable', 'medicoController@app_realizada_por_cobrar')->name('app_realizada_por_cobrar');

    Route::get('medico/{id}/appointments/all', 'medicoController@appointments_all')->name('appointments_all');
    Route::get('medico/{id}/appointments/past_collect', 'medicoController@appointments_past_collect')->name('appointments_past_collect');

    Route::get('medico/{id}/appointments/completed', 'medicoController@appointments_completed')->name('appointments_completed');

    Route::get('medico/{id}/appointments/paid_and_pending', 'medicoController@appointments_paid_and_pending')->name('appointments_paid_and_pending');

    Route::get('medico/{id}/appointments/confirmed', 'medicoController@appointments_confirmed')->name('appointments_confirmed');

    Route::get('medico/{id}/appointments/canceled', 'medicoController@appointments_canceled')->name('appointments_canceled');
    Route::post('borrar_social','medicoController@borrar_social')->name('borrar_social');

    Route::get('medic/{id}/consulting_room/create','consulting_roomController@consulting_room_create')->name('consulting_room_create');
    Route::post('medic/{id}/consulting_room/store','consulting_roomController@consulting_room_store')->name('consulting_room_store');
    Route::get('medic/{id}/consulting_room/edit','consulting_roomController@consulting_room_edit')->name('consulting_room_edit');
    Route::post('medic/{id}/consulting_room/update','consulting_roomController@consulting_room_update')->name('consulting_room_update');
    Route::get('medico/{m_id}/patient/{p_id}/appointments','medicoController@medico_appointments_patient')->name('medico_appointments_patient');

    Route::post('medico/{id}/store/insurrances','medicoController@medico_store_insurrances')->name('medico_store_insurrances');
    Route::get('medico/{id}/create/add/insurrances','medicoController@medico_create_add_insurrances')->name('medico_create_add_insurrances');

    //MEDICAL_CENTER
    //se le aplico el middleware en el consructor
    Route::resource('medicalCenter','medicalCenterController');
    //
    Route::group(['middleware' => ['verify_complete_medical_center'],'except'=>['update']], function (){


        Route::post('medicalCenter/{id}/coordinates/store','medicalCenterController@medicalCenter_store_coordinates')->name('medicalCenter_store_coordinates');
        Route::post('medicalCenter/select/insurrances','medicalCenterController@select_insurrances')->name('select_insurrances');

        //
        Route::post('medicalCenter/social/store','medicalCenterController@medicalCenter_social_store')->name('medicalCenter_social_store');
        Route::get('medicalCenter/{id}/search/medico','medicalCenterController@search_medico_medical_center')->name('search_medico_medical_center');

        Route::get('medicalCenter/{id}/search/medico/belongs','medicalCenterController@search_medico_belong_medical_center')->name('search_medico_belong_medical_center');
        Route::post('medicalCenter/{id}/store/experience','medicalCenterController@medical_center_experience_store')->name('medical_center_experience_store');
        Route::post('medicalCenter/{id}/store/specialty','medicalCenterController@medical_center_specialty_store')->name('medical_center_specialty_store');
        Route::post('medicalCenter/{id}/list/specialty','medicalCenterController@medicalCenter_list_specialty')->name('medicalCenter_list_specialty');
        Route::post('medicalCenter/{id}/list/experience','medicalCenterController@medicalCenter_list_experience')->name('medicalCenter_list_experience');

        Route::post('medicalCenter/specialty/delete','medicalCenterController@medical_specialty_delete')->name('medical_specialty_delete');
        Route::post('medicalCenter/experience/delete','medicalCenterController@medical_experience_delete')->name('medical_experience_delete');

        Route::get('medicalCenter/{id}/create/add/insurrances','medicalCenterController@create_add_insurrances')->name('create_add_insurrances');
        Route::post('medicalCenter/{id}/store/insurrances','medicalCenterController@medicalCenter_store_insurrances')->name('medicalCenter_store_insurrances');

        Route::get('medicalCenter/insurance/{id}/delete','medicalCenterController@delete_insurance')->name('delete_insurance');


        Route::get('data/primordial/{id}/medical_center/address','medicalCenterController@data_primordial_medical_center2')->name('data_primordial_medical_center2');

        Route::get('medical_center/{id}/panel','medicalCenterController@medical_center_panel')->name('medical_center_panel');

        Route::get('confirm/MedicalCenter/{id}/{code}','medicalCenterController@confirmMedicalCenter')->name('confirmMedicalCenter');

        Route::get('confirm/MedicalCenter/{id}/{code}','medicalCenterController@confirmMedicalCenter')->name('confirmMedicalCenter');
        //

        Route::post('medicalCenter/{id}/description','medicalCenterController@medicalCenter_description_show')->name('medicalCenter_description_show');

        Route::post('medicalCenter/{id}/description','medicalCenterController@medicalCenter_description_show')->name('medicalCenter_description_show');
        Route::post('medicalCenter/{id}/description/update','medicalCenterController@medicalCenter_description_update')->name('medicalCenter_description_update');


        Route::get('medicalCenter/{id}/manage/medicos','medicalCenterController@medical_center_manage_medicos')->name('medical_center_manage_medicos');


        Route::get('medicalCenter/{id}/edit/data','medicalCenterController@medical_center_edit_data')->name('medical_center_edit_data');
        Route::post('medicalCenter/{id}/edit/data/update','medicalCenterController@medical_center_edit_data_update')->name('medical_center_edit_data_update');
        Route::post('medicalCenter/add/medico','medicalCenterController@medical_center_add_medico')->name('medical_center_add_medico');

        Route::get('medicalCenter/{id}/edit/address','medicalCenterController@medical_center_edit_address')->name('medical_center_edit_address');

        Route::post('medicalCenter/{id}/update/address','medicalCenterController@medical_center_update_address')->name('medical_center_update_address');


        Route::get('medicalCenter/{id}/edit/schedule','medicalCenterController@medical_center_edit_schedule')->name('medical_center_edit_schedule');

        Route::post('medicalCenter/{id}/store/schedule','medicalCenterController@medical_center_store_schedule')->name('medical_center_store_schedule');

        Route::get('medicalCenter/{id}/delete/schedule','medicalCenterController@medical_center_schedule_delete')->name('medical_center_schedule_delete');

    });//end midleware verify complete medical center
    Route::get('medicalCenter/{id}/data/primordial/','medicalCenterController@data_primordial_medical_center')->name('data_primordial_medical_center');

    Route::post('image/medical_center/store','photoController@image_store_medical_center')->name('image_store_medical_center');


    Route::get('medicalCenter/image/delete/{id}','photoController@photo_medical_delete')->name('photo_medical_delete');

    Route::get('medico/photo/delete/{id}','photoController@photo_delete')->name('photo_delete');
    Route::resource('photo','photoController');
    Route::post('image/medico/store','photoController@image_store')->name('image_store');


    Route::resource('consulting_room','consulting_roomController');

    Route::get('medico/{id}/info/create','medicoController@medico_specialty_create')->name('medico_specialty_create');
    Route::get('medico/{id}/info/edit','medicoController@medico_specialty_edit')->name('medico_specialty_edit');
    Route::post('medico/specialty/store','medicoController@medico_specialty_store')->name('medico_specialty_store');
    Route::post('medico/specialty{id}/update','medicoController@medico_specialty_update')->name('medico_specialty_update');
    Route::get('medico/specialty{id}/delete','medicoController@medico_specialty_delete')->name('medico_specialty_delete');

    Route::get('medical/centers/list','administratorsController@medical_center_list')->name('medical_center_list');

    Route::get('medicos/list','medicoController@medicosList')->name('medicosList');

    Route::get('category/{id}/specialty/delete','specialty_categoryController@specialtyC_delete')->name('specialtyC_delete');

    Route::resource('specialty','specialtyController');
    Route::resource('sub_specialty','sub_specialtyController');


    Route::resource('administrators','administratorsController');
    Route::get('medicos_list','administratorsController@medicos_list')->name('medicos_list');

    //plans
    Route::resource('plans','plansController');

    Route::post('admin/porcentage/store','plansController@porcentage_store')->name('porcentage_store');
    Route::get('admin/plans/porcentages','plansController@plans_porcentages')->name('plans_porcentages');
    Route::get('planes','plansController@planes')->name('planes');
    Route::get('medico/{id}/contract/plan','plansController@contract')->name('contract');

    Route::get('planes/medic/{id}','plansController@planes_medic')->name('planes_medic');

    Route::get('plans/medic/specialties','plansController@planes_medic_specialties')->name('planes_medic_specialties');
    Route::get('plans/alterativa/psicologos/Terapeutas','plansController@planes_alt_psicologos')->name('planes_alt_psicologos');

    //
    Route::resource('promoters','promotersController');

    Route::post('account_number_store','promotersController@account_number_store')->name('account_number_store');
    Route::get('account_number/{id}/edit','promotersController@account_number_edit')->name('account_number_edit');
    Route::get('account_number/{id}/delete','promotersController@account_number_delete')->name('account_number_delete');
    Route::post('account_number/update','promotersController@account_number_update')->name('account_number_update');


    Route::get('promoter/{id}/accounts/number','promotersController@accounts_number')->name('accounts_number');

    Route::resource('specialty_category','specialty_categoryController');
    Route::get('promoter/medico/{id}/comisions','promotersController@promoter_medico_comisions')->name('promoter_medico_comisions');


    Route::get('promoters/{id}/add/medic/invited','promotersController@add_medic')->name('add_medic');

    Route::post('promoters/store/medic','promotersController@store_medic')->name('store_medic');

    Route::get('promoters/{id}/add/medical_center/invited','promotersController@add_medical_center')->name('add_medical_center');

    Route::get('promoter/{id}/list_medical_center_invited','promotersController@list_medical_center_invited')->name('list_medical_center_invited');


    Route::get('promoter/{id}/deposits','promotersController@promoter_deposits')->name('promoter_deposits');


    Route::get('promoter/deposit/{id}/details','promotersController@deposit_details')->name('deposit_details');

    Route::post('deposit_establish_payment_store','promotersController@deposit_establish_payment_store')->name('deposit_establish_payment_store');

    Route::get('admin/promoters/deposits/{id}/establish_payment','promotersController@deposit_establish_payment')->name('deposit_establish_payment');

    Route::get('promoter/{id}/deposits/pending','promotersController@promoter_deposits_pending')->name('promoter_deposits_pending');
    Route::get('promoter/{id}/deposits/paid_out','promotersController@promoter_deposits_paid_out')->name('promoter_deposits_paid_out');



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

    ///////ASSISTANT
    Route::get('admin/assistant/list','administratorsController@assistant_list')->name('assistant_list');


    Route::resource('permissionSet','permissionSetController');
    Route::get('admin/{id}/permissions','administratorsController@permissions_admin')->name('permissions_admin');
    Route::get('permission/{id}/set/admin/','permissionSetController@PermissionSet')->name('PermissionSet');

    Route::get('permissions/{id}/store/{id2}/','PermissionSetController@PermissionSetStore')->name('PermissionSetStore');
    Route::get('clients/promoter/{id}','promotersController@clientsPromoter')->name('clientsPromoter');
    //sRoute::get('edit/price/{id}/plan','plansController@PermissionSet')->name('editPrice');

    Route::post('medico/{id}/coordinates/store','medicoController@medico_store_coordinates')->name('medico_store_coordinates');

    Route::get('patient/{p_id}/medico/{m_id}/
    rate','patientController@patient_rate_medic')->name('patient_rate_medic');
    Route::post('check_show_rate','medicoController@check_show_rate')->name('check_show_rate');
    Route::post('check_view_ajax','medicoController@check_view_ajax')->name('check_view_ajax');



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


}); //END verify_conultation_open4




Route::resource('assistant','assistantController');
Route::get('medico/search/assistant/registered','assistantController@search_assistants_registered')->name('search_assistants_registered');
Route::post('medico/assistant/add/store','assistantController@add_assistant_store')->name('add_assistant_store');

Route::get('medico/{id}/assistant/add','assistantController@add_assistant')->name('add_assistant');
Route::post('assistant/assist/medico','assistantController@assist_medico')->name('assist_medico');
Route::get('assistant/{id}/medicos','assistantController@assistant_medicos')->name('assistant_medicos');
Route::get('medico/{id}/asistants/create','assistantController@medico_assistant_create')->name('medico_assistant_create');
Route::get('medico/{id}/asistants','assistantController@medico_assistants')->name('medico_assistants');
Route::post('assistant_permissions_store','assistantController@assistant_permissions_store')->name('assistant_permissions_store');

Route::get('assistant/{id}/permission','assistantController@assistant_permissions')->name('assistant_permissions');

Route::get('confirm/assistant/{id}/{code}','assistantController@confirmAssistant')->name('confirmAssistant');


Route::get('register/assistant/{id}/step4','assistantController@AvisoConfirmAccountAssistant')->name('AvisoConfirmAccountAssistant');
/////////////
