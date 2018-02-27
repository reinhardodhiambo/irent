@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => $house->house_number]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>

            <tr>
                <th>House Number</th>
                <td>{{ $house->house_number }}</td>
            </tr>

            <tr>
                <th>Bedroom</th>
                <td>
                    {{$house->bedroom}}
                </td>
            </tr>
            <tr>
                <th>Bathroom</th>
                <td>
                    {{ $house->bathroom}}
                </td>
            </tr>
            <tr>
                <th>Kitchen</th>
                <td>
                    {{ $house->kitchen}}
                </td>
            </tr>
            <tr>
                <th>Restroom</th>
                <td>
                    {{ $house->toilet}}
                </td>
            </tr>
            <tr>
                <th>Balcony</th>
                <td>
                    {{ $house->balcony}}
                </td>
            </tr>
            <tr>
                <th>Floor</th>
                <td>
                    {{ $house->floor}}
                </td>
            </tr>

            <tr>
                <th>Price</th>
                <td>
                    {{ $house->price}}
                </td>
            </tr>

            <tr>
                <th>Created At</th>
                <td>{{ $house->created_at }} ({{ $house->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>Update At</th>
                <td>{{ $house->updated_at }} ({{ $house->updated_at->diffForHumans() }})</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection