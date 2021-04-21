<?php
//Used for error testing
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/User.php';
require __DIR__ . '/src/Review.php';

// TODO Remove before release
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
// TODO Implement security/format checking middle ware
// $app->addRoutingMiddleware();

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


// sets the base path to allow systems with different configurations to run the same, mostly
$app->setBasePath((function () {
	// literally everything in here is to avoid typing Week_whatever each time this gets copied for the next week. DO NOT DO THIS!!!
	$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
	$uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
	if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
		return $_SERVER['SCRIPT_NAME'];
	}
	if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
		return $scriptDir;
	}
	return '';
})()); // Append route with api cuz I don't want to write that every time also


// Define app routes
$app->get('/test', function (Request $request, Response $response, $args) {
	$response->getBody()->write(json_encode($_SERVER));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

/********* USER ROUTES *********/

// /users - displays all users
$app->get('/users', function (Request $request, Response $response, array $args) {
	// get our sort/filter vals
	$params = $request->getQueryParams();
	// FIXME we need a specific and standard set of search params that are allowable.
	$filterVal = (isset($params['filter-by']) ? $params['filter-by'] . ' ' . $params['filter-val'] : '');
	$users = User::getAllUsers($filterVal, $params['archived'] ?? false);
	if (empty($users)) {
		$response->getBody()->write(json_encode([
			"message" => "no Users Found"
		]));
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(404);
	}
	//return review info based on ID
	$response->getBody()->write(json_encode($users));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

//finds User by Email TODO modify route
$app->get('/user/{email}', function (Request $request, Response $response, array $args) {
	//set the string within args array to $email variable
	$email = $args['email'];
	//check if input has been submitted
	if (!$email) {
		//set response message for invalid email format
		$response->getBody()->write(
			json_encode(
				['message' => 'invalid email provided',]
			)
		);
		// return the error and a invalid request status
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(400);
	}
	// otherwise get the user
	$user = User::findUserByEmail($email);
	// if we got nothing back from the user
	if (empty($user)) {
		// set not found message
		$response->getBody()->write(json_encode([
			'message' => 'user not found'
		]));
		// return 404
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(404);
	}
	// assuming everything else went ok encode the user
	$response->getBody()->write(json_encode($user->jsonSerialize()));
	// return users info
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// lists all users info including their reviews //
$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
	// get the integer value of the passed in id
	$id = intval($args['id']);
	// if that id is not a number or is 0
	if (!$id) {
		// set a message to explain what broke
		$response->getBody()->write(
			json_encode(
				['message' => 'invalid id provided',]
			)
		);
		// return the error and a invalid request status
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(400);
	}
	// otherwise get the user
	$user = User::findUserById($id);
	// if we got nothing back from the user
	if (empty($user)) {
		// set not found message
		$response->getBody()->write(json_encode([
			'message' => 'user not found'
		]));
		// return 404
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(404);
	}
	// assuming everything else went ok encode the user
	$response->getBody()->write(json_encode($user->jsonSerialize()));
	// return users info
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// Create new user
$app->post('/user/new', function (Request $request, Response $response, array $args) {
	// get request body
	$body = json_decode($request->getBody());

	/* Check phone number
	Accepted patterns for phone-number
	###-###-####
	(###)###-####
	(###) ###-####
	##########
	### ### ####
	*/

	//regex pattern set to a string
	$numberRegEx = '\(?(\d{3})[\)\s-]*(\d{3})[\s\-]?(\d{4})';
	//check user input against string pattern
	if (!preg_match($numberRegEx, $body->phone)) {
		//set response message for invalid format
		$response->getBody()->write(
			json_encode(
				['message' => 'invalid format for phone number']
			)
		);
		//return the error with an invalid request status
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(400);
	}

	//regx pattern set as a string
	$userPhoneRegex = '\(?(\d{3})[\)\s-]*(\d{3})[\s\-]?(\d{4})';

	//output of function set to userPhone w/ this format (###) ###-####
	$userPhone = preg_replace($userPhoneRegex, '$1$2$3', $body->phone);

	// create user from request values
	$user = new User($body->first_name, $body->last_name, $body->email, $body->password, $userPhone, $body->preferred ?? false);
	// save the user
	$user->saveToDB();
	// set encoded user as response body
	$response->getBody()->write(json_encode($user));
	// return response with 201 (added ok) code
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(201);
});

//Change info for a user that already exists
$app->post('/user/{id}', function (Request $request, Response $response, array $args) {
	// get int value of requested id
	$id = intval($args['id']);
	// check validity of id
	if (!$id) {
		// set a message to explain what broke
		$response->getBody()->write(json_encode([
			'message' => 'invalid id provided',
		]));
		// return the error and a invalid request status
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(400);
	}
	// look up the user
	$user = User::findUserById($id);
	// if no matching user found
	if (!$user) {
		// set the response message
		$response->getBody()->write(json_encode([
			'message' => 'no user found for id:' . $id,
		]));
		// return the error and a 404 status
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(404);
	}

	// get the request as a stdObject
	$body = json_decode($request->getBody());

	//Update user info
	if (isset($body->first_name)) {
		$user->setFirstName($body->first_name);
	}

	if (isset($body->last_name)) {
		$user->setLastName($body->last_name);
	}

	if (isset($body->email)) {
		// TODO check if valid email
		$user->setEmail($body->email);
	}

	if (isset($body->password)) {
		$user->setPassword($body->password);
	}

	if (isset($body->phone)) {
		$user->setPhoneNumber($body->phone);
	}

	// save the changes made to the db
	$user->saveToDB();

	// sent the response
	$response->getBody()->write(json_encode($user));
	// return response with correct code
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(201);
});

//user/{userId}  delete a user by id
$app->delete('/user/{userId}', function (Request $request, Response $response, array $args) {
	// get int value of requested id
	$id = intval($args['userId']);
	// check validity of id
	if (!$id) {
		// set a message to explain what broke
		$response->getBody()->write(json_encode([
			'message' => 'invalid id provided',
		]));
		// return the error and a invalid request status
		return $response->withStatus(400);
	}
	// look up the user
	$user = User::findUserById($id);
	// if no matching user found
	if (!$user) {
		// set the response message
		$response->getBody()->write(json_encode([
			'message' => 'no user found for id:' . $id,
		]));
		// return the error and a 404 status
		return $response->withStatus(404);
	}

	$user->archive();

	$response->getBody()->write(json_encode($user));

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

/********* REVIEW ROUTES *********/

// /reviews - displays all reviews
$app->get('/reviews', function (Request $request, Response $response, array $args) {
	// get our sort/filter vals
	$params = $request->getQueryParams();
	// FIXME we need a specific and standard set of search params that are allowable.
	$filterVal = (isset($params['filter-by']) ? $params['filter-by'] . ' ' . $params['filter-val'] : '');
	$reviews = Review::getAllReviews($filterVal, $params['archived'] ?? false);
	//return review info based on ID
	$response->getBody()->write(json_encode($reviews));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// /review/{reviewID} - displays the info about a specific review
$app->get('/review/{reviewID}', function (Request $request, Response $response, array $args) {
	// get the integer value of the passed in id
	$reviewID = intval($args['reviewID']);
	// if that id is not a number or is 0
	if (!$reviewID) {
		// set a message to explain what broke
		$response->getBody()->write(json_encode([
			'message' => 'invalid id provided',
		]));
		// return the error and a invalid request status
		return $response->withStatus(400);
	}
	$review = Review::getReviewByID($reviewID);
	//return review info based on ID
	$response->getBody()->write(json_encode($review));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

//review/new  Creates a new review
$app->post('/review/new', function (Request $request, Response $response, array $args) {
	$body = json_decode($request->getBody());

	if (empty($body->score) || empty($body->comment)) {
		return $response->withStatus(400);
	}

	if (empty($body->userID) || intval($body->userID) == 0) {
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

//review/{reviewId} Update a review
$app->post('/review/{reviewId}', function (Request $request, Response $response, array $args) {
	// get the integer value of the passed in id
	$id = intval($args['reviewId']);
	// if that id is not a number or is 0
	if (!$id) {
		// set a message to explain what broke
		$response->getBody()->write(json_encode([
			'message' => 'invalid id provided',
		]));
		// return the error and a invalid request status
		return $response->withStatus(400);
	}
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
		$review->saveToDB();

		$response->getBody()->write(json_encode($review));
		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(201);
	}
	return $response->withStatus(500);
});

//review/{reviewId}  delete a review by id
$app->delete('/review/{reviewId}', function (Request $request, Response $response, array $args) {
	// get the integer value of the passed in id
	$id = intval($args['reviewId']);
	// if that id is not a number or is 0
	if (!$id) {
		// set a message to explain what broke
		$response->getBody()->write(json_encode([
			'message' => 'invalid id provided',
		]));
		// return the error and a invalid request status
		return $response->withStatus(400);
	}
	$review = Review::getReviewByID($id);

	$review->archive();

	$response->getBody()->write(json_encode($review));

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});


// Run app
$app->run();
