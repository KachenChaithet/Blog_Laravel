@extends('admin.admin_master')
@section('editpost')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Edit Blog Post</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="tab-content text-muted bg-white ">


                                <div class="tab-pane pt-4 active show " id="profile_setting" role="tabpanel"
                                    aria-labelledby="setting_tab">
                                    <div class="row">

                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card border mb-0">

                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title mb-0">Edit Blog Post</h4>
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>


                                                    <form id="postForm" action="{{ route('update.blog.post', $post->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="card-body">

                                                            <div class="form-group mb-3 row">
                                                                <label for="example-select" class="form-label">Blog
                                                                    Category</label>
                                                                <div class="col-lg-12 col-xl-12">

                                                                    <select name="blogcat_id" class="form-select"
                                                                        id="example-select">

                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}"
                                                                                {{ $post->blogcat_id == $category->id ? 'selected' : '' }}>
                                                                                {{ $category->category_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label">Post Title</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text"
                                                                        name="post_title" id="title"
                                                                        value="{{ $post->post_title }}">
                                                                </div>
                                                            </div>


                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label">Post Description</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input name="long_desrp" id="description"
                                                                        type="hidden" />
                                                                    <div id="quill-editor" style="height: 200px;">
                                                                        {!! $post->long_desrp !!}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Post Image</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="file"
                                                                        name="image" id="image">

                                                                </div>

                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <img id="showImage"
                                                                        src="{{ !empty($post->image) ? asset('uploads/post/' . $post->image) : asset('uploads/no_image.jpg') }}"
                                                                        class="rounded-circle avatar-xxl img-thumbnail float-start"
                                                                        alt=" image " />
                                                                </div>

                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                Change</button>





                                                        </div>
                                                    </form><!--end card-body-->


                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </div> <!-- end education -->

                            </div> <!-- Tab panes -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const form = document.getElementById('postForm');


        form.addEventListener('submit', function() {
            document.getElementById('description').value = quill.root.innerHTML;
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
