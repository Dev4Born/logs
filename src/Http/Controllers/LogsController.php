<?php

/**
 *  
 *  Copyright (C) 2017
 *  
 *  File      : LogsController.php
 *  Author    : Miłosz Nowak
 *  Copyright : (c) 2017 Dev4Born
 *  Link      : https://dev4born.pro
 *  Date      : 12/12/17
 *  
 */

namespace dev4born\logs\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

/**
 *  
 *  Class LogsController
 *  
 *  
 *  @package dev4born\logs
 *  
 */

class LogsController extends Controller
{
	/**
	 *  
	 *  @brief Extension of log files
	 *  
	 *  
	 *  @var string
	 *  
	 */
	
	private $enlargement = 'log';
	
	/**
	 *  
	 *  @brief Create a new controller instance
	 *  
	 *  
	 *  @return void
	 *  
	 */
	
	public function __construct()
	{
		$this->permissions = $this->permission();
		
		$this->middleware($this->permissions);
	}

	/**
	 *  
	 *  @brief Show all logs/events
	 *  
	 *  @param Request $request
	 *  
	 *  @return View
	 *  
	 */
	
	public function logs(Request $request)
	{
		$list = $this->files();
		
		if($this->files($request['file']) == true && preg_match('/'.$this->enlargement.'/', $request['file'])) {
		
		    $logs = file_get_contents(storage_path().'/logs/'.$request['file']);
		
		} elseif($this->files('laravel.'.$this->enlargement) == true) {
			
		    $logs = file_get_contents(storage_path().'/logs/laravel.'.$this->enlargement);
		
		} else {
			
		    $logs = false;	
			
		}

		return view('logs.views::logs', ['request' => $request, 
		                                 'logs'    => $logs,
		                                 'list'    => $list]);
		
	}

	/**
	 *  
	 *  @brief Download log file
	 *  
	 *  @param String $filename
	 *  
	 *  @return Response (download)
	 *  
	 */
	
	public function download(string $filename)
	{
		$files = storage_path().'/logs/'.$filename;
		
		return response()->download($files);
	}	
	
	/**
	 *  
	 *  @brief Deleting log file 
	 *  
	 *  @param String $filename
	 *  
	 *  @return Back 
	 *  
	 */
	
	public function remove(string $filename)
	{
	    $logs = storage_path('logs').'/'.$filename;	
		
		app('files')->delete($logs);
		
		return back();
	}
	
	/**
	 *  
	 *  @brief Verifying that everything functions properly
	 *  
	 *  
	 *  @return Response (JSON)
	 *  
	 */
	
	public function json()
	{
		if($this->files() != true) {
			
			$data = ['error' => 'Everything functions properly.'];
			
		} else {
		
		    $data = ['error' => 'Perhaps an error occurred - check the logs/events.'];
		  
		}
		
		return response()->json($data);
	}
	
	/**
	 *  
	 *  @brief List of files with logs
	 *  
	 *  
	 *  @return Array
	 *  
	 */
	
	private function files($basic = '*')
	{
        $files = glob(storage_path() . '/logs/'.$basic);
		
        return array_values($files);		
	}
	
	/**
	 *  
	 *  @brief Permissions/middleware
	 *  
	 *  
	 *  @return Array
	 *  
	 */
	
	private function permission()
	{
        $configs = config('logs.config'); 
		  
        $permissions = array();
		
		if(!$configs) {
		  
		    $configs = ['guest'];
		
		}
		
		foreach ($configs as $config) {
			
			array_push($permissions, $config);

		}	
		
		return $permissions;
	}	
}