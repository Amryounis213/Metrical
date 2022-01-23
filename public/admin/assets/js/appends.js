$('.append').click(function (e) { 
    e.preventDefault();
    $('#parent').append(`
           
            
          
                
                
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Community</label>
                        <div class="col-10">
                            <select name="community_id" class="form-control selectpicker" data-size="5"
                                data-live-search="true">
                                <option value="">Select</option>
                                @foreach ($communities as $communities)
                                <option value="{{$communities->id}}">{{$communities->name_en}}</option> 
                                @endforeach  
                            </select>
                        </div>
                    </div>



                    <div class="form-group row ">
                        <label class="col-2 col-form-label">Name</label>
                        <div class="col-lg-3">
                            <input  maxlength="25"  name="name_ar[]" value="{{ old('name_ar') }}"  type="text" class="form-control kt_maxlength_1" placeholder="Arabic" />
                            
                        </div>
                        <div class="col-lg-3">
                            <input maxlength="25"  name="name_gr[]" value="{{ old('name_gr') }}"  type="text" class="form-control kt_maxlength_1" placeholder="Germany" />
                            
                        </div>

                        <div class="col-lg-4">
                            <input maxlength="25"  name="name_en[]" value="{{ old('name_en') }}"  type="text" class="form-control kt_maxlength_1" placeholder="English" />
                            
                        </div>

                    
                    </div>

                    <div class="form-group row">
                    <label for="example-search-input" class="col-2 col-form-label">Description (Arabic)</label>
                    <div class="col-10" style="position: relative;">
                        <textarea name="description_ar"  class="form-control kt_maxlength_5_modal"  maxlength="200" placeholder="" rows="6">{{$property->description_ar}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-2 col-form-label">Description (Germany)</label>
                    <div class="col-10" style="position: relative;">
                        <textarea name="description_gr"  class="form-control kt_maxlength_5_modal"  maxlength="200" placeholder="" rows="6">{{$property->description_gr}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-2 col-form-label">Description (English)</label>
                    <div class="col-10" style="position: relative;">
                        <textarea name="description_en"  class="form-control kt_maxlength_5_modal"  maxlength="200" placeholder="" rows="6">{{$property->description_en}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                <label for="address_ar" class="col-2 col-form-label">Address (Arabic)</label>
                <div class="col-10">
                    <input  name="address_ar"
                        class="form-control kt_maxlength_1" type="text"
                        value="{{$property->address_ar}}"
                        maxlength="100"
                        value="{{ old('address_ar') }}"
                        id="readness_percentage" />
                </div>
            </div>
            <div class="form-group row">
                <label for="address_ar" class="col-2 col-form-label">Address (Germany)</label>
                <div class="col-10">
                    <input  name="address_gr"
                        class="form-control kt_maxlength_1" type="text"
                        value="{{$property->address_gr}}"
                        maxlength="100"
                        value="{{ old('address_gr') }}"
                        id="readness_percentage" />
                </div>
            </div>
            <div class="form-group row">
                <label for="address_ar" class="col-2 col-form-label">Address (English)</label>
                <div class="col-10">
                    <input  name="address_en"
                        class="form-control kt_maxlength_1" type="text"
                        value="{{$property->address_en}}"
                        maxlength="100"
                        value="{{ old('address_en') }}"
                        id="readness_percentage" />
                </div>
            </div>


            <div class="form-group row ">
                <label class="col-2 col-form-label">Area (mm)</label>
                <div class="col-lg-4">
                    <input max="100000" value="{{ old('area') }}"  name="area" step="any" type="number" class="form-control"  value="{{$property->area}}" placeholder="Ex:195 mm" />
                    
                </div>

                <label class="col-2 col-form-label">Reference</label>
                <div class="col-lg-4">
                    <input   name="reference" value="{{ old('reference') }}" type="text" class="form-control"  value="{{$property->reference}}" placeholder="Ex: 9551200" />
                    
                </div>

            

              
            </div>

           
           
            <div class="form-group row">
                <label for="feminizations" class="col-2 col-form-label">Feminizations</label>
                <div class="col-10">
                    <input  name="feminizations"
                        class="form-control" type="text"
                        value="{{ old('feminizations') }}"
                        id="readness_percentage" />
                </div>
            </div>

          
            <div class="form-group row">
                <label class="col-2 col-form-label">Property Status</label>
                <div class="col-10">
                    <div class="radio-inline">
                        <label class="radio radio-danger">
                            <input type="radio" value="0" name="status" checked="checked"/>
                            <span></span>
                            Under Constraction
                        </label>
                        <label class="radio radio-danger">
                            <input type="radio" value="1" name="status"  />
                            <span></span>
                            Ready
                        </label>
                        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Short Term</label>
                <div class="col-10">
                    <div class="radio-inline">
                        <label class="radio radio-danger">
                            <input type="radio" value="0" name="is_shortterm" checked="checked"/>
                            <span></span>
                            No
                        </label>
                        <label class="radio radio-danger">
                            <input type="radio" value="1" name="is_shortterm"  />
                            <span></span>
                            Yes
                        </label>
                        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Type</label>
                <div class="col-10">
                    <div class="radio-inline">
                        <label class="radio radio-danger">
                            <input type="radio" value="0" name="type" checked="checked"/>
                            <span></span>
                            house
                        </label>
                        <label class="radio radio-danger">
                            <input type="radio" value="1" name="type"  />
                            <span></span>
                            apartment
                        </label>
                        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Offer Type</label>
                <div class="col-10">
                    <div class="radio-inline">
                        <label class="radio radio-danger">
                            <input type="radio" value="stop" name="offer_type" checked />
                            <span></span>
                            stop
                        </label>
                        <label class="radio radio-danger">
                            <input type="radio" value="sale" name="offer_type"  />
                            <span></span>
                            sale
                        </label>
                        <label class="radio radio-danger">
                            <input type="radio" value="rent" name="offer_type" />
                            <span></span>
                            rent
                        </label>
                       
                    </div>
                </div>
            </div>
            <div class="form-group row ">
                <label class="col-2 col-form-label">Information</label>
                <div class="col-lg-3">
                    <input name="gate" type="number" class="form-control"placeholder="Gates" />
                    <span class="form-text text-muted">Gates number</span>
                </div>
                <div class="col-lg-3">
                    <input name="bathroom" type="number" class="form-control" placeholder="Bathroom" />
                    <span class="form-text text-muted">Bathroom number</span>

                </div>


               
                 
                
                
                   
                   
                 
                   
                    


    `)
});