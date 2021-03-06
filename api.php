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
 * validates $name passed into function for length and characters
 * 
 * '/^[a-z ,.\'-]+$/i' name must match this regex
 * and must be between 1 and 30 characters inclusively
 * 
 * Returns formatted phone number if valid or false if invalid
 *  
 * @param string $name
 * @return boolean|string
 */
function validateName(string $name)
{

	//check length
	//length of first name
	$stringLength = strlen($name);

	//if length of firstName isn't greater than or equal to one or less than or equal to thirty return an error
	if (!($stringLength >= 1 && $stringLength <= 30)) {
		return false;
	}
	//check for bad characters
	//set preg_match regex for name -will be used for first and last name
	$nameRegEx = '/^[a-z ,.\'-]+$/i';
	//check name input against string pattern 
	if (!preg_match($nameRegEx, $name)) {
		//set response for invalid name format
		return false;
	}

	return true;
}

/**
 * validates phone number against regex pattern
 * 
 * Accepted patterns for phone-number
 * ###-###-####
 * (###)###-####
 * (###) ###-####
 * ##########
 * ### ### ####
 *
 * @param string $phone
 * @return boolean|string
 */
function validatePhone(string $phone)
{
	//check against regex pattern 
	//regex pattern for phone number
	$numberRegEx = '/^\(?(\d{3})[\)\s-]*(\d{3})[\s\-]?(\d{4})$/';

	//check user input against string pattern
	if (!preg_match($numberRegEx, $phone)) {
		//set response message for invalid format
		return false;
	}

	$userPhone = preg_replace($numberRegEx, '$1$2$3', $phone);
	return $userPhone;
}

/**
 * validates email based on regex
 * /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}/i
 *
 * @param string $email
 * @return boolean
 */
function validateEmail(string $email): bool
{
	// set email regex to pattern
	$emailRegEx = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/i';
	// check $email against the regex
	if (!preg_match($emailRegEx, $email)) {
		// email is not formatted correctly
		return false;
	}

	return true;
}


//200 status code - ok
function sendResponse($data, int $code, Response $response)
{
	if ($data instanceof JsonSerializable || is_array($data)) {
		$response->getBody()->write(json_encode($data));
	} else {
		$code = 500;
	}
	// return response with 201 (added ok) code
	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus($code);
}

// 400 response
function badRequestResponse(array $data, Response $response)
{
	return sendResponse($data, 400, $response);
}

//404 response
function notFoundResponse(string $message, Response $response)
{
	return sendResponse(["message" => $message], 404, $response);
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

// Define app routes
$app->get('/test', function (Request $request, Response $response, $args) {
	return sendResponse($_SERVER, 200, $response);
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
		return notFoundResponse('no users Found', $response);
	}
	//return review info based on ID
	return sendResponse($users, 200, $response);
});

//finds User by email or id
$app->get('/user/{value}', function (Request $request, Response $response, array $args) {
	//set the string within args array to $value variable
	$value = $args['value'];
	//set value check if 0
	if ($value === '0') {
		//set error message -call bad request
		return badRequestResponse(['message' => 'zero is not a valid identifier'], $response);
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
		return badRequestResponse(['message' => $value . ' is not a valid identifier, must be email or integer id'], $response);
	}

	// if we got nothing back from the user
	if (empty($user)) {
		// set not found message
		return notFoundResponse('user not found', $response);
	}
	//json encode the user data and write to the response body
	return sendResponse($user, 200, $response);
});

