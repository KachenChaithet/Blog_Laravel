@extends('admin.admin_master')
@section('allfeature')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">

            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Feature</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>title</th>
                                        <th>description</th>
                                        <th>icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($features as $key => $feature)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $feature->title }}</td>
                                            <td>{{ $feature->description }}</td>
                                            <td>{{ $feature->icon }}</td>
                                            <td>
                                                <a href="{{ route('edit.review', $feature->id) }}"
                                                    class="btn btn-success btn-sm">Edit</a>

                                                <form action="{{ route('delete.review', $feature->id) }}" method="POST"
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
