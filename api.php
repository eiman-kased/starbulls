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

// FIXME add proper docblock comment here
// 400 request
function badRequest(string $message, Response $response)
{
	$response->getBody()->write(json_encode([
		"message" => $message
	]));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(400);
}

// FIXME this function name makes no sense
// FIXME add proper docblock comment here
// 404 request 
function badRequest404(string $message, Response $response)
{
	$response->getBody()->write(json_encode([
		"message" => "no Users Found"
	]));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(404);
}

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

// 400 request
public function badRequest400(string $message, Response $response) {
	$response->getBody()->write(json_encode([
		"message" => $message
	]));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(400);
}

//404 request
public function badRequest404(string $message, Response $response) {
	$response->getBody()->write(json_encode([
		"message" => $message
	]));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(404);
}

//200 status code - ok
public function badRequest200(string $message, Response $response) {
	$response->getBody()->write(json_encode($user));
	//return the response w/ status code
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
}

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
		return badRequest404('no Users Found', $response);
	}
	//return review info based on ID
	$response->getBody()->write(json_encode($users));
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

//finds User by email or id
$app->get('/user/{value}', function (Request $request, Response $response, array $args) {
	//set the string within args array to $value variable
	$value = $args['value'];
	//set value check if 0
	if ($value === '0') {
		//set error message -call bad request
		return badRequest400('zero is not a valid identifier', $response);
	}
	//create user object
	$user = false;
	// check if $value is a valid email
	if (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}/i', $value)) {
		// find user by email
		$user = User::findUserByEmail($value);
	} //check if value is integers only
		else if (!preg_match('/\D/', $value)) { 
		 //assign output of function to $user
		$user = User::findUserById($value);
	} else {
		//set error message
		return badRequest400('is not a valid identifier, must be email or integer id', $response);
	}

	// if we got nothing back from the user
	if (empty($user)) {
		// set not found message
		return badRequest404('user not found', $response);
	}
	//json encode the user data and write to the response body
	$response->getBody()->write(json_encode($user));
	//return the response w/ 200 status code
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// Create new user
$app->post('/user/new', function (Request $request, Response $response, array $args) {
	// get request body
	$body = json_decode($request->getBody());

	//set preg_match regex for name - will be used for first and last name
	$nameRegEx = '/^[a-z ,.\'-]+$/';

	//check name input against string pattern 
	if (!preg_match($nameRegEx, $body->first_name)) {
		//set response for invalid name format
		return badRequest('invalid name character included', $response);
	}

	//check last_name format
	if (!preg_match($nameRegEx, $body->last_name)) {
		//set response for invalid name format
		return badRequest('invalid name character included', $response);
	}

	/* Check phone number
	Accepted patterns for phone-number
	###-###-####
	(###)###-####
	(###) ###-####
	##########
	### ### ####
	*/

	//regex pattern set to a string
	$numberRegEx = '/\(?(\d{3})[\)\s-]*(\d{3})[\s\-]?(\d{4})/';
	//check user input against string pattern
	if (!preg_match($numberRegEx, $body->phone)) {
		//set response message for invalid format
		return badRequest('invalid format for phone number', $response);
	}

	//output of function set to userPhone w/ this format (###) ###-####
	$userPhone = preg_replace($numberRegEx, '$1$2$3', $body->phone);
	//if length of phone isn't equal to ten return an error
	if (strlen($userPhone) !== 10) {
		return badRequest('phone number must be 10 digits', $response);
	}

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
		return badRequest400('invalid id provided', $response);
	}

	// look up the user
	$user = User::findUserById($id);
	// if no matching user found
	if (!$user) {
		// set the response message
		return badRequest404('no user found for id', $response);
	}

	// get the request as a stdObject
	$body = json_decode($request->getBody());


	//Update user info that already exists
	if (isset($body->first_name)) {
		//set preg_match regex for name -will be used for first and last name
		$nameRegEx = '/^[a-z ,.\'-]+$/';
		//check name input against string pattern 
		if (!preg_match($nameRegEx, $body->first_name)) {
			//set response for invalid name format
			return badRequest400('invalid name character included', $response);
		}

		//output of function set to firstName w/ this format - Bo, John, Nancy, Monica
		$userFirstName = preg_replace($nameRegEx, '$1', $body->first_name);
		//set to variable
		$stringLength = strlen($userFirstName);

		//if length of firstName isn't greater than or equal to one or less than or equal to thirty return an error
		if (!$stringLength > 1 && !$stringLength < 30) {
			return badRequest400('first name must be between 1 and 30 characters', $response);
		}

		$user->setFirstName($body->first_name);
	}

	if (isset($body->last_name)) {
		//check last_name format
		if (!preg_match($nameRegEx, $body->last_name)) {
			//set response for invalid name format
			return badRequest400('invalid name character included', $response);
		}

		//output of function set to lastName w/ this format - Johnson, Smith, Xian, Shelly, Worchester
		$userLastName = preg_replace($nameRegEx, '$1', $body->last_name);
		//if length of lastName isn't greater than or equal to one or less than or equal to thirty return an error
		if (!$stringLength > 1 && !$stringLength < 30) {
			return badRequest400('last name must be at least one character', $response);
			
		}
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
		//regex pattern set to a string
		$numberRegEx = '/\(?(\d{3})[\)\s-]*(\d{3})[\s\-]?(\d{4})/';
		//check user input against string pattern
		if (!preg_match($numberRegEx, $body->phone)) {
			//return 400 error message
			return badRequest400('invalid format for phone number', $response);
		}

		//output of function set to userPhone w/ this format (###) ###-####
		$userPhone = preg_replace($numberRegEx, '$1$2$3', $body->phone);
		//if length of phone isn't equal to ten return an error
		if (strlen($userPhone) !== 10) {
			return badRequest400('phone number must be 10 digits', $response);
		}
		$user->setPhoneNumber($userPhone);
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
		return badRequest400('invalid id provided', $response);
	}

	// look up the user
	$user = User::findUserById($id);
	// if no matching user found
	if (!$user) {
		// return 404 error message
		return badRequest404('no user found for id', $response);
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
		return badRequest400('invalid id provided', $response);
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
		return badRequest400('score and comment cannot be empty', $response);
	}


	if (empty($body->userID) || intval($body->userID) == 0) {
		return badRequest400('userID must have a value greater than 0', $response);
	}

	if (floatval($body->score) < 0) {
		return badRequest400('score must be greater than 0', $response);
	}

	$review = new Review(floatval($body->score), trim($body->comment), $body->userID);
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
		return badRequest400('invalid id provided', $response);
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
		return badRequest400('invalid id provided', $response);
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
