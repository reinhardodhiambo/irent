<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\House;
use App\Models\Auth\User\User;
use App\UserHouse;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Entities\LogEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function get_apartment_details($apartment_id)
    {
        $occupied = 0;
        $vacant =0;
        $houses = House::with('UserHouse')->where('apartment_id', $apartment_id)->get();
        if ($houses) {
            foreach ($houses as $house) {
                $user_house = UserHouse::where('house_id',$house->id)->first();
                if($user_house)
                    $occupied++;
                else
                    $vacant++;
            }
        }

        return (object)['vacant'=>$vacant,'occupied'=>$occupied,'total'=>$vacant+$occupied];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counts = [
            'users' => \DB::table('users')->join('users_roles', 'users.id', '=', 'users_roles.user_id')->where('users_roles.user_id',3)->count(),
            'users_unconfirmed' => \DB::table('users')->join('users_roles', 'users.id', '=', 'users_roles.user_id')->where('confirmed', false)->count(),
            'users_inactive' => \DB::table('users')->join('users_roles', 'users.id', '=', 'users_roles.user_id')->where('active', false)->count(),
            'protected_pages' => 0,
        ];

        foreach (\Route::getRoutes() as $route) {
            foreach ($route->middleware() as $middleware) {
                if (preg_match("/protection/", $middleware, $matches)) $counts['protected_pages']++;
            }
        }

        $apartments = null;
        if(auth()->user()->hasRole('administrator')){
            $apartments = Apartment::with('houses')->where('owner_id',auth()->user()->id)->get();
            $apartments_array = [];
            foreach ($apartments as $apartment){
                $details = self::get_apartment_details($apartment->id);
                $apartments_array[] =[
                    'id'=>$apartment->id,
                    'name'=> $apartment->name,
                    'vacant'=>$details->vacant,
                    'occupied'=>$details->occupied,
                    'total_houses'=>$details->total,
                ];
            }
            $apartments = json_decode(json_encode($apartments_array), FALSE);
        }


        return view('admin.dashboard', ['counts' => $counts,'apartments' => $apartments]);
    }


    public function getLogChartData(Request $request)
    {
        \Validator::make($request->all(), [
            'start' => 'required|date|before_or_equal:now',
            'end' => 'required|date|after_or_equal:start',
        ])->validate();

        $start = new Carbon($request->get('start'));
        $end = new Carbon($request->get('end'));

        $dates = collect(\LogViewer::dates())->filter(function ($value, $key) use ($start, $end) {
            $value = new Carbon($value);
            return $value->timestamp >= $start->timestamp && $value->timestamp <= $end->timestamp;
        });


        $levels = \LogViewer::levels();

        $data = [];

        while ($start->diffInDays($end, false) >= 0) {

            foreach ($levels as $level) {
                $data[$level][$start->format('Y-m-d')] = 0;
            }

            if ($dates->contains($start->format('Y-m-d'))) {
                /** @var  $log Log */
                $logs = \LogViewer::get($start->format('Y-m-d'));

                /** @var  $log LogEntry */
                foreach ($logs->entries() as $log) {
                    $data[$log->level][$log->datetime->format($start->format('Y-m-d'))] += 1;
                }
            }

            $start->addDay();
        }

        return response($data);
    }

    public function getRegistrationChartData()
    {

        $data = [
            'registration_form' => User::whereDoesntHave('providers')->count(),
            'google' => User::whereHas('providers', function ($query) {
                $query->where('provider', 'google');
            })->count(),
            'facebook' => User::whereHas('providers', function ($query) {
                $query->where('provider', 'facebook');
            })->count(),
            'twitter' => User::whereHas('providers', function ($query) {
                $query->where('provider', 'twitter');
            })->count(),
        ];

       return response($data);
    }
}
