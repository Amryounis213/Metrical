@extends('components.admin-layout')
@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endsection
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{$title}}</h5>
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
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div  class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--begin::Form-->
                            <form class="form" action="{{ route('properties.store')}}" method="POST"
                                enctype="multipart/form-data"  class="dropzone" id="dropzone">
                                @csrf
                                <div class="card-body">
                                    <div id='parent' class="card-body">
                                        <div class="form-group row">

                                            <label class="col-2 col-form-label">Main Image</label>
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

                                       


                                       
                                        @if (!Route::is('properties.create'))
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Community</label>
                                            <div class="col-10">
                                                <select name="community_id" class="form-control selectpicker" data-size="5"
                                                    data-live-search="true">
                                                    <option value="">Select</option>
                                                    <option value="{{$community->id}}" selected>{{$community->name_en}}</option> 
                                                </select>
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Community</label>
                                            <div class="col-10">
                                                <select name="community_id" class="form-control selectpicker" data-size="5"
                                                    data-live-search="true">
                                                    <option value="">Select</option>
                                                    @foreach ($communities as $communities)
                                                    <option {{ old('community_id') == $communities->id ? "selected" : "" }}  value="{{$communities->id}}" >{{$communities->name_en}}</option> 
                                                    @endforeach  
                                                </select>
                                            </div>
                                        </div>
                                        
                                        @endif
  

                                        <div class="form-group row ">
                                            <label class="col-2 col-form-label">Name</label>
                                            <div class="col-lg-3">
                                                <input  maxlength="25"  name="name_ar" value="{{ old('name_ar') }}"  type="text" class="form-control kt_maxlength_1" placeholder="Arabic" />
                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <input maxlength="25"  name="name_gr" value="{{ old('name_gr') }}"  type="text" class="form-control kt_maxlength_1" placeholder="Germany" />
                                                
                                            </div>

                                            <div class="col-lg-4">
                                                <input maxlength="25"  name="name_en" value="{{ old('name_en') }}"  type="text" class="form-control kt_maxlength_1" placeholder="English" />
                                                
                                            </div>

                                          
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (Arabic)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_ar" value="{{ old('description_ar') }}" class="form-control kt_maxlength_5_modal editor" minlength="200"   maxlength="1500" placeholder="" rows="6">{{ old('description_ar') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (Germany)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_gr" value="{{ old('description_gr') }}" class="form-control kt_maxlength_5_modal editor" minlength="200"  maxlength="1500" placeholder="" rows="6">{{ old('description_gr') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (English)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_en" value="{{ old('description_en') }}" class="form-control kt_maxlength_5_modal editor" minlength="200"  maxlength="1500" placeholder="" rows="6">{{ old('description_en') }}</textarea>
                                            </div>
                                        </div>



                                        

                                        <div class="form-group row ">
                                            <label class="col-2 col-form-label">Area (mm)</label>
                                            <div class="col-lg-4">
                                                <input min="0" max="100000" value="{{ old('area') }}"  name="area" step="any" type="number" class="form-control"  value="{{$property->area}}" placeholder="Ex:195 mm" />
                                                
                                            </div>

                                            <label class="col-2 col-form-label">Reference</label>
                                            <div class="col-lg-4">
                                                <input   name="reference" value="{{ old('reference') }}" type="text" class="form-control"  value="{{$property->reference}}" placeholder="Ex: 9551200" />
                                                
                                            </div>

                                        

                                          
                                        </div>

                                       
                                       
                                    

                                      
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Property Status</label>
                                            <div class="col-10">
                                                <div class="radio-inline">
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="0" name="status" {{ old('status') == '0' ? "checked" : "" }} checked="checked"/>
                                                        <span></span>
                                                        Under Constraction
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="1"  name="status" {{ old('status') == '1' ? "checked" : "" }}  />
                                                        <span></span>
                                                        Ready
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Type</label>
                                            <div class="col-10">
                                                <div class="radio-inline">
                                                    <label class="radio radio-danger">
                                                        <input  type="radio" value="house" name="type" {{ old('type') == 'house' ? "checked" : "" }} checked="checked"/>
                                                        <span></span>
                                                        house
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="apartment" name="type"  {{ old('type') == 'apartment' ? "checked" : "" }} />
                                                        <span></span>
                                                        apartment
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Offer Type</label>
                                            <div class="col-10">
                                                <div class="radio-inline">
                                                    <label class="radio radio-danger">
                                                        <input id="none" type="radio" value="stop" name="offer_type" {{ old('offer_type') == 'stop' ? "checked" : "" }} checked />
                                                        <span></span>
                                                        none
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input id="sale" type="radio" value="sale" name="offer_type" {{ old('offer_type') == 'sale' ? "checked" : "" }} />
                                                        <span></span>
                                                        sale
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input id="rent" type="radio" value="rent" name="offer_type" {{ old('offer_type') == 'rent' ? "checked" : "" }} />
                                                        <span></span>
                                                        rent
                                                    </label>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div id="shortterm" class="form-group row ">
                                            <label class="col-2 col-form-label">Short Term</label>
                                            <div class="col-10">
                                                <div class="radio-inline">
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="0" name="is_shortterm" checked="checked"/>
                                                        <span></span>
                                                        No
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="1" name="is_shortterm"  />
                                                        <span></span>
                                                        Yes
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row ">
                                            <label class="col-2 col-form-label">Information</label>
                                            <div class="col-lg-2">
                                                <input min="0" name="gate" value="{{ old('gate')}}" type="number" class="form-control" placeholder="Gates" />
                                                <span class="form-text text-muted">Gates number</span>
                                            </div>
                                            <div class="col-lg-2">
                                                <input min="0" name="bathroom" value="{{ old('bathroom')}}" type="number" class="form-control" placeholder="Bathroom" />
                                                <span class="form-text text-muted">Bathroom number</span>

                                            </div>

                                            <div class="col-lg-2">
                                                <input min="0" name="bedroom" value="{{ old('bedroom')}}" type="number" class="form-control" placeholder="Bedroom" />
                                                <span class="form-text text-muted">Bedroom number</span>

                                            </div>

                                            <div class="col-lg-3">
                                                <input maxlength="15" value="{{ old('floor')}}" name="floor" type="text" class="form-control" placeholder="Ex :The forth or 4" />
                                                <span class="form-text text-muted">Floor</span>

                                            </div>
                                          
                                        </div>

                                       
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Amenities</label>
                                            <div class="checkbox-inline">
                                                @foreach ($amenities as $amenity)
                                                <label class="checkbox">
                                                    <input type="checkbox" name="amenities[]" value="{{$amenity->name}}" />
                                                    <span></span>{{$amenity->name}}</label>
                                                @endforeach
                                                
                                               
                                            </div>
                                           
                                        </div>
                                        <!--
                                        <div id="map" style="height: 500px;width: 1000px;"></div>
                                        -->
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-2">Create</button>
                                        <button type="reset" class="btn btn-secondary">Reset Fields</button>
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
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response) 
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
};
</script>
<script>
    $("#shortterm").hide();
    $("#rent").click(function(){
        $("#shortterm").show();
    });
    $("#sale").click(function(){
        $("#shortterm").hide();
    });
    $("#none").click(function(){
        $("#shortterm").hide();
    });
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<script>
   var allEditors = document.querySelectorAll('.editor');
for (var i = 0; i < allEditors.length; ++i) {
  ClassicEditor.create(allEditors[i]);
}
  </script> 
@endsection
@include('components.form-script');
@endsection
