<?php

/**
 *  
 *  Copyright (C) 2017
 *  
 *  File      : web.php
 *  Author    : Miłosz Nowak
 *  Copyright : (c) 2017 Dev4Born
 *  Link      : https://dev4born.pro
 *  Date      : 12/11/17
 *  
 */

Route::get('laravel/{secret}/logs', 'LogsController@logs');
Route::get('laravel/{secret}/logs/json', 'LogsController@json');
Route::get('laravel/logs/{filename}', 'LogsActionsController@download');
Route::get('laravel/logs/remove/{filename}', 'LogsActionsController@remove');

