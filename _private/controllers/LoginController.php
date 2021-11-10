<?php

namespace Website\Controllers;

/**
 * Class LoginController
 *
 *
 */
class LoginController {

	public function loginForm() {

		$template_engine = get_template_engine();
		echo $template_engine->render('login_form');

	}

	public function handleLoginForm(){
		
		// Form valideren: email en wachtwoord ingevuld?
		$result = validateRegistrationData($_POST);

		
		// Checken: bestaat gebruiker met dat email wel?
		if(userNotRegistered($result['data']['email'] ) ){
			$result['errors']['email'] = 'Deze gebruiker is niet bekend';
		}else{
		// Controleren wachttwoord klopt (password_verify)
		$user = getUserByEmail ( $result['data']['email'] );

		if(password_verify($result['data']['wachtwoord'], $user['wachtwoord'])){
			// Gebruiker inloggen

			loginUser($user);

			// Gebruiker doorsturen naar eigen dashboard
			redirect(url('login.dashboard'));


		}else {
			$result['errors']['wachtwoord'] = 'Wachtwoord is niet correct';
		}
	}
		$template_engine = get_template_engine();
		echo $template_engine->render('login_form',['errors' => $result['errors']]);

	}

	public function userDashboard(){

		//checken of je wel echt bent ingelogd
		loginCheck();

		$template_engine = get_template_engine();
		echo $template_engine->render('user_dashboard');
	}

	public function logout(){
		logoutUser();
		redirect(url('home'));
	}

}
