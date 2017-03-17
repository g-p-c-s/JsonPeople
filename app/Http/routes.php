<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('people', function () {
	/**
	 * @todo these checks can go into a private method on a controller
	 * 			or into a Validation class
	 */
    // Content-Type must be JSON
    if (!request()->isJson()) {
        return response('JSON Expected!', 422);
    }

    // Has any data?
    if (!request()->has('data')) {
        return response('Empty/Unprocessable Input.', 422);
    }

    // Any peoples to process?!
    if (count(request()->input('data'))<1) {
        return response('Nothing to process.', 422);
    }

    // Collect the data for further parsing
    $people = collect(request()->input('data'));

    // Sort by age
    $sortedPeople = $people->map(function ($person) {
        // Add name field
        $person['name'] = sprintf("%s %s", $person['first_name'], $person['last_name']);
        return $person;
    })->sortByDesc('age');

    // Extract Emails from Sorted Collect
    // Just so similar order is maintained.
    $emails = $sortedPeople->map(function ($person) {
        return $person['email'];
    })->implode(",");

    // Persit the values
    $p = new App\People;
    $p->emails = $emails;
    $p->details = $sortedPeople->values();
    $p->save();

    return response(['success' => true, 'count' => count($sortedPeople->values())], 200);
});


Route::get('/', function () {
    return view('welcome');
});