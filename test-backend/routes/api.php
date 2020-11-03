<?php

Route::group(['namespace' => 'api'], function () {
    Route::apiResource('dono-propriedade', 'PropertyOwnerController');
    Route::apiResource('propriedades', 'PropertyController');
    Route::apiResource('contratos', 'ContractController');
});
