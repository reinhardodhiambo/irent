<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\House;
use App\Models\Auth\User\User;
use App\UserHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController
{
    public function index(Request $request)
    {
        $apartments = Apartment::with('houses', 'houses.UserHouse')->where('owner_id', '!=', '')->paginate(10);
        //$apartments = Apartment::with('houses', 'houses.UserHouse')->paginate();
        return view('admin.apartments', ['apartments' => $apartments]);
    }

    public function repeat(Apartment $apartment, Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createApartments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apartment = new Apartment([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'owner_id' => auth()->user()->id,
            'location' => $request->get('location'),
        ]);

        $apartment->save();

        return redirect('/admin/apartments');
    }

    /**
     * Display the specified resource.
     *
     * @param Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', ['apartment' => $apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit($apartment)
    {
        $apartment = Apartment::with('houses')->whereIn('id', $apartment);

        return view('admin.apartments.edit', compact('apartment', 'id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
    ID	Name 	Description 	Location	Actions
     * 1    Siwaka    Hostel    Keri Road    ￼
     * 2    cxzc    xczxc    xczxczxczxc    ￼
     * 3    xc\    \x    \xc    ￼
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $apartment = Apartment::find($id);
        $apartment->name = $request->get('name');
        $apartment->description = $request->get('description');
        $apartment->location = $request->get('location');
        $apartment->save();

        return redirect('/admin/apartments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        $apartment->delete();

        return redirect('/admin/apartments');
    }


    public static function getUserApartments($apartment_id, $user_id)
    {
        $houses = House::with('UserHouse')->where('apartment_id', $apartment_id)->get();
        if ($houses) {
            foreach ($houses as $house) {
                $user_house = UserHouse::where('user_id',$user_id)->where('house_id',$house->id)->first();
                if($user_house)
                   return true;
            }
        }else
        return false;

    }
}
