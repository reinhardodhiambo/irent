@extends('admin.layouts.admin')

@section('title',__('views.admin.users.edit.title', ['name' => $apartment->name]) )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route'=>['admin.apartments.update', $apartment->id],'method' => 'put','class'=>'form-horizontal form-label-left']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                   Name
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('name')) parsley-error @endif"
                           name="name" value="{{ $apartment->name }}" required>
                    @if($errors->has('name'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('name') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    Description
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="description" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('description')) parsley-error @endif"
                           name="description" value="{{ $apartment->description }}" required>
                    @if($errors->has('description'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('description') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">
                    Location
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="location" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('location')) parsley-error @endif"
                           name="location" value="{{ $apartment->location }}" required>
                    @if($errors->has('location'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('location') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary"
                       href="{{ URL::previous() }}"> Cancel</a>
                    <button type="submit" class="btn btn-success"> Save</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/users/edit.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/users/edit.js')) }}
@endsection