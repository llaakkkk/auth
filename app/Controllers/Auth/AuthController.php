<?php

namespace App\Controllers\Auth;

use Slim\Views\Twig as View;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;


/**
* 
*/
class AuthController extends Controller
{



	public function getSignUp(Request $request, Response $response) {

		$this->view->render($response, 'auth/signup.twig');

	}


	public function postSignUp(Request $request, Response $response) {
		$validation = $this->validator->validate($request, [
				'email' => v::noWhitespace()->notEmpty()->email(),
				'name' => v::notEmpty()->alpha(),
				'password' => v::noWhitespace()->notEmpty(),

			]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		$email = $request->getParam('email');
		$name = $request->getParam('name');

		User::create([
			'email' => $email,
			'name' => $name,
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT)
		]);


        $result = $this->mailer->send('forms/email.twig', [
            'email' => $email,
            'name' => $name,
            'message' => 'Hello'] , function($msg) use ($email){
              $msg->to( $email ); // How do I put the email from the form here?
              $msg->subject( 'register' ); // How do i put the subject from the form here?
              $msg->from('me@myself.com'); // if you want different sender email in mailer call function
              $msg->fromName('Me Myself'); // if you want different sender name in mailer call function
	    });


		return $response->withRedirect($this->router->pathFor('home'));
		
	}
}