<?php

$hostname = app(Hyn\Tenancy\Contracts\CurrentHostname::class);

if ($hostname) {
    Route::domain($hostname->fqdn)->group(function () {

        Auth::routes([
            'register' => false,
            'reset' => false,
            'verify' => false
        ]);

        Route::get('search', 'Tenant\SearchController@index')->name('search.index');
        Route::get('buscar', 'Tenant\SearchController@index')->name('search.index');
        Route::get('search/tables', 'Tenant\SearchController@tables');


        Route::get('downloads/{model}/{type}/{external_id}/{format?}', 'Tenant\DownloadController@downloadExternal')->name('tenant.download.external_id');
        Route::get('print/{model}/{external_id}/{format?}', 'Tenant\DownloadController@toPrint');
        Route::get('/exchange_rate/ecommence/{date}', 'Tenant\Api\ServiceController@exchangeRateTest');


        Route::middleware(['auth', 'redirect.module', 'locked.tenant'])->group(function () {
            Route::get('catalogs', 'Tenant\CatalogController@index')->name('tenant.catalogs.index');
            Route::get('advanced', 'Tenant\AdvancedController@index')->name('tenant.advanced.index');
            Route::get('tasks', 'Tenant\TaskController@index')->name('tenant.tasks.index');
            Route::post('tasks/commands', 'Tenant\TaskController@listsCommand');
            Route::post('tasks/tables', 'Tenant\TaskController@tables');
            Route::post('tasks', 'Tenant\TaskController@store');
            Route::delete('tasks/{task}', 'Tenant\TaskController@destroy');
            //Company
            Route::get('companies/create', 'Tenant\CompanyController@create')->name('tenant.companies.create');
            Route::get('companies/tables', 'Tenant\CompanyController@tables');
            Route::get('companies/record', 'Tenant\CompanyController@record');
            Route::post('companies', 'Tenant\CompanyController@store');
            Route::post('companies/uploads', 'Tenant\CompanyController@uploadFile');

            //Card Brands
            Route::get('card_brands/records', 'Tenant\CardBrandController@records');
            Route::get('card_brands/record/{card_brand}', 'Tenant\CardBrandController@record');
            Route::post('card_brands', 'Tenant\CardBrandController@store');
            Route::delete('card_brands/{card_brand}', 'Tenant\CardBrandController@destroy');

            //Configurations
            Route::get('configurations/addSeeder', 'Tenant\ConfigurationController@addSeeder');
            Route::get('configurations/preprinted/addSeeder', 'Tenant\ConfigurationController@addPreprintedSeeder');
            Route::get('configurations/getFormats', 'Tenant\ConfigurationController@getFormats');
            Route::get('configurations/preprinted/getFormats', 'Tenant\ConfigurationController@getPreprintedFormats');
            Route::get('configurations/create', 'Tenant\ConfigurationController@create')->name('tenant.configurations.create');
            Route::get('configurations/record', 'Tenant\ConfigurationController@record');
            Route::post('configurations', 'Tenant\ConfigurationController@store');
            Route::post('configurations/icbper', 'Tenant\ConfigurationController@icbper');
            Route::post('configurations/changeFormat', 'Tenant\ConfigurationController@changeFormat');
            Route::get('configurations/tables', 'Tenant\ConfigurationController@tables');
            Route::get('configurations/visual_defaults', 'Tenant\ConfigurationController@visualDefaults')->name('visual_defaults');
            Route::post('configurations/visual_settings', 'Tenant\ConfigurationController@visualSettings')->name('visual-settings');
            Route::get('configurations/pdf_templates', 'Tenant\ConfigurationController@pdfTemplates')->name('tenant.advanced.pdf_templates');
            Route::get('configurations/pdf_guide_templates', 'Tenant\ConfigurationController@pdfGuideTemplates')->name('tenant.advanced.pdf_guide_templates');
            Route::get('configurations/pdf_preprinted_templates', 'Tenant\ConfigurationController@pdfPreprintedTemplates')->name('tenant.advanced.pdf_preprinted_templates');
            Route::post('configurations/uploads', 'Tenant\ConfigurationController@uploadFile');
            Route::post('configurations/preprinted/generateDispatch', 'Tenant\ConfigurationController@generateDispatch');
            Route::get('configurations/preprinted/{template}', 'Tenant\ConfigurationController@show');

            //Configuration mail servers
            Route::get('configuration_mail_servers', 'Tenant\ConfigurationMailServerController@index')->name('tenant.configuration_mail_servers.index');
            Route::get('configuration_mail_servers/create', 'Tenant\ConfigurationMailServerController@create');
            Route::get('configuration_mail_servers/record/{id}', 'Tenant\ConfigurationMailServerController@record');
            Route::post('configuration_mail_servers', 'Tenant\ConfigurationMailServerController@store');
            Route::get('configuration_mail_servers/records', 'Tenant\ConfigurationMailServerController@records');
            Route::get('configuration_mail_servers/columns', 'Tenant\ConfigurationMailServerController@columns');
            Route::delete('configuration_mail_servers/{id}', 'Tenant\ConfigurationMailServerController@destroy');

            //Configuration mail servers
            Route::get('terms_conditions', 'Tenant\TermsConditionsController@index')->name('tenant.terms_conditions.index');
            Route::get('terms_conditions/show', 'Tenant\TermsConditionsController@show');
            Route::post('terms_conditions/write', 'Tenant\TermsConditionsController@write');
            Route::post('configurations/uploads', 'Tenant\ConfigurationController@uploadFile');

            ///banners
            Route::get('banners', 'Tenant\BannerController@index')->name('tenant.banners.index');
            Route::get('banners/records', 'Tenant\BannerController@records');
            Route::post('banners', 'Tenant\BannerController@store');
            Route::get('banners/columns', 'Tenant\BannerController@columns');
            Route::post('banners/uploads', 'Tenant\BannerController@upload');

            //discards
            Route::get('discards', 'Tenant\DiscardController@index')->name('tenant.discards.index');
            Route::get('discards/tables', 'Tenant\DiscardController@tables');
            Route::get('discards/records', 'Tenant\DiscardController@records');
            Route::post('discards', 'Tenant\DiscardController@store');

            //Certificates
            Route::get('certificates/record', 'Tenant\CertificateController@record');
            Route::post('certificates/uploads', 'Tenant\CertificateController@uploadFile');
            Route::delete('certificates', 'Tenant\CertificateController@destroy');

            //Establishments
            Route::get('establishments', 'Tenant\EstablishmentController@index')->name('tenant.establishments.index');
            Route::get('establishments/create', 'Tenant\EstablishmentController@create');
            Route::get('establishments/tables', 'Tenant\EstablishmentController@tables');
            Route::get('establishments/record/{establishment}', 'Tenant\EstablishmentController@record');
            Route::post('establishments', 'Tenant\EstablishmentController@store');
            Route::get('establishments/records', 'Tenant\EstablishmentController@records');
            Route::delete('establishments/{establishment}', 'Tenant\EstablishmentController@destroy');

            //Bank account types
            Route::get('bank_account_types/records', 'Tenant\BankAccountTypeController@records');
            Route::get('bank_account_types/record/{code}', 'Tenant\BankAccountTypeController@record');
            Route::post('bank_account_types', 'Tenant\BankAccountTypeController@store');
            Route::delete('bank_account_types/{code}', 'Tenant\BankAccountTypeController@destroy');

            //Bank account types
            Route::get('countries/records', 'Tenant\CountryController@records');
            Route::get('countries/record/{code}', 'Tenant\CountryController@record');
            Route::post('countries', 'Tenant\CountryController@store');
            Route::delete('countries/{code}', 'Tenant\CountryController@destroy');

            //Bank Accounts
            Route::get('bank_accounts', 'Tenant\BankAccountController@index')->name('tenant.bank_accounts.index');
            Route::get('bank_accounts/records', 'Tenant\BankAccountController@records');
            Route::get('bank_accounts/create', 'Tenant\BankAccountController@create');
            Route::get('bank_accounts/tables', 'Tenant\BankAccountController@tables');
            Route::get('bank_accounts/record/{bank_account}', 'Tenant\BankAccountController@record');
            Route::post('bank_accounts', 'Tenant\BankAccountController@store');
            Route::delete('bank_accounts/{bank_account}', 'Tenant\BankAccountController@destroy');

            //Series
            Route::get('series/records/{establishment}', 'Tenant\SeriesController@records');
            Route::get('series/create', 'Tenant\SeriesController@create');
            Route::get('series/tables', 'Tenant\SeriesController@tables');
            Route::post('series', 'Tenant\SeriesController@store');
            Route::delete('series/{series}', 'Tenant\SeriesController@destroy');

            //Users
            Route::get('users', 'Tenant\UserController@index')->name('tenant.users.index');
            Route::get('users/create', 'Tenant\UserController@create')->name('tenant.users.create');
            Route::get('users/data_table', 'Tenant\UserController@data_table');
            Route::get('users/tables', 'Tenant\UserController@tables');
            Route::get('users/record/{user}', 'Tenant\UserController@record');
            Route::post('users', 'Tenant\UserController@store');
            Route::get('users/records', 'Tenant\UserController@records');
            Route::delete('users/{user}', 'Tenant\UserController@destroy');
            Route::get('users/send_confirmation/{id}', 'Tenant\UserController@send_confirmation');

            //Person Ussers
            Route::get('person-users/tables', 'Tenant\PersonUserController@tables');
            Route::get('person-users/records/{personId}', 'Tenant\PersonUserController@records');
            Route::post('person-users', 'Tenant\PersonUserController@store');
            Route::delete('person-users/{id}', 'Tenant\PersonUserController@destroy');

            //Items Ecommerce
            Route::get('items_ecommerce', 'Tenant\ItemController@index_ecommerce')->name('tenant.items_ecommerce.index');

            //Items
            Route::get('items', 'Tenant\ItemController@index')->name('tenant.items.index')->middleware('redirect.level');
            Route::get('items/columns', 'Tenant\ItemController@columns');
            Route::get('items/records', 'Tenant\ItemController@records');
            Route::get('items/tables', 'Tenant\ItemController@tables');
            Route::get('items/record/{item}', 'Tenant\ItemController@record');
            Route::post('items', 'Tenant\ItemController@store');
            Route::delete('items/{item}', 'Tenant\ItemController@destroy');
            Route::delete('items/item-unit-type/{item}', 'Tenant\ItemController@destroyItemUnitType');
            Route::post('items/import', 'Tenant\ItemController@import');
            Route::post('items/upload', 'Tenant\ItemController@upload');
            Route::post('items/visible_store', 'Tenant\ItemController@visibleStore');
            Route::post('items/duplicate', 'Tenant\ItemController@duplicate');
            Route::get('items/disable/{item}', 'Tenant\ItemController@disable');
            Route::get('items/enable/{item}', 'Tenant\ItemController@enable');
            Route::get('items/images/{item}', 'Tenant\ItemController@images');
            Route::get('items/images/delete/{id}', 'Tenant\ItemController@delete_images');
            Route::get('items/export', 'Tenant\ItemController@export')->name('tenant.items.export');
            Route::get('items/export/wp', 'Tenant\ItemController@exportWp')->name('tenant.items.export.wp');
            Route::get('items/export/barcode', 'Tenant\ItemController@exportBarCode')->name('tenant.items.export.barcode');
            Route::get('items/export/barcode/print', 'Tenant\ItemController@printBarCode')->name('tenant.items.export.barcode.print');
            Route::get('items/export/barcode/last', 'Tenant\ItemController@itemLast')->name('tenant.items.last');

            //Persons
            Route::get('persons/columns', 'Tenant\PersonController@columns');
            Route::get('persons/tables', 'Tenant\PersonController@tables');
            Route::get('persons/{type}', 'Tenant\PersonController@index')->name('tenant.persons.index');
            Route::get('persons/{type}/records', 'Tenant\PersonController@records');
            Route::get('persons/record/{person}', 'Tenant\PersonController@record');
            Route::post('persons', 'Tenant\PersonController@store');
            Route::delete('persons/{person}', 'Tenant\PersonController@destroy');
            Route::post('persons/import', 'Tenant\PersonController@import');
            Route::get('persons/enabled/{type}/{person}', 'Tenant\PersonController@enabled');
            Route::get('persons/send_invitation/{id}', 'Tenant\PersonController@send_invitation_portal');
            Route::get('persons/customers/exportation', 'Tenant\PersonController@export')->name('tenant.persons.export');
            Route::get('persons/{type}/exportation', 'Tenant\PersonController@export')->name('tenant.persons.export');




            Route::post('options/delete_documents', 'T@deleteDocuments');
            Route::get('services/ruc/{number}', 'Tenant\Api\ServiceController@ruc');
            Route::get('services/dni/{number}', 'Tenant\Api\ServiceController@dni');
            Route::post('services/exchange_rate', 'Tenant\Api\ServiceController@exchange_rate');
            Route::post('services/search_exchange_rate', 'Tenant\Api\ServiceController@searchExchangeRateByDate');
            Route::get('services/exchange_rate/{date}', 'Tenant\Api\ServiceController@exchangeRateTest');

            //Codes
            Route::get('codes/records', 'Tenant\Catalogs\CodeController@records');
            Route::get('codes/tables', 'Tenant\Catalogs\CodeController@tables');
            Route::get('codes/record/{code}', 'Tenant\Catalogs\CodeController@record');
            Route::post('codes', 'Tenant\Catalogs\CodeController@store');
            Route::delete('codes/{code}', 'Tenant\Catalogs\CodeController@destroy');

            //Units
            Route::get('unit_types/records', 'Tenant\UnitTypeController@records');
            Route::get('unit_types/record/{code}', 'Tenant\UnitTypeController@record');
            Route::post('unit_types', 'Tenant\UnitTypeController@store');
            Route::delete('unit_types/{code}', 'Tenant\UnitTypeController@destroy');

            //Detractions
            Route::get('detraction_types/records', 'Tenant\DetractionTypeController@records');
            Route::get('detraction_types/tables', 'Tenant\DetractionTypeController@tables');
            Route::get('detraction_types/record/{code}', 'Tenant\DetractionTypeController@record');
            Route::post('detraction_types', 'Tenant\DetractionTypeController@store');
            Route::delete('detraction_types/{code}', 'Tenant\DetractionTypeController@destroy');

            //Banks
            Route::get('banks/records', 'Tenant\BankController@records');
            Route::get('banks/record/{bank}', 'Tenant\BankController@record');
            Route::post('banks', 'Tenant\BankController@store');
            Route::delete('banks/{bank}', 'Tenant\BankController@destroy');

            //Exchange Rates
            Route::get('exchange_rates/records', 'Tenant\ExchangeRateController@records');
            Route::post('exchange_rates', 'Tenant\ExchangeRateController@store');

            //Currency Types
            Route::get('currency_types/records', 'Tenant\CurrencyTypeController@records');
            Route::get('currency_types/record/{currency_type}', 'Tenant\CurrencyTypeController@record');
            Route::post('currency_types', 'Tenant\CurrencyTypeController@store');
            Route::delete('currency_types/{currency_type}', 'Tenant\CurrencyTypeController@destroy');
            //Tribute Concept Type
            Route::get('tribute_concept_types/records', 'Tenant\TributeConceptTypeController@records');
            Route::get('tribute_concept_types/record/{id}', 'Tenant\TributeConceptTypeController@record');
            Route::post('tribute_concept_types', 'Tenant\TributeConceptTypeController@store');
            Route::delete('tribute_concept_types/{id}', 'Tenant\TributeConceptTypeController@destroy');

            //Tags
            Route::get('tags', 'Tenant\TagController@index')->name('tenant.tags.index');
            Route::get('tags/columns', 'Tenant\TagController@columns');
            Route::get('tags/records', 'Tenant\TagController@records');
            Route::get('tags/record/{tag}', 'Tenant\TagController@record');
            Route::post('tags', 'Tenant\TagController@store');
            Route::delete('tags/{tag}', 'Tenant\TagController@destroy');

            //Promotion
            Route::get('promotions', 'Tenant\PromotionController@index')->name('tenant.promotion.index');
            Route::get('promotions/columns', 'Tenant\PromotionController@columns');
            Route::get('promotions/tables', 'Tenant\PromotionController@tables');
            Route::get('promotions/records', 'Tenant\PromotionController@records');
            Route::get('promotions/record/{tag}', 'Tenant\PromotionController@record');
            Route::post('promotions', 'Tenant\PromotionController@store');
            Route::delete('promotions/{promotion}', 'Tenant\PromotionController@destroy');
            Route::post('promotions/upload', 'Tenant\PromotionController@upload');


            Route::get('item-sets', 'Tenant\ItemSetController@index')->name('tenant.item_sets.index');
            Route::get('item-sets/columns', 'Tenant\ItemSetController@columns');
            Route::get('item-sets/records', 'Tenant\ItemSetController@records');
            Route::get('item-sets/tables', 'Tenant\ItemSetController@tables');
            Route::get('item-sets/record/{item}', 'Tenant\ItemSetController@record');
            Route::post('item-sets', 'Tenant\ItemSetController@store');
            Route::delete('item-sets/{item}', 'Tenant\ItemSetController@destroy');
            Route::delete('item-sets/item-unit-type/{item}', 'Tenant\ItemSetController@destroyItemUnitType');
            Route::post('item-sets/import', 'Tenant\ItemSetController@import');
            Route::post('item-sets/upload', 'Tenant\ItemSetController@upload');
            Route::post('item-sets/visible_store', 'Tenant\ItemSetController@visibleStore');
            Route::get('item-sets/item/tables', 'Tenant\ItemSetController@item_tables');

            Route::get('person-types/columns', 'Tenant\PersonTypeController@columns');
            Route::get('person-types', 'Tenant\PersonTypeController@index')->name('tenant.person_types.index');
            Route::get('person-types/records', 'Tenant\PersonTypeController@records');
            Route::get('person-types/record/{person}', 'Tenant\PersonTypeController@record');
            Route::post('person-types', 'Tenant\PersonTypeController@store');
            Route::delete('person-types/{person}', 'Tenant\PersonTypeController@destroy');

            //Cuenta
            Route::get('cuenta/payment_index', 'Tenant\AccountController@paymentIndex')->name('tenant.payment.index');
            Route::get('cuenta/configuration', 'Tenant\AccountController@index')->name('tenant.configuration.index');
            Route::get('cuenta/payment_records', 'Tenant\AccountController@paymentRecords');
            Route::get('cuenta/tables', 'Tenant\AccountController@tables');
            Route::post('cuenta/update_plan', 'Tenant\AccountController@updatePlan');
            Route::post('cuenta/payment_culqui', 'Tenant\AccountController@paymentCulqui')->name('tenant.account.payment_culqui');

            //Payment Methods
            Route::get('payment_method/records', 'Tenant\Catalogs\PaymentMethodTypeController@records');
            Route::get('payment_method/record/{code}', 'Tenant\Catalogs\PaymentMethodTypeController@record');
            Route::post('payment_method', 'Tenant\Catalogs\PaymentMethodTypeController@store');
            Route::delete('payment_method/{code}', 'Tenant\Catalogs\PaymentMethodTypeController@destroy');

            //formats PDF
            Route::get('templates', 'Tenant\FormatTemplateController@records');
            //Expense method types
            Route::prefix('expense-method-types')->group(function () {
                Route::get('/records', 'Tenant\ExpenseMethodTypeController@records');
                Route::get('/record/{id}', 'Tenant\ExpenseMethodTypeController@record');
                Route::post('', 'Tenant\ExpenseMethodTypeController@store');
                Route::delete('/{id}', 'Tenant\ExpenseMethodTypeController@destroy');
            });
            //Payment method types
            Route::prefix('payment-method-types')->group(function () {
                Route::get('/records', 'Tenant\PaymentMethodTypeController@records');
                Route::get('/record/{id}', 'Tenant\PaymentMethodTypeController@record');
                Route::post('', 'Tenant\PaymentMethodTypeController@store');
                Route::delete('/{id}', 'Tenant\PaymentMethodTypeController@destroy');
            });
            // Payment method types
            Route::get('payment_method_types_general/record/{id}', 'Tenant\PaymentMethodTypeGeneralController@record');
            Route::post('payment_method_types_general', 'Tenant\PaymentMethodTypeGeneralController@store');
            Route::get('payment_method_types_general/{type}/records', 'Tenant\PaymentMethodTypeGeneralController@records');
            Route::get('payment_method_types_general/columns', 'Tenant\PaymentMethodTypeGeneralController@columns');
            Route::delete('payment_method_types_general/{id}', 'Tenant\PaymentMethodTypeGeneralController@destroy');
            Route::get('payment_method_types_general/{type}', 'Tenant\PaymentMethodTypeGeneralController@index')->name('tenant.payment_method_types_general.index');
        });
    });
} else {
    Route::domain(env('APP_URL_BASE'))->group(function () {

        Route::get('login', 'System\LoginController@showLoginForm')->name('login');
        Route::post('login', 'System\LoginController@login');
        Route::post('logout', 'System\LoginController@logout')->name('logout');
        Route::get('phone', 'System\UserController@getPhone');

        Route::middleware('auth:admin')->group(function () {
            Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
            Route::get('/', function () {
                return redirect()->route('system.dashboard');
            });
            Route::get('dashboard', 'System\HomeController@index')->name('system.dashboard');

            //Clients
            Route::get('clients', 'System\ClientController@index')->name('system.clients.index');
            Route::get('clients/records', 'System\ClientController@records');
            Route::get('clients/record/{client}', 'System\ClientController@record');

            Route::get('clients/create', 'System\ClientController@create');
            Route::get('clients/tables', 'System\ClientController@tables');
            Route::get('clients/charts', 'System\ClientController@charts');
            Route::post('clients', 'System\ClientController@store');
            Route::post('clients/update', 'System\ClientController@update');

            Route::delete('clients/{client}', 'System\ClientController@destroy');
            Route::post('clients/password/{client}', 'System\ClientController@password');
            Route::post('clients/locked_emission', 'System\ClientController@lockedEmission');
            Route::post('clients/locked_tenant', 'System\ClientController@lockedTenant');
            Route::post('clients/locked_user', 'System\ClientController@lockedUser');
            Route::post('clients/renew_plan', 'System\ClientController@renewPlan');


            Route::post('clients/set_billing_cycle', 'System\ClientController@startBillingCycle');

            Route::post('clients/locked_tenant', 'System\ClientController@lockedTenant');

            Route::post('clients/upload', 'System\ClientController@upload');

            Route::get('client_payments/records/{client_id}', 'System\ClientPaymentController@records');
            Route::get('client_payments/client/{client_id}', 'System\ClientPaymentController@client');
            Route::get('client_payments/tables', 'System\ClientPaymentController@tables');
            Route::post('client_payments', 'System\ClientPaymentController@store');
            Route::delete('client_payments/{client_payment}', 'System\ClientPaymentController@destroy');
            Route::get('client_payments/cancel_payment/{client_payment_id}', 'System\ClientPaymentController@cancel_payment');

            Route::get('client_account_status/records/{client_id}', 'System\AccountStatusController@records');
            Route::get('client_account_status/client/{client_id}', 'System\AccountStatusController@client');
            Route::get('client_account_status/tables', 'System\AccountStatusController@tables');

            //Planes
            Route::get('plans', 'System\PlanController@index')->name('system.plans.index');
            Route::get('plans/records', 'System\PlanController@records');
            Route::get('plans/tables', 'System\PlanController@tables');
            Route::get('plans/record/{plan}', 'System\PlanController@record');
            Route::post('plans', 'System\PlanController@store');
            Route::delete('plans/{plan}', 'System\PlanController@destroy');

            //Users
            Route::get('users/create', 'System\UserController@create')->name('system.users.create');
            Route::get('users/record', 'System\UserController@record');
            Route::post('users', 'System\UserController@store');

            Route::get('services/ruc/{number}', 'System\ServiceController@ruc');

            Route::get('certificates/record', 'System\CertificateController@record');
            Route::post('certificates/uploads', 'System\CertificateController@uploadFile');
            Route::post('certificates/saveSoapUser', 'System\CertificateController@saveSoapUser');
            Route::delete('certificates', 'System\CertificateController@destroy');
            Route::get('configurations', 'System\ConfigurationController@index')->name('system.configuration.index');

            Route::get('companies/record', 'System\CompanyController@record');
            Route::post('companies', 'System\CompanyController@store');

            // auto-update
            Route::get('auto-update', 'System\UpdateController@index')->name('system.update');
            Route::get('auto-update/branch', 'System\UpdateController@branch')->name('system.update.branch');
            Route::get('auto-update/pull/{branch}', 'System\UpdateController@pull')->name('system.update.pull');

            Route::get('auto-update/artisan/migrate', 'System\UpdateController@artisanMigrate')->name('system.update.artisan.migrate');
            Route::get('auto-update/artisan/migrate/tenant', 'System\UpdateController@artisanTenancyMigrate')->name('system.update.artisan.tenancy.migrate');
            Route::get('auto-update/artisan/clear', 'System\UpdateController@artisanClear')->name('system.update.artisan.clear');

            Route::get('auto-update/composer/install', 'System\UpdateController@composerInstall')->name('system.update.composer.install');

            Route::get('auto-update/keygen', 'System\UpdateController@keygen')->name('system.update.keygen');

            Route::get('auto-update/version', 'System\UpdateController@version')->name('system.update.version');

            //Configuration

            Route::post('configurations', 'System\ConfigurationController@store');
            Route::get('configurations/record', 'System\ConfigurationController@record');
            Route::get('configurations/apiruc', 'System\ConfigurationController@apiruc');

            // backup
            Route::get('backup', 'System\BackupController@index')->name('system.backup');
            Route::get('backup/db', 'System\BackupController@db')->name('system.backup.db');
            Route::get('backup/files', 'System\BackupController@files')->name('system.backup.files');
            Route::post('backup/upload', 'System\BackupController@upload')->name('system.backup.upload');

            Route::get('backup/last-backup', 'System\BackupController@mostRecent');
            Route::get('backup/download/{filename}', 'System\BackupController@download');
        });
    });
}
