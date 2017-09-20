<?php 


 namespace App\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;
/**
* 
*/
class OldInputMiddleware extends Middleware
{
	
	function __invoke(Request $request,Response $response, $next)
	{
		$this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
		$_SESSION['old'] = $request->getParams();

		$response = $next($request, $response);

		return $response;
	}
}