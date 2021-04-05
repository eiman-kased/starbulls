<?php
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/User.php';
require __DIR__ . '/src/Review.php';

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
$app->get('/', function (Request $request, Response $response, $args) {
	$name = $args['name'];
	$response->getBody()->write("Hello, $name");
	return $response;
});

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
	$body = json_decode($request->getBody());
	$response->getBody()->write($body->test);
	return $response;
});

// /review/show/{reviewID} - displays the info about a specific review not just the review contents
$app->get('/review/{reviewID}', function (Request $request, Response $response, array $args) {
	$reviewID = intval($args['reviewID']);
	$review = \Review::getReviewsByID($reviewID);
	echo '<pre>';
	var_dump($review);
	echo '</pre>';
	//return review info based on ID
	// $response->getBody()->write(json_encode($review));
	return $response;
});

$app->post('/review/new', function (Request $request, Response $response, array $args) {
	$body = json_decode($request->getBody());

	if (empty($body->score) || empty($body->comment)) {
		return $response->withStatus(500);
	}

	if (empty($body->userID) && intval($body->userID) == 0) {
		return $response->withStatus(400);
	}

	if (!intval($body->score) > 0) {
		return $response->withStatus(400);
	}

	$review = new Review($body->score, $body->comment, $body->userID);
	if ($review->saveToDB()) {
		$response->getBody()->write(json_encode($review));
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(201);
	}

	return $response->withStatus(500);
});

$app->post('/review/edit/{reviewid}', function (Request $request, Response $response, array $args) {
	$id = $args['reviewID'];
	$body = json_decode($request->getBody());
	//check that the review has an id and user id
	if (!empty($body->$id)) {
		if (intval($body->$id) == 0) {
			return $response->withStatus(400);
		}
		//check that the score and comment are not empty
		if (empty($body->score) || empty($body->comment)) {
			return $response->withStatus(500);
		}
		//check to make sure score is more than 0
		if (!intval($body->score) > 0) {
			return $response->withStatus(400);
		}
		//update db
		$review = new Review($body->$id, $body->score, $body->comment);
		if ($review->updateReview()) {
			$response->getBody()->write(json_encode($review));
			return $response
				->withHeader('Content-Type', 'application/json')
				->withStatus(201);
		}
	}
	return $response->withStatus(500);
});


// Run app
$app->run();
