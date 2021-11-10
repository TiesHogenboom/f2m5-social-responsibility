<?php

namespace Website\Controllers;

/**
 * Class RegistrationController
 *
 *
 */
class RegistrationController {

	public function registrationForm() {

		$template_engine = get_template_engine();
		echo $template_engine->render('register/form');

	}

	public function handleRegistrationForm(){
		//hier wordt zo het form afgehandeld
		
		$result = validateRegistrationData($_POST);

		if ( count( $result ['errors'] ) === 0 ) {
			// Opslaan van de gebruiker

			if ( userNotRegistered($result['data']['email'])) {
				
			createUser($result['data']['email'], $result['data']['wachtwoord']);

				//doorsturen naar bedankt pagina
				$bedanktUrl = url('register.thankyou');
				redirect($bedanktUrl);
				//alles hierna wordt niet meer uitgevoerd


			} else {
				//anders foutmelding tonen
				$errors['email'] = 'Dit account bestaat al';
			}
			
			
		}


		$template_engine = get_template_engine();
		echo $template_engine->render('register_form', ['errors' => $result ['errors']]);
	}


	public function registrationThankYou(){

		$template_engine = get_template_engine();
		echo $template_engine->render("register/thankyou");
	}
}

