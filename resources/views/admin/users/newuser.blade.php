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
                            <form class="form" method="POST" action="{{route('storeuser')}}" enctype="multipart/form-data">
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
                                    <input id="fname" name="first_name" value="{{old('first_name')}}" type="text" class="form-control" placeholder="Enter first name"/>
                                    <span class="form-text text-muted">Please enter your first name</span>
                                   </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Last Name:</label>
                                    <div class="col-lg-6">
                                     <input id="lname"  name="last_name" value="{{old('last_name')}}" type="text" class="form-control" placeholder="Enter last name"/>
                                     <span class="form-text text-muted">Please enter your last name</span>
                                    </div>
                                   </div>


                                  <div class="form-group row">
                                   <label class="col-lg-3 col-form-label text-right">Email address:</label>
                                   <div class="col-lg-6">
                                    <input id="email" name="email" value="{{old('email')}}"  type="email" class="form-control" placeholder="Enter email"/>
                                    <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                   </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Password:</label>
                                    <div class="col-lg-6">
                                     <input  name="password"     type="text"  class="form-control" value="{{$str_random}}"/>
                                     <span class="form-text text-muted">We'll never share your password with anyone else</span>
                                    </div>
                                   </div>


                                   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Country:</label>
                                    <div class="col-lg-6">
                                        <select id="country" onclick="phonecode()"  name="country"   class="form-control form-control-light">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($countries as $countries)
                                            <option {{ old('country') == $countries->id ? "selected" : "" }} value="{{$countries->id}}">{{$countries->name}}</option>
                                            @endforeach
                                            

                                        </select>
                                
                                     
                                    </div>
                                   </div>
                                
                                   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">City :</label>
                                    <div class="col-lg-6">
                                        <select name="city"   class="form-control form-control-light">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($cities as $cities)
                                            <option {{ old('city') == $cities->id ? "selected" : "" }} value="{{$cities->id}}">{{$cities->name}}</option>
                                            @endforeach
                                            

                                        </select>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">Nationalty :</label>
                                    <div class="col-lg-6">
                                        <select name="nationality"   class="form-control form-control-light">
                                            <option value="">-- Select Nationalty --</option>
                                            @foreach ($countries2 as $countries2)
                                            <option {{ old('nationality') == $countries2->id ? "selected" : "" }} value="{{$countries2->id}}">{{$countries2->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                   </div>

                                  


                                 </div>
                                 




                                 
                                 
                                
                             
                                 
                               
                                 <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Customer Phone:</h3>
                                 <div class="mb-15">

                                  <div class="form-group row">
                                   <label class="col-lg-3 col-form-label text-right">Phone :</label>
                                   <div class="col-lg-2">
                                    <select name="phonecode"   class="form-control form-control-light selectpicker" data-size="5"
                                    data-live-search="true">
                                    <option value="">000 </option>
                                             @foreach ($phonecode as $phonecode)
                                            <option {{ old('phonecode') == $phonecode->phonecode ? "selected" : "" }} value="{{$phonecode->phonecode}}">{{$phonecode->phonecode}}</option>
                                            @endforeach
                                        </select>
                                   </div>

                                   <div class="col-lg-4">
                                    <div class="input-group">
                                     
                                     <input name="mobile_number" value="{{old('mobile_number')}}"  type="number" class="form-control" placeholder="Phone number"/>
                                    </div>
                                   </div>

                                  
                                  </div>

                                

                                    <div class="form-group row">
                                     <label class="col-lg-3 col-form-label text-right">Emirate ID :</label>
                                     <div class="col-lg-6">
                                      <div class="input-group">
                                       <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                       <input name="id_number"  id="kt_phone_input" value="{{old('id_number')}}" type="text" class="form-control phone"  placeholder="Ex : 784-1234-1234567-1" maxlength="15"/>
                                      </div>
                                     </div>
                                    </div>

                                    <div class="mb-15">

                                       

                                 </div>
                                  <h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Customer Linking:</h3>
                                  <div class="mb-15">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right">Type :</label>
                                        <div class="col-lg-6">
                                            <select id="type" value="{{old('type')}}" name="type" class="form-control form-control-light">
                                                <option value="0">Lead</option>
                                                <option value="1">Owner</option>
                                                <option value="2">Tenant</option>
                                            </select>
                                        </div>
                                       </div>

                                    <div id="comm" class=" form-group row">
                                        <label class="col-lg-3 col-form-label text-right">Communities :</label>
                                        <div class="col-lg-6">
                                            <select id="community"  name="community_id" class="form-control form-control-light">
                                                <option value="">-- Select Communities --</option>
                                                @foreach ($communities as $country)
                                                <option value="{{$country->id}}">{{$country->name_en}}</option>
                                                @endforeach
    
                                            </select>
                                        </div>
                                    </div>


                                  


                                   <div class="form-group row owner tenant">
                                    <label class="col-lg-3 col-form-label text-right">Passport Copy :</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input value="{{old('passport_copy')}}" name="passport_copy" type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label " for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                   </div>


                                   <div class="form-group row owner">
                                    <label class="col-lg-3 col-form-label text-right">Title Dead Copy :</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input name="title_dead_copy" value="{{old('title_dead_copy')}}" type="file" class="custom-file-input owner" id="customFile">
                                            <label class="custom-file-label " for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                   </div>

                                   <div class="form-group row owner ">
                                    
                                        <label class="col-lg-3 col-form-label text-right">Unit Name (Property) :</label>
                                        <div class="col-lg-6">
                                            <select id="property" name="property" class="form-control form-control-light">
                                                <option value="">-- Select Property --</option>
                                                @foreach ($properties1 as $properties)
                                                <option value="{{$properties->id}}">{{$properties->name_en}}</option>
                                                @endforeach
    
                                            </select>
                                        </div>
                                      
                                   </div>


                                <div class="form-group row  tenant">
                                    
                                    <label class="col-lg-3 col-form-label text-right">Unit Name (Property T) :</label>
                                    <div class="col-lg-6">
                                        <select id="property2"  name="property" class="form-control form-control-light">
                                            <option value="">-- Select Property --</option>
                                            @foreach ($properties2 as $properties)
                                            <option value="{{$properties->id}}">{{$properties->name_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                  
                               </div>

                                   <div class="form-group row owner">
                                    <label class="col-lg-3 col-form-label text-right">Renting Price :</label>
                                    <div class="col-lg-6">
                                     <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text"><i class="la la-comment-dollar"></i></span></div>
                                      <input name="renting_price"  value="{{old('renting_price')}}"  type="number" class="form-control " placeholder="Renting price"/>
                                     </div>
                                    </div>
                                   </div>
                                  
                                 </div>
                                 
                                 <div class="form-group row tenant">
                                    <label class="col-lg-3 col-form-label text-right">Visa Copy :</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input name="visa_copy" type="file" value="{{old('visa_copy')}}"  class="custom-file-input" id="customFile">
                                            <label class="custom-file-label "  for="customFile">Choose file</label>
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


     $(document).ready(function () {
                $('#community').on('change', function () {
                let id = $(this).val();
                $('#property').empty();
                $('#property2').empty();
                $('#property').append(`<option value="0" disabled selected>Processing...</option>`);
                $('#property2').append(`<option value="0" disabled selected>Processing...</option>`);
                let x =$('#type').val();
            if(x == 1) {
            $.ajax({
                type: 'GET',
                url: 'admin/GetPropertyByCommunity/' + id,
                success: function (response) {
                $('#property').empty();
                $('#property').append(`<option value="0" disabled selected>Select Property*</option>`);
                response.forEach(element => {
                    $('#property').append(`<option value="${element['id']}">${element['name']}</option>`);
                    });
                }  
            });
            }
            else if (x == 2)
            {
                $.ajax({
                type: 'GET',
                url: 'admin/tenant/GetPropertyByCommunity/' + id,
                success: function (response) {
                $('#property2').empty();
                $('#property2').append(`<option value="0" disabled selected>Select Property*</option>`);
                response.forEach(element => {
                    $('#property2').append(`<option value="${element['id']}">${element['name']}</option>`);
                    });
                }  
            });
            }
            else{
                $('#community').hide(); 
            }
          

            });
        });
   


   
</script>
<script>
    function phonecode()
    {
       
       let countryId = document.getElementById('country').value;
       console.log(countryId);
        $.ajax({
        type: 'GET',
        url: 'admin/getPhonecodeByCountry/' + countryId,
        success: function (response) {
            $('#phonecode').empty();
            response.forEach(element => {

                    $('#phonecode').append(`${element['phonecode']}`);
                    });
        }
        });
        
    }


  
</script>
@include('components.hide-show-inputs');
@endsection