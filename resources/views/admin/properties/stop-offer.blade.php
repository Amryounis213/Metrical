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
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{--$properties_count--}} Total</span>
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
                                    <span class="card-label font-weight-bolder text-dark">{{$title}}</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                                </h3>
                                <div class="card-toolbar">
                                   
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-0">
                                <!--begin::Search Form-->
                                <div class="mb-7">
                                   
                                </div>
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-vertical-center"
                                        id="kt_advance_table_widget_2">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th class="pl-0" style="width: 40px">
                                                    <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                        <input type="checkbox" value="1" />
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th class="pl-0" style="min-width: 100px">#</th>
                                                <th style="min-width: 120px">full_name</th>
                                                <th style="min-width: 120px">email</th>
                                                <th style="min-width: 120px">propertiy</th>
                                                <th style="min-width: 120px">offer</th>
                                                <th style="min-width: 120px">reason</th>
                                                
                                                <th class="min-width: 120px" >Submited At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($offers as $key=>$offer)
                                            <tr>
                                                <td></td>
                                                <td class="pl-0 py-6">
                                                    <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $key+1}}
                                                    </span>
                                                </td>
                                                <td class="pl-0 py-6">
                                                    <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{  $offer->full_name}}
                                                    </span>
                                                </td>
                                                <td class="pl-0 py-6">
                                                    <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{  $offer->email}}
                                                    </span>
                                                </td>
                                                <td class="pl-0 py-6">
                                                    <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{  $offer->offer->property->name_en ?? ''}}
                                                    </span>
                                                </td>
                                                <td class="pl-0 py-6">
                                                    <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{  $offer->offer->type ?? ''}}
                                                    </span>
                                                </td>
                                                <td class="pl-0 py-6">
                                                    <button data-toggle="modal" data-target="#stop-offer{{$offer->id}}" type="button" class="btn btn-primary btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto">View reason</button>
                                                    
                                                </td>
                                                <td class="pl-0 py-6">
                                                    <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{  $offer->created_at}}
                                                    </span>
                                                </td>
                                                
                                            </tr>

                                              <!-- Modal-->
                            <div class="modal fade" id="stop-offer{{$offer->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reson</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="height: 300px;">
                                            {{$offer->reason}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                data-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary font-weight-bold">Save
                                                changes</button> --}}
                                        </div>
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


                          
                        </div>
                        <!--end::Advance Table Widget 5-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection