@extends('components.admin-layout')
@section('title', 'Edit Admin')   

@section('content')
<div class="card card-custom" style="width: 100%">
    <div class="card-header">
    <h3 class="card-title">
        Edit Admin Page
    </h3>
    </div>
    <!--begin::Form-->
    <form method="POST" action="{{route('admins.update', $id)}}"
    enctype="multipart/form-data" >
        @csrf
        @method('put')
    <div class="card-body">
    <div class="form-group mb-8">
    <div class="alert alert-custom alert-default" role="alert">
        <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
        <div class="alert-text">
            <x-alert />
            The Phone Number Should Be First Time Use
        </div>
    </div>
    </div>
    
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="form-group row">

        <label class="col-2 col-form-label">Main Image</label>
        <div class="col-lg-9 col-xl-6">
            <div class="image-input image-input-empty image-input-outline"
                id="kt_image_4"
                style="background-image: url({{$user->image_path}})">
                <div class="image-input-wrapper"></div>
                <label
                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                    data-action="change" data-toggle="tooltip" title=""
                    data-original-title="Change avatar">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input name="image" type="file" 
                        accept=".png, .jpg, .jpeg" value="{{old('image', $user->image_path)}}"/>
                    <input type="hidden" name="image_remove" />
                </label>
                <span
                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                    data-action="cancel" data-toggle="tooltip"
                    title="Cancel avatar">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
                <span
                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                    data-action="remove" data-toggle="tooltip"
                    title="Remove avatar">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            </div>
            <span class="form-text text-muted">Image For user</span>
        </div>
    </div>
    <x-form-input label='First Name' name="first_name" :value="$user->first_name" />
    <x-form-input label='Last Name' name="last_name" :value="$user->last_name" />
    <x-form-input label='Mobile Number' name='mobile_number' :value="$user->mobile_number" />
    <x-form-input label='Email' name="email" type='email' :value="$user->email" />
    <x-form-input label='Current Password' name="current_pass" type='passowrd'/>
    <x-form-input label='New Password' name="password" type='passowrd'/>

    
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
