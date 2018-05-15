@extends('admin.layouts.admin')

@section('title', 'KRA')

@section('content')

    <div class="row">
        {{--{{ Form::open(array('route' => array('admin.payments.search',Request::route('apartment_id')))) }}
        <div style="background: #878688;padding:2%; margin-bottom: 2%">
            <form><h5 style="color:black">Search</h5>
                --}}{{--<div>
                    <input type="text" name="house_number" class="form-control"
                           placeholder="House Number"
                            autofocus/>
                </div>
                <div style="margin-bottom: 2%">
                    <label style="color:black">
                        <input name="status" type="radio" value=0>Paid
                    </label>
                    <label style="color:black">
                        <input name="status" type="radio" value=1>Unpaid
                    </label>
                </div>--}}{{--
                <div style="margin-bottom: 2%">
                    <input type="text" name="date" class="form-control"
                           placeholder="Date"
                    />
                </div>
                <div>
                    <button type="submit"
                            class="btn btn-default submit">Search
                    </button>
                </div>
            </form>
        </div>

        {{ Form::close() }}--}}

        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Status</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Tax</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td> @if($payment->status==0)<h4><span class="label label-warning">Unpaid</span></h4>
                        @else
                            <h4><span class="label label-success">Paid</span></h4>
                        @endif</td>
                    <td>{{ $payment->created_at}}</td>
                    <td>{{ $payment->amount}}</td>
                    <td>{{ $payment->tax}}</td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.payment.show', [$payment->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.users.index.show') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <th>TOTAL</th>
                <th>{{$total_amount}}</th>
                <th>{{$total_tax}}</th>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div class="pull-right">
        </div>
    </div>
@endsection