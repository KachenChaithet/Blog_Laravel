@extends('admin.admin_master')
@section('allreview')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">

            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Review</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($reviews as $key => $review)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $review->name }}</td>
                                            <td>{{ $review->position }}</td>
                                            <td><img src="{{ asset('uploads/' . $review->image) }}" alt=""
                                                    style="width: 70px; height: 40px;"></td>
                                            <td>{{ $review->message }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm">Edit</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
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
