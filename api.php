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
$app->get('/test', function (Request $request, Response $response, $args) {
	$response->getBody()->write(json_encode($_SERVER));
	return $response;
});

/********* USER ROUTES *********/

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

	$user = new User($body->first_name, $body->last_name, $body->email, $body->password, $body->phone, $body->preferred ?? false);
	$response->getBody()->write(json_encode($user));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(201);
});

//Change info for a user that already exists
$app->post('/user/{id}', function (Request $request, Response $response, array $args) {
	$id = $args['id'];
	//Locate id
	$user = User::findUserById(intval($id));
	$body = json_decode($request->getBody());

	//Update user info
	if (isset($body->first_name)) {
		$user->setFirstName($body->first_name);
	}

	if (isset($body->last_name)) {
		$user->setLastName($body->last_name);
	}

	if (isset($body->email)) {
		$user->setEmail($body->email);
	}

	if (isset($body->password)) {
		$user->setPassword($body->password);
	}

	if (isset($body->phone)) {
		$user->setPhoneNumber($body->phone);
	}
	var_dump($user);

	$response->getBody()->write(json_encode($user));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(201);
});


/********* REVIEW ROUTES *********/

// /review/{reviewID} - displays the info about a specific review not just the review contents
$app->get('/reviews', function (Request $request, Response $response, array $args) {
	// get our sort/filter vals
	$params = $request->getQueryParams();
	$filterVal = (isset($params['filter-by']) ? $params['filter-by'].' '.$params['filter-val'] : '');
	$reviews = Review::getAllReviews($filterVal, $params['archived'] ?? false);
	//return review info based on ID
	$response->getBody()->write(json_encode($reviews));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// /review/{reviewID} - displays the info about a specific review not just the review contents
$app->get('/review/{reviewID}', function (Request $request, Response $response, array $args) {
	$reviewID = intval($args['reviewID']);
	$review = \Review::getReviewByID($reviewID);
	//return review info based on ID
	$response->getBody()->write(json_encode($review));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
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

$app->post('/review/{reviewId}', function (Request $request, Response $response, array $args) {
	$id = $args['reviewId'];
	$body = json_decode($request->getBody());
	//check that the review has an id and user id
	if (intval($id)) {
		$review = Review::getReviewByID($id);
		//check that the score and comment are not empty
		if (empty($body->score) && empty($body->comment)) {
			return $response->withStatus(400);
		}

		//check to make sure score is more than 0
		if (!empty($body->score) && !intval($body->score) > 0) {
			return $response->withStatus(400);
		}

		//update review
		if (!empty($body->score)) {
			$review->setScore($body->score);
		}

		if (!empty($body->comment)) {
			$review->setComment($body->comment);
		}

		$response->getBody()->write(json_encode($review));
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(201);
	}
	return $response->withStatus(500);
});

$app->delete('/review/{reviewId}', function (Request $request, Response $response, array $args) {
	$id = $args['reviewId'];
	$review = Review::getReviewByID($id);

	$review->archive();

	$response->getBody()->write(json_encode($review));

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});


// Run app
$app->run();
