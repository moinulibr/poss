
<table class="table table-bordered" style="font-size: 14px;">
    <thead style="background-color:rgb(66, 66, 66); color:#e9ff30">
        <tr>
            <td>Stock Name</td>
            <td>Stock</td>
            @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                <td style="font-size: 14px;">
                    <small>
                        {{$ppric->label}}
                    </small>
                </td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <input type="hidden" class="defaultProductStockId " value="{{$defaultProductStockId}}">
        @foreach ($product->productStocksNORWhereStatusIsActiveWhenCreateSale() as $productStock)    
        <tr class="selectedProductStockRow selectedProductStockRow_{{$productStock->id}}" data-id="{{$productStock->id}}" style="background-color:#ffffff;">
            <input type="hidden" class="selectedProductStockId selectedProductStockId_{{$productStock->id}}">
            <td>
                <span class="selectedProductStock selectedProductStock_{{$productStock->id}}  productStockHover productStockHovereffect_{{$productStock->id}}" data-id="{{$productStock->id}}">
                    {{ $productStock->label }}
                </span>
            </td>
            <td style="background-color: #ededed;color: #0c0101;text-align: center">
                <span class="selectedProductStock selectedProductStock_{{$productStock->id}} productStockHover productStockHovereffect_{{$productStock->id}}" data-id="{{$productStock->id}}">
                    {{-- {{ unitIdWiseUnitView_hh(
                        $productStock->available_stock,$productStock->available_base_stock,
                        $product->unit_id,$product->unit_id //$changing_unit_id = 8
                    ) }} --}}
                    {{ $productStock->available_base_stock }}
                </span>
            </td>
            @foreach ($productStock->productStockWiseProductPrices() as $pSPPrice) 
            <td>
                <span class="selectedProductStock selectedProductStock_{{$productStock->id}} productStockHover productStockHovereffect_{{$productStock->id}}" data-id="{{$productStock->id}}">
                    {{$pSPPrice->price}}
                </span>
            </td>
            @endforeach
            
        </tr>
        @endforeach
        <input type="hidden" class="product_id" name="product_id" value="{{$product->id}}">
        <input type="hidden" class="displaySinglePriceListByProductStockId" value="{{route('admin.sell.regular.pos.display.sigle.price.list.by.product.stock.id')}}">
        
        
        


        
        
        {{-- <tr style="background-color:green;color:white;">
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                    Offer Stock
                </span>
            </td>
            <td  style="cursor: pointer;text-align:center;background-color: #979797">
                <span style="cursor: pointer;">
                    80
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    24
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    60
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    35
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    40
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    36
                </small>
                </span>
            </td>
        </tr> --}}
    </tbody>
</table>