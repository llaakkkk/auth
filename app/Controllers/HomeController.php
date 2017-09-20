<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
/**
* 
*/
class HomeController extends Controller
{


	// protected $view;	

	// public function __construct (View $view) {
	// 	$this->view = $view;
	// }

	public function index ($request, $response)
	{
//		$user = User::where('email', 'lena@test.com')->first();
//		var_dump($user->email);die;

		User::create([
			'name' => 'Lena Kirichok',
			'email' => 'lena@academy.com',
			'password' => '123'
		]);
		return $this->view->render($response, 'home.twig');

	}
}