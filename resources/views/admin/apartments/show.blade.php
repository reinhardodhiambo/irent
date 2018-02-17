@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => $apartment->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>

            <tr>
                <th>Name</th>
                <td>{{ $apartment->name }}</td>
            </tr>

            <tr>
                <th>Description</th>
                <td>
                    {{$apartment->description}}
                </td>
            </tr>
            <tr>
                <th>Location</th>
                <td>
                    {{ $apartment->location}}
                </td>
            </tr>

            <tr>
                <th>Created At</th>
                <td>{{ $apartment->created_at }} ({{ $apartment->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>Update At</th>
                <td>{{ $apartment->updated_at }} ({{ $apartment->updated_at->diffForHumans() }})</td>
            </tr>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add House
    </button>


    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>House No.</th>
                <th>Bedrooms</th>
                <th>Kitchen</th>
                <th>Bathroom</th>
                <th>Restroom</th>
                <th>Balcony</th>
                <th>Floor</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($apartment->houses as $house)
                <tr>
                    <td>{{ $house->house_number }}</td>
                    <td>{{ $house->bedroom }}</td>
                    <td>{{ $house->kitchen }}</td>
                    <td>{{ $house->bathroom }}</td>
                    <td>{{ $house->toilet }}</td>
                    <td>{{ $house->balcony }}</td>
                    <td>{{ $house->floor }}</td>
                    <td>

                        <a class="btn btn-xs btn-primary" href="{{ route('admin.houses.show', [$house->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.users.index.show') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.apartment.edit', [$house->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.users.index.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" href="{{ route('admin.houses.delete', [$house->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="delete">
                            <i class="fa fa-trash"></i>
                        </a>
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
                    <h4 class="modal-title" id="myModalLabel">New House</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="login_wrapper">
                            <div class="animate form">
                                <section class="login_content">
                                    {{ Form::open(['url' => 'admin/housestore/'.$apartment->id,'method'=>'post']) }}
                                    <form><h1>House</h1>
                                        <div>
                                            <input type="text" name="house_number" class="form-control"
                                                   placeholder="House number"
                                                   value="{{ old('house_number') }}" required autofocus/>
                                        </div>
                                        <div><select class="select2_group form-control" id="bedroom" name="bedroom">
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
                                        </select></div>
                                        <div>
                                            <select id="kitchen" name="kitchen" class="form-control" required="">
                                                <option value="">select type of kitchen</option>
                                                <option value="1">American Kitchen</option>
                                                <option value="2">British Kitchen</option>
                                            </select>
                                        </div>
                                        <div>
                                            <select id="bathroom" name="bathroom" class="form-control" required="">
                                                <option value="">number of bathroom</option>
                                                <option value="1">1 bathroom</option>
                                                <option value="2">2 bathrooms</option>
                                                <option value="3">3 bathrooms</option>
                                                <option value="4">4 bathrooms</option>
                                                <option value="5">5 bathrooms</option>
                                                <option value="6">6 bathrooms</option>
                                            </select>
                                        </div>

                                        <div>
                                            <select id="toilet" name="toilet" class="form-control" required="">
                                                <option value="">number of toilet</option>
                                                <option value="1">1 toilet</option>
                                                <option value="2">2 toilets</option>
                                                <option value="3">3 toilets</option>
                                                <option value="4">4 toilets</option>
                                                <option value="5">5 toilets</option>
                                                <option value="6">6 toilets</option>
                                            </select>
                                        </div>
                                        <div>
                                            <select id="balcony" name="balcony" class="form-control" required="">
                                                <option value="">number of balcony</option>
                                                <option value="0">none</option>
                                                <option value="1">1 balcony</option>
                                                <option value="2">2 balconies</option>
                                            </select>
                                        </div>
                                        <div>
                                            <select id="floor" name="floor" class="form-control" required="">
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
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                            </button>
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