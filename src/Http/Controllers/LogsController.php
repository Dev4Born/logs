<?php

/**
 *  
 *  Copyright (C) 2017
 *  
 *  File      : LogsController.php
 *  Author    : Miłosz Nowak
 *  Copyright : (c) 2017 Dev4Born
 *  Link      : https://dev4born.pro
 *  Date      : 12/14/17
 *  
 */
 
namespace dev4born\logs\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;
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
	 *  @param Request $request
	 *  @param Redirector $redirect
	 *  
	 *  @return void
	 *  
	 */
	
	public function __construct(Request $request, Redirector $redirect)
	{
		$this->routers = $request->route('secret');
		
		if($this->permission($this->routers) != true) {
			
			$redirect->to('/')->send();

        } elseif($this->routers == 'view') {
			
			$this->middleware($this->permission($this->routers));
			
		} elseif($this->permission($this->routers) != $this->routers) {
			
		    $redirect->to('/')->send();

        } 
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
	 *  @parm string $basic
	 *  
	 *  @return Array
	 *  
	 */
	
	private function files($basic = '*')
	{
        $files = glob(storage_path().'/logs/'.$basic);
		
        return array_values($files);		
	}
	
	/**
	 *  
	 *  @brief Permissions/middleware
	 *  
	 *  @parm string $secret
	 *   
	 *  @return Array
	 *  
	 */
	
	private function permission(string $secret)
	{
        $configs = config('logs.config'); 
		 
        $permissions = array();
		
		foreach ($configs as $config) {
			
			array_push($permissions, $config); 

		}
			
		if($permissions[0]['secret'] != $secret) {
			
			$parameter = $permissions[0]['middleware'];
				
		} else {
			
			$parameter = true;
		}
		
		return $parameter;
	}	
}