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

		
		$queries = DB::SELECT(DB::raw("SELECT * FROM City, Airport WHERE City.name LIKE '%$city%' AND City.id = Airport.city_id AND City.country_name = '$country'"));

		$results = array();
		
		
		foreach ($queries as $query)
		{
		    $results[] = [ 'id' => $query->name, 'value' => $query->name . "-" . $query->code];
		}

		return Response::json($results);
	}

	public function autocompleteCityA(){
		$city = Input::get('term');
		$country = Input::get('country');

		
		$queries = DB::SELECT(DB::raw("SELECT * FROM City, Airport WHERE City.name LIKE '%$city%' AND City.id = Airport.city_id AND City.country_name = '$country'"));

		$results = array();
		
		
		foreach ($queries as $query)
		{
		    $results[] = [ 'id' => $query->name, 'value' => $query->name];
		}

		return Response::json($results);
	}



	public function postFlights(){

		//PDO::setAttribute("PDO::MYSQL_ATTR_USE_BUFFERED_QUERY", true);
		$deptCity = Input::get('p');
		$arrivalCity = Input::get('u');
		$leavingDate = Input::get('dept_date');
		$singular = Input::get('group1');

		//Split all the strings
		$splitString = explode('-', $deptCity);

		$deptCity = $splitString[0];
		$deptAirport = $splitString[1];

		$splitString = explode('-', $arrivalCity);

		$arrivalCity = $splitString[0];
		$arrivalAirport = $splitString[1];

		$dt = strtotime($leavingDate);

		$day = date("D", $dt);

		$dayNum = 1;

	

		switch ($day) {
		    case "Sun":
		        $dayNum = 1;
		        break;
		    case "Mon":
		        $dayNum = 1;
		        break;
		    case "Tue":
		        echo "i equals 2";
		        break;
	        case "Wed":
		        $dayNum = 1;
		        break;
	        case "Thu":
		        $dayNum = 1;
		        break;
	        case "Fri":
		        $dayNum = 1;
		        break;
	        case "Sat":
		        $dayNum = 1;
		        break;
			}	

			$destination = $arrivalAirport;

			$departure = $deptAirport;

			$date = $dayNum;
	

	




		if($singular == "direct"){
			//do a singular flight query

				$results = DB::select(DB::raw("SELECT x.*, dest_city.utc_offset as destination_utc, depart_city.utc_offset as depart_utc
												FROM Flight x, Airport dest, Airport depart, City dest_city, City depart_city
												WHERE x.airport_destination = '$destination' AND x.airport_departure = '$departure' AND x.airport_destination = dest.code AND x.airport_departure = depart.code AND dest.city_id = dest_city.id AND depart.city_id = depart_city.id AND x.days LIKE '%$date%' ORDER BY duration" ) );	


				return View::make('single')->with('results', $results)
										   ->with('deptCity', $deptCity)
										   ->with('arrivalCity', $arrivalCity);

			
		} else {
			//do a multi flight query

				$mysqli = new mysqli("127.0.0.1", "root", "", "airline562");



				$sql    = "select * 
							from( select merge_w_utc_con.*, dest_city.utc_offset as dest_city_utc_offset
							from( select merge_w_utc_orig.*, con_city.utc_offset as con_city_utc_offset
							from( select merge_w_dest_city_id.*, org_city.utc_offset as org_city_utc_offset
							from( select merge_w_connect_city_id.*, d_airp.city_id as d_airp_city_id
							from( select merge_w_orig_city_id.*, c_airp.city_id as c_airp_city_id
							from( select all_flights.*, o_airp.city_id as o_airp_city_id
							from( select dep.airport_departure as originating, dep.airport_destination as connecting, dest.airport_destination as destination, dep.duration as first_flight_time, dest.duration as second_flight_time, dep.departure_time as first_flight_dep_time, dest.departure_time as second_flight_dep_time, dep.days as first_flight_days, dest.days as second_flight_days, dep.id as first_flight_id, dest.id as second_flight_id from Flight dest
							LEFT OUTER JOIN Flight dep
							ON dep.airport_destination = dest.airport_departure
							where dest.airport_destination = '$destination' and dep.airport_departure = '$departure' and dep.days like '%$date%' and dest.days like '%$date%' ) all_flights
							LEFT OUTER JOIN Airport o_airp
							ON o_airp.code = all_flights.originating ) merge_w_orig_city_id
							LEFT OUTER JOIN Airport c_airp
							ON c_airp.code = merge_w_orig_city_id.connecting ) merge_w_connect_city_id
							LEFT OUTER JOIN Airport d_airp
							ON d_airp.code = merge_w_connect_city_id.destination ) merge_w_dest_city_id
							LEFT OUTER JOIN City org_city
							ON org_city.id = merge_w_dest_city_id.o_airp_city_id ) merge_w_utc_orig
							LEFT OUTER JOIN City con_city
							ON con_city.id = merge_w_utc_orig.c_airp_city_id ) merge_w_utc_con
							LEFT OUTER JOIN City dest_city
							ON dest_city.id = merge_w_utc_con.d_airp_city_id ) all_merged
							where ( ( ( TIME_TO_SEC(first_flight_dep_time) + (60 * first_flight_time) + (3600 * org_city_utc_offset) ) < ( TIME_TO_SEC(second_flight_dep_time) + (3600 * con_city_utc_offset ) ) )  ) ORDER by first_flight_time + second_flight_time LIMIT 100";

// ORDER by first_flight_time + second_flight_time LIMIT 100


			$results = $mysqli->query($sql);

			$flights;
			while($row=$results->fetch_assoc()){
		         $flights[] = $row;
		    }
		    $results->free();



		     return View::make('multi')->with('results', $flights)
										   ->with('deptCity', $deptCity)
										   ->with('arrivalCity', $arrivalCity);


		}
	}







}
