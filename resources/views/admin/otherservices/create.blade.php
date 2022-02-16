@extends('components.admin-layout')
@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Create New service</h5>
                        <!--end::Page Title-->
                      
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
           
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--begin::Form-->
                            <form class="form" action="{{ route('otherservices.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="card-body">


                                        <div class="form-group row">

                                        <label class="col-2 col-form-label">Main Image</label>
                                            <div class="col-10">
                                                <div class="image-input image-input-empty image-input-outline" id="kt_image_4" style="background-image: url(http://127.0.0.1:8000/admin/assets/media/users/blank.png)">
                                                    <div class="image-input-wrapper"></div>
                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input name="image" type="file" accept=".png, .jpg, .jpeg">
                                                        <input type="hidden" name="image">
                                                    </label>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                                <span class="form-text text-muted">image</span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Name</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_1" name="name" class="form-control" type="text"
                                                    maxlength="25" value="{{old('name')}}" id="example-text-input" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description" class="form-control"  maxlength="500" placeholder=""
                                                    rows="6">{{old('description')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Email</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_1" name="email" class="form-control" type="text"
                                                    maxlength="25" value="{{old('email')}}" id="example-text-input" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Phone Number</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_1" name="mobile" class="form-control" type="text"
                                                    maxlength="25" value="{{old('mobile')}}" id="example-text-input" />
                                            </div>
                                        </div>

                                          
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary mr-2">Create</button>
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card-->


                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@include('components.form-script')
@endsection


@section('scripts')

<script src="{{asset('js/pages/crud/file-upload/image-input.js')}}"></script>
<script>
    var avatar2 = new KTImageInput('kt_image_5');

</script>
@endsection