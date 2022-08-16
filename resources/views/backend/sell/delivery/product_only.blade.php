<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="width:5%;">AS Code</th>
                <th style="width:35%;">Product</th>
                <th style="width:5%;">Quantity</th>
                <th style="width:55%;">
                    <div class="table-responsive"  style="padding-bottom: 0px;margin-bottom: -7px !important;">
                        <table id="example1" class="table table-bordered table-striped table-hover" style="padding-bottom: 0px;margin-bottom: 0px;">
                            <tr>
                                <td  style="width:25%;">Stock Name</td>
                                <td  style="width:10%;">
                                    <small>Stock Qty</small>
                                </td>
                                <td  style="width:5%;">
                                    <small>Sell Qty</small>
                                </td>
                                <td  style="width:15%;">
                                    <small>Delivered Qty</small>
                                </td>
                                <td  style="width:15%;">
                                    <small>Remaining Del. Qty</small>
                                </td>
                                <td  style="width:30%;">
                                    <small>Deliverying Qty</small>
                                </td>
                            </tr>
                        </table>
                    </div> 
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->sellProducts ? $data->sellProducts : NULL  as $item)
            <tr>
                @php
                    $cats = json_decode($item->cart,true);
                @endphp
                <td> {{$item->custom_code}}</td>
                <td>
                    @if (array_key_exists('productName',$cats))
                        {{$cats['productName']}}
                        @else
                        NULL
                    @endif
                </td>
                <td style="text-align: center">
                    {{$item->quantity}}
                    {{-- @if (array_key_exists('unitName',$cats))
                        <small>{{$cats['unitName']}}</small>
                        @else
                        NULL
                    @endif --}}
                </td>
                <td>
                    <div class="table-responsive" style="padding-bottom: 0px;margin-bottom: -7px !important;">
                        <table id="example1" class="table table-bordered table-striped table-hover"  style="padding-bottom: 0px;margin-bottom: 0px;">
                            @foreach ($item->sellProductStocks as $pstock)
                            <tr>
                                <td style="width:21%;">
                                    <small>
                                        {{ $pstock->stock ? $pstock->stock->label : NULL}}
                                    </small>
                                </td>
                                <td style="width:10%;text-align: center">
                                    {{ $pstock->productStock ? $pstock->productStock->available_base_stock : NULL}}
                                </td>
                                <td style="width:5%;text-align: center">{{$pstock->total_quantity}}</td>
                                <td style="width:15%;text-align: center">0</td>
                                <td style="width:15%;text-align: center">0</td>
                                <td style="width:30%;text-align: center">
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>