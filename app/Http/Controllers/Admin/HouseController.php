<?php

namespace App\Http\Controllers\Admin;

use App\House;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;
use App\UserHouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\Auth\ContractEmail;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($apartment_id)
    {
        $houses = House::where('apartment_id', id)->with('user_house','user_house.user')->paginate();

        return $houses;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param $apartment_id
     * @return House
     */
    public function create(Request $request, $apartment_id)
    {
        $house = new House;
        $house->house_number = $request->house_number;
        $house->apartment_id = $apartment_id;
        $house->bedroom = $request->bedroom;
        $house->kitchen = $request->kitchen;
        $house->bathroom = $request->bathroom;
        $house->floor = $request->floor;
        $house->toilet = $request->toilet;
        $house->balcony = $request->balcony;
        $house->price = str_replace(',','',$request->price);
        $house->save();

        return back()->withInput();
        // return redirect('apartments/'.$apartment_id.'/show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param House $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $kitchen = ['','American Kitchen','British Kitchen'];
        return view('admin.houses.show', ['house' => $house,'kitchen'=>$kitchen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $house
     * @return \Illuminate\Http\Response
     */
    public function edit($house)
    {
        $house = House::where('id', $house)->first();

        return view('admin.houses.edit', compact('house', 'id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $house = House::find($id);
        $house->house_number = $request->house_number;
        $house->bedroom = $request->bedroom;
        $house->kitchen = $request->kitchen;
        $house->bathroom = $request->bathroom;
        $house->floor = $request->floor;
        $house->toilet = $request->toilet;
        $house->balcony = $request->balcony;
        $house->price = $request->price;
        $house->save();

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::find($id);
        $house->delete();

        return back()->withInput();


    }

    /**
     * @param $house_id
     * @param Request $request
     * @return string
     */
    public function rentUser($house_id, Request $request)
    {

        $user = User::where('national_id', $request->national_id)->first();

        if ($user) {

            $user_house = UserHouse::firstOrCreate(['user_id' => $user->id, 'house_id' => $house_id]);

            if ($user_house) {
                $user->notify(new ContractEmail());
                return back()->withInput();
            } 
                return json_encode(["error" => 403, "message" => "user not found"]);


        }

        return json_encode(["error" => 403, "message" => "user not found"]);

    }

    public function terminate($house_id){
        $userHouse = UserHouse::where('house_id',$house_id)->where('user_id','!=',0)->first();
        if($userHouse){
            //$user_house = DB::statement("UPDATE user_house SET user_id = 0,updated_at = '".Carbon::now()."' where user_id =".$user_id." AND house_id=".$house_id);
            $userHouse->user_id = 0;
            $userHouse->save();

        }
        return back()->withInput();
    }

    public static function getUserHouses($house_id, $user_id)
    {
        $user_house = UserHouse::where('user_id',$user_id)->where('house_id',$house_id)->first();
        if($user_house)
            return true;
        else return false;

    }


}
