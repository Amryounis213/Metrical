@extends('components.admin-layout')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Properties</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{$properties_count ?? $properties->count()}} Total</span>

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
                @if ($percentage > 0)
                    
                <div class="flex-row-fluid">
                    <div class="d-flex align-items-center pt-2">
                        <span class="ml-3 mr-3 font-weight-bolder">Rental Properties</span>
                        <div class="progress progress-xs mt-2 mb-2 w-50">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$percentage . '%'}};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="ml-3 font-weight-bolder">% {{$percentage}}</span>
                    </div>
                </div>
                @endif

                <!--end::Details-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Button-->
                    <a href="#" class=""></a>
                    <!--end::Button--> 
                    <!--begin::Button-->
                    <a  href="{{route('properties.create')}}" class="btn btn-light-primary font-weight-bold ml-2">Add Property</a>
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
                    @foreach ($properties as $property)
                    <div class="col-xl-6">
                      
                              <!--begin::Card-->
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Pic-->
                                    <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                                        <img src="{{asset('uploads/'. $property->image_url)}}" alt="image" />
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column mr-auto">
                                        <!--begin: Title-->
                                        <a href="#" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{$property->name_en}}</a>
                                        <span class="text-muted font-weight-bold">{{$property->community->name_en ?? 'Test'}} Community</span>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar mb-auto">
                                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <!--begin::Navigation-->
                                                <ul class="navi navi-hover">
                                                    <li class="navi-header pb-1">
                                                        <span class="text-primary text-uppercase font-weight-bold font-size-sm">Options</span>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a  href="{{route('properties.edit' ,$property->id)}}" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="flaticon2-shopping-cart-1"></i>
                                                            </span>
                                                            <span class="navi-text">Edit </span>
                                                        </a>
                                                    </li>
                                                    <form id="form{{$property->id}}" class="delete" action="{{route('properties.destroy',$property->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    <li class="navi-item">
                                                       
                                                        <a href="" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="flaticon2-shopping-cart-1"></i>
                                                            </span>

                            
                                                           <span class="delete navi-text">Delete</span>
                                                        </a>
                                                        
                                                    </li>
                                                </form>
                                                </ul>
                                                <!--end::Navigation-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Content-->
                                @forelse ($property->rent as $rent)
                                <div class="d-flex flex-wrap mt-14">
                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="d-block font-weight-bold mb-4">Start Date</span>
                                        <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{$rent->from ?? ''}}</span>
                                    </div>
                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="d-block font-weight-bold mb-4">Finish Date</span>
                                        <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{$rent->to ?? ''}}</span>
                                    </div>
                                   
                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="d-block font-weight-bold mb-4">Rent Price </span>
                                        <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{$rent->price ?? ''}}</span>
                                    </div>
                                </div> 
                                @empty
                                <div class="d-flex flex-wrap mt-14">
                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="d-block font-weight-bold mb-4">Start Date</span>
                                        <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">Not yet rented</span>
                                    </div>
                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="d-block font-weight-bold mb-4">Finish Date</span>
                                        <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">Not yet rented</span>
                                    </div>
                                </div>   
                                @endforelse
                                
                                <!--end::Content-->

                              
                                <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="faq">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <div class="card-header" id="faqHeading{{$property->id}}">
                                            <div class="card-title text-dark collapsed" data-toggle="collapse" data-target="#faq{{$property->id}}" aria-expanded="false" aria-controls="faq1" role="button">
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
                                        <div id="faq{{$property->id}}" class="collapse" aria-labelledby="faqHeading1" data-parent="#faq" style="">
                                            <div class="card-body text-dark-50 line-height-lg pl-12">{{$property->description_en}}</div>
                                        </div>
                                    </div>
                               
                                <!--begin::Card-->
                                
                                <!--end::Card-->
                            </div>

                            <hr>
                                <!--begin::Blog-->
                                <div class="d-flex flex-wrap">
                                    <!--begin: Item-->
                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="font-weight-bolder mb-4">Short Term</span>
                                        <span class="font-weight-bolder font-size-h5 pt-1">
                                        <span class="font-weight-bold text-dark-50"></span>{{$property->is_shortterm ? 'Yes' : 'NO'}}</span>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="font-weight-bolder mb-4">Bedroom</span>
                                        <span class="font-weight-bolder font-size-h5 pt-1">
                                        <span class="font-weight-bold text-dark-50"></span>{{$property->bedroom}}</span>
                                    </div>

                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="font-weight-bolder mb-4">Bathroom</span>
                                        <span class="font-weight-bolder font-size-h5 pt-1">
                                        <span class="font-weight-bold text-dark-50"></span>{{$property->bathroom}}</span>
                                    </div>


                                    <div class="mr-12 d-flex flex-column mb-7">
                                        <span class="font-weight-bolder mb-4">Offer Type</span>
                                        <span class="font-weight-bolder font-size-h5 pt-1">
                                        <span class="font-weight-bold text-dark-50"></span>{{$property->offer_type}}</span>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                        <span class="font-weight-bolder mb-4">Owner / Tenant</span>
                                        <div class="symbol-group symbol-hover">
                                            @if ($property->owner != null)
                                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="{{$property->owner->full_name ?? ''}}">
                                                
                                                <img style="
                                                display: inline-block;
                                                width: 100%;
                                                max-width: 30px;
                                                height: 30px;"
                                                 alt="Pic" src="{{asset($property->owner->user->image_path)}}" />
                                                {{-- {{$property->owner->full_name ?? ''}} --}}
                                            </div>
                                            @else
                                            <div class="symbol symbol-30 symbol-circle">
                                               No Owner else 
                                            </div>
                                            @endif
                                          
                                            
                                        </div>
                                    </div>
                                    <!--end::Item-->
                              
                                    <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                        <div class="mr-2 d-flex flex-column mb-7">
                                            <span class="d-block font-weight-bold mb-4">Amenities</span>
                                            @if ($property->amenities != null)
                                                
                                           <div class="row">
                                            @forelse ($property->amenities as $amenity)
                                            <div class="mr-12 d-flex flex-column mb-7">
                                                <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{$amenity}}</span>
                                            </div>
                                            @empty
                                            No
                                            @endforelse
                                           </div>
                                            @endif
                                          
                                        </div>
                                        
                                        
                                        
                                        <!--end::Progress-->
                                    </div> 
                                </div>
                                <!--end::Blog-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer d-flex align-items-center">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center mr-7">
                                        <span class="svg-icon svg-icon-gray-500">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Bullet-list.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000" />
                                                    <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                   
                                </div>
                                {{-- <button type="button" class="btn btn-primary btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto">details</button> --}}
                                <button data-toggle="modal" data-target="#owner-{{$property->id}}" type="button" class="btn btn-success btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                                      </svg>
                                    Add Owner
                                </button>

                                @if($property->tenant_id == null)
                                <button  data-toggle="modal" data-target="#exampleModal{{$property->id}}" type="button" class="btn btn-success btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto make-rent">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
                                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
                                      </svg>
                                     Make Rent
                                </button>
                                @else
                                <a href="{{route('StopRent' , $property->id)}}" class="btn btn-warning btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
                                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
                                      </svg>
                                     Close Rent Now  </a>
                                @endif
                                <a href="{{route('show-properties-image' , $property->id)}}"  type="button" class="btn btn-success btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto make-rent">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                      </svg>
                                    Upload Images
                                </a>

                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Card-->
                       
                      
                    </div>

                      <!-- Modal-->
                     <!-----Model For Rent--->
                     <div class="modal fade" id="exampleModal{{$property->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Make A property Rent</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <form action="{{route('renting.store')}}" method="POST">
                                <div class="modal-body">
                                        @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Start Time</label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                            <div class="input-group date kt_datetimepicker_7_1" data-target-input="nearest">
                                                <input name="from" type="text" class="form-control datetimepicker-input" placeholder="Select date &amp; time" data-target=".kt_datetimepicker_7_1" />
                                                <div class="input-group-append" data-target=".kt_datetimepicker_7_1" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                    
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Last Time</label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                            <div class="input-group date kt_datetimepicker_7_2"  data-target-input="nearest">
                                                <input name="to" type="text" class="form-control datetimepicker-input" placeholder="Select date &amp; time" data-target=".kt_datetimepicker_7_2" />
                                                <div class="input-group-append" data-target=".kt_datetimepicker_7_2" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                    
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Price</label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                        <input name="price" type="number" class="form-control"  placeholder="Ex : 500"/>
                                        </div>
                                    </div>
                                    <input hidden  name="property_id" type="number" class="form-control"  value="{{$property->id}}" />
                    
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Tenant</label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                            <select name="tenant_id" class="form-control" id="exampleSelectd">
                                                <option data-dismiss>--Select Name</option>
                                               
                                                    
                                    
                                                @foreach ($tenants as $tenant)
                                                @if ($tenant->tenant != null)
                                                <option value="{{$tenant->tenant->id}}" >{{$tenant->tenant->full_name}}</option>
                                                @endif
                                                @endforeach

                                               
                                        </select>                    
                                    
                                        </div>
                                    </div>
                                       
                                       
                                </div>
                    
                    
                    
                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Create</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                    

                    <!----- End Model For Rent --->
                      <!-- Modal-->
                     <!-----Model For Owner--->
                     <div class="modal fade" id="owner-{{$property->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Owner For <strong class="text-success"> {{$property->name_en}}</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <form action="{{route('properties.addOwner')}}" method="POST">
                                <div class="modal-body">
                                        @csrf
                                    
                                        <input hidden  name="property_id" type="number" class="form-control"  value="{{$property->id}}" />
                                       
                                    
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Owners</label>
                                            <div class="col-10">
                                                <select name="owner_id" class="form-control selectpicker" data-size="7"
                                                data-live-search="true">
                                                <option value="">Select</option>
                                                @foreach ($owners as $owner)
                                                @if ($owner->owner != null)
                                                <option value="{{$owner->owner->id}}" >{{$owner->owner->full_name}}</option>
                                                @endif
                                                @endforeach
                                             
                                             </select>
                                            </div>
                                        </div>
                                        
                                  
                                       
                                       
                                </div>
                    
                    
                    
                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Create</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>


                    <!----- End Model For Rent --->
                    @endforeach

                  
                   
                </div>
                <!--end::Row-->
                
                <!--begin::Pagination-->
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    
                       {{$properties->links()}} 
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
<script src="{{asset('assets/js/pages/crud/file-upload/dropzonejs.js')}}"></script>
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<script src="https://keenthemes.com/metronic/assets/js/engage_code.js"></script>
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>

@endsection