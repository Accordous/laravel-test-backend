<?php

Route::group(['namespace' => 'api'], function () {
    Route::get('propriedades-contratos/{id}', 'PropertyController@contract');
    Route::apiResource('propriedades', 'PropertyController');
    Route::apiResource('contratos', 'ContractController');
});
