@extends('admin.layouts.admin')

@section('title', __('views.admin.users.index.title'))

@section('content')

    <div class="row">
        <div class="login_wrapper">
            <div class="animate form">
                <section class="login_content">
                    <form method="post" action="{{url('admin/addCaretaker')}}">
                    <h1>New Caretaker</h1>
                        {{csrf_field()}}
                    <div>
                        <input type="text" name="name" class="form-control"
                               placeholder="{{ __('views.auth.register.input_0') }}"
                               value="{{ old('name') }}" required autofocus/>
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control"
                               placeholder="{{ __('views.auth.register.input_1') }}"
                               required/>
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control"
                               placeholder="{{ __('views.auth.register.input_2') }}"
                               required=""/>
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="{{ __('views.auth.register.input_3') }}"
                               required/>
                    </div>

                    <div>
                        <button type="submit"
                                class="btn btn-default submit">Add
                        </button>
                    </div>

                    </form>
                </section>
            </div>
        </div>

    </div>
    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>@sortablelink('email', __('views.admin.users.index.table_header_0'),['page' =>
                    $users->currentPage()])
                </th>
                <th>@sortablelink('confirmed', __('views.admin.users.index.table_header_4'),['page' =>
                    $users->currentPage()])
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                @if($user->hasRole('caretaker') && $user->owner_id==auth()->user()->id)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->confirmed)
                                <span class="label label-success">{{ __('views.admin.users.index.confirmed') }}</span>
                            @else
                                <span class="label label-warning">{{ __('views.admin.users.index.not_confirmed') }}</span>
                            @endif</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', [$user->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.users.index.show') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', [$user->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.users.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            @if(!$user->hasRole('administrator'))
                                <a class="btn btn-xs btn-danger user_destroy"
                                        href="{{ route('admin.user.delete', [$user->id]) }}" data-toggle="tooltip"
                                        data-placement="top" data-title="{{ __('views.admin.users.index.delete') }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $users->links() }}
        </div>
    </div>
@endsection