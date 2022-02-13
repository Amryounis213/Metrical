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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Social Media Links</h5>
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

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">Socail Media Links</h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--begin::Form-->
                            <form class="form" action="{{route('socials.update' ,$social->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                   




                                    <div class="form-group row ">
                                        <label class="col-2 col-form-label">Facebook</label>
                                        <div class="col-lg-9">
                                            <input id="kt_maxlength_1"  name="facebook_link" value="{{ $social->facebook_link }}" type="text" class="form-control" placeholder="Link" />
                                        </div>
                                       

                                      
                                    </div>

                                    <div class="form-group row ">
                                        <label class="col-2 col-form-label">Twitter</label>
                                        <div class="col-lg-9">
                                            <input id="kt_maxlength_1"  name="twitter_link" value="{{ $social->twitter_link }}" type="text" class="form-control" placeholder="Link" />
                                            
                                        </div>
                                       

                                      
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-2 col-form-label">Youtube</label>
                                        <div class="col-lg-9">
                                            <input id="kt_maxlength_1"  name="youtube_link" value="{{ $social->youtube_link }}" type="text" class="form-control" placeholder="Link" />
                                        </div>
                                       

                                      
                                    </div>




                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-10">
                                            <button type="submit" class="btn btn-success mr-2">Create</button>
                                            <button type="reset" class="btn btn-secondary">Reset Fields</button>
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
{{--
@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<script>
   var allEditors = document.querySelectorAll('.editor');
for (var i = 0; i < allEditors.length; ++i) {
  ClassicEditor.create(allEditors[i]);
}
  </script>
@endsection
--}}