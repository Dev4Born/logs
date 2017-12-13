<?php

/**
 *  
 *  Copyright (C) 2017
 *  
 *  File      : LogsLaravelServiceProvider.php
 *  Author    : Miłosz Nowak
 *  Copyright : (c) 2017 Dev4Born
 *  Link      : https://dev4born.pro
 *  Date      : 12/13/17
 *  
 */

namespace Dev4Born\logs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

/**
 *  
 *  Provider LogsLaravelServiceProvider
 *  
 *  
 *  @package Dev4Born\logs
 *  
 */

class LogsLaravelServiceProvider extends ServiceProvider
{
    /**
     *  
     * @brief Indicates if loading of the provider is deferred
     *
	 *
     * @var bool
	 *
     */
	 
    protected $defer = false;
	
    /**
     *
	 * @brief Perform post-registration booting of services
     *
	 *
     * @return void
	 *
     */
	 
    public function boot()
    {
        $this->Routes($this->app->router);
		
		$this->loadViewsFrom(__DIR__.'/Views', 'logs.views');
		
        $this->mergeConfigFrom(__DIR__.'/../../../../config/logs.php', 'logs.config');
    }

	/**
	 *  
	 *  @brief Registered routes for the application
	 *  
	 *  @param Router $routers
	 *  
	 *  @return void
	 *  
	 */
	
    public function Routes(Router $routers)
    {		
        $routers->group(['namespace' => 'Dev4Born\logs\Http\Controllers'], function($routers) {
			
            require __DIR__.'/Http/web.php';
			
        });
    }
	
    /**
     *
	 * @brief Register any package services
     *
	 *
     * @return void
	 *
     */
	 
    public function register()
    {
        //
    }	

}