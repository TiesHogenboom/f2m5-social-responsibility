<?php

namespace Website\Controllers;

/**
 * Class SecureController
 *
 */
class SecureController {

	public function index() {

		loginCheck();

		$template_engine = get_template_engine();
		echo $template_engine->render('secure/index');


	}

}

