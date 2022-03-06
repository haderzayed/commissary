<?php

use App\Models\Governorate;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Admin' ],function (){
    //Route::resource('users', 'UsersController')->except(['show', 'update', 'destroy']);
//    Route::group(['middleware'=>'can:all_permissions' ],function () {

//        Route::get('users', 'UsersController@index')->name('users.index');
//        Route::get('create', 'UsersController@create')->name('users.create');
//        Route::post('store', 'UsersController@store')->name('users.store');
//        Route::get('edit/{id}', 'UsersController@edit')->name('users.edit');
//    Route::group([ 'prefix'=>'role'],function (){
//
//        Route::resource('role', 'RolesController');
//        Route::post('role/{id}/update', 'RolesController@update')->name('role.update');
//        Route::post('role/{id}/destroy', 'RolesController@destroy')->name('role.delete');
//    });


//        Route::post('users/update/{id}', 'UsersController@update')->name('users.update');
//        Route::get('users/delete/{id}', 'UsersController@destroy')->name('users.delete');
//        Route::get('users/view/{id}', 'UsersController@view')->name('users.view');


//    div.divGaver
//    });
    /*-------------------------------representative-------*/
//    Route::group(['middleware'=>'can:managment_Representative' ],function () {

//        Route::prefix('representative')->group(function () {
//            Route::get('/', 'RepresentativeController@index')->name('Representative.index');
//            Route::get('create', 'RepresentativeController@create')->name('Representative.create');
//            Route::post('store', 'RepresentativeController@store')->name('Representative.store');
//            Route::get('edit/{id}', 'RepresentativeController@edit')->name('Representative.edit');
//            Route::post('update/{id}', 'RepresentativeController@update')->name('Representative.update');
//            Route::get('delete/{id}', 'RepresentativeController@destroy')->name('Representative.delete');
//            Route::get('view/{id}', 'RepresentativeController@view')->name('Representative.view');
//            Route::get('/divGaver/{id}', 'RepresentativeController@getcityGaver')->name('divGaver');
//        });
//    });
    /*--------------------------------------*/
//    Route::group(['middleware'=>'can:managment_activesstore' ],function () {

//        Route::resource('fieldstore', 'CorporateFieldsController')->except(['show', 'update', 'delete']);
//        Route::post('fieldstore/{id}/update', 'CorporateFieldsController@update')->name('fieldstore.update');
//        Route::get('fieldstore/delete/{id}', 'CorporateFieldsController@destroy')->name('fieldstore.delete');
//
//    });
/*--------------------------------------*/
//    Route::group(['middleware'=>'can:managment_contractingreason' ],function () {

//        Route::resource('reasoncontract', 'ReasonsNoContractController')->except(['show', 'update', 'delete']);
//        Route::post('reasoncontract/{id}/update', 'ReasonsNoContractController@update')->name('reasoncontract.update');
//        Route::get('reasoncontract/delete/{id}', 'ReasonsNoContractController@destroy')->name('reasoncontract.delete');
////    });
    /*----------------------------*/
//    Route::group(['middleware'=>'can:managment_store' ],function () {

//        Route::resource('storedata', 'StoreDataController')->except(['show', 'update', 'delete']);
//        Route::post('storedata/{id}/update', 'StoreDataController@update')->name('storedata.update');
//        Route::get('storedata/delete/{id}', 'StoreDataController@destroy')->name('storedata.delete');
//    }); Route::group(['middleware'=>'can:managment_store' ],function () {

//      //  Route::resource('Allcities', 'CityController')->except(['show', 'update', 'delete']);
//        Route::post('allcities/{id}/update', 'CityController@update')->name('allcities.update');
//        Route::get('allcities/delete/{id}', 'CityController@destroy')->name('allcities.delete');
////    });
//
//}); Route::group(['middleware'=>'can:managment_store' ],function () {

//        Route::resource('AllCountry', 'CountryController')->except(['show', 'update', 'delete']);
//        Route::post('AllCountry/{id}/update', 'CountryController@update')->name('AllCountry.update');
//        Route::get('AllCountry/delete/{id}', 'CountryController@destroy')->name('AllCountry.delete');
////    });
//}); Route::group(['middleware'=>'can:managment_store' ],function () {

//        Route::resource('AllTerritory', 'TerritoryController')->except(['show', 'update', 'delete']);
//        Route::post('AllTerritory/{id}/update', 'TerritoryController@update')->name('AllTerritory.update');
//        Route::get('AllTerritory/delete/{id}', 'TerritoryController@destroy')->name('AllTerritory.delete');
//        //    });
//});
// Route::group(['middleware'=>'can:managment_store' ],function () {

//        Route::resource('AllGovernorate', 'GovernorateController')->except(['show', 'update', 'delete']);
//        Route::post('AllGovernorate/{id}/update', 'GovernorateController@update')->name('AllGovernorate.update');
//        Route::get('AllGovernorate/delete/{id}', 'GovernorateController@destroy')->name('AllGovernorate.delete');
//        Route::get('AllGovernorate/divGaver/{id}', 'GovernorateController@getcityGaver')->name('divGaver');

        //    });
    //// Route::group(['middleware'=>'can:managment_store' ],function () {

        //Route::resource('Allcity', 'CityController')->except(['show', 'update', 'delete']);
       // Route::post('Allcity/{id}/update', 'CityController@update')->name('Allcity.update');
       // Route::get('Allcity/delete/{id}', 'CityController@destroy')->name('Allcity.delete');

    Route::resource('roles', 'RolesController' );
    Route::resource('users', 'UsersController' );
    Route::resource('city', 'CityController');
    Route::resource('country', 'CountryController');
    Route::resource('government', 'GovernorateController');
    Route::resource('neighborhood','NeighborhoodController');
    Route::resource('territory', 'TerritoryController');
    Route::resource('representative', 'RepresentativeController');
    Route::resource('store', 'StoreDataController');
    Route::resource('contract', 'ReasonsNoContractController');
    Route::resource('fields', 'CorporateFieldsController');


    Route::get('/getTerritory/{id}','CityController@getTerritory');
    Route::get('/getGovernment/{id}','CityController@getGovernment');
    Route::get('/get-city/{id}','CityController@getCity');
    Route::get('/get-neighborhood/{id}','CityController@getNeighborhood');
    Route::get('representative/divGaver/{id}', 'RepresentativeController@getcityGaver')->name('divGaver');
    Route::get('users/divGaver/{id}', 'UsersController@getcityGaver')->name('divGaver');


});

