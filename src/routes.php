<?php
// Routes

$app->get('/', 'HomeController:index')->setName('home');
# .. $app->get('/home', function ($request, $response) {
# ..     // Sample log message
# ..     $this->logger->info("Slim-Skeleton '/home' route");

# ..     // Render index view
# ..     return $this->view->render($response, 'home.twig');
# .. });
$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');
