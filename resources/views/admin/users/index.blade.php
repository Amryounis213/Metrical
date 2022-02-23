@extends('components.admin-layout')

@section('content')

<div id="dd" class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Users</h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Search Form-->
            <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{$users->count()}} Total</span>
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
                    <span class="card-label font-weight-bolder text-dark">{{$title ?? 'Users Filter'}}</span>
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-0">
                <!--begin::Search Form-->
                <div class="mb-7">
                    <form action="{{route('users.filter')}}" class="row align-items-center" method="POST">
                        @csrf
                        <div class="col-lg-10 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-8 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input name="name" type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                              
                               
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                        <select name="type" class="form-control" id="filter">
                                            <option value="">--Select--</option>
                                            <option value="1">Owner</option>
                                            <option value="2">Tenant</option>
                                            <option value="0">Lead</option>
                                            <option value="4">All</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                           <button type="submit" class="btn btn-light-primary px-6 font-weight-bold" >Search</button>
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
                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                        <thead>
                            <tr class="text-uppercase">
                                
                                <th class="pl-0" style="min-width: 100px">#</th>
                                <th style="min-width: 120px">Image</th>
                                <th style="min-width: 120px">Name</th>
                                <th style="min-width: 120px">Joined</th>
                                <th style="min-width: 120px">Mobile Number</th>
                                <th style="min-width: 130px">Type</th>
                                <th style="min-width: 130px">Request type</th>
                                <th style="min-width: 130px">Status</th>
                                <th class="pr-0 text-right" style="min-width: 160px">action</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            @foreach ($users as $key=>$user)
                            <tr>
                               
                                <td class="pl-0">
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$key +1}}</a>
                                    <input hidden id="userId"  value="{{$user->id}}">
                                </td>
                                <td>

                                    <div class="symbol mr-5 pt-1">
                                        <div class="symbol-label min-w-65px min-h-100px" style="background-image: url({{ asset($user->image_path)}})"></div>
                                    </div>

                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $user->first_name . ' ' . $user->last_name }}</span>

                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg text-primary">{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}

                                    </span>

                                </td>
                             
                                <td>
                                    

                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $user->mobile_number }}</span>

                                        
                                </td>
                                <td>
                                    @if($user->type == '0')
                                    <span class="label label-lg label-warning label-inline">Lead</span>
                                    @elseif($user->type == '1')
                                    <span class="label label-lg label-light-success label-inline">Owner</span>
                                    @elseif($user->type == '2')
                                    <span class="label label-lg label-light-primary label-inline">Tenant</span>
                                    @else
                                    <span class="label label-lg label-light-primary label-inline">Admin</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->need == 'normal')
                                    <span class="label label-lg label-secondary label-inline">No request</span>
                                    @elseif($user->need == 'owner')
                                    <span class="label label-lg label-light-success label-inline">Owner</span>
                                    @else
                                    <span class="label label-lg label-light-primary label-inline">Tenant</span>
                                    @endif
                                </td>

                                <td>
                                    
                                   <span  class="label @if($user->is_active) label-light-success  @else label-light-danger @endif  label-inline ml-2">@if($user->is_active) Active @else blocked @endif</span>
                                                             
                                </td>
                                <td class="pr-0 text-right">
                                    <a href="{{route('binding.show', $user->id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                           
<span class="svg-icon svg-icon-success">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
        </g>
    </svg>
    
</span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        
                                    </a>



                                   



                                  

                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
                <!--end::Table-->
            </div>


            <!-- Modal-->
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
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
    </div></div>
@endsection


@section('scripts')
<script src="{{asset('admin/assets/js/pages/crud/forms/validation/form-widgets.js')}}"></script>

@endsection