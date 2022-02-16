@extends('components.admin-layout')
@section('stylesheet')

@endsection
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
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <!--begin::Pic-->
                        @if ($user->image_url)
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img alt="Pic" src="{{asset('uploads/' . $user->image_url)}}">
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
                                         
                                         <span class="label label-light-success label-inline font-weight-bolder mr-1">Lead</span>

                                        @endif
                                    </div>

                                    @if($user->request_sent)
                                    <br>
                                    <strong>Hint : <strong class="text-success">{{$user->first_name}} {{$user->last_name}}</strong> Want to Link with <strong class="text-success">{{$unit_name->name_en}}</strong></strong>
                                    <br>
                                    <strong>Rq Type : <strong class="text-success">@if ($user->need  == 'owner') Own  @elseif ($user->need  == 'tenant') Rent @else  None @endif </strong>
                                    <br>
                                    <strong>Rq Date : <strong class="text-success">{{$user->updated_at}}</strong>

                                    @endif
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
                                        @if($user->type == 1 || $user->type == 2 ) 
                                        @if($user->request_sent == 1)
                                        <a href="{{route('Done' ,$user->id)}}" class="btn btn-sm btn-info font-weight-bolder text-uppercase mr-2 ">
                                            <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Done-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                    <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg><!--end::Svg Icon--></span>
                                            Accept For New Property  </a>
                                        @endif
                                        @endif
                                        @if (!$user->type == 1 || !$user->type == 2)
                                            
                                        <form action="{{route('binding.refuse' ,$user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-sm btn-danger font-weight-bolder text-uppercase mr-2">
                                            <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                                </g>
                                            </svg><!--end::Svg Icon--></span>
                                        Refuse</button>

                                    </form>
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
                                        Lead User</a>


                                   
                                    
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
                                <h3 class="card-label">User Details Preview
                            </div>
                            <a href="{{route('edituser' ,$user->id)}}" class="btn btn-success">Edit info</a>
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
                                <label class="col-4 col-form-label">Owned Units:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a >{{-- $user->owner->unit_number --}}</a>
                                        @foreach ($ownedproperty as $owned)
                                        <a class="text-dark">{{ $owned->name_en }} ,</a>
                                        @endforeach
                                        
                                    </span>
                                </div>

                            </div>
                           
                            @else
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Owned Units:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        <a> None</a>
                                    </span>
                                </div>
                            </div>

                            @endif

                            @if ( $user->tenant)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Rental Units:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">
                                        @foreach ($rentalproperty as $owned)
                                        <a class="text-dark">{{ $owned->name_en }} ,</a>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if($user->country)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Country:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->Country->name ?? ''}}</span>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->country)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">City:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->City->name ?? ''}}</span>
                                </div>
                            </div>
                            @endif
                            @if($user->mobile_number)

                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Mobile:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->mobile_number ?? ''}}</span>
                                </div>
                            </div>
                            @endif

                            @if($user->id_number)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Emirate ID:</label>
                                <div class="col-8">
                                    <span class="form-control-plaintext font-weight-bolder">{{ $user->id_number  ?? ''}}</span>
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
                           
                            @endif
                            @if($user->owner)
                           
                           
                            
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Community: </label>
                                <div class="col-8">
                                    <span class="form-control-plaintext">
                                    <span class="label label-lg label-inline ">{{ $user->owner->community->name_en}}</span></span>
                                </div>
                            </div>
                            @elseif($user->tenant)
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Community </label>
                                <div class="col-8">
                                    <span class="form-control-plaintext">
                                    
                                    <span class="label label-lg label-inline ">{{$user->tenant->community->name_en ?? $user->owner->community->name_en}}</span></span>
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

                                @if($user->type != 0)
                                
                                <a data-toggle="modal" data-target="#exampleModalScrollable"  class="btn btn-sm btn-warning font-weight-bolder text-uppercase ml-2">
                                    Edit Document
                                </a>

                                @endif
                            </div>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body" >
                            
                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                    @if ($user->tenant)
                                    <a href="{{asset('uploads/' .  $user->tenant->passport_copy)}}" data-lity>
                                   
                                        <img src="{{asset('uploads/' .  $user->tenant->passport_copy)}}" class="bgi-no-repeat bgi-size-cover rounded min-h-361px " style="height: 361px; width: 100%;">
                                    
                                    </a>
                                    @elseif($user->owner)
                                    <a href="{{asset('uploads/' . $user->owner->passport_copy)}}" data-lity>
                                            
                                        <img src="{{asset('uploads/' .  $user->owner->passport_copy)}}" class="bgi-no-repeat bgi-size-cover rounded min-h-361px " style="height: 361px; width: 100%;">
                                            
                                    </a>

                                    @else
                                            

                                    @endif




                                </div>

                          


                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                    @if ($user->tenant)
                                    <a href="{{asset('uploads/' . $user->tenant->visa_copy)}}" data-lity>
                                        
                                        <img src="{{asset('uploads/' .  $user->tenant->visa_copy)}}" class="bgi-no-repeat bgi-size-cover rounded min-h-361px " style="height: 361px; width: 100%;">
                                       
                                    </a>

                                    @elseif($user->owner)
                                    <a href="{{asset('uploads/' . $user->owner->title_dead_copy)}}" data-lity>
                                                <img src="{{asset('uploads/' .  $user->owner->title_dead_copy)}}" class="bgi-no-repeat bgi-size-cover rounded min-h-361px " style="height: 361px; width: 100%;">
                                    </a>
                                    @else


                                    @endif

                                </div>
                                
                            </div>
                           
                        </div>
                        
                        <!--end::Body-->
                        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                            aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <form action="{{route('update-docs')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Documents</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="height: 300px;">
                                       
                                        @if ($user->tenant)
                                        <input hidden name="tenant_id" value="{{$user->tenant->id}}">
                                        <div class="form-group row tenant">
                                            <label class="col-lg-3 col-form-label text-right">Visa Copy :</label>
                                            <div class="col-lg-9">
                                                <div class="custom-file">
                                                    <input name="visa_copy" type="file" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label " for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($user->owner)
                                        <input name="owner_id" hidden value="{{$user->owner->id}}">
                                        <div class="form-group row owner">
                                            <label class="col-lg-3 col-form-label text-right">Title Dead Copy :</label>
                                            <div class="col-lg-9">
                                                <div class="custom-file">
                                                    <input name="title_dead_copy" type="file" class="custom-file-input owner" id="customFile">
                                                    <label class="custom-file-label " for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
        
                                        @endif
                                        <div class="form-group row owner tenant">
                                            <label class="col-lg-3 col-form-label text-right">Passport Copy :</label>
                                            <div class="col-lg-9">
                                                <div class="custom-file">
                                                    <input name="passport_copy" type="file" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label " for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                         

                                      
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end::Footer-->
                    </div>


                    
                    <!--end::Card-->
                </div>
            </div>
        </div>
            <div class="row mt-10">
                <div class="col-xl-12">
                    <!--begin::Card-->
                    
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">User History (Enquires & Contacts)
                            </h3></div>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-4 row">
                            @foreach ($history as $history)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b card-stretch bg-gray border">
                                    <!--begin::Body-->
                                    <div class="card-body pt-4">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex justify-content-end">
                                           <span class="font-weight-bold text-success">
                                               @if ($history->property_id)
                                               Enquiry
                                               @else
                                               Contact
                                           @endif
                                        </span>
                                        </div>
                                        <!--end::Toolbar-->
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center mb-7">
                                            <!--begin::Pic-->
                                            <div class="flex-shrink-0 mr-4">
                                                <div class="symbol symbol-circle symbol-lg-75">
                                                    <img src="{{asset('uploads/' . $user->image_url)}}" alt="image">
                                                </div>
                                                                                    
                                            </div>
                                            <!--end::Pic-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a  class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{$user->first_name . ' '.$user->last_name}}</a>
                                               
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::Desc-->
                                        <p class="mb-7 overflow-auto max-h-100px h-100px">
                                            {{$history->message}}
                                        </p>
                                        <!--end::Desc-->
                                        <!--begin::Info-->
                                        <div class="mb-7">
                                            <div class="d-flex justify-content-between align-items-center">
                                               
                                            </div>
                                           
                                            <div class="d-flex justify-content-between align-items-cente my-1">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Created at:</span>
                                                <a href="#" class="text-muted text-hover-primary">{{$history->created_at}}</a>
                                            </div>
                                            
                                        </div>
                                       
                                        
            
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end:: Card-->
                            </div> 
                            @endforeach                          
                            
                           
                        </div>
                        <!--end::Body-->
                       
                        <!--end::Footer-->
                    </div>


                    
                    <!--end::Card-->
                </div>
                
            </div>
           
            
            
            <!--end::Row-->
        </div>
            
            <!--end::Row-->
        </div>
            
            <!--end::Row-->
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script src="{{asset('admin/assets/js/lity/lity.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/custom/education/student/profile.js')}}"></script>

@endsection