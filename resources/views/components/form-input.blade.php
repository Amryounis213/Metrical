<<<<<<< HEAD
<div class="form-group row" style="margin: 10px">
        <label for="example-password-input" class="col-2 col-form-label ">{{$label}}</label>
        <div class="col-4">
=======
<div class="form-group row mb-10" style="margin: 10px">
        <label for="example-password-input" class="col-lg-3 col-form-label text-right">{{$label}}</label>
        <div class="col-lg-6">
>>>>>>> 28ae44a720ad77e537dd657549699a1c9cd44459
            <input class="form-control @error($name) is-invalid @enderror" name={{$name}} type={{$type ?? 'text'}} value="{{old($name, $value ?? null)}}"/>
            @error($name)
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
</div>
