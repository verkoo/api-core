<?php
Route::group([
    'middleware' => ['web'],
    'namespace' => '\Verkoo\Common\Http\Controllers'
], function () {
    Route::resource('users', 'UserController');
    Route::get('tpv', 'PagesController@tpv');
});

/** ONLY ADMIN */
Route::group([
    'middleware' => ['web', 'only-admin'],
    'namespace' => '\Verkoo\Common\Http\Controllers'
], function () {
    Route::get('/', 'PagesController@dashboard');

    /** A */
    Route::get('/annotations', 'PagesController@annotations');

    /** B */
    Route::get('/boxes/sessions', 'PagesController@sessions');
    Route::resource('boxes', 'BoxController');
    Route::resource('boxes/{box}/users', 'BoxUserController');
    Route::resource('brands', 'BrandsController');

    /** C */
    Route::get('calendar', 'PagesController@calendar');
    Route::resource('categories', 'CategoriesController');
    Route::get('/contacts', 'PagesController@contacts');
    Route::resource('customers', 'CustomersController');
    Route::resource('customers/{customer}/addresses', 'AddressesController');

    /** D */
    Route::get('documents/{type}/{id}', 'PdfDocumentController@index');
    Route::get('/default-delivery-notes', 'PagesController@defaultDelivery');
    Route::get('/delivery-notes', 'PagesController@delivery');

    /** E */
    Route::resource('expeditures', 'ExpedituresController');
    Route::get('/expediture-delivery-notes', 'PagesController@expeditureDelivery');
    Route::resource('expediture-types', 'ExpeditureTypesController');

    /** I */
    Route::get('/invoices', 'PagesController@invoices');

    /** O */
    Route::resource('options', 'OptionsController');
    Route::get('orders', 'PagesController@orders');

    /** P */
    Route::resource('payments', 'PaymentController');

    /** Q */
    Route::get('/quotes', 'PagesController@quotes');

    /** R */
    Route::post('reports/cash-pending', 'ReportsController@cashPending');
    Route::get('reports/orders', 'ReportOrdersController@index');
    Route::post('reports/orders', 'ReportOrdersController@store');
    Route::get('reports/products', 'ReportsController@products');

    /** S */
    Route::get('/statistics/suppliers', 'StatisticsController@suppliers');
    Route::get('/statistics/customers', 'StatisticsController@customers');
    Route::get('/statistics/products', 'StatisticsController@products');
    Route::resource('suppliers', 'SuppliersController');

    /** T */
    Route::resource('taxes', 'TaxesController');

    /** U */
    Route::resource('units-of-measure', 'UnitsOfMeasureController');
});

/***** API ********/
Route::group([
    'middleware' => ['api', 'auth:api'],
    'prefix' => 'api',
    'namespace' => '\Verkoo\Common\Http\Controllers\Api'
], function () {
    /** B */
    Route::resource('boxes', 'BoxController');

    /** C */
    Route::get('calendar', 'CalendarController@index');
    Route::post('calendar', 'CalendarController@store');
    Route::post('cash-recipe', 'CashRecipeController@store');
    Route::resource('categories', 'CategoriesController');
    Route::resource('contacts', 'ContactsController');
    Route::resource('customers', 'CustomerController');
    Route::resource('customers/{customer}/delivery-notes', 'CustomerDeliveryNotesController');

    /** O */
    Route::post('open-drawer', 'OpenDrawer');

    /** P */
    Route::resource('payments', 'PaymentController');

    /** S */
    Route::get('settings', 'SettingsController@index');
    Route::patch('settings', 'SettingsController@update');
    Route::get('statistics/delivery-notes/total', 'DeliveryNotesStatisticsController@totalDeliveryNotes');
    Route::get('statistics/delivery-notes/pending', 'DeliveryNotesStatisticsController@pendingDeliveryNotes');
    Route::get('statistics/delivery-notes/best-selling-products', 'DeliveryNotesStatisticsController@bestSellingProducts');
    Route::get('statistics/delivery-notes/best-customers', 'DeliveryNotesStatisticsController@bestCustomers');
    Route::get('statistics/expediture-delivery-notes/suppliers', 'ExpeditureDeliveryNotesStatisticsController@suppliers');
    Route::resource('suppliers', 'SuppliersController');

    /** U */
    Route::get('users', 'UsersController@index');
});

