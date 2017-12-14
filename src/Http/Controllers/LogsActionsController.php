<?php

/**
 *  
 *  Copyright (C) 2017
 *  
 *  File      : LogsActionsController.php
 *  Author    : Miłosz Nowak
 *  Copyright : (c) 2017 Dev4Born
 *  Link      : https://dev4born.pro
 *  Date      : 12/14/17
 *  
 */
 
namespace dev4born\logs\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

/**
 *  
 *  Class LogsActionsController
 *  
 *  
 *  @package dev4born\logs
 *  
 */
 
class LogsActionsController extends Controller
{
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
		$this->hash = sha1(date('Y-m-d H:i'));
	}
	
	/**
	 *  
	 *  @brief Download log file
	 *  
	 *  @param string $filename
	 *  
	 *  @return Response (download)
	 *  
	 */
	
	public function download(string $filename)
	{
		if($this->token($filename)[0] != $this->hash) {
			
            return back();		
		
		}
		
		$files = storage_path().'/logs/'.$this->token($filename)[1];
		
		return response()->download($files);
	}	
	
	/**
	 *  
	 *  @brief Deleting log file 
	 *  
	 *  @param string $filename
	 *  
	 *  @return Back 
	 *  
	 */
	
	public function remove(string $filename)
	{
		if($this->token($filename)[0] != $this->hash) {
			
            return back();		
		
		}
		
	    $logs = storage_path('logs').'/'.$this->token($filename)[1];	
		
		app('files')->delete($logs);
		
		return back();
	}
	
	/**
	 *  
	 *  @brief Verification of correctness token
	 *  
	 *  @param string $filename
	 *  
	 *  @return $verification
	 *  
	 */
	
	private function token(string $filename) 
	{
		$verification = explode('_', $filename);
		
		return $verification;
	}
}