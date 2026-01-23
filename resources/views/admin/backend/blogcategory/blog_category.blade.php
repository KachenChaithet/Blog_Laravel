@extends('admin.admin_master')
@section('blogcategory')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">
                    Add Blog Category
                </button>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Blog category</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Category Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categorys as $key => $category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->category_slug }}</td>
                                            <td>

                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#category" id="{{ $category->id }}"
                                                    onclick="categoryEdit(this.id)">
                                                    Edit
                                                </button>

                                                <form action="{{ route('delete.blog.category', $category->id) }}" method="POST"
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
    {{-- add modal --}}
    <div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="standard-modalLabel">Blog Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.blog.category') }}" method="POST">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-lable">Blog Category Name</label>
                            <input type="text" name="category_name" id="input1" class="form-control">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit category modal --}}
    <div class="modal fade" id="category" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="standard-modalLabel">Edit Blog Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('update.blog.category') }}" method="POST">
                    @csrf
                    <input id="cat_id" name="cat_id" type="hidden">
                    <div class="modal-body">

                        <div class="form-group col-md-12">
                            <label for="cat" class="form-lable">Blog Category Name</label>
                            <input type="text" name="category_name" id="cat" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function categoryEdit(id) {
            $.ajax({
                type: 'GET',
                url: '/edit/blog/category/' + id,
                dataType: 'json',

                success: function(data) {
                    console.log(data);
                    $('#cat').val(data.category_name);
                    $('#cat_id').val(data.id);
                }
            })

        }
    </script>
@endsection
