@extends('admin.admin_master')
@section('editreview')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Edit Review</h4>
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
                                                                <h4 class="card-title mb-0">Edit Review</h4>
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>


                                                    <form action="{{ route('update.review', $review->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="card-body">

                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Name</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text"
                                                                        name="name" id="name"
                                                                        value="{{ $review->name }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Position</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text"
                                                                        name="position" id="position"
                                                                        value="{{ $review->position }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Message</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <textarea class="form-control" name="message" id="message">{{ $review->message }}</textarea>

                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> User Photo</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="file"
                                                                        name="image" id="image">

                                                                </div>

                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <img id="showImage"
                                                                        src="{{ !empty($review->image) ? asset('uploads/reviews/' . $review->image) : asset('uploads/no_image.jpg') }}"
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
