@extends('admin.admin_master')
@section('allteam')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">

            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Team</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($teams as $key => $team)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $team->name }}</td>
                                            <td>{{ $team->position }}</td>
                                            <td><img src="{{ !empty($team->image) ? asset('uploads/teams/' . $team->image) : asset('uploads/no_image.jpg') }}  "
                                                    alt="" style="width: 70px; height: 40px;"></td>
                                            <td>
                                                <a href="{{ route('edit.team', $team->id) }}"
                                                    class="btn btn-success btn-sm">Edit</a>

                                                <form action="{{ route('delete.team', $team->id) }}" method="POST"
                                                    class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm show-confirm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
