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
            'users' => \DB::table('users')->where('owner_id',auth()->user()->id)->get()->count(),
            'users_unconfirmed' => \DB::table('users')->join('users_roles', 'users.id', '=', 'users_roles.user_id')->where('owner_id',auth()->user()->id)->where('confirmed', false)->count(),
            'users_inactive' => \DB::table('users')->join('users_roles', 'users.id', '=', 'users_roles.user_id')->where('owner_id',auth()->user()->id)->where('active', false)->count(),
            'apartments' => \DB::table('apartments')->where('owner_id','=',auth()->user()->id)->get()->count()
        ];

        foreach (\Route::getRoutes() as $route) {
            foreach ($route->middleware() as $middleware) {
                //if (preg_match("/protection/", $middleware, $matches)) $counts['protected_pages']++;
            }
        }

        $apartments = null;
        $charts = null;
        if(auth()->user()->hasRole('administrator')){
            $apartments = Apartment::with('houses')->where('owner_id',auth()->user()->id)->get();
            $apartments_array = [];
            $chartsa = [];
            foreach ($apartments as $apartment){
                $details = self::get_apartment_details($apartment->id);
                $rate = self::get_rates($apartment->id);
                $chartsa [] = app()->chartjs
                    ->name('chart'.$apartment->id)
                    ->type('bar')
                    ->size(['width' => 400, 'height' => 200])
                    ->labels(['January', 'February','March', 'April','May','June',
                        'July','August','September','October','November','December'])
                    ->datasets([
                        [
                            "label" => "House Uptake",
                            'backgroundColor' => ['rgba(230, 100, 235, 0.9)', 'rgba(230, 100, 235, 0.9)','rgba(230, 100, 235, 0.9)', 'rgba(230, 100, 235, 0.9)','rgba(230, 100, 235, 0.9)', 'rgba(230, 100, 235, 0.9)','rgba(230, 100, 235, 0.9)', 'rgba(230, 100, 235, 0.9)','rgba(230, 100, 235, 0.9)', 'rgba(230, 100, 235, 0.9)','rgba(230, 100, 235, 0.9)', 'rgba(230, 100, 235, 0.9)'],
                            'data' =>$rate[0]
                        ],
                        [
                            "label" => "Vacation",
                            'backgroundColor' => ['rgba(54, 200, 235, 0.9)', 'rgba(54, 200, 235, 0.9)','rgba(54, 200, 235, 0.9)', 'rgba(54, 200, 235, 0.9)','rgba(54, 200, 235, 0.9)', 'rgba(54, 200, 235, 0.9)','rgba(54, 200, 235, 0.9)', 'rgba(54, 200, 235, 0.9)','rgba(54, 200, 235, 0.9)', 'rgba(54, 200, 235, 0.9)','rgba(54, 200, 235, 0.9)', 'rgba(54, 200, 235, 0.9)'],
                            'data' => $rate[1]
                        ]
                    ])
                    ->options([]);
                $apartments_array[] =[
                    'id'=>$apartment->id,
                    'name'=> $apartment->name,
                    'vacant'=>$details->vacant,
                    'occupied'=>$details->occupied,
                    'total_houses'=>$details->total,
                ];
            }
            $apartments = json_decode(json_encode($apartments_array), FALSE);
            $charts = $chartsa;
        }


        return view('admin.dashboard', ['counts' => $counts,'apartments' => $apartments, 'charts'=>$charts]);
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


    /**
     * @param $apartemnt_id
     */
    public function get_rates($apartemnt_id){
        $houses = House::where('apartment_id', $apartemnt_id)->get();
        $month=['January', 'February','March', 'April','May','June',
                        'July','August','September','October','November','December'];
        $uptake = [];
        $vacation = [];
        $houzes = [];
        for ($months=1; $months<13; $months++) {
            $new_tenants = 0;
            $vacating_tenants = 0;
            foreach ($houses as $house) {
                $userHouses = UserHouse::where('house_id', $house->id)->get();
                foreach ($userHouses as $userHouse) {
                    if($userHouse->updated_at->month==$months){
                        $new_tenants++;
                        //if(array_search($userHouse->house_id,$houzes)){
                        if($userHouse->user_id==0){
                            $vacating_tenants++;
                        }
                    }
                    $houzes [] = $house-> id;
                }
            }
            $uptake_rate = 0;
            $vacation_rate = 0;
            if(count($houses)>0) {
                $uptake_rate = (($new_tenants / count($houses)) * 100);
                $vacation_rate = (($vacating_tenants / count($houses)) * 100);
            }

            $uptake[] = $uptake_rate;
            $vacation[] = $vacation_rate;
        }

        return [0=>$uptake,1=>$vacation];
    }
}
