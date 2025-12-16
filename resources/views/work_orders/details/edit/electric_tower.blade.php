<div class="tab-pane" id="electric_tower" aria-labelledby="electric-tower" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="form-group col-sm-4">
                    <label>عامود ١٠</label>
                    <div class="input-group">
                        <input type="number" name="tower10" class="touchspin" value="{{$workOrder->electricity_tower->tower10 ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label>عامود ١٣</label>
                    <div class="input-group">
                        <input type="number" name="tower13" class="touchspin" value="{{$workOrder->electricity_tower->tower13 ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label>محول</label>
                    <div class="input-group">
                        <input type="number" name="converter" class="touchspin" value="{{$workOrder->electricity_tower->converter ?? 0 }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>شداد</label>
                    <div class="input-group">
                        <input type="number" name="shadad" class="touchspin" value="{{$workOrder->electricity_tower->shadad ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label>شبكة ض/ع</label>
                    <div class="input-group">
                        <input type="number" name="grid_high_voltage" class="touchspin" value="{{$workOrder->electricity_tower->grid_high_voltage ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label>شبكة ض/م</label>
                    <div class="input-group">
                        <input type="number" name="grid_low_voltage" class="touchspin" value="{{$workOrder->electricity_tower->grid_low_voltage ?? 0 }}" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
