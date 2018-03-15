<?php

namespace App\Http\Controllers\Admin;

use App\Repair;
use Illuminate\Http\Request;

class RepairController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($apartment_id)
    {
        $repairs = Repair::with('apartment')->where('apartment_id','=',$apartment_id)->paginate(10);
        return view('admin.repairs.index', ['repairs' => $repairs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param $user_id
     * @param $apartment_id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$user_id,$apartment_id)
    {
        $repair = new Repair([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'user_id' => $user_id,
            'apartment_id' => $apartment_id
        ]);

        $repair->save();

        return redirect('/admin/repairs/'.$apartment_id.'/show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
