<?php
/*
|--------------------------------------------------------------------------
| client(user's) Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web'])->group(function() {
    // change the language of all the site
    Route::get('lang/{lang}','GeneralController@language');

// client(user)'s route-list which no need to authentication
    Auth::routes(['verify' => true]);
//verify the user
    Route::get('client/verify/{token}','Auth\RegisterController@verifyUser');
// Send the verify user mail
    Route::get('resend-mail','Auth\RegisterController@reSendMail');
// Resend the verify user mail
    Route::post('resend-verifymail','Auth\RegisterController@sendverifymail')->name('resend-mail');

// if  client role is accepted the client request routes
    Route::get('client/accept/request/{id}','Auth\RegisterController@acceptClientRequest')->name('client.accept.role.request');

// if  supplier accept  the request of the client
    Route::get('invitation/accept/{id}','Client\MessageInvitationController@acceptInvitation')->name('client.invitation.accept');
    Route::get('allDownload','Client\MessageInvitationController@allDownload');


    Route::namespace('Client')->middleware('auth')->group(function(){

        // route is display after first time login only

        Route::get('new-password','HomeController@newPassword')->name('client.first.new.password');
        Route::post('store-password','HomeController@storeNewPassword')->name('client.first.store.password');

        Route::get('create-company','HomeController@createCompany')->name('client.first.company.create');
        Route::post('store-company','HomeController@storeCompany')->name('client.first.company.store');

        Route::get('profile','HomeController@createProfile')->name('client.first.create.profile');
        Route::post('store-profile','HomeController@storeProfile')->name('client.first.store.profile');

        Route::get('branding','HomeController@addBrand')->name('client.first.create.brand');
        Route::post('store-brand','HomeController@storeBrand')->name('client.first.brand.store');

        Route::get('questionnaire/create','HomeController@createQuestionnaire')->name('client.first.create.questionnaire');
        Route::post('store-questionnaire','HomeController@storeQuestionnaire')->name('client.first.store.questionnaire');

        // get the city and state name   this is out of  above condition bcz this route is used for another route
        Route::get('get-state-list/{id}','HomeController@getStates')->name('client.get.state');
        Route::get('get-city-list/{id}','HomeController@getCities')->name('client.get.city');

        // routes of the summary
        Route::get('/', 'SummaryController@index');
        Route::get('home','SummaryController@index')->name('home');

        // route of change the password of  client
        Route::get('change-password','HomeController@changePassword')->name('client.change.password');
        Route::post('change-password','HomeController@storeChangePassword')->name('client.store.change.password');

        // Add profile of client
        Route::get('add-profile','ProfileController@addProfile')->name('client.profile.add');
        Route::post('storeprofile','ProfileController@storeProfile')->name('client.profile.store');
        Route::get('view-profile','ProfileController@showProfile')->name('client.profile.view');
        Route::get('edit-profile','ProfileController@editProfile')->name('client.profile.edit');
        Route::put('updateprofile','ProfileController@updateProfile')->name('client.profile.update');

        //ROLES
        Route::get('view-roles','ProfileController@showRoles')->name('client.profile.roles');


        // edit branding
        Route::get('edit-brand','BrandController@editBrand')->name('client.edit.brand');
        Route::post('update-brand','BrandController@updateBrand')->name('client.update.brand');


        // role permission model
        Route::resource('roles','ClientRoleController');

        // route of the create the  client and assign the role
        Route::get('show/description/{id}','ClientRoleController@showDescription')->name('client.show.description');
        Route::post('create/client','ClientRoleController@createClient')->name('client.create.client');
        Route::post('edit/client','ClientRoleController@updateClientRole')->name('client.edit.client');
        Route::get('delete/client/{id}','ClientRoleController@deleteClient')->name('client.delete.client');
        Route::get('edit/pending/client/{id}','ClientRoleController@editClientRole')->name('client.edit.pending.client');
        Route::post('update/pending/client/{id}','ClientRoleController@updatePendingClientRole')->name('client.update.pending.client');
        Route::get('delete/pending/client/{id}','ClientRoleController@deletePendingClientRole')->name('client.delete.pending.client');

        //company routes
        Route::get('edit-company','CompanyController@edit')->name('client.company.edit');
        Route::put('update/company','CompanyController@update')->name('client.company.update');
        Route::put('update/company/branding','CompanyController@updateBranding')->name('client.company.update.branding');
        Route::get('company-list','CompanyController@index')->name('client.company.list');
        Route::post('store/company','CompanyController@store')->name('client.company.store');
        Route::get('show-company/{id}','CompanyController@show')->name('client.company.show');
        Route::delete('delete/company/{id}','CompanyController@destroy')->name('client.company.delete');

        // suppliers invitation crud by client
        Route::get('suppliers','ClientSupplierController@index')->name('client.supplier.index');
        Route::get('supplier/data/get-paginate', 'ClientSupplierController@getPaginate');
        Route::get('supplier/data/get-paginate-pending', 'ClientSupplierController@getPaginatePending');
        Route::get('supplier/data/get-paginate-delete', 'ClientSupplierController@getPaginateDelete');
        Route::get('suppliers/{id}','ClientSupplierController@supplierDetails')->name('client.supplier.details');
        Route::get('create/supplier','ClientSupplierController@createSupplier')->name('client.supplier.create');
        Route::get('resend-invitation/{id}','ClientSupplierController@reSendInvitatin')->name('client.supplier.reinvite');
        Route::get('supplier/change-status/{str}/{id}','ClientSupplierController@changeStatus')->name('client.supplier.change.status');
        Route::get('delete-supplier/{id}','ClientSupplierController@destory')->name('client.supplier.delete');
        Route::get('suppliier/location/list/{id}','ClientSupplierController@supplierLocationList')->name('client.supplier.location.list');
        Route::post('supplier/location/filter','ClientSupplierController@locationFilter')->name('client.supplier.location.filter');
        Route::get('supplier/accept/answer/{id}/{value}','ClientSupplierController@acceptAnswer')->name('client.accept.answer');
        Route::post('supplier/add/file','ClientSupplierController@uploadAnsFile')->name('client.upload.ansfile');
        Route::post('supplier/add/observation','ClientSupplierController@uploadAnsObservation')->name('client.upload.observation');
        Route::get('supplier/reinvitation/{supplier}','ClientSupplierController@reInvitation')->name('client.supplier.reinvitation.new');


        // client add the observation route
        Route::post('add/observation','ClientSupplierController@clientObservation')->name('client.add.observation');
        Route::get('delete/invitation/{id}','ClientSupplierController@deleteInvitation')->name('client.supplier.pending.delete');
        Route::get('send/ticket/observation','ClientSupplierController@sendObservation')->name('client.send.ticket.observation');
        Route::post('Send/ticket/store','ClientSupplierController@sentTicket')->name('client.sent.observation.store');

        // questionnaries groupcud by cliet Route
        Route::get('questionnaire-group-list','QuestionnarieGroupController@index')->name('client.questionnariegroup.index');
        Route::get('create-questionnaire-group','QuestionnarieGroupController@create')->name('client.questionnariegroup.create');
        Route::post('questionnaire-group/store','QuestionnarieGroupController@store')->name('client.questionnariegroup.store');
        Route::get('show-questionnaire-group/{id}','QuestionnarieGroupController@show')->name('client.questionnariegroup.show');
        Route::get('edit-questionnaire-group/{id}','QuestionnarieGroupController@edit')->name('client.questionnariegroup.edit');
        Route::put('questionnaire-group/update/{id}','QuestionnarieGroupController@update')->name('client.questionnariegroup.update');
        Route::delete('delete-questionnaire-group/{id}','QuestionnarieGroupController@destroy')->name('client.questionnariegroup.delete');

        // make questionnaires   crud by client
        Route::get('questionnaire','QuestionnaireController@index')->name('client.questionnarie.index');
        Route::get('create-questionnaire/','QuestionnaireController@create')->name('client.questionnarie.create');
        Route::get('cancel-btn','QuestionnaireController@cancelBtn')->name('client.questionnaire.close');
        Route::post('questionnaire/store','QuestionnaireController@store')->name('client.questionnarie.store');
        Route::get('show-questionnaire/{id}','QuestionnaireController@show')->name('client.questionnarie.show');
        Route::get('edit-questionnaire/{qid}','QuestionnaireController@edit')->name('client.questionnarie.edit');
        Route::put('questionnaire/update/{id}','QuestionnaireController@update')->name('client.questionnarie.update');
        Route::get('delete-questionnaire/{id}','QuestionnaireController@destroy')->name('client.questionnarie.delete');
        Route::get('questionnaire/status/{id}','QuestionnaireController@changeStatus')->name('client.questionnarie.status');
        Route::get('view/supplier/{id}','QuestionnaireController@showPendingQuestionary')->name('client.show.questionary');
        Route::get('import-questionnaires/{id}','QuestionnaireController@importQuestionnaire')->name('client.import.questionnaire');
        Route::post('save-import','QuestionnaireController@storeImport')->name('client.save.import');
        Route::get('list-questionnaire','QuestionnaireController@listQuestionnaire')->name('client.list.questionnaire');
        // questionnaire setting route
        Route::get('questionnaire/setting/{id}','QuestionnairePermissionController@questionnaireSetting')->name('client.questionnaire.setting');
        Route::post('questionnaire/setting','QuestionnairePermissionController@storeSetting')->name('client.questionnaire.store.setting');
        Route::post('questionnaires/setting/change/status/{id}','QuestionnairePermissionController@changeQuestionnaireStatus')->name('client.questionnaire.change.status');
        // download the questionnaires
        Route::get('download/questionnaires/{sid}/{lid}/{qid}','QuestionnaireController@downloadQuestionnaires')->name('client.download.questionnaire');


        // routes of the question crud by client
        Route::get('question-list','QuestionController@index')->name('client.question.index');
        Route::get('create-question/{id}','QuestionController@create')->name('client.question.create');
        Route::post('question/store','QuestionController@store')->name('client.question.store');
        Route::get('show-question/{id}','QuestionController@show')->name('client.question.show');
        Route::get('edit-question/{id}','QuestionController@edit')->name('client.question.edit');
        Route::put('question/update/{id}','QuestionController@update')->name('client.question.update');
        Route::get('delete-question/{id}','QuestionController@destroy')->name('client.question.delete');

        // route of the message section
        Route::get('ticket/inbox','MessageTicketController@ticketInboxList')->name('client.ticket.inbox');
        Route::get('ticket/inbox/details/{id}','MessageTicketController@ticketInboxDetails')->name('client.ticket.inboxdetails');
        Route::post('ticket/inbox/reply','MessageTicketController@ticketReplyOnInboxMessage')->name('client.inbox.ticket.reply');

        Route::get('ticket/sent','MessageTicketController@ticketSentList')->name('client.ticket.sent');
        Route::get('ticket/sent/details/{id}','MessageTicketController@ticketSentDeatils')->name('client.ticket.sentdetail');
        Route::post('ticket/sent/reply','MessageTicketController@ticketReplyOnSentMessage')->name('client.sent.ticket.reply');


        Route::get('ticket/new','MessageTicketController@newTicket')->name('client.ticket.new');
        Route::get('send/ticket/{id}','MessageTicketController@sendTicket')->name('client.ticket.send');
        Route::post('ticket/new-data','MessageTicketController@storeTicket')->name('client.ticket.new.store');
        Route::get('tickets/get-location/{id}','MessageTicketController@getLocationName')->name('client.ticket.get.location');
        Route::get('ticket/change-status/{id}','MessageTicketController@changeTicketStatus')->name('client.ticket.change.status');
        Route::get('ticket/inbox/change-status/{id}','MessageTicketController@supplierChangeTicketStatus')->name('client.supplier.ticket.change.status');
        Route::post('ticket/inbox/delete','MessageTicketController@deleteInboxTickets')->name('client.delete.inbox.tickets');
        Route::post('ticket/sent/delete','MessageTicketController@deleteSentTickets')->name('client.delete.sent.tickets');


        // accept the  supplier location
        Route::get('accept-location/{lid}','MessageTicketController@acceptLocation')->name('client.accept.location');


        // route of the invitation
        Route::get('invitation/sent','MessageInvitationController@invitationInbox')->name('client.invitation.sent');
        Route::get('invitation/sent/details/{id}','MessageInvitationController@invitationSentDetail')->name('client.invitation.sentdetail');
        Route::get('invitation/sent/new','MessageInvitationController@newInvitation')->name('client.invitation.newset');
        Route::post('invitation/store','MessageInvitationController@invitation')->name('client.invitation.store');
        Route::get('invitation/reinvitation/{id}','MessageInvitationController@reInvitation')->name('client.reinvitation');
        Route::post('reinvite/expired','MessageInvitationController@inviteToExpired')->name('client.reinvitation.expired');

        Route::get('invitation/expired','MessageInvitationController@invitationExpired')->name('client.invitation.expired');
        Route::get('invitation/expired/details/{id}','MessageInvitationController@invitationExpiredDetail')->name('client.invitation.expireddetail');
        Route::get('invitation/timeout','MessageInvitationController@invitationTimeout')->name('client.invitation.timeout');

        // route of the questionnaire reminder
        Route::get('questionnaire/reminder','MessageQuestionnaireController@reminder')->name('client.questionnaire.reminder');
        Route::get('questionnaire/reminder/details/{id}','MessageQuestionnaireController@reminderDetails')->name('client.questionnaire.reminberdetails');
        Route::post('questionnaire/send/reminder','MessageQuestionnaireController@sendReminder')->name('client.send.reminder');
        Route::post('questionnaire/resend/selectall','MessageQuestionnaireController@resendAllSelected')->name('client.resend.selectall');

        // route of the event(calander)
        Route::get('event','ClientEventController@index')->name('client.event.inex');
        Route::post('evnet-data','ClientEventController@storeEvent')->name('client.event.store');
        Route::get('get-event-data/{id}','ClientEventController@geteventdata')->name('client.event.getdata');
        Route::post('event-update/{id}','ClientEventController@updateEvent')->name('client.event.update');
        Route::get('event-delete/{id}','ClientEventController@deleteEvent')->name('client.event.delete');
        Route::post('event/prevday','ClientEventController@getPrevDay');
        Route::post('event/nextday','ClientEventController@getNextDay');
        Route::post('event/today','ClientEventController@getToDay');
        Route::get('event/{date}','ClientEventController@getDateEvent')->name('client.get.event');

        // create the folder and file by  client in supplier module
        Route::post('create-folder','ClientSupplierController@createFolder')->name('client.create.folder');
        Route::post('update-file','ClientSupplierController@uploadFile')->name('admin.upload.file');

        Route::get('download-file/{id}/{name}','ClientSupplierController@downloadAllFile')->name('client.supplier.download.file');
//    Route::get('download-file','ClientSupplierController@downloadAllFile')->name('client.supplier.download.file');

        Route::get('single-file/{id}','ClientSupplierController@downloadSingleFile')->name('client.supplier.single.file');
        Route::get('delete-file/{id}','ClientSupplierController@deleteSingleFile')->name('client.supplier.delete.file');
        Route::post('rename-folder','ClientSupplierController@renameFolder')->name('client.rename.folder');
        Route::post('delete-folder','ClientSupplierController@deleteDirectory')->name('client.delete.folder');

        // client add  the file and observation on the supplier's answers
        Route::post('client-add-file','ClientObservationController@addFile')->name('client.ans.add.file');
        Route::post('client-add-obs','ClientObservationController@addObservation')->name('client.ans.add.observation');
        Route::get('delete-observation/{id}','ClientObservationController@deleteObservation')->name('client.ans.observation.delete');



    });

    /*************************************User(clients) Routes End***********************************/



    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register admin routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::namespace('Admin\Auth')->prefix('admin')->group(function(){

        Route::get('login','AdminLoginController@adminLoginForm')->name('admin.login.form');
        Route::post('login','AdminLoginController@adminLogin')->name('admin.login');

        // Route::get('registration','AdminRegisterController@adminRegisterForm')->name('admin.register.form');
        // Route::post('send-confirm-mail','AdminRegisterController@sendConfrimationMail')->name('admin.send.confirm-mail');
        // Route::post('registration','AdminRegisterController@adminRegister')->name('admin.register');

        Route::get('forgot/password/reset','AdminForgotPasswordController@forgotPassWordForm')->name('admin.forgot.form');
        Route::post('forgot/password/reset','AdminForgotPasswordController@sendResetLinkEmail')->name('admin.forgotpassword');

        Route::get('password/reset/{token}/{email}','AdminResetPasswordController@resetPasswordForm')->name('admin.reset.form');
        Route::post('reset-password','AdminResetPasswordController@reset')->name('admin.reset');

        Route::post('logout','AdminLoginController@logout')->name('admin.logout');
    });

    Route::namespace('Admin')->middleware('auth:admin')->prefix('admin')->group(function(){
        Route::get('/','DashboardController@index');
        Route::get('dashboard','DashboardController@index')->name('dashboard');

        //change password of admin routes
        Route::get('change-password','DashboardController@changePassword')->name('admin.change.password');
        Route::post('change-password','DashboardController@storeChangePassword')->name('admin.store.change.password');

        // route of profile admin
        Route::get('view-profile','AdminProfileController@showProfile')->name('admin.profile.view');
        Route::get('edit-profile','AdminProfileController@editProfile')->name('admin.profile.edit');
        Route::put('updateprofile','AdminProfileController@updateProfile')->name('admin.profile.update');

        // route  of show thw client and .........
        Route::get('client/list','AdminClientController@showClientList')->name('admin.client.list');
        Route::get('client/create','AdminClientController@create')->name('admin.client.create');
        Route::post('client/store','AdminClientController@registerClient')->name('admin.client.store');


        // they sypplier in admin routes.
        Route::get('supplier-list/{id}','AdminClientController@showclietstSupplierList')->name('admin.client.supplier.list');
        Route::get('change-status/{status}/{id}','AdminClientController@changeStatus')->name('admin.change.status');
        Route::get('supplier/change-status/{status}/{id}','AdminClientController@changeSupplierStatus')->name('admin.supplier.change.status');

        // admin can add update delete and read the company  sector data
        Route::get('list-sector','AdminCompanySectorController@listSector')->name('admin.sector.list');
        Route::get('create-sector','AdminCompanySectorController@createSector')->name('admin.sector.create');
        Route::post('store-sector','AdminCompanySectorController@storeSector')->name('admin.sector.store');
        Route::get('show-sector/{id}','AdminCompanySectorController@showSector')->name('admin.sector.show');
        Route::get('edit-sector/{id}','AdminCompanySectorController@editSector')->name('admin.sector.edit');
        Route::put('update-sector/{id}','AdminCompanySectorController@updateSector')->name('admin.sector.update');
        Route::delete('delete-sector/{id}','AdminCompanySectorController@deleteSector')->name('admin.sector.delete');

        // admin can add update delete and read the company size data
        Route::get('list-size','AdminCompanySizeController@listSize')->name('admin.size.list');
        Route::get('create-size','AdminCompanySizeController@createSize')->name('admin.size.create');
        Route::post('store-size','AdminCompanySizeController@storeSize')->name('admin.size.store');
        Route::get('show-size/{id}','AdminCompanySizeController@showSize')->name('admin.size.show');
        Route::get('edit-size/{id}','AdminCompanySizeController@editSize')->name('admin.size.edit');
        Route::put('update-size/{id}','AdminCompanySizeController@updateSize')->name('admin.size.update');
        Route::delete('delete-size/{id}','AdminCompanySizeController@deleteSize')->name('admin.size.delete');

        // admin can update delete and read the company maturity level
        Route::get('list-maturity','AdminCompanyMaturityController@listMaturity')->name('admin.maturity.list');
        Route::get('create-maturity','AdminCompanyMaturityController@createMaturity')->name('admin.maturity.create');
        Route::post('store-maturity','AdminCompanyMaturityController@storeMaturity')->name('admin.maturity.store');
        Route::get('show-maturity/{id}','AdminCompanyMaturityController@showMaturity')->name('admin.maturity.show');
        Route::get('edit-maturity/{id}','AdminCompanyMaturityController@editMaturity')->name('admin.maturity.edit');
        Route::put('update-maturity/{id}','AdminCompanyMaturityController@updateMaturity')->name('admin.maturity.update');
        Route::delete('delete-maturity/{id}','AdminCompanyMaturityController@deleteMaturity')->name('admin.maturity.delete');

        // routes of the question value crud
        Route::get('question-value/list','AdminQuestionValueController@index')->name('admin.questionvalue.list');
        Route::get('question-value/create','AdminQuestionValueController@create')->name('admin.questionvalue.create');
        Route::post('question-value/store','AdminQuestionValueController@store')->name('admin.questionvalue.store');
        Route::get('question-value/show/{id}','AdminQuestionValueController@show')->name('admin.questionvalue.show');
        Route::get('question-value/edit/{id}','AdminQuestionValueController@edit')->name('admin.questionvalue.edit');
        Route::put('question-value/update/{id}','AdminQuestionValueController@update')->name('admin.questionvalue.update');
        Route::delete('question-value/delete/{id}','AdminQuestionValueController@destroy')->name('admin.questionvalue.delete');
        Route::get('question-value/change-status','AdminQuestionValueController@changStatus')->name('admin.questionvalue.changestatus');

        Route::resource('admin-roles','AdminRoleController');

        Route::resource('admin-permission','AdminPermissionController');


        // admin route for the questionnarie  listing
        Route::get('questionnaire/list','AdminQuestionnaireController@questionnaireList')->name('admin.questionnaire.list');
        Route::get('questionnaire/{id}','AdminQuestionnaireController@questionnaireDetails')->name('admin.questionnaire.details');

        // country
        // Route::get('country','AdminCountryController@index')->name('admin.country.list');

    });

    /*************************************  Admin Routes End***********************************/


    /*
    |--------------------------------------------------------------------------
    | Supplier  Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register supplier routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */



    Route::namespace('Supplier\Auth')->prefix('supplier')->group(function()
    {

        Route::get('login','SupplierLoginController@SupplierLoginForm')->name('supplier.login.form');
        Route::post('login','SupplierLoginController@SupplierLogin')->name('supplier.login');

        Route::get('resend-mail','SupplierRegisterController@reSendMail');
        Route::post('resend-verifymail','SupplierRegisterController@sendverifymail')->name('supplier.verify.resend-mail');

        Route::get('accept-invitation/{token}','SupplierRegisterController@acceptInvitation')->name('accept.invitation');

        Route::get('registration','SupplierRegisterController@supplierRegisterForm')->name('supplier.register.form');
        Route::get('verify/{token}','SupplierRegisterController@verifySupplier');
        Route::post('registration','SupplierRegisterController@supplierRegister')->name('supplier.register');

        Route::get('forgot/password/reset','SupplierForgotPasswordController@forgotPassWordForm')->name('supplier.forgot.form');
        Route::post('forgot/password/reset','SupplierForgotPasswordController@sendResetLinkEmail')->name('supplier.forgotpassword');

        Route::get('password/reset/{token}/{email}','SupplierResetPasswordController@resetPasswordForm')->name('supplier.reset.form');
        Route::post('reset-password','SupplierResetPasswordController@reset')->name('supplier.reset');

        Route::post('logout','SupplierLoginController@logout')->name('supplier.logout');
    });


    Route::namespace('Supplier')->middleware('auth:supplier')->prefix('supplier')->group(function(){
        Route::get('/','SupplierHomeController@index');
        Route::get('home','SupplierHomeController@index')->name('supplier.home');

        Route::get('new/password','SupplierHomeController@showNewPasswordForm')->name('supplier.first.new.password');
        Route::post('new/password/store','SupplierHomeController@storeNewPassword')->name('supplier.first.store.newpassword');

        Route::get('new/location','SupplierHomeController@locationForm')->name('supplier.first.location');
        Route::post('new/location/store','SupplierHomeController@storeLocation')->name('supplier.first.store.location');

        Route::get('location/get-state-list/{id}','SupplierHomeController@getStates')->name('supplier.get.state');
        Route::get('location/get-city-list/{id}','SupplierHomeController@getCities')->name('supplier.get.city');

        Route::get('new/profile','SupplierHomeController@profileForm')->name('supplier.first.profile');
        Route::post('new/profile/store','SupplierHomeController@storeProfile')->name('supplier.first.store.profile');

        // change the password of the supplier
        Route::get('change-password','SupplierHomeController@changePassword')->name('supplier.change.password');
        Route::post('change-password','SupplierHomeController@storeChangePassword')->name('supplier.store.change.password');

        // route of the supplier profile
        Route::get('view-profile','SupplierProfileController@showProfile')->name('supplier.profile.view');
        Route::get('edit-profile','SupplierProfileController@editProfile')->name('supplier.profile.edit');
        Route::put('updateprofile','SupplierProfileController@updateProfile')->name('supplier.profile.update');

        // route of the supplier location data
        Route::get('location-list','SupplierLocationController@index')->name('supplier.location.index');
        Route::get('state-list/{id}','SupplierLocationController@getStates')->name('supplier.location.getstate');
        Route::get('city-list/{id}','SupplierLocationController@getCities')->name('supplier.location.getcity');
        Route::get('create-location','SupplierLocationController@create')->name('supplier.location.create');
        Route::post('location/store','SupplierLocationController@store')->name('supplier.location.store');
        Route::get('edit-location/{id}','SupplierLocationController@edit')->name('supplier.location.edit');
        Route::put('location/update/{id}','SupplierLocationController@update')->name('supplier.location.update');
        Route::delete('delete-location/{id}','SupplierLocationController@destroy')->name('supplier.location.delete');

        // route of the  supplier tickets
        Route::get('ticket/inbox','MessageTicketController@ticketInbox')->name('supplier.ticket.inbox');
        Route::get('ticket/inbox/detail/{id}','MessageTicketController@ticketInboxDetails')->name('supplier.ticket.index.detail');
        Route::post('ticket/inbox/reply','MessageTicketController@ticketReplyOnInboxMessage')->name('supplier.ticket.inbox.reply');
        Route::get('ticket/sent/list','MessageTicketController@sentTicketList')->name('supplier.ticket.sentlist');
        Route::get('ticket/sent/details/{id}','MessageTicketController@ticketSentDeatils')->name('supplier.ticket.sent.detail');
        Route::post('ticket/sent/reply','MessageTicketController@ticketReplyOnSentMessage')->name('supplier.ticket.sent.reply');
        Route::get('ticket/new','MessageTicketController@newTicket')->name('supplier.ticket.new');
        Route::post('ticket/new/store','MessageTicketController@storeTicket')->name('supplier.ticket.store');
        Route::get('ticket/change-status/{id}','MessageTicketController@changeTicketStatus')->name('supplier.ticket.change.status');
        Route::post('ticket/sent/delete','MessageTicketController@deleteSentTicket')->name('suppler.delete.sent.ticket');
        Route::post('ticket/index/delete','MessageTicketController@deleteInboxTicket')->name('supplier.delete.index.ticket');


        //route of the answer the questionnaire at the supplier module
        Route::get('questionnaire','SupplierQuestionnaireController@index')->name('supplier.quetionnaire.index');
        Route::post('answer','SupplierQuestionnaireController@submitAnswer')->name('supplier.questionnaire.answer');
        Route::post('create-folder','SupplierQuestionnaireController@createFolder')->name('supplier.create.folder');
        Route::get('questionnaire/{id}','SupplierQuestionnaireController@questionnaireDetails')->name('supplier.questionary.details');

        // create the folder and file by  client in supplier module
        Route::post('create-folder','SupplierQuestionnaireController@createFolder')->name('supplier.create.folder');
        Route::post('update-file','SupplierQuestionnaireController@uploadFile')->name('suppler.upload.file');
        Route::get('download-file/{id}/{name}','SupplierQuestionnaireController@downloadAllFile')->name('supplier.download.file');
        Route::get('single-file/{id}','SupplierQuestionnaireController@downloadSingleFile')->name('supplier.single.file');
        Route::get('delete-file/{id}','SupplierQuestionnaireController@deleteSingleFile')->name('supplier.delete.file');
        Route::post('rename-folder','SupplierQuestionnaireController@renameFolder')->name('supplier.rename.folder');
        Route::post('delete-folder','SupplierQuestionnaireController@deleteDirectory')->name('supplier.delete.folder');
    });




    /*************************************** Suppliers Routes End *************************************/

});
