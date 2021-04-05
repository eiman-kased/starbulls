<?php
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/User.php';

// var_dump($_SERVER);
/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
$app = AppFactory::create();

// Add Routing Middleware
$app->addRoutingMiddleware();

/**
 * Add Error Handling Middleware
 *
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * which can be replaced by a callable of your choice.

 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define app routes
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
	$name = $args['name'];
	$response->getBody()->write("Hello, $name");
	return $response;
});

// lists a users info including their reviews //
$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
	$id = $args['id'];
	$user = \User::findUserById($id);
	//returning users info
	$response->getBody()->write(json_encode($user->jsonSerialize()));
	return $response;
});

// Create new user
$app->post('/users/new', function (Request $request, Response $response, array $args) {
	return json_encode(var_dump($request));
});

//Change info for a user that already exists
$app->post('/user/{id}', function (Request $request, Response $response, array $args) {

	//update info identified by $args['id']
	$id = $args['id'];
	$user = \User::findUserById(intval($id));
	$user = findUserById($request->id);
	$user->setFname($request->fname);
	$user->setLname($request->lname);
	//Convert the string to an integer value
	foreach ($id as $user => $values) {}
	//Return updated user info
	$response->getBody()->write(json_encode($user));
	return $response;
});






// Run app
$app->run();
