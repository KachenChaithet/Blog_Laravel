@extends('admin.admin_master')
@section('allpost')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">

            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Post</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Titlte</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($posts as $key => $post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            
                                            <td>{{ $post->post_title }}</td>
                                            <td>{{ $post->blog?->category_name }}</td>
                                            <td><img src="{{ !empty($post->image) ? asset('uploads/post/' . $post->image) : asset('uploads/no_image.jpg') }}  "
                                                    alt="" style="width: 70px; height: 40px;"></td>
                                            <td>{!! Str::limit($post->long_desrp, 50, '...') !!}</td>
                                            <td>
                                                <a href="{{ route('edit.blog.post', $post->id) }}"
                                                    class="btn btn-success btn-sm">Edit</a>

                                                <form action="{{ route('delete.blog.post', $post->id) }}" method="POST"
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
