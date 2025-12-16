<div class="invoice-repeater">
    <div data-repeater-list="{{$name}}">
        <div class="row d-flex align-items-end">
            <input id="{{$name}}DeletedIds" name="{{$name}}DeletedIds" type="hidden" value="">
            @foreach ($options['columns'] as $column)
              @if ($column->type!="hidden")
                  <div class="col-md-{{$column->divSize ?? 2}} col-12">
                      <div class="mb-0">
                          <label class="form-label" for="{{$column->name}}">{{$column->title}}</label>
                      </div>
                  </div>
              @endif
            @endforeach
        </div>
        <div data-repeater-item>
          <div class="row d-flex align-items-end">
            @foreach ($options['columns'] as $column)
              @if ($column->type=="hidden")
                <input
                    type="{{$column->type}}"
                    class="form-control"
                    id="{{$column->id}}"
                    name="{{$column->name}}"
                    value="{{$column->value}}"
                />
              @else
                <div class="col-md-{{$column->divSize ?? 2}} col-12">
                  <div class="mb-0">
                    {{-- <label class="form-label" for="{{$column->name}}">{{$column->title}}</label> --}}
                    <input
                        type="{{$column->type}}"
                        class="form-control"
                        id="{{$column->id}}"
                        name="{{$column->name}}"
                        aria-describedby="{{$column->name}}"
                        placeholder="{{$column->placeholder}}"
                        value="{{$column->value}}"
                    />
                  </div>
                </div>
              @endif
            @endforeach
            {{-- <div class="col-md-4 col-12">
              <div class="mb-1">
                <label class="form-label" for="itemname">Item Name</label>
                <x-select2 name="work_order_id" :options="array('1'=>'test1','2'=>'test2')" :labelTitle="__('models/workOrders.fields.id')"></x-select2> 
              </div>
            </div> --}}
            {{-- <div class="col-md-4 col-12">
              <div class="mb-1">
                <label class="form-label" for="itemname">Item Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="itemname"
                  name="itemname"
                  aria-describedby="itemname"
                  placeholder="Vuexy Admin Template"
                />
              </div>
            </div> --}}

            {{-- <div class="col-md-2 col-12">
              <div class="mb-1">
                <label class="form-label" for="itemcost">Cost</label>
                <input
                  type="number"
                  class="form-control"
                  id="itemcost"
                  name="itemcost"
                  aria-describedby="itemcost"
                  placeholder="32"
                />
              </div>
            </div> --}}

            {{-- <div class="col-md-2 col-12">
              <div class="mb-1">
                <label class="form-label" for="itemquantity">Quantity</label>
                <input
                  type="number"
                  class="form-control"
                  id="itemquantity"
                  name="itemquantity"
                  aria-describedby="itemquantity"
                  placeholder="1"
                />
              </div>
            </div> --}}

            {{-- <div class="col-md-2 col-12">
              <div class="mb-1">
                <label class="form-label" for="staticprice">Price</label>
                <input type="text" readonly class="form-control-plaintext" id="staticprice" value="$32" />
              </div>
            </div> --}}

            <div class="col-md-2 col-12 ">
              <div class="mb-0">
                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                  <i data-feather="x" class="me-25"></i>
                  <span>ازالة</span>
                </button>
              </div>
            </div>
          </div>
          <hr />
        </div>
        
    </div>
    <div class="row">
        <div class="col-12">
            <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                <i data-feather="plus" class="me-25"></i>
                <span>اضافة سجل جديد</span>
            </button>
        </div>
    </div>
</div>

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-repeater.js')) }}"></script>
  <script>
  function _deleteCallback(element,deletedId) {
    $("#{{$name}}DeletedIds").val(function() {
      if(this.value){
        newVal=this.value + ',' +deletedId ;
      }else{
        newVal=this.value + deletedId ;
      }
      return newVal;
    });
  }
  </script>
@endsection