<?php
// DIC configuration

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

// view renderer
$container['renderer'] = function ($container) {
    $settings = $container->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//twig
$container['view'] = function ($container) {
	
	$settings = $container->get('settings')['twig'];

	$view = new \Slim\Views\Twig($settings['template_path'], [
		'cache' => false,
		]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
		));

	return $view;
};

$container['validator'] = function ($container) {
	return new App\Validation\Validator;
};

$container['mailer'] = function ($container) {
	$mailer = new \PHPMailer\PHPMailer\PHPMailer();
    $mailer->isSMTP();

	$mailer->Host = 'smtp.gmail.com';  // your email host, to test I use localhost and check emails using test mail server application (catches all  sent mails)
	$mailer->SMTPAuth = true;                 // I set false for localhost
	$mailer->SMTPSecure = 'ssl';              // set blank for localhost
	$mailer->Port = '465';
    $mailer->SMTPDebug = 0;
	$mailer->Username = 'llakie@gmail.com';    // I set sender email in my mailer call
	$mailer->Password = 'password';
	$mailer->isHTML(true);

	return new \App\Mail\Mailer($mailer, $container->view);
};
$container['HomeController'] = function ($container) {
	return new \App\Controllers\HomeController($container, $container->view);
};

$container['AuthController'] = function ($container) {
	return new \App\Controllers\Auth\AuthController($container, $container->view);
};