<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use Website\middleware\IsAuthenticated;

SimpleRouter::setDefaultNamespace( 'Website\Controllers' );

SimpleRouter::group( [ 'prefix' => site_url() ], function () {

	// START: Zet hier al eigen routes (alle URL's die je op je website hebt) en welke controller en functie deze pagina afhandelt
	// Lees de docs, daar zie je hoe je routes kunt maken: https://github.com/skipperbent/simple-php-router#routes

	SimpleRouter::get( '/', 'WebsiteController@home' )->name( 'home' );


	SimpleRouter::group(['prefix' => '/registreren'], function(){

		SimpleRouter::get( '/admin', 'AdminController@index' )->name( 'admin.index' );

	});

	SimpleRouter::group(['prefix' => '/registreren'], function(){

		SimpleRouter::get('/', 'RegistrationController@registrationForm')->name('register.form');
		SimpleRouter::post('/verwerken', 'RegistrationController@handleRegistrationForm')->name('register.handle');
		SimpleRouter::get('/bedankt', 'RegistrationController@registrationThankYou')->name('register.thankyou');

	});
	

	//login routes
	SimpleRouter::get('/login', 'LoginController@LoginForm')->name('login.form');
	SimpleRouter::post('/login/verwerken', 'LoginController@handleLoginForm')->name('login.handle');
	SimpleRouter::get('/logout', 'LoginController@Logout')->name('logout');

	//Secure (ingelogde gebruikers) routes
	SimpleRouter::group(['prefix' => '/ingelogd', 'middleware' => IsAuthenticated::class], function(){

		SimpleRouter::get('/', 'SecureController@index')->name('secure.index');

	});


	
	SimpleRouter::get('/ingelogd/dashboard', 'LoginController@userDashboard')->name('login.dashboard');


	// STOP: Tot hier al je eigen URL's zetten, dit stukje laat de 4040 pagina zien als een route/url niet kan worden gevonden.
	SimpleRouter::get( '/not-found', function () {
		http_response_code( 404 );

		return '404 Page not Found';
	} );

} );


// Dit zorgt er voor dat bij een niet bestaande route, de 404 pagina wordt getoond (die hierboven als route staat ingesteld)
SimpleRouter::error( function ( Request $request, \Exception $exception ) {
	if ( $exception instanceof NotFoundHttpException && $exception->getCode() === 404 ) {
		response()->redirect( site_url() . '/not-found' );
	}      

} );

