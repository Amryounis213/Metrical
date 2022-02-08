@if (Session::has('success'))
<script>
    toastr.warning('Your file has been deleted')
</script>
<div class="alert alert-success">

    {{ Session::get('success') }}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">
    {{ Session::get('error') }}
</div>

@endif