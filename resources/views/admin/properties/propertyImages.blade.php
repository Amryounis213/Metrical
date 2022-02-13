@extends('components.admin-layout')
@section('stylesheet')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>

</style>
@endsection
@section('content')
  
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{$title}}</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                       
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
               
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
          <!--begin::Content-->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
     {{Session::get('success')}}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endif
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <div class="card-toolbar">
                                </div>
                            </div>
                           
                            <!--begin::Form-->
                            <form action="{{route('store-properties-image')}}"  class="dropzone dropzone-default dropzone-success" id="myGreatDropzone">
                                @csrf
                                <input type="hidden" value="{{$propertyId}}" name="property_id" >

                            </form>
                            <input id="uploadfiles" type="button" class="btn btn-success" value="Uplolad">

                            <!--end::Form-->
                        </div>
                        <!--end::Card-->
                        <div class="row">
                            @foreach ($images as $image)
                            <div class="col-md-4 mb-3">
                            <a href="{{asset('uploads/' . $image->path)}}" data-lity>

                                <div class="container">
                                    <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{asset('uploads/'. $image->path)}})"></div>
                                </div>
                            </a>
                            </div>
                            @endforeach
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js" integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin/assets/js/lity/lity.js')}}"></script>
<script>
   Dropzone.autoDiscover = false;

  

var myDropzone = new Dropzone(".dropzone", { 
   maxFilesize: 10,
   acceptedFiles: ".jpeg,.jpg,.png,.gif",
   addRemoveLinks: true,
   autoProcessQueue: false,
   parallelUploads: 10 ,

});

$('#uploadfiles').click(function(){
   myDropzone.processQueue();
});
</script>

@endsection