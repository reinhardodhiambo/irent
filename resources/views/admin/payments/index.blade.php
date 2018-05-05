@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => 'Payment']))

@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add Payments
    </button>

    <div class="row">
        {{ Form::open(array('route' => array('admin.payments.search',Request::route('apartment_id')))) }}
        <div style="background: #878688;padding:2%; margin-bottom: 2%">
            <form><h5 style="color:black">Search</h5>
                {{--<div>
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
                </div>--}}
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

        {{ Form::close() }}

        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>House Number</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->house->house_number}}</td>
                    <td> @if($payment->status==0)<h4><span class="label label-warning">Unpaid</span></h4>
                        @else
                            <h4><span class="label label-success">Paid</span></h4>
                        @endif</td>
                    <td>{{ $payment->created_at}}</td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.payment.show', [$payment->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.users.index.show') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $payments->appends(\Request::except('page'))->render() !!}

        <div class="pull-right">
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">New Payment</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="login_wrapper">
                            <div class="animate form">
                                <section class="login_content">
                                    {{ Form::open(array('route' => array('admin.paymentstore',auth()->user()->id, $payments[0]->apartment_id), 'files' => true)) }}
                                    <form><h1>New Payment</h1>
                                        <div>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="name"
                                                   value="{{ old('name') }}" required autofocus/>
                                        </div>
                                        <div>
                                            <input type="text" name="description" class="form-control"
                                                   placeholder="description"
                                                   required/>
                                        </div>
                                        <div>
                                            <input type="text" name="amount" class="form-control"
                                                   placeholder="amount"
                                                   required/>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control" name="photos[]" multiple/>
                                        </div>
                                        <div>
                                            <button type="submit"
                                                    class="btn btn-default submit">Add
                                            </button>
                                        </div>
                                    </form>

                                    {{ Form::close() }}
                                </section>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
@endsection