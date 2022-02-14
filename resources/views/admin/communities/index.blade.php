@extends('components.admin-layout')
@section('stylesheet')
<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
     <!--begin::Subheader-->
     <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Communities</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ $communities->count() }} Total</span>
                    <form method="{{route('communities.results')}}" method="POST" class="ml-5">
                        @csrf
                        <div  class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                            
                            <input name="name" type="text" class="form-control" id="kt_subheader_search_form" placeholder="Search..." />
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

            </div>
            <!--end::Details-->
            <a href="{{route('communities.create')}}" class="btn btn-light-success font-weight-bolder btn-sm">Add Community</a>

            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                @foreach ($communities as $community)
                    
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Body-->
                        <div class="card-body text-center pt-4">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="text-danger font-weight-bold">{{$community->area}} mm</span>
                                </div>
                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-header pb-1">
                                                    <span class="text-primary text-uppercase font-weight-bold font-size-sm">Options</span>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="{{route('communities.edit' ,$community->id)}}" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="far fa-edit"></i>
                                                        </span>
                                                        <span class="navi-text">Edit </span>
                                                    </a>
                                                </li>
                                                <form class="delete" action="{{route('communities.destroy',$community->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link  ">
                                                        <span class="navi-icon">
                                                            <i class="far fa-trash-alt"></i>
                                                        </span>

                        
                                                       <span class=" delete   navi-text">Delete</span>
                                                    </a>
                                                </li>
                                                </form>
                                            </ul>
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                               
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::User-->
                            <div class="mt-7">
                                <div class="symbol symbol-circle symbol-lg-90">
                                    <img src="{{asset('uploads/' . $community->image)}}"  alt="image">
                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::Name-->
                            <div class="my-4">
                                <a  class=" font-weight-bold text-primary font-size-h4 active">{{$community->name_en}} Community</a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Label-->
                            <span class="btn btn-text @if($community->status == 1) btn-light-success  @else btn-light-warning @endif btn-sm font-weight-bold">{{$community->status ? 'Ready' : 'Under Constraction'}} %{{$community->readness_percentage}}</span><br>
                            <!--end::Label-->
                            <!--begin::Buttons-->
                            <div class="mt-9">
                                <a href="{{route('showPropertiesByCommunity', $community->id)}}" class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase">( {{$community->properties_count}} ) View Properties</a>
                            </div>

                          
                            <!--end::Buttons-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')


<script src="{{asset('admin/assets/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
@if(Session::has('primary'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-bottom-right",
  }

  toastr.error("{{ session('primary') }}");
@endif

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



<script src="{{asset('admin/assets/js/sweettost/alert2.js')}}"></script>

@endsection