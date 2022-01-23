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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{$title }}</h5>
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
                                <h3 class="card-title">{{ $title }}</h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--begin::Form-->
                            <form class="form" action="{{ route('events.update', $event->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group row">
                                        <div class="image-input image-input-outline" id="kt_image_1">
                                            <div class="image-input-wrapper" style="background-image: url({{asset('uploads/'.$event->image_url)}})"></div>
                                           
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                             <i class="fa fa-pen icon-sm text-muted"></i>
                                             <input type="file" name="image_url" value="{{asset('uploads/'.$event->image_url)}}" accept=".png, .jpg, .jpeg"/>
                                             <input type="hidden" name="profile_avatar_remove"/>
                                            </label>
                                           
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                             <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                           </div>
                                        </div>   
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Community</label>
                                            <div class="col-10">
                                                <select name="community_id" class="form-control selectpicker"
                                                    data-size="7" data-live-search="true">
                                                    <option value="">Select</option>
                                                    @foreach($communites as $community)
                                                    <option value="{{ $community->id }}" @if($event->community->name_en
                                                        == $community->name_en) selected
                                                        @endif>{{ $community->name_en }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                                <span class="form-text text-muted">you can select any category </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Arabic Title</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_1" name="title_ar" class="form-control"
                                                    type="text" maxlength="25" value="{{$event->title_ar}}"
                                                    id="example-text-input" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Germany Title</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_1" name="title_gr" class="form-control"
                                                    type="text" maxlength="25" value="{{$event->title_gr}}"
                                                    id="example-text-input" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">English Title</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_1" name="title_en" class="form-control"
                                                    type="text" maxlength="25" value="{{$event->title_en}}"
                                                    id="example-text-input" />
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (Arabic)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_ar" value="{{ old('description_ar') }}" class="form-control kt_maxlength_5_modal"  maxlength="1000" placeholder="" rows="6">{{$event->description_ar}}</textarea>
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (Germany)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_gr" value="{{ old('description_gr') }}" class="form-control kt_maxlength_5_modal"  maxlength="1000" placeholder="" rows="6">{{$event->description_gr}}</textarea>
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (English)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_en" value="{{ old('description_en') }}" class="form-control kt_maxlength_5_modal"  maxlength="1000" placeholder="" rows="6">{{$event->description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-search-input"
                                                class="col-2 col-form-label">Adress</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_2" name="address" class="form-control"
                                                    type="text" value="{{$event->address}}" id="example-search-input" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="start_date" class="col-2 col-form-label">From </label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_2" name="start_date" class="form-control"
                                                    type="date" value="{{Carbon\Carbon::parse($event->start_date)->format('20y-m-d')}}" />
                                               
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="end_date" class="col-2 col-form-label">To</label>
                                            <div class="col-10">
                                                <input id="kt_maxlength_2" name="end_date" class="form-control"
                                                    type="date" value="{{Carbon\Carbon::parse($event->end_date)->format('20y-m-d')}}" id="end_date" />
                                            </div>
                                        </div>








                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-2">Update</button>
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
@endsection