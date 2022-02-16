@extends('components.admin-layout')

@section('content')    
<!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                    <!--end::Page Title-->
                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200">
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Info-->
               
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
              <div class="row">
                <div class="col-lg-4 col-xxl-4">
                  <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 150px; background-image: url({{asset('admin/assets/media/bg/bg-9.jpg')}})">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                      <!--begin::Title-->
                      <a @can('properties.view-any') href="{{route('properties.index')}}" @endcan class="text-dark-75 text-hover-warning font-weight-bolder font-size-h3">Properties</a> <br>
                      <span class="text-inverse-primary font-weight-bolder font-size-h2 mt-3" >{{$properties}}</span>
                      <!--end::Title-->
                    </div>
                    <!--end::Body-->
                  </div>
                  <div class="row">
                  <div class="col-md-8">

                  <div class="card card-custom  bg-dark bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 150px;">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                      <!--begin::Title-->
                      <a @can('user.view-any') href="{{route('binding.users')}}" @endcan class="text-warning text-hover-warning font-weight-bolder ">Pending User</a> <br>
                      <span class="text-inverse-primary font-weight-bolder font-size-h2 mt-3" >{{$pending_users->count()}}</span>
                      <!--end::Title-->
                    </div>
                    <!--end::Body-->
                  </div>

                  </div>
                 
                  <div class="col-md-4">

                    <div class="card card-custom  bg-dark bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 150px;">
                      <!--begin::Body-->
                      <div class="card-body d-flex flex-column">
                        <!--begin::Title-->
                        <a @can('events.view') href="{{route('events.index')}}" @endcan class="text-warning text-hover-warning font-weight-bolder " style="font-size: 12px;">Events</a> <br>
                        <span class="text-inverse-primary font-weight-bolder font-size-h4 mt-3" >{{$events->count()}}</span>
                        <!--end::Title-->
                      </div>
                      <!--end::Body-->
                    </div>
  
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">

                      <div class="card card-custom  bg-dark bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 150px;">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                          <!--begin::Title-->
                          <a @can('events.view') href="{{route('news.index')}}" @endcan class="text-warning text-hover-warning font-weight-bolder ">News</a> <br>
                          <span class="text-inverse-primary font-weight-bolder font-size-h4 mt-3" >{{$news->count()}}</span>
                          <!--end::Title-->
                        </div>
                        <!--end::Body-->
                      </div>
    
                      </div>
                    <div class="col-md-4">
  
                    <div class="card card-custom  bg-dark bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 150px;">
                      <!--begin::Body-->
                      <div class="card-body d-flex flex-column">
                        <!--begin::Title-->
                        <a @can('communities.view') href="{{route('communities.index')}}" @endcan class="text-warning text-hover-warning font-weight-bolder ">Com</a> <br>
                        <span class="text-inverse-primary font-weight-bolder font-size-h2 mt-3" >{{$communities->count()}}</span>
                        <!--end::Title-->
                      </div>
                      <!--end::Body-->
                    </div>
  
                    </div>
                    
                    <div class="col-md-4">
  
                      <div class="card card-custom  bg-dark bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 150px;">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                          <!--begin::Title-->
                          <a @can('offers.view') href="{{route('offers.index')}}" @endcan class="text-warning text-hover-warning font-weight-bolder " style="font-size: 12px;">Offers</a> <br>
                          <span class="text-inverse-primary font-weight-bolder font-size-h4 mt-3" >{{$offers}}</span>
                          <!--end::Title-->
                        </div>
                        <!--end::Body-->
                      </div>
    
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xxl-4">
                  <!--begin::List Widget 9-->
                  <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header align-items-center border-0 mt-4">
                      <h3 class="card-title align-items-start flex-column">
                        <span class="font-weight-bolder text-dark">Rents Activity</span>
                      </h3>
                      <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                         
                         
                        </div>
                      </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                      <!--begin::Timeline-->
                      <div class="timeline timeline-6 mt-3">
                        <!--begin::Item-->
                        @foreach ($rents as $rent)
                        <div class="timeline-item align-items-start">
                          <!--begin::Label-->
                          <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{\Carbon\Carbon::parse($rent->created_at)->format('h:i')}}</div>
                          <!--end::Label-->
                          <!--begin::Badge-->
                          <div class="timeline-badge">
                            <i class="fa fa-genderless text-warning icon-xl"></i>
                          </div>
                          <!--end::Badge-->
                          <!--begin::Text-->
                          <div class="font-weight-mormal font-size-lg timeline-content text-dark pl-3">{{$rent->property->name_en}} rent now from {{$rent->tenant->full_nume ?? 'User'}}</div>
                          <!--end::Text-->
                        </div>
                        @endforeach
                      
                        <!--end::Item-->
                        
                        
                      </div>
                      <!--end::Timeline-->
                    </div>
                    <!--end: Card Body-->
                  </div>


                  
                  
                  <!--end: List Widget 9-->
                </div>
                <div class="col-lg-4 col-xxl-4">
                  

                 
                  <!--begin::Mixed Widget 18-->
										<div class="card card-custom gutter-b card-stretch">
											<!--begin::Header-->
											<div class="card-header border-0 pt-5">
												<div class="card-title font-weight-bolder">
													<div class="card-label">Rental Real Property</div>
													
												</div>
												
											</div>
											<!--end::Header-->
                      <div class="card-body d-flex flex-column">
                        <div class="flex-grow-1">
                          <div id="kt_mixed_widget_14_chart" style="height: 200px">
                          
                          
                          
                          </div>
                        </div>
                        <div class="mt-n12 position-relative zindex-0">
                          <!--begin::Widget Item-->
                          <div class="d-flex align-items-center mb-8">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                                  <div class="symbol-label">
                                      <span class="svg-icon svg-icon-lg svg-icon-gray-500">
                                          <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                  <rect x="0" y="0" width="24" height="24" />
                                                  <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                                  <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                                  <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                                  <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                              </g>
                                          </svg>
                                          <!--end::Svg Icon-->
                                      </span>
                                  </div>
                              </div>
                              <!--end::Symbol-->
                              <!--begin::Title-->
                              <div>
                                  <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Property / Rent</a>
                                  <div class="font-size-sm text-muted font-weight-bold mt-1"> <span class="text-dark">{{$properties}}</span> /<span class="text-success">{{$rents_active}}</span> </div>
                              </div>
                              <!--end::Title-->
                          </div>
                          <!--end::Widget Item-->
                          <!--begin::Widget Item-->
                          <div class="d-flex align-items-center mb-8">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                                  <div class="symbol-label">
                                      <span class="svg-icon svg-icon-lg svg-icon-gray-500">
                                          <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-pie.svg-->
                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                  <rect x="0" y="0" width="24" height="24" />
                                                  <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3" />
                                                  <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000" />
                                              </g>
                                          </svg>
                                          <!--end::Svg Icon-->
                                      </span>
                                  </div>
                              </div>
                              <!--end::Symbol-->
                              <!--begin::Title-->
                              <div>
                                  <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Total rental income</a>
                                  <div class="font-size-sm text-success font-weight-bold mt-1">{{$total_price}} AED </div>
                              </div>
                              <!--end::Title-->
                          </div>
                          <!--end::Widget Item-->
                      
                      </div>
                      </div>
										</div>
										<!--end::Mixed Widget 18-->

                 
                </div>
               
                <div class="col-xxl-8 col-md-8 order-2 order-xxl-1">
                  <div class="card card-custom gutter-b">
                    <div class="card-body p-0">
                      <!-- begin: Invoice-->
                      <!-- begin: Invoice header-->
                      
                      <!-- end: Invoice header-->
                      <!-- begin: Invoice body-->
                      <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Communities</th>
                                  <th class="text-right font-weight-bold text-muted text-uppercase">News</th>
                                  <th class="text-right font-weight-bold text-muted text-uppercase">Events</th>
                                  <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Properties</th>
                                 
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($communities as $community)
                                <tr class="font-weight-boldest">
                                  <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                  <!--begin::Symbol-->
                                  <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                    <div class="symbol-label" style="background-image: url({{asset('uploads/' . $community->image)}})"></div>
                                  </div>
                                  <!--end::Symbol-->
                                  {{$community->name_en}}</td>
                                  <td class="text-right pt-7 align-middle">{{$community->news_count}}</td>
                                  <td class="text-right pt-7 align-middle">{{$community->event_count}}</td>
                                  <td class="text-right pt-7 align-middle">{{$community->properties_count}}</td>
                                </tr>
                                @endforeach
                             
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- end: Invoice body-->
                      <!-- begin: Invoice footer-->
                      
                      <!-- end: Invoice footer-->
                      <!-- begin: Invoice action-->
                      
                      <!-- end: Invoice action-->
                      <!-- end: Invoice-->
                    </div>
                  </div>
                </div>
                <div class="col-xxl-4 col-md-4 order-2 order-xxl-1">
                  <div class="card card-custom gutter-b">
                    <div class="card-body p-0">
                      <!-- begin: Invoice-->
                      <!-- begin: Invoice header-->
                      
                      <!-- end: Invoice header-->
                      <!-- begin: Invoice body-->
                      <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Top Owner</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="font-weight-boldest">
                                  <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                  <!--begin::Symbol-->
                                  <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                    <div class="symbol-label" style="background-image: url({{ asset('uploads/' .$user1->image_url)}})"></div>
                                   
                                  </div>
                                  <a href="{{route('binding.show' ,$user1->id)}}" class="text-left pt-7 font-size-h6 text-dark text-hover-success">{{ $user1->first_name . ' ' . $user1->last_name }}</a>
                                  <br><a  class="text-left pt-7 text-warning">&nbsp; ({{$topowner}} Properties )</a>
                                  <!--end::Symbol-->
                                  </td>
                                  
            
                                  
                                </tr>
                             
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- end: Invoice body-->
                      <!-- begin: Invoice footer-->
                      
                      <!-- end: Invoice footer-->
                      <!-- begin: Invoice action-->
                      
                      <!-- end: Invoice action-->
                      <!-- end: Invoice-->
                    </div>
                  </div>
                </div>  

                <div class="col-xxl-8 col-md-12 order-2 order-xxl-1">
                  <div class="card card-custom gutter-b">
                    <div class="card-body p-0">
                      <!-- begin: Invoice-->
                      <!-- begin: Invoice header-->
                      
                      <!-- end: Invoice header-->
                      <!-- begin: Invoice body-->
                      <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Pending User</th>
                                  <th class="text-left font-weight-bold text-muted text-uppercase">Name</th>
                                  <th class="text-left font-weight-bold text-muted text-uppercase">Email</th>
                                  <th class="text-left font-weight-bold text-muted text-uppercase">Joined</th>
                                  <th class="text-left pr-0 font-weight-bold text-muted text-uppercase">Request Type</th>
                                  <th class="text-left pr-0 font-weight-bold text-muted text-uppercase">Options</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($pending_users as $key=>$user)
                                <tr class="font-weight-boldest">
                                  <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                  <!--begin::Symbol-->
                                  <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                    <div class="symbol-label" style="background-image: url({{ asset($user->image_path)}})"></div>
                                  </div>
                                  <!--end::Symbol-->
                                  </td>
                                  <td class="text-left pt-7 align-middle">{{ $user->first_name . ' ' . $user->last_name }}</td>
                                  <td class="text-left pt-7 align-middle">{{ $user->email }}</td>
                                  <td class="text-left pt-7 align-middle">{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                  <td class="text-left pt-7 align-middle">
                                    @if($user->need == 'normal')
                                    <span class="label label-lg label-secondary label-inline">No request</span>
                                    @elseif($user->need == 'owner')
                                    <span class="label label-lg label-light-success label-inline">Owner</span>
                                    @else
                                    <span class="label label-lg label-light-primary label-inline">Tenant</span>
                                    @endif  
                                  </td>
                                  <td class="text-left pt-7 align-middle">
                                    <a href="{{route('binding.show', $user->id)}}" class="btn btn-outline-warning btn-sm mr-3">
                                      <i class="flaticon-browser"></i>Show </a>
                                  </td>
                                </tr>
                                @endforeach
                             
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- end: Invoice body-->
                      <!-- begin: Invoice footer-->
                      
                      <!-- end: Invoice footer-->
                      <!-- begin: Invoice action-->
                      
                      <!-- end: Invoice action-->
                      <!-- end: Invoice-->
                    </div>
                  </div>
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
<script>
  var x1 = {{ round($percantage , 2 )}};
  var element = document.getElementById("kt_mixed_widget_14_chart");

 console.log(element);
  var height = parseInt(KTUtil.css(element, 'height'));     
  var chart = new ApexCharts(element, options);
  chart.render();
    
</script>
<script src="{{asset('admin/assets/js/pages/widgets.js')}}"></script>


@endsection
