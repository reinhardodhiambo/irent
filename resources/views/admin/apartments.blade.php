@extends('admin.layouts.admin')

@section('title', __('views.membership.title'))

@section('content')

    @if(auth()->user()->hasRole('administrator'))
    <div class="row">
        <div class="login_wrapper">
            <div class="animate form">
                <section class="login_content">
                    {{ Form::open(['route' => 'admin.apartmentstore']) }}
                    <form><h1>New Apartment</h1>
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
                            <input type="text" name="location" class="form-control"
                                   placeholder="location"
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
    @endif

    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>@sortablelink('name', 'Name',['page' => $apartments->currentPage()])</th>
                <th>@sortablelink('description', 'Description',['page' => $apartments->currentPage()])</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($apartments as $apartment)
                {{ $apartment->houses }}
                @if(array_search(auth()->user()->id,(array)$apartment->houses))
                <tr>
                    <td>{{ $apartment->id }}</td>
                    <td>{{ $apartment->name }}</td>
                    <td>{{ $apartment->description }}</td>
                    <td>{{ $apartment->location }}</td>
                    <td>

                        <a class="btn btn-xs btn-primary" href="{{ route('admin.apartments.show', [$apartment->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.users.index.show') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if(auth()->user()->hasRole('administrator'))
                            <a class="btn btn-xs btn-info" href="{{ route('admin.apartment.edit', [$apartment->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.users.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-danger"
                               href="{{ route('admin.apartments.delete', [$apartment->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="delete">
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
            {{ $apartments->links() }}
        </div>
    </div>
@endsection
