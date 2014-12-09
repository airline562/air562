<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function getCountriesAutoComplete(){
		 $term = Input::get('busqueda');
        $books = array();
        $search = DB::table('books')->where('name', 'LIKE', '%'.$term.'%')->get();
        foreach($search as $results => $book){
            $books[] = array('id'=>$book->id, 'label'=>$book->name, 'value'=>$book->id);
        }
        return Response::json($books);
	}

	public function autocompleteCountry(){
		$term = Input::get('term');
		
		$results = array();
		
		$queries = DB::table('Country')
			->where('name', 'LIKE', '%'.$term.'%')
			->take(5)->get();

			
		
		foreach ($queries as $query)
		{
		    $results[] = [ 'id' => $query->name, 'value' => $query->name ];
		}

		return Response::json($results);
	}

	public function autocompleteCity(){
		$city = Input::get('term');
		$country = Input::get('country');

		
		
		$results = array();
		
		$queries = DB::table('City')
			->where('name', 'LIKE', '%'.$city.'%')
			->where('country_name', '=' , $country)
			->take(5)->get();
		foreach ($queries as $query)
		{
		    $results[] = [ 'id' => $query->name, 'value' => $query->name ];
		}

		return Response::json($results);
	}


	public function postFlights(){

	}





}
