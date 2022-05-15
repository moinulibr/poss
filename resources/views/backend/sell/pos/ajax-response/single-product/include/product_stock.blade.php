
<table class="table table-bordered" style="">
    <thead style="background-color:rgb(66, 66, 66); color:#e9ff30">
        <tr>
            <td>Stock Name</td>
            <td>Stock</td>
            @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                <td style="font-size: 12px;">
                    <small>
                        {{$ppric->label}}
                    </small>
                </td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($product->productStockNORWhereStatusIsActive() as $productStock)    
        <tr>
            <td>{{$productStock->label}}</td>
            <td style="background-color: #ededed;color: #0c0101;text-align: center">
                {{$productStock->available_base_stock}}
            </td>
            @foreach ($productStock->productStockWiseProductPrices() as $pSPPrice) 
            <td>
                <small>
                    {{$pSPPrice->price}}
                </small>
            </td>
            @endforeach
            
        </tr>
        @endforeach
        <tr style="background-color:green;color:white;">
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
        </tr>
    </tbody>
</table>