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

Route::get('laravel/logs', 'LogsController@logs');
Route::get('laravel/logs/json', 'LogsController@json');
Route::get('laravel/logs/{filename}', 'LogsController@download');
Route::get('laravel/logs/remove/{filename}', 'LogsController@remove');

