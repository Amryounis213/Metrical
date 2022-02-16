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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">User | Edit <span class="text-primary"> {{$user->first_name}} {{$user->last_name}} </span> information</h5>
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
                            <form class="form" action="{{route('updateuserinfo' , [$user->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input hidden name="id" value="{{$user->id}}">
                                <div class="card-body">
                                 <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Customer Info:</h3>
                                 <div class="mb-15">

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right">Avatar image:</label>
                                        <div class="ml-4 image-input" id="kt_image_2">
                                            <div class="image-input-wrapper" style="background-image: url({{asset('uploads/' . $user->image_url)}})"></div>
                                           
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
                                   <label class="col-lg-3 col-form-label text-right">First Name:<strong class="text-danger">*</strong></label>
                                   <div class="col-lg-6">
                                    <input name="first_name" value="{{$user->first_name}}" type="text" class="form-control" placeholder="Enter first name"/>
                                    <span class="form-text text-muted">Please enter your first name</span>
                                   </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Last Name:<strong class="text-danger">*</strong></label>
                                    <div class="col-lg-6">
                                     <input name="last_name" value="{{$user->last_name}}" type="text" class="form-control" placeholder="Enter last name"/>
                                     <span class="form-text text-muted">Please enter your last name</span>
                                    </div>
                                   </div>


                                  <div class="form-group row">
                                   <label class="col-lg-3 col-form-label text-right">Email address:<strong class="text-danger">*</strong></label>
                                   <div class="col-lg-6">
                                    <input name="email" value="{{$user->email}}"  type="email" class="form-control" placeholder="Enter email"/>
                                    <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                   </div>
                                  </div>

            


                                   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Country:<strong class="text-danger">*</strong></label>
                                    <div class="col-lg-6">
                                        <select id="country" name="country"   class="form-control form-control-light">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($country as $country)
                                            <option value="{{$country->id}}" @if($country->id == $user->country) selected  @endif>{{$country->name}}</option>
                                            @endforeach
                                            

                                        </select>
                                
                                     
                                    </div>
                                   </div>
                                   
                                  
                                   
                                    <div id="city" class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right">City :<strong class="text-danger">*</strong></label>
                                        <div class="col-lg-6">
                                            <select name="city"   class="form-control form-control-light">
                                                <option value="">-- Select City --</option>
                                                @foreach ($cities as $cities)
                                                <option value="{{$cities->id}}" @if($cities->id == $user->city) selected  @endif>{{$cities->name}}</option>
                                                @endforeach
                                                
    
                                            </select>
                                        </div>
                                       </div>
                                  
                                  
                                   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Nationalty :<strong class="text-danger">*</strong></label>
                                    <div class="col-lg-6">
                                        <select name="nationality"   class="form-control form-control-light">
                                            <option value="">-- Select Nationalty --</option>
                                            @foreach ($countries2 as $countries2)
                                            <option value="{{$countries2->id}}" @if($countries2->id == $user->nationality) selected  @endif>{{$countries2->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                   </div>




                                 </div>
                                 




                                 
                                 
                                
                             
                                 
                               
                                 <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Customer Phone:</h3>
                                 <div class="mb-15">

                                  <div class="form-group row">
                                   <label class="col-lg-3 col-form-label text-right">Phone :<strong class="text-danger">*</strong></label>
                                   <div class="col-lg-6">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="la la-chain"></i></span></div>
                                     <input name="mobile_number" value="{{$user->mobile_number}}"  type="text" class="form-control" placeholder="Phone number"/>
                                    </div>
                                   </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Emirate ID :</label>
                                    <div class="col-lg-6">
                                     <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                      <input id="kt_phone_input" name="id_number"  value="{{$user->id_number}}"  type="text" class="form-control phone" placeholder="enter emirate ID"/>
                                     </div>
                                    </div>
                                   </div>

                                 </div>
                                  <h3 class="font-size-lg text-dark font-weight-bold mb-6">3. New Password (Optional):</h3>
                                  <div class="mb-15">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right">Password:</label>
                                        <div class="col-lg-6">
                                         <input name="password" id="password" type="text"   class="form-control" disabled />
                                         <span class="form-text text-muted">We'll never share your password with anyone else</span>


                                        </div>
                                        <i id="editpass" class="flaticon2-edit text-hover-success"></i>
                                        
                                       </div>


                                 
                                  
                                   

                                   
                                  
                                 </div>
                                
                                </div>
                                <div class="card-footer">
                                 <div class="row">
                                  <div class="col-lg-3"></div>
                                  <div class="col-lg-6">
                                   <button type="submit" class="btn btn-success mr-2">Submit</button>
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
@section('scripts')

<script src="{{asset('admin/assets/js/pages/crud/file-upload/image-input.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/crud/forms/widgets/jquery-mask.js')}}"></script>

<script>
    var avatar2 = new KTImageInput('kt_image_2');
    var button = document.querySelector("#editpass");
    var input = document.querySelector("#password");
    button.addEventListener("click", function(){
  input.toggleAttribute("disabled");
});


if($(country).val() == 231){
    $('#city').show();
}
else{
    $('#city').hide();
}
    $('#country').on('change', function () {
       if($(this).val() == 231)
       {
           $('#city').show();
       }
       else{
        $('#city').hide();
       }
    });
</script>

@endsection