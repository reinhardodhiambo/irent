<?php

namespace App\Http\Controllers\Admin;

use App\Repair;
use App\RepairPhoto;
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
        $repairs = Repair::with('apartment')->where('apartment_id', '=', $apartment_id)->get();
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
    public function create(Request $request, $user_id, $apartment_id)
    {
        /*$this->validate($request, [

            'name' => 'required',

            'description' => 'required',

            'photos'=>'required',

        ]);*/
        $repair = new Repair([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'user_id' => $user_id,
            'apartment_id' => $apartment_id
        ]);
        $repair->save();

        if ($request->hasFile('photos')) {

            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];

            $files = $request->file('photos');

            foreach ($files as $key => $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

                if ($check) {

                    $photo = $request->photos;

                    $filename = $photo[$key]->store('photos');

                    $repair_photo = new RepairPhoto([

                        'repair_id' => $repair->id,

                        'filename' => $filename

                    ]);

                    $repair_photo->save();


                    echo "Upload Successfully";

                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';

                }

            }
        }

        return redirect('/admin/repairs/' . $apartment_id . '/show');
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
     * @param Repair $repair
     * @return \Illuminate\Http\Response
     */
    public function show(Repair $repair)
    {
        $photos = RepairPhoto::where('repair_id', $repair->id)->get();
        return view('admin.repairs.show', ['repair' => $repair, 'photos' => $photos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
