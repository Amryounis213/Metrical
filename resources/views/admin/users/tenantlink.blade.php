@extends('components.admin-layout')
@section('stylesheet')
<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">User | Link User With Property </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->

                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm">Actions</a>
                <!--end::Actions-->
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-success svg-icon-2x">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>

                </div>
                <!--end::Dropdown-->
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
                            <h3 class="card-title">Rent   <span class="text-success"> (  {{$tenant->full_name}} )</span> with Property <span class="text-success">(  {{$property->name_en}} ) </span></h3>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <!--begin::Form-->
                       
                        <form class="form" method="POST" action="{{route('renting.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="mb-15">


                                    <input name="redirect" hidden value="1">
                                    <input hidden name="tenant_id" value="{{ $tenant->id }}" >
                                    <input hidden name="property_id" value="{{ $property->id }}" >
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Start Time</label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                            <div class="input-group date kt_datetimepicker_7_1" data-target-input="nearest">
                                                <input name="from" type="text" class="form-control datetimepicker-input" placeholder="Select date &amp; time" data-target=".kt_datetimepicker_7_1" />
                                                <div class="input-group-append" data-target=".kt_datetimepicker_7_1" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Last Time</label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                            <div class="input-group date kt_datetimepicker_7_2"  data-target-input="nearest">
                                                <input name="to" type="text" class="form-control datetimepicker-input" placeholder="Select date &amp; time" data-target=".kt_datetimepicker_7_2" />
                                                <div class="input-group-append" data-target=".kt_datetimepicker_7_2" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Price</label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                        <input name="price" type="number" class="form-control"  placeholder="Ex : 500"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
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
@endsection
@section('scripts')
<script src="{{asset('admin/assets/js/pages/crud/file-upload/image-input.js')}}"></script>
<script>
    var avatar2 = new KTImageInput('kt_image_2');
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>

@if(Session::has('rent'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-bottom-right",
  
  }
  		toastr.warning("{{ session('rent') }}");
@endif
</script>
@endsection