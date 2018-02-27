@extends('admin.layouts.admin')

@section('title',__('views.admin.users.edit.title', ['name' => $house->house_number]) )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route'=>['admin.houses.update', $house->id],'method' => 'put','class'=>'form-horizontal form-label-left']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="house_number">
                   House Number
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="house_number" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('house_number')) parsley-error @endif"
                           name="house_number" value="{{ $house->house_number }}" required>
                    @if($errors->has('house_number'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('house_number') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bedroom">
                    Bedrooms
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_group form-control col-md-7 col-xs-12 @if($errors->has('bedroom')) parsley-error @endif"
                            id="bedroom" name="bedroom" value="{{$house->bedroom}}">
                        <optgroup label="Not Ensuit">
                            <option value="1">1 bedroom</option>
                            <option value="2">2 bedrooms</option>
                        </optgroup>
                        <optgroup label="All Ensuit">
                            <option value="3">1 bedroom</option>
                            <option value="4">2 bedrooms</option>
                            <option value="5">3 bedrooms</option>
                            <option value="6">4 bedrooms</option>
                            <option value="7">5 bedrooms</option>
                        </optgroup>
                        <optgroup label="Not all Ensuit">
                            <option value="8">2 bedrooms & 1 ensuit</option>
                            <option value="9">3 bedrooms & 1 ensuit</option>
                            <option value="10">4 bedrooms & 1 ensuit</option>
                            <option value="11">5 bedrooms & 1 ensuit</option>
                        </optgroup>
                    </select>
                    @if($errors->has('bedroom'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('bedroom') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bathroom">
                    Bathroom
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-7 col-xs-12 @if($errors->has('bathroom')) parsley-error @endif"
                            id="bathroom" name="bathroom" value="{{$house->bathroom}}">
                        <option value="">number of bathroom</option>
                        <option value="1">1 bathroom</option>
                        <option value="2">2 bathrooms</option>
                        <option value="3">3 bathrooms</option>
                        <option value="4">4 bathrooms</option>
                        <option value="5">5 bathrooms</option>
                        <option value="6">6 bathrooms</option>
                    </select>
                    @if($errors->has('bathroom'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('bathroom') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="toilet">
                    Toilet
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-7 col-xs-12 @if($errors->has('toilet')) parsley-error @endif"
                            id="toilet" name="toilet" value="{{$house->toilet}}">
                        <option value="">number of toilet</option>
                        <option value="1">1 toilet</option>
                        <option value="2">2 toilets</option>
                        <option value="3">3 toilets</option>
                        <option value="4">4 toilets</option>
                        <option value="5">5 toilets</option>
                        <option value="6">6 toilets</option>
                    </select>
                    @if($errors->has('toilet'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('toilet') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kitchen">
                    Kitchen
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="kitchen" name="kitchen" class="form-control col-md-7 col-xs-12 @if($errors->has('kitchen')) parsley-error @endif" value="{{$house->kitchen}}" required="">
                        <option value="">select type of kitchen</option>
                        <option value="1">American Kitchen</option>
                        <option value="2">British Kitchen</option>
                    </select>
                    @if($errors->has('kitchen'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('kitchen') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="balcony">
                    Balcony
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_group form-control col-md-7 col-xs-12 @if($errors->has('balcony')) parsley-error @endif"
                            id="balcony" name="balcony" value="{{$house->balcony}}">
                        <option value="">number of balcony</option>
                        <option value="0">none</option>
                        <option value="1">1 balcony</option>
                        <option value="2">2 balconies</option>
                    </select>
                    @if($errors->has('balcony'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('balcony') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="floor">
                    Floor
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_group form-control col-md-7 col-xs-12 @if($errors->has('floor')) parsley-error @endif"
                            id="floor" name="floor" value="{{$house->floor}}">
                        <option value="">floor number</option>
                        <option value="1">1st floor</option>
                        <option value="2">2nd floor</option>
                        <option value="3">3rd floor</option>
                        <option value="4">4th floor</option>
                        <option value="5">5th floor</option>
                        <option value="6">6th floor</option>
                        <option value="7">7th floor</option>
                        <option value="8">8th floor</option>
                    </select>
                    @if($errors->has('floor'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('floor') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">
                    Monthly Price
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="price" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('price')) parsley-error @endif"
                           name="price" value="{{ $house->price }}" required>
                    @if($errors->has('price'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('price') as $error)
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