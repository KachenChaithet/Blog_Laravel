@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Profile</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ !empty($profileData->photo) ? asset('uploads/' . $profileData->photo) : asset('uploads/no_image.jpg') }}"
                                        class="rounded-circle avatar-xxl img-thumbnail float-start"
                                        alt="{{ $profileData->photo ?? 'image' }}" />

                                    <div class="overflow-hidden ms-4">
                                        <h4 class="m-0 text-dark fs-20">{{ $profileData->name }}</h4>
                                        <p class="my-1 text-muted fs-16">{{ $profileData->email }}</p>

                                    </div>
                                </div>
                            </div>



                            <div class="tab-content text-muted bg-white">


                                <div class="tab-pane pt-4 active show" id="profile_setting" role="tabpanel"
                                    aria-labelledby="setting_tab">
                                    <div class="row">

                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card border mb-0">

                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title mb-0">Personal Information</h4>
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>

                                                    {{-- form change profile --}}
                                                    <form action="{{ route('profile.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="card-body">

                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Name</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text"
                                                                        name="name" id="name"
                                                                        value="{{ $profileData->name }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Email</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="email"
                                                                        name="email" id="email"
                                                                        value="{{ $profileData->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Phone</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text"
                                                                        name="phone" id="phone"
                                                                        value="{{ $profileData->phone }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Address</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <textarea class="form-control" name="address" id="address">{{ $profileData->address }}</textarea>

                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label"> Profile Photo</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="file"
                                                                        name="photo" id="photo" />

                                                                </div>

                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <img id="showPhoto"
                                                                        src="{{ !empty($profileData->photo) ? asset('uploads/' . $profileData->photo) : asset('uploads/no_image.jpg') }}"
                                                                        class="rounded-circle avatar-xxl img-thumbnail float-start"
                                                                        alt="{{ $profileData->photo ?? 'image' }}" />
                                                                </div>

                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                Change</button>
                                                    </form>




                                                </div><!--end card-body-->


                                            </div>
                                        </div>

                                        {{-- form change password --}}
                                        <form action="{{ route('admin.password.update') }}" method="POST"
                                            class="col-lg-6 col-xl-6 w-full">
                                            @csrf
                                            <div class="">
                                                <div class="card border mb-0">

                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title mb-0">Change Password</h4>
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>

                                                    <div class="card-body mb-0">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Old Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input
                                                                    class="form-control @error('old_password') is-invalid  @enderror"
                                                                    type="password" name="old_password" id="old_password"
                                                                    placeholder="Old Password">
                                                                @error('old_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">New Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input
                                                                    class="form-control @error('new_password') is-invalid  @enderror"
                                                                    type="password" name="new_password" id="new_password"
                                                                    placeholder="New Password">
                                                                @error('new_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Confirm Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    name="new_password_confirmation"
                                                                    id="new_password_confirmation"
                                                                    placeholder="Confirm Password">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <button type="submit" class="btn btn-primary">Change
                                                                    Password</button>
                                                                <button type="button"
                                                                    class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div><!--end card-body-->
                                                </div>
                                            </div>
                                        </form>

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
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showPhoto').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
