@extends('admin.admin_master')
@section('allfaqs')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">

            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Faqs</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>title</th>
                                        <th>description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($faqs as $key => $faq)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $faq->title }}</td>
                                            <td>{{ Str::limit($faq->description, 50, '...') }}</td>
                                            <td>
                                                <a href="{{ route('edit.faqs', $faq->id) }}"
                                                    class="btn btn-success btn-sm">Edit</a>

                                                <form action="{{ route('delete.faqs', $faq->id) }}" method="POST"
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
