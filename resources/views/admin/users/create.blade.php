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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">User | Create New User</h5>
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
                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions"
                        data-placement="left">
                        <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                            fill="#000000" />
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
                                <h3 class="card-title">{{ $title }}</h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--begin::Form-->
                            <form class="form" method="POST" action="{{route('storeuser')}}">
                                @csrf
                                <div class="card-body">
                                 <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Customer Info:</h3>
                                 <div class="mb-15">

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right">Avatar image:</label>
                                        <div class="ml-4 image-input" id="kt_image_2">
                                            <div class="image-input-wrapper" style="background-image: url({{asset('admin/assets/media/users/100_2.jpg')}})"></div>
                                           
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                             <i class="fa fa-pen icon-sm text-muted"></i>
                                             <input type="file" name="image_url" accept=".png, .jpg, .jpeg"/>
                                             <input type="hidden" name="profile_avatar_remove"/>
                                            </label>
                                           
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                             <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
     
                                    
                                  <div class="form-group row">
                                   <label class="col-lg-3 col-form-label text-right">First Name:</label>
                                   <div class="col-lg-6">
                                    <input name="first_name" type="text" class="form-control" placeholder="Enter first name"/>
                                    <span class="form-text text-muted">Please enter your first name</span>
                                   </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Last Name:</label>
                                    <div class="col-lg-6">
                                     <input name="last_name" type="text" class="form-control" placeholder="Enter last name"/>
                                     <span class="form-text text-muted">Please enter your last name</span>
                                    </div>
                                   </div>


                                  <div class="form-group row">
                                   <label class="col-lg-3 col-form-label text-right">Email address:</label>
                                   <div class="col-lg-6">
                                    <input name="email"   type="email" class="form-control" placeholder="Enter email"/>
                                    <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                   </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Password:</label>
                                    <div class="col-lg-6">
                                     <input name="password"  disabled  type="text"  class="form-control" value="metrical123"/>
                                     <span class="form-text text-muted">We'll never share your password with anyone else</span>
                                    </div>
                                   </div>

                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Country :</label>
                                    <div class="col-lg-6">
                                        <select name="country" class="form-control form-control-light">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">City :</label>
                                    <div class="col-lg-6">
                                        <select name="city" class="form-control form-control-light">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($cities as $cities)
                                            <option value="{{$cities->id}}">{{$cities->name}}</option>
                                            @endforeach
                                            

                                        </select>
                                    </div>
                                   </div>




                                 </div>
                                 




                                 
                                 
                                
                             
                                 
                               
                                 <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Customer Account:</h3>
                                 <div class="mb-15">

                                  <div class="form-group row">
                                   <label class="col-lg-3 col-form-label text-right">Phone :</label>
                                   <div class="col-lg-6">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="la la-chain"></i></span></div>
                                     <input name="mobile_number"  type="number" class="form-control" placeholder="Phone number"/>
                                    </div>
                                   </div>
                                  </div>


                                 </div>
                                  <h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Customer Linking:</h3>
                                  <div class="mb-15">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right">Communities :</label>
                                        <div class="col-lg-6">
                                            <select name="community_id" class="form-control form-control-light">
                                                <option value="">-- Select Communities --</option>
                                                @foreach ($communities as $country)
                                                <option value="{{$country->id}}">{{$country->name_en}}</option>
                                                @endforeach
    
                                            </select>
                                        </div>
                                       </div>


                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Type :</label>
                                    <div class="col-lg-6">
                                        <select id="type" name="type" class="form-control form-control-light">
                                            <option value="0">Normal</option>
                                            <option value="1">Owner</option>
                                            <option value="2">Tenant</option>
                                        </select>
                                    </div>
                                   </div>


                                   <div class="form-group row owner tenant">
                                    <label class="col-lg-3 col-form-label text-right">Passport Copy :</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input name="passport_copy" type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label " for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                   </div>


                                   <div class="form-group row owner">
                                    <label class="col-lg-3 col-form-label text-right">Title Dead Copy :</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input name="title_dead_copy" type="file" class="custom-file-input owner" id="customFile">
                                            <label class="custom-file-label " for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                   </div>

                                   <div class="form-group row owner tenant">
                                    <label class="col-lg-3 col-form-label text-right">Unit number :</label>
                                    <div class="col-lg-6">
                                     <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text"><i class="la la-archway"></i></span></div>
                                      <input name="unit_number"  type="number" class="form-control" placeholder="Unit number"/>
                                     </div>
                                    </div>
                                   </div>


                                   <div class="form-group row owner">
                                    <label class="col-lg-3 col-form-label text-right">Renting Price :</label>
                                    <div class="col-lg-6">
                                     <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text"><i class="la la-comment-dollar"></i></span></div>
                                      <input name="renting_price"  type="number" class="form-control " placeholder="Renting price"/>
                                     </div>
                                    </div>
                                   </div>
                                  
                                 </div>
                                 
                                 <div class="form-group row tenant">
                                    <label class="col-lg-3 col-form-label text-right">Visa Copy :</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input name="visa_copy" type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label " for="customFile">Choose file</label>
                                        </div>
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
</script>

@include('components.hide-show-inputs');
@endsection