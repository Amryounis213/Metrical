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
                                        <a >{{ $user->emirate_id }}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Renting Price:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a >{{ $user->renting_price }}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Community: </label>
                                <div class="col-8">
                                    <span class="form-control-plaintext">
                                    
                                    <span class="label label-inline label-danger label-bold">{{ $user->tenant->community_id ?? $user->owner->community_id }}</span></span>
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
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header card-header-tabs-line">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"></path>
                                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"></circle>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="nav-text">Passport Copy</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                            <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="nav-text">Visa Copy</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body px-0">
                            <div class="tab-content pt-5">
                                <!--begin::Tab Content-->
                                @if ($user->tenant)
                                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                    <div class="container">
                                        <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->tenant->passport_copy )}})"></div>
                                    </div>
                                </div>
                                @elseif($user->owner)

                                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                    <div class="container">
                                        <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->owner->passport_copy )}})"></div>
                                    </div>
                                
                                @else

                                    No Image ^_^
                                @endif
                                
                                <!--end::Tab Content-->
                                <!--begin::Tab Content-->
                                @if ($user->tenant)
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                                    <div class="container">
                                        <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->tenant->visa_copy)}})"></div>
                                    </div>
                                </div>
                                @elseif($user->owner)

                                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                    <div class="container">
                                        <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $user->owner->visa_copy )}})"></div>
                                    </div>
                                
                                @else

                                    No Image ^_^
                                @endif
                               
                                <!--end::Tab Content-->
                               
                                <!--end::Tab Content-->
                            </div>
                        </div>
                        <!--end::Body-->
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