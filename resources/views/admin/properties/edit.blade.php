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
                            <form class="form" action="{{ route('properties.update' , $property->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('Put')
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group row">

                                            <label class="col-2 col-form-label">Property Image</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="image-input image-input-empty image-input-outline"
                                                    id="kt_image_4"
                                                    style="background-image: url({{asset('uploads/'. $property->image_url)}})">
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
                                            <label class="col-2 col-form-label">Community</label>
                                            <div class="col-10">
                                                <select name="community_id" class="form-control selectpicker" data-size="5"
                                                    data-live-search="true">
                                                    <option value="">Select</option>
                                                    @foreach ($communities as $communities)
                                                    <option value="{{$communities->id}}" @if($communities->id == $property->community_id) selected @endif >{{$communities->name_en}}</option> 
                                                    @endforeach  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label class="col-2 col-form-label">Name</label>
                                            <div class="col-lg-3">
                                                <input id="kt_maxlength_1"  name="name_ar" value="{{$property->name_ar}}" type="text" class="form-control" placeholder="Arabic" />
                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <input id="kt_maxlength_1" name="name_gr" value="{{$property->name_gr}}" type="text" class="form-control" placeholder="Germany" />
                                                
                                            </div>

                                            <div class="col-lg-4">
                                                <input id="kt_maxlength_1" name="name_en" value="{{$property->name_en}}" type="text" class="form-control" placeholder="English" />
                                                
                                            </div>

                                          
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (Arabic)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_ar" class="form-control editor"  minlength="200" maxlength="1500" placeholder="" rows="6">{{$property->description_ar}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (Germany)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_gr" class="form-control editor"  minlength="200" maxlength="1500" placeholder="" rows="6">{{$property->description_gr}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-2 col-form-label">Description (English)</label>
                                            <div class="col-10" style="position: relative;">
                                                <textarea name="description_en" class="form-control editor" minlength="200" maxlength="1500" placeholder="" rows="6">{{$property->description_en}}</textarea>
                                            </div>
                                        </div>



                                        <div class="form-group row ">
                                            <label class="col-2 col-form-label">Address</label>
                                            <div class="col-lg-3">
                                                <input  maxlength="75"  name="address_ar" value="{{  $property->address_ar }}"  type="text" class="form-control kt_maxlength_1" placeholder="Arabic" />
                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <input maxlength="75"  name="address_gr" value="{{  $property->address_gr }}"  type="text" class="form-control kt_maxlength_1" placeholder="Germany" />
                                                
                                            </div>

                                            <div class="col-lg-4">
                                                <input maxlength="75"  name="address_en" value="{{ $property->address_en }}"  type="text" class="form-control kt_maxlength_1" placeholder="English" />
                                                
                                            </div>

                                          
                                        </div>


                                        <div class="form-group row ">
                                            <label class="col-2 col-form-label">Area (sqft)</label>
                                            <div class="col-lg-4">
                                                <input id="kt_maxlength_1" min="0"  name="area" type="number" class="form-control"  value="{{$property->area}}" placeholder="Ex:195 mm" />
                                                
                                            </div>

                                            <label class="col-2 col-form-label">Reference</label>
                                            <div class="col-lg-4">
                                                <input id="kt_maxlength_1" name="reference" type="text" class="form-control"  value="{{$property->reference}}" placeholder="Ex: 9551200" />
                                                
                                            </div>

                                        

                                          
                                        </div>

                                       
                                       
                                       

                                      
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Property Status</label>
                                            <div class="col-10">
                                                <div class="radio-inline">
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="0" name="status"  @if ($property->status == '0') checked @endif/>
                                                        <span></span>
                                                        Under Constraction
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="1" name="status" @if ($property->status == '1') checked @endif  />
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
                                                        <input type="radio" value="house" name="type" @if ($property->type == 'house') checked @endif/>
                                                        <span></span>
                                                        house
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input type="radio" value="apartment" name="type" @if ($property->type == 'apartment') checked @endif  />
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
                                                        <input id="none" type="radio" value="stop" name="offer_type" @if ($property->offer_type == 'stop') checked @endif />
                                                            
                                                       
                                                        <span></span>
                                                        none
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input id="sale" type="radio" value="sale" name="offer_type"  @if ($property->offer_type == 'sale') checked @endif />
                                                        <span></span>
                                                        sale
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input id="rent" type="radio" value="rent" name="offer_type" @if ($property->offer_type == 'rent') checked @endif />
                                                        <span></span>
                                                        rent
                                                    </label>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div id="shortterm" class="form-group row">
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
                                                <input name="gate" value="{{$property->gate}}" type="number" class="form-control"placeholder="Gates" />
                                                <span class="form-text text-muted">Gates number</span>
                                            </div>
                                            <div class="col-lg-2">
                                                <input name="bathroom" value="{{$property->bathroom}}" type="number" class="form-control" placeholder="Bathroom" />
                                                <span class="form-text text-muted">Bathroom number</span>

                                            </div>

                                            <div class="col-lg-2">
                                                <input name="bedroom" value="{{$property->bedroom}}" type="number" class="form-control" placeholder="Bedroom" />
                                                <span class="form-text text-muted">Bedroom number</span>

                                            </div>

                                            <div class="col-lg-3">
                                                <input maxlength="15" value="{{$property->floor}}" name="floor" type="text" class="form-control" placeholder="Ex :The forth or 4" />
                                                <span class="form-text text-muted">Floor</span>

                                            </div>
                                          
                                        </div>

                                       
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Amenities</label>
                                            <div class="checkbox-inline">
                                                @foreach ($amenities as $amenity)
                                                <label class="checkbox">
                                                    <input type="checkbox" name="amenities[]" value="{{$amenity->name}}" @if(in_array($amenity->name , $property->amenities ?? [])) checked="checked" @endif/>
                                                    <span></span>{{$amenity->name}}</label>
                                                @endforeach
                                                
                                               
                                            </div>
                                           
                                        </div>
                                        <!--
                                        <div id="map" style="height: 500px;width: 1000px;"></div>
                                        -->
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-2">Update</button>
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
   
    @include('components.form-script');
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<script>
   var allEditors = document.querySelectorAll('.editor');
for (var i = 0; i < allEditors.length; ++i) {
  ClassicEditor.create(allEditors[i]);
}
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
@endsection