// Create new user
$app->post('/user/new', function (Request $request, Response $response, array $args) {
	// get request body
	$body = json_decode($request->getBody());
	//create empty array
	$errors = array();

	//check first name input against string pattern 
	if (!validateName($body->first_name)) {
		//set response for invalid name format
		$errors[] = [
			'field' => ['first_name'],
			'message' => 'invalid character or length of first name',
		];
	}
	//check last_name format
	if (!validateName($body->last_name)) {
		//set response for invalid name format
		$errors[] = [
			'field' => ['last_name'],
			'message' => 'invalid character or length of last name',
		];
	}

	// Check phone number
	$userPhone = validatePhone($body->phone);
	if (!$userPhone) {
		//set response message for invalid format
		$errors[] = [
			'field' => ['phone'],
			'message' => 'invalid format for phone number',
		];
	}

	// validate the email
	if (!validateEmail($body->email)) {
		// push error to error array
		$errors[] = [
			'field' => ['email'],
			'message' => 'invalid format for email',
		];
	}

	//check if any errors were reported
	if (!empty($errors)) {
		// if so return invalid response with list of offending fields and messages
		return badRequestResponse($errors, $response);
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
	$id = intval($args['id']);
	//Create empty array for errors
	$errors = array();
	// check validity of id
	if (!$id) {
		// add error message to error array 
		$errors[] = ['message' => 'invalid id provided'];
	}

	// look up the user
	$user = User::findUserById($id);
	// if no matching user found
	if (!$user) {
		// set the response message for 404 not found
		return notFoundResponse('no user found for id', $response);
	}

	// get the request as a stdObject
	$body = json_decode($request->getBody());

	//Update user info that already exists
	if (isset($body->first_name)) {
		$userFirstName = $body->first_name;
		//check name input against string pattern 
		if (!validateName($userFirstName)) {
			// pass error message through error array 
			$errors[] = [
				'field' => ['first_name'],
				'message' => 'invalid character or length of first name'
			];
		}

		//set first name to $user
		$user->setFirstName($userFirstName);
	}

	if (isset($body->last_name)) {
		$userLastName = $body->last_name;
		//check last_name format
		if (!validateName($userLastName)) {
			//pass error message through error array 
			$errors[] = [
				'field' => ['last_name'],
				'message' => 'invalid character in last name'
			];
		}

		//set last name to $user
		$user->setLastName($userLastName);
	}

	if (isset($body->email)) {
		// TODO check if valid email
		// validate the email
		if (!validateEmail($body->email)) {
			// push error to error array
			$errors[] = [
				'field' => ['email'],
				'message' => 'invalid format for email',
			];
		} else {
			$user->setEmail($body->email);
		}
	}

	if (isset($body->password)) {
		$user->setPassword($body->password);
	}

	if (isset($body->phone)) {
		//check user input against string pattern
		$userPhone = validatePhone($body->phone);
		if (!$userPhone) {
			//return 400 error message into array
			$errors[] = [
				'field' => ['phone'],
				'message' => 'invalid format for phone number',
			];
		} else {
			$user->setPhoneNumber($userPhone);
		}
	}
	//check for errors in the array
	if (!empty($errors)) {
		//return bad response 
		return badRequestResponse($errors, $response);
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
		// return 400  bad request error for invalid id
		return badRequestResponse(['message' => 'invalid id provided'], $response);
	}
	// look up the user
	$user = User::findUserById($id);
	// if no matching user found
	if (!$user) {
		// return 404 not found error for no user id 
		return notFoundResponse('no user found for id', $response);
	}
	//archive user
	$user->archive();

	return sendResponse($user, 200, $response);
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
	return sendResponse($reviews, 200, $response);
});

// /review/{reviewID} - displays the info about a specific review
$app->get('/review/{reviewID}', function (Request $request, Response $response, array $args) {
	// get the integer value of the passed in id
	$reviewID = intval($args['reviewID']);
	// if that id is not a number or is 0
	if (!$reviewID) {
		// set a message to explain what broke
		return badRequestResponse(['message' => 'invalid id provided'], $response);
	}

	$review = Review::getReviewByID($reviewID);
	//return review info based on ID
	return sendResponse($review, 200, $response);
});

//review/new  Creates a new review
$app->post('/review/new', function (Request $request, Response $response, array $args) {
	$body = json_decode($request->getBody());

	if (empty($body->score) || empty($body->comment)) {
		return badRequestResponse([
			'field' => [
				'score',
				'comment',
			],
			'message' => 'score and comment cannot be empty',
		], $response);
	}


	if (empty($body->userID) || intval($body->userID) == 0) {
		return badRequestResponse([
			'field' => ['userID'],
			'message' => 'userID must have a value greater than 0',
		], $response);
	}

	if (floatval($body->score) < 0) {
		return badRequestResponse([
			'field' => ['score'],
			'message' => 'score must be greater than 0',
		], $response);
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
		return badRequestResponse([
			'field' => ['id'],
			'message' => 'invalid id provided',
		], $response);
	}

	$body = json_decode($request->getBody());
	//check that the review has an id and user id
	if (intval($id)) {
		$review = Review::getReviewByID($id);
		//check that the score and comment are not empty
		if (empty($body->score) && empty($body->comment)) {
			$response->getBody()->write(json_encode([
				'field' => [
					'score',
					'comment',
				],
				'message' => 'score and comment need values',
			]));
			return $response->withStatus(400);
		}

		//check to make sure score is more than 0
		if (!empty($body->score) && !intval($body->score) > 0) {
			$response->getBody()->write(json_encode([
				'field' => ['score'],
				'message' => 'score must be greater than 0',
			]));
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
		return badRequestResponse(['message' => 'invalid id provided'], $response);
	}
	$review = Review::getReviewByID($id);

	$review->archive();

	return sendResponse($review, 200, $response);
});

// Run app
$app->run();
