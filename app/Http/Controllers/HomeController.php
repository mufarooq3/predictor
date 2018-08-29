<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Make;
use App\dimModel;
use App\State;
use App\Year;
use App\Badge;
use App\BodyType;
use App\Fuel;

class HomeController extends Controller
{
    public function index(){
    	$makes=Make::all();
    	$models=dimModel::all();
    	$states=State::all();
    	$years=Year::all();
    	$badges=Badge::all();
    	$bodyTypes=BodyType::all();
    	$fuels=Fuel::all();
//    	dd($makes, $models, $states, $bodyTypes, $fuels);
        return view('home')
            ->with('makes', $makes)
            ->with('models', $models)
            ->with('states', $states)
            ->with('years', $years)
            ->with('badges', $badges)
            ->with('bodyTypes', $bodyTypes)
            ->with('fuels', $fuels);
    }

    public function predict(Request $request){
        $make=Make::where('make', $request->make)->first()->make_id;
        $model=dimModel::where('model', $request->model)->first()->model_id;
        $fuel=Fuel::where('fuel_type', $request->fuel)->first()->fuel_type_id;
        $bodyType=BodyType::where('body_type', $request->bodyType)->first()->body_type_id;
        $state=State::where('state', $request->state)->first()->state_id;
        $badge=$request->badge;
        $year=$request->year;
        $km=$request->km;

//        dd($make, $model, $fuel, $bodyType, $state, $badge, $year, $km);

    	$message=$make.'#'.$model.'#'.$fuel.'#'.$bodyType.'#'.$state.'#'.$badge.'#'.$year.'#'.$km;
    	// $path=app_path().'/predictor/predict.py';
    	// $cmd=$path.' '.$argv;
    	// dd(exec($cmd));
     //    dd($request);
    	$host    = "127.0.0.1";
		$port    = 44444;
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		// connect to server
		$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
		// send string to server
		socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
		// get server response
		$result = socket_read ($socket, 1024) or die("Could not read server response\n");
//		echo "Reply From Server  :".$result;
		// close socket
		socket_close($socket);

		return $result;
    }
}
