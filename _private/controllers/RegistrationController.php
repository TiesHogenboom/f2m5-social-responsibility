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
		echo $template_engine->render('register_form');

	}

	public function handleRegistrationForm(){
		//hier wordt zo het form afgehandeld
		
		$errors = [];

		//Checks: valideren of het een geldige emailadres is
		$email		= filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL );
		$wachtwoord = trim( $_POST['wachtwoord'] );

		if ( $email === false ) {
			$errors['email'] = 'Geen geldige email ingevuld';
		}

		//Checks: wachtwoord minimaal 6 characters is
		if ( empty ( $wachtwoord ) || strlen( $wachtwoord ) < 6 ) {
			$errors['wachtwoord'] = 'Geen geldige wachtwoord, (minimaal 6 tekens)';
		}

		if ( count( $errors ) === 0 ) {
			// Opslaan van de gebruiker

			//check of de gebruiker al bestaat
			$connection = dbConnect();
			$sql		= "SELECT * FROM `gebruikers` WHERE `email` = :email";
			$statement  = $connection->prepare( $sql );
			$statement->execute( [ 'email' => $email] );

			if ( $statement->rowCount() === 0 ) {
				//als die er niet is dan verder met opslaan
				$sql			= "INSERT INTO `gebruikers` (`email`, `wachtwoord`) VALUES (:email, :wachtwoord)";
				$statement 		= $connection->prepare( $sql );
				$safe_password  = password_hash( $wachtwoord, PASSWORD_DEFAULT );
				$params			= [
					'email'		  => $email,
					'wachtwoord'  => $safe_password
				];
				$statement->execute( $params );

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
		echo $template_engine->render('register_form', ['errors' => $errors]);
	}


	public function registrationThankYou(){

		$template_engine = get_template_engine();
		echo $template_engine->render("register_thankyou");
	}
}

