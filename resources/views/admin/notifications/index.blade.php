@extends('admin.layouts.admin')

@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add Notification
    </button>

    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>User</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <td>{{ $notification->user_name }}</td>
                    <td>{{ $notification->message }}</td>
                    @if($notification->user_id==auth()->user()->id)
                        <td><span class="label label-success">Read</span></td>
                    @else
                        <td><span class="label label-warning">Unread</span></td>
                    @endif
                    <td>

                        <a class="btn btn-xs btn-primary" href="{{--{{ route('admin.repair.show', [$repair->id]) }}--}}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.users.index.show') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if(auth()->user()->hasRole('administrator'))
                            <a class="btn btn-xs btn-info" href="{{--{{ route('admin.house.edit', [$repair->id]) }}--}}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.users.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-danger"
                               href="{{--{{ route('admin.houses.delete', [$repair->id]) }}--}}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="pull-right">
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">New Notification</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="login_wrapper">
                            <div class="animate form">
                                <section class="login_content">
                                    {{ Form::open(array('route' => array('admin.notificationstore',auth()->user()->id,Request::route('apartment')))) }}
                                    <form><h1>New Notification</h1>
                                        <div>
                                            <input type="text" name="message" class="form-control"
                                                   placeholder="message"
                                                   required/>
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