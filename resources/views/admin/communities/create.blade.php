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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Create Communities |</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                   
                   
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
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
                            <form class="form" action="{{ route('communities.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group row">

                                            <label class="col-2 col-form-label">Community Image</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="image-input image-input-empty image-input-outline"
                                                    id="kt_image_4"
                                                    style="background-image: url({{asset('media/users/blank.png')}})">
                                                    <div class="image-input-wrapper"></div>
                                                    <label
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change" data-toggle="tooltip" title=""
                                                        data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input name="image_url" type="file" name="profile_avatar"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="profile_avatar_remove" />
                                                    </label>
                                                    <span
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel" data-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                    <span
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="remove" data-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                                <span class="form-text text-muted">Default empty input with blank
                                                    image</span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Status</label>
                                            <div class="col-10">
                                                <select name="status" class="form-control selectpicker" data-size="7"
                                                    data-live-search="true">
                                                    <option value="">Select</option>
                                                    <option value="0">Under Construction</option>
                                                    <option value="1">Ready</option>

                                                </select>
                                                <span class="form-text text-muted">you can select any category </span>
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label class="col-2 col-form-label">Name</label>
                                            <div class="col-lg-3">
                                                <input id="kt_maxlength_1"  name="name_ar" value="{{$community->name_ar}}" type="text" class="form-control" placeholder="Arabic" />
                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <input id="kt_maxlength_1" name="name_gr" value="{{$community->name_gr}}" type="text" class="form-control" placeholder="Germany" />
                                                
                                            </div>

                                            <div class="col-lg-4">
                                                <input id="kt_maxlength_1" name="name_en" value="{{$community->name_en}}" type="text" class="form-control" placeholder="English" />
                                                
                                            </div>

                                          
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Area</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_2" name="area" class="form-control"
                                                    type="any" value="{{$community->area}}"
                                                    id="example-search-input" placeholder="Ex : 50000 mm" />
                                            </div>
                                        </div>
                                        
                                        <input id="percantage" name="readness_percentage"
                                        class="form-control" type="number"
                                        value="{{$community->readness_percentage}}"
                                        id="readness_percentage" hidden />
                                
                           



                            <div class="form-group row">
                                <label for="readness_percentage" class="col-2 col-form-label">Readness
                                    Percentage</label>
                                <div class="col-10">
                                  <div class="row align-items-center">
                                   <div class="col-4">
                                    <input type="number" name="readness_percentage" class="form-control" id="kt_nouislider_1_input" />
                                   </div>
                                   <div class="col-8">
                                    <div id="kt_nouislider_1" class="nouislider-drag-danger"></div>
                                   </div>
                                  </div>
                                  </div>
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
<script src="{{asset('admin/assets/js/pages/crud/forms/widgets/nouislider.js')}}"></script>
@endsection