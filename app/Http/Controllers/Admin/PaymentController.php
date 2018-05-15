<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Payment;
use App\PaymentPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($apartment_id)
    {
        $payments = Payment::with('apartment', 'house')->where('apartment_id', $apartment_id)->sortable()->paginate();
        return view('admin.payments.index', ['payments' => $payments,'apartment_id'=>$apartment_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $user_id, $apartment_id)
    {
        $payment = new Payment([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'amount' => $request->get('amount'),
            'user_id' => $user_id,
            'house_id' => 5,
            'method' => 0,
            'apartment_id' => $apartment_id
        ]);

        $payment->save();

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

                    $payment_photo = new PaymentPhoto([

                        'payment_id' => $payment->id,

                        'filename' => $filename

                    ]);
                    $payment_photo->save();


                    echo "Upload Successfully";

                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';

                }

            }
        }

        return redirect('/admin/payments/' . $apartment_id . '/show');
    }

    public function searchPayment(Request $request, $apartment_id)
    {

        $house_number = Input::get('house_number');
        $date = Input::get('date');
        $status = Input::get('status');
        if (isset($house_number)) {
            $payments = Payment::with('apartment', 'house')->where('house.house_number', 'LIKE', "%$request->house_number%")->where('apartment_id', $apartment_id)->sortable()->paginate();
        } elseif (isset($date)) {
            $payments = Payment::with('apartment', 'house')->where('created_at', 'LIKE', "%$request->date%")->where('apartment_id', $apartment_id)->sortable()->paginate();
        } elseif (isset($status)) {


        } else {
            $payments = Payment::with('apartment', 'house')->where('apartment_id', $apartment_id)->sortable()->paginate();
        }
        return view('admin.payments.index', ['payments' => $payments]);
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
     * @param Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $photos = PaymentPhoto::where('payment_id', $payment->id)->get();
        return view('admin.payments.show', ['payment' => $payment, 'photos' => $photos]);
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
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function changeStatus($id)
    {
        $payment = Payment::where('id', $id)->first();
        if ($payment->status == 0)
            $payment->status = 1;
        else
            $payment->status = 0;
        $payment->save();
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    public function kra()
    {
        $payments_array = [];
        $payments = null;
        $apartments = Apartment::where('owner_id', auth()->user()->id)->get();
        $total_amount = 0.00;
        $total_tax = 0.00;
        foreach ($apartments as $apartment) {
            $paym = Payment::where('apartment_id', $apartment->id)->get();
            foreach ($paym as $pay) {
                $pay->{"tax"} = ($pay->amount) * 0.10;
                $total_amount = $total_amount + $pay->amount;
                $total_tax = $total_tax + ($pay->amount) * 0.10;
                $payments_array[] = $pay;
            }
        }
        $payments = json_decode(json_encode($payments_array, FALSE));

        return view('admin.kra.index', ['payments' => $payments, 'total_tax'=>$total_tax, 'total_amount'=>$total_amount]);


    }
}
