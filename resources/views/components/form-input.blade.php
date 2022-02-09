<div class="form-group row" style="margin: 10px">
        <label for="example-password-input" class="col-2 col-form-label ">{{$label}}</label>
        <div class="col-4">
            <input class="form-control @error($name) is-invalid @enderror" name={{$name}} type={{$type ?? 'text'}} value="{{old($name, $value ?? null)}}"/>
            @error($name)
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
</div>
