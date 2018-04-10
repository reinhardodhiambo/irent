@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => $repair->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>

            <tr>
                <th>Name</th>
                <td>{{ $repair->name }}</td>
            </tr>

            <tr>
                <th>Description</th>
                <td>
                    {{$repair->description}}
                </td>
            </tr>

            <tr>
                <th>Photos</th>
                <td>
                    @foreach($photos as $photo)
                       <img style="max-height: 400px; max-width: 400px;" src={{asset("$photo->filename")}}>
                    @endforeach

                </td>
            </tr>

            <tr>
                <th>Created At</th>
                <td>{{ $repair->created_at }} ({{ $repair->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>Update At</th>
                <td>{{ $repair->updated_at }} ({{ $repair->updated_at->diffForHumans() }})</td>
            </tr>
            </tbody>
        </table>
    </div>



    <div class="modal fade bs-example-modal-lk" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Tenant</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="login_wrapper">
                            <div class="animate form">
                                <section class="login_content">
                                    {{ Form::open(array('route' => array('admin.house.rent',Request::route('house')))) }}
                                    <form><h1>Rent</h1>
                                        <div>
                                            <input type="text" name="national_id" class="form-control"
                                                   placeholder="national_id"
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