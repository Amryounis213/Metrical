@extends('components.admin-layout')
@section('stylesheet')
<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
@php
    $people =  \App\Models\InterestedUser::where('status' , '1')->get();
@endphp
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Events</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{$events->count()}} Total</span>

                        <form class="ml-5">
                            <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                                <input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Search..." />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                                    </span>
                                </div>
                            </div>
                        </form>

                       
                    </div>
                    <!--end::Search Form-->
                    <!--begin::Group Actions-->
                    <div class="d-flex- align-items-center flex-wrap mr-2 d-none" id="kt_subheader_group_actions">
                        <div class="text-dark-50 font-weight-bold">
                        <span id="kt_subheader_group_selected_rows">23</span>Selected:</div>
                        <div class="d-flex ml-6">
                            <div class="dropdown mr-2" id="kt_subheader_group_actions_status_change">
                                <button type="button" class="btn btn-light-primary font-weight-bolder btn-sm dropdown-toggle" data-toggle="dropdown">Update Status</button>
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-sm">
                                    <ul class="navi navi-hover pt-3 pb-4">
                                        <li class="navi-header font-weight-bolder text-uppercase text-primary font-size-lg pb-0">Change status to:</li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" data-toggle="status-change" data-status="1">
                                                <span class="navi-text">
                                                    <span class="label label-light-success label-inline font-weight-bold">Approved</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" data-toggle="status-change" data-status="2">
                                                <span class="navi-text">
                                                    <span class="label label-light-danger label-inline font-weight-bold">Rejected</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" data-toggle="status-change" data-status="3">
                                                <span class="navi-text">
                                                    <span class="label label-light-warning label-inline font-weight-bold">Pending</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" data-toggle="status-change" data-status="4">
                                                <span class="navi-text">
                                                    <span class="label label-light-info label-inline font-weight-bold">On Hold</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button class="btn btn-light-success font-weight-bolder btn-sm mr-2" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">Fetch Selected</button>
                            <button class="btn btn-light-danger font-weight-bolder btn-sm mr-2" id="kt_subheader_group_actions_delete_all">Delete All</button>
                        </div>
                    </div>
                    <!--end::Group Actions-->
                </div>
               

                <!--end::Details-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Button-->
                    <a href="#" class=""></a>
                    <!--end::Button--> 
                    <!--begin::Button-->
                    <a  href="{{route('events.create')}}" class="btn btn-light-primary font-weight-bold ml-2">Add Event</a>
                    <!--end::Button-->
                  
                </div>
                <!--end::Toolbar-->

                
            </div>
        </div>
        <!--end::Subheader-->
        @if(Session::has('rent'))
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                            <div class="alert alert-custom alert-primary fade show" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                <div class="alert-text">{{ Session::get('rent') }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Row-->
                <div class="row">
                    @foreach ($events as $event)
                    <div class="col-xl-6">
        
                             
                        <div class="card card-custom gutter-b card-stretch">
                           
                            <div class="card-body">
                                <!--begin::Wrapper-->
                                <div class="d-flex justify-content-between flex-column h-100">
                                    <!--begin::Container-->
                                    <div class="h-100">
                                        <!--begin::Header-->
                                        <div class="d-flex flex-column flex-center">
                                            <!--begin::Image-->
                                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url({{asset('uploads/'.$event->image_url)}})"></div>
                                            <!--end::Image-->
                                            <!--begin::Title-->
                                            <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">{{$event->title_en}}</a>
                                            <!--end::Title-->
                                            <!--begin::Text-->
                                            <div class="font-weight-bold text-dark-50 font-size-sm pb-7">{{$event->address}}</div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="pt-1">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a  class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Community</a>
                                                    <span class="text-muted font-weight-bold">{{$event->community->name_en}}</span>
                                                </div>
                                                <!--end::Text-->
                                               
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Start Date</a>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d')}}</span>
                                                <!--end::label-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"></circle>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">End Date</a>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">{{\Carbon\Carbon::parse($event->end_date)->format('Y-m-d')}}</span>
                                                <!--end::label-->
                                            </div>


                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Like.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z" fill="#000000"/>
                                                                <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1"/>
                                                            </g>
                                                        </svg><!--end::Svg Icon--></span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Number of interested</a>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">{{ $people->where('event_id' , $event->id)->count()}}</span> 
                                                <!--end::label-->
                                            </div>
                                            <!--end::Item-->
                                            @if($people->where('event_id' , $event->id)->count())
                                            <div class="d-flex flex-row flex-grow-1 justify-content-center">
                                            <a href="{{route('send-reminder' , $event->id)}}" class="btn btn-light-success">Send Reminder</a>
                                             </div>
                                             @endif
                                            <hr>
                                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="faq">
                                                <!--begin::Card-->
                                                <div class="card">
                                                    <div class="card-header" id="faqHeading{{$event->id}}">
                                                        <div class="card-title text-dark collapsed" data-toggle="collapse" data-target="#faq{{$event->id}}" aria-expanded="false" aria-controls="faq1" role="button">
                                                            <span class="svg-icon svg-icon-primary">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                            <div class="card-label text-dark pl-4">Description</div>
                                                        </div>
                                                    </div>
                                                    <div id="faq{{$event->id}}" class="collapse" aria-labelledby="faqHeading1" data-parent="#faq" style="">
                                                        <div class="card-body text-dark-50 line-height-lg pl-12">{{$event->description_en}}</div>
                                                    </div>
                                                </div>
                                               
                                                <!--begin::Card-->
                                                
                                                <!--end::Card-->
                                            </div>

                                            <hr>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--eng::Container-->
                                    <!--begin::Footer-->
                                    <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_3" data-toggle="tooltip" title="" >
                                        <a href="{{route('events.edit' ,$event->id)}}"
                                            class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                        <path
                                                            d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            opacity="0.3" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </a>
                                       
                                        <a class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                            <form class="delete" action="{{route('events.destroy', $event->id)}}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button  class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            width="24px" height="24px" viewBox="0 0 24 24"
                                                            version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                    fill="#000000" fill-rule="nonzero" />
                                                                <path
                                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </button>

                                            </form>
                                        </a>
                                    </div>
                                    <!--end::Footer-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                             
                           
                        </div>
                      
                       
                      
                    </div>


                  
                    @endforeach

                  
                   
                </div>
                <!--end::Row-->
                
                <!--begin::Pagination-->
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    
                       {{$events->links()}} 
                </div>
                <!--end::Pagination-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
        
    </div>

<x-form-script />

@endsection
@section('scripts')
<script src="{{asset('admin/assets/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script src="{{asset('admin/assets/js/sweettost/alert.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/custom/todo/todo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>

@if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-bottom-right",
  
  }
  		toastr.success("{{ session('success') }}");
@endif
</script>

@endsection