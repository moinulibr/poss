<div class="form-group row">
    <div class="col-md-6">
        <label class="text-body">Customer</label>
        <fieldset class="form-group mb-3">
            <input type="text"  class="form-control" placeholder="Enter Customer " value="{{$customer?$customer->name:NULL}}" disabled />
            
        </fieldset>
    </div>
    <div class="col-md-6">
        <label class="text-body">Customer Phone</label>
        <fieldset class="form-group mb-3">
            <input type="text" name="text" class="form-control" value="{{$customer?$customer->phone:NULL}}" disabled />
        </fieldset>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label class="text-body">Use Shipping Address</label>
        <fieldset class="form-group mb-3">
            <select class="use_shipping_address  form-control" >
                <option value="1">Existing Shipping Address</option>
                <option value="2">New Shipping Address (add)</option>
            </select>
        </fieldset>
    </div>
    <div class="existing_shipping_address_div col-md-6">
        <label class="text-body">Shipping Address</label>
        <fieldset class="form-group mb-3">
            <select class="customer_shipping_address_id form-control ">
                @if ($customer)    
                    @foreach ($customer->shippingAddresses as $item)
                    <option value="{{$item->id}}">
                        {{ $item->address }}, phone :   {{ $item->phone }} 
                    </option>
                    @endforeach
                @else
                <option value="">No Shipping Address Found</option>
                @endif 
            </select>
        </fieldset>
    </div>
    <!-----------new shipping address---->
    <div class="col-md-6 new_shipping_address_div"  style="display: none">
        <label class="text-body">Shipping Phone</label>
        <fieldset class="form-group mb-3">
            <input type="text" name="phone" class="form-control" placeholder="Shipping Phone"  />
        </fieldset>
    </div>
    <!-----------new shipping address---->
</div>
<!-----------new shipping address---->
<div class="form-group row new_shipping_address_div"  style="display: none">
    <div class="col-md-6">
        <label class="text-body">Email Address (shipping)</label>
        <fieldset class="form-group mb-3">
            <input type="text" name="email" class="shipping_email form-control" placeholder="Email Address (shipping)" />
        </fieldset>
    </div>
    <div class="col-md-6">
        <label class="text-body">Shipping Address</label>
        <fieldset class="form-group mb-3">
            <textarea  name="new_shipping_address" class="new_shipping_address form-control" placeholder="New Shipping Address"  ></textarea>
        </fieldset>
    </div>
</div>
<!-----------new shipping address---->