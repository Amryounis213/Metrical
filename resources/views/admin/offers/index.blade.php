@extends('components.admin-layout')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Offers</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{$offers->count()}} Total</span>
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
                <!--end::Button-->
              
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    @if(Session::has('create'))
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <div class="alert alert-custom alert-primary fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">{{ Session::get('create') }}</div>
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
    @if(Session::has('edit'))
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <div class="alert alert-custom alert-primary fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">{{ Session::get('edit') }}</div>
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
    @if(Session::has('delete'))
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <div class="alert alert-custom alert-danger fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">{{ Session::get('delete') }}</div>
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
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Advance Table Widget 5-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">{{$title ?? 'Offers Filter'}}</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">All Offer Here</span>
                                </h3>
                                <div class="card-toolbar">
                                   
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-0">
                                <!--begin::Search Form-->
                                <div class="mb-7">
                                    <form action="{{route('offers.filter')}}" method="POST" class="row align-items-center">
                                        @csrf
                                        <div class="col-lg-9 col-xl-8">
                                            <div class="row align-items-center">
                                                <div class="col-md-8 my-2 my-md-0">
                                                    <div class="input-icon">
                                                        <input name="name" type="text" class="form-control" placeholder="Search..."
                                                            id="kt_datatable_search_query" />
                                                        <span>
                                                            <i class="flaticon2-search-1 text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                                        <select name="type" class="form-control" id="kt_datatable_search_type">
                                                            <option value="">All</option>
                                                            <option value="sale">Sale</option>
                                                            <option value="rent">Rent</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                            <button class="btn btn-light-primary px-6 font-weight-bold">Search</button>
                                        </div>
                                    </form>
                                </div>

                                @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                 {{Session::get('success')}}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                @endif
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-vertical-center"
                                        id="kt_advance_table_widget_2">
                                        <thead>
                                            <tr class="text-uppercase">
                                                
                                                <th class="pl-0" style="min-width: 100px">#</th>
                                                <th style="min-width: 120px">Full Name</th>
                                                <th style="min-width: 120px">Type</th>
                                                <th style="min-width: 120px">Price</th>
												<th style="min-width: 120px">Property</th>
                                                <th style="min-width: 120px">Status</th>
                                                <th style="min-width: 120px">DOC 1</th>
                                                <th style="min-width: 120px">DOC 2</th>
                                                <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($offers as $key => $event)
                                            <tr>
                                                
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$key + 1}}</a>
                                                </td>

                                                <td>
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$event->full_name}}</span>

                                                </td>
                                                <td>
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$event->type}}</span>

                                                </td>
                                                <td>
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ number_format( $event->sale_price, 2, ',', '.')  ?? number_format( $event->rent_price, 2, ',', '.') }} AED </span>
                                                </td>

												<td>
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{  $event->property->name_en ?? ''}} <br> 
                                                        @if ($event->rent_start_date)
                                                        <span
                                                        class="text-primary font-weight-bolder d-block font-size-lg">({{ $event->rent_start_date}} - {{ $event->rent_end_date}})</span>
                                                        @endif
                                                       
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="label label-lg @if($event->status == "1") label-light-success @else label-light-primary @endif label-inline">{{ $event->status ? 'Accepted' : 'Pending' }}</span>
                                                    
                                                </td>
                                                <td>
                                                    <a href="{{asset('uploads/' .  $event->passport_copy)}}" data-lity>
                                                        Show passport  
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="{{asset('uploads/' .  $event->title_dead_copy)}}" data-lity>
                                                        Show title copy  
                                                    </a>
                                                </td>


                                                <td class="pr-0 text-right">
                                                    <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                    
                                                    <a class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <form class="delete" action="{{ route('offers.destroy', $event->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button  class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                                    <i class="flaticon2-delete text-primary"></i>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </button>

                                                        </form>
                                                    </a>
                                                    @if ($event->status == 0)
                                                    <a class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <form action="{{ route('offers.accept', $event->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" style="border:none">
                                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                                        <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
                                                                    </g>
                                                                </svg><!--end::Svg Icon--></span>
                                                            </button>

                                                        </form>
                                                    </a> 
                                                    @endif
													
                                                    
                                                </td>
                                            </tr>


                                             <!-- Modal-->
                            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                            aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <form action="{{route('update-offer')}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="height: 300px;">
                                        <input  hidden name="offer_id" type="number" class="form-control"  value="{{$event->id}}" />

                                        @if ($event->type == 'rent')
                                            

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Rent Price</label>
                                                <div class="col-9">
                                                    <input   name="rent_price" type="number" class="form-control"  value="{{$event->rent_price}}" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Start Date</label>
                                                <div class="col-9">
                                                    <input   name="rent_start_date" type="date" class="form-control"  value="{{$event->rent_start_date}}" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">End Date</label>
                                                <div class="col-9">
                                                    <input   name="rent_end_date" type="date" class="form-control"  value="{{$event->rent_end_date}}" />
                                                </div>
                                            </div>

                                        @else
                                        <input   name="sale_price" type="number" class="form-control"  value="{{$event->sale_price}}" />


                                        @endif

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
                        <!--end::Body-->
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>


                            <!-- Modal-->
                            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                                aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="height: 300px;">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary font-weight-bold">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Advance Table Widget 5-->
                    </div>
                </div>
            </div>
            {{-- $offers->links() --}}
        </div>
    </div>


@endsection

@section('scripts')
<script src="{{asset('admin/assets/js/lity/lity.js')}}"></script>

<script src="{{asset('admin/assets/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script src="{{asset('admin/assets/js/sweettost/alert.js')}}"></script>


@endsection