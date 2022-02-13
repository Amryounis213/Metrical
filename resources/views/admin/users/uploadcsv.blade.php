@extends('components.admin-layout')

@section('content')
  
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Import Csv For Users</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                       
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
               
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
          <!--begin::Content-->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('success'))
<div class="container">
<div class="alert alert-success" role="alert">
 {{Session::get('success')}}
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
</div>
@endif
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div  class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">Import Csv Files for Users</h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--begin::Form-->
                            <form action="{{route('importUser')}}" method="POST" enctype="multipart/form-data" >               
                                @csrf
                               
                               
                                <div class="mb-15 mt-14">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right">Full Name:</label>
                                        <div class="col-lg-6">
                                            <input name="excel" type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                           
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-success mr-2">Import</button>
                                            
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

@include('components.form-script');
@endsection
