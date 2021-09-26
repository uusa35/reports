<div class="form-group row ">
    <label for="created_at"
           class="col-md-4 col-form-label text-md-right">{{ __('general.location') }}</label>
    <div class="col-md-6">
        <input type="hidden" name="latitude" id="address-latitude" value="29.3187128"/>
        <input type="hidden" name="longitude" id="address-longitude" value="47.9971457"/>
        <div id="address-map-container" style="width:100%;height:300px; ">
            <div style="width: 100%; height: 100%" id="address-map"></div>
        </div>
    </div>
</div>
