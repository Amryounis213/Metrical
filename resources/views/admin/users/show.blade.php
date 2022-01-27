@extends('components.admin-layout')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">View User or Request</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Information For Users</span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="#" class="btn btn-default font-weight-bold">Back</a>
                <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <!--begin::Pic-->
                        @if ($user->image_url)
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img alt="Pic" src="{{asset('uploads/' , $user->image_url)}}">
                            </div>
                        </div> 
                        @else
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img alt="Pic" src="{{asset('admin/assets/media/stock-600x400/img-70.jpg')}}">
                            </div>
                        </div> 
                        @endif
                        
                        <!--end::Pic-->
                        <!--begin: Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <!--begin::User-->
                                <div class="mr-3">
                                    <div class="d-flex align-items-center mr-3">
                                        <!--begin::Name-->
                                        <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$user->first_name}} {{$user->last_name}}</a>
                                        <!--end::Name-->
                                         @if ($user->need  == 'owner')

                                        <span class="label label-light-success label-inline font-weight-bolder mr-1">Owner</span>

                                         @elseif ($user->need  == 'tenant')

                                         <span class="label label-light-success label-inline font-weight-bolder mr-1">Tenant</span>

                                         @else  
                                         
                                         <span class="label label-light-success label-inline font-weight-bolder mr-1">Normal</span>

                                        @endif
                                    </div>
                                  
                                   
                                </div>
                                   
                                   
                                    <!--end::Contacts-->
                               

                                <!--begin::User-->
                                <!--begin::Actions-->
                                <div class="mb-10">
                                    @if ($user->owner || $user->tenant)
                                    <a href="{{route('binding.accept' ,$user->id)}}" class="btn btn-sm btn-success font-weight-bolder text-uppercase mr-2 @if($user->type == 1 || $user->type == 2) disabled @endif">
                                        <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Done-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg><!--end::Svg Icon--></span>
                                        Accept</a>
                                        

                                        @if (!$user->type == 1 || !$user->type == 2)
                                            
                                       
                                        <a href="{{route('binding.refuse' ,$user->id)}}" class="btn btn-sm btn-danger font-weight-bolder text-uppercase mr-2">
                                            <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                                </g>
                                            </svg><!--end::Svg Icon--></span>
                                        Refuse</a>
                                        @endif

                                    @else


                                    <a  class="btn btn-sm btn-light-dark font-weight-bolder text-uppercase mr-2 disabled">
                                        <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                            </g>
                                        </svg><!--end::Svg Icon--></span>
                                    Normal User</a>
                                    
                                    @endif
                                   
                                       
                                   

                            
                                </div>
                                <!--end::Actions-->
                            </div>
                            
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <!--begin::Description-->
                               
                                <!--end::Description-->
                                <!--begin::Progress-->
                                
                                <!--end::Progress-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-4">
                    <!--begin::Card-->
                    
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">Data Card Preview
                            </div>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-4">
                            @if ($user->first_name)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Name:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->first_name  }} {{ $user->last_name  }}</span>
                                </div>
                            </div>
                            @endif
                            @if($user->email)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Email:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a >{{ $user->email }}</a>
                                    </span>
                                </div>
                            </div>
                            @endif

                          
                            @if($user->owner)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Unit Number:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a >{{ $user->owner->unit_number }}</a>
                                    </span>
                                </div>
                            </div>
                            @elseif ( $user->tenant)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Unit Number:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a >{{ $user->tenant->unit_number ??  $user->tenant->unit_number}}</a>
                                    </span>
                                </div>
                            </div>
                            @else
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Unit Number:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a> None</a>
                                    </span>
                                </div>
                            </div>

                            @endif
                            @if($user->country)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Country:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->country }}</span>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->country)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">City:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->country }}</span>
                                </div>
                            </div>
                            @endif
                            @if($user->mobile_number)

                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Mobile:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->mobile_number }}</span>
                                </div>
                            </div>
                            @endif

                            @if($user->id_number)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Emirate ID:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->id_number }}</span>
                                </div>
                            </div>
                            @endif
                         
                           
                            @if($user->nationalty)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Nationalty: </label>
                                <div class="col-8">
                                    <span class="form-control-plaintext">
                                    
                                    <span class="label label-inline label-danger label-bold">{{ $user->nationalty }}</span></span>
                                </div>
                            </div>
                            @endif
                           

                            @if($user->tenant)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Community: </label>
                                <div class="col-8">
                                    <span class="form-control-plaintext">
                                    
                                    <span class="label label-inline label-danger label-bold">{{ $user->tenant->community_id ?? $user->owner->community_id }}</span></span>
                                </div>
                            </div>
                            @endif
                            @if($user->owner)
                           
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Emirate ID:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a >{{ $user->owner->emirate_id }}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Renting Price:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a >{{ $user->owner->renting_price }}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Community: </label>
                                <div class="col-8">
                                    <span class="form-control-plaintext">
                                    
                                    <span class="label label-inline label-danger label-bold">{{ $user->tenant->community ?? $user->owner->community->name_en}}</span></span>
                                </div>
                            </div>
                            @endif
                           
                            
                           
                           
                           
                        </div>
                        <!--end::Body-->
                       
                        <!--end::Footer-->
                    </div>


                    
                    <!--end::Card-->
                </div>
                <div class="col-xl-8">
                    <!--begin::Card-->
                    

                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <ul class="nav nav-tabs nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Passport Copy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">@if ($user->owner)
                                            Title Dead Copy
                                        @else
                                            Visa Copy 
                                        @endif</a>
                                    </li>
                                   
                                </ul>
                            </div>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body" >
                            
                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                    @if ($user->tenant)
                                    <div class="container">
                                        <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->tenant->passport_copy )}})"></div>
                                    </div>

                                    @elseif($user->owner)
                                  
                                            <div class="container">
                                                <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->owner->passport_copy )}})"></div>
                                            </div>
                                   

                                    @else


                                    @endif




                                </div>




                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                    @if ($user->tenant)
                               
                                        <div class="container">
                                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->tenant->visa_copy )}})"></div>
                                        </div>
                                    

                                    @elseif($user->owner)
                                    
                                            <div class="container">
                                                <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->owner->title_dead_copy )}})"></div>
                                            </div>
                                    

                                    @else


                                    @endif

                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                    
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                            
                                </div>
                            </div>
                           
                        </div>
                        
                        <!--end::Body-->
                       
                        <!--end::Footer-->
                    </div>


                    
                    <!--end::Card-->
                </div>
              

            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('admin/assets/js/pages/custom/education/student/profile.js')}}"></script>
@endsection