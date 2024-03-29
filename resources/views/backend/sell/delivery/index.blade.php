<style>
    .modal-full {
            min-width: 90%;
            margin: 0;
            margin-left:5%;
        }

        .modal-full .modal-content {
            min-height: 100vh;
        }
</style>
<div class="modal-dialog modal-lg modal-full" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">
                <strong style="mergin-right:20px;">Sell Details (Invoice No.: {{$data->invoice_no}})</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h4>
        </div>

        <div class="modal-body">


            <div style="margin-top: -60px;">
                <div>
                    <div class="mb-2 text-right my-5">
                        <label>
                            <strong>Date : </strong>  <span style="font-size:14px;"> {{date('d-m-Y h:i:s a',strtotime($data->created_at))}}</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label>
                                <strong>Invoice No: </strong> <span style="font-size:14px;"> {{$data->invoice_no}}</span>
                            </label>
                        </div>
                        {{--  <div class="mb-2">
                            <label>
                                <strong>Status: </strong>  <span style="font-size:14px;"> {{$data->order_no}}</span>
                            </label>
                        </div>  --}}
                        <div class="mb-2">
                            <label>
                                <strong>Payment Status: </strong>
                                    {{-- @if($data->totalPaidAmount() > 0)
                                        <span>
                                            @if($data->totalSaleAmount() == $data->totalPaidAmount())
                                                <span class="badge badge-primary"> Paid </span>

                                            @elseif($data->totalSaleAmount() > 0 && $data->totalSaleAmount()  < $data->totalPaidAmount())
                                                <small class="badge badge-warning"> Over</small><span class="badge badge-primary"> Paid </span>

                                            @elseif($data->totalSaleAmount() > 0 && $data->totalSaleAmount()  > $data->totalPaidAmount())
                                                <span class="badge badge-danger">Due</span>

                                            @elseif($data->totalSaleAmount() < 0)
                                                <span class="badge badge-defalut" style="backgrounc-color:#06061f;color:red;">Invalid </span>
                                            @endif
                                            </span>
                                        @else
                                        <span class="badge badge-danger">Due</span>
                                    @endif --}}
                                    <span class="badge badge-danger">Due</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label>
                                <strong>Customer Name : </strong> <span style="font-size:14px;"> {{$data->customer ? $data->customer->name  :NULL}}</span>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label>
                                <strong>Address : </strong>
                                {{$data->customer ? $data->customer->address  :NULL}}
                            </label>
                            <br/>
                            <label>
                                <strong>Mobile : </strong>
                                {{$data->customer ? $data->customer->phone  :NULL}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label>
                                <strong>Shipping :</strong>
                                {{ $data->shipping_id ? $data->shipping? $data->shipping->address : NUll : NULL }}
                                {{ $data->shipping_id ? $data->shipping ? " (". $data->shipping->phone .")" : NUll : NULL }}
                            </label>
                        </div>
                        <div class="mb-2">
                            <label>
                                <strong>Reference By: </strong>
                                {{$data->referenceBy ? $data->referenceBy->name:NULL}}
                                {{$data->referenceBy ? " (". $data->referenceBy->phone .")" :NULL}}
                            </label>
                        </div>
                        <div class="mb-2">
                            <label>
                                <strong>Receiver Details: </strong>
                                {{$data->receiver_details}}
                            </label>
                        </div>
                    </div>
                </div>

                <br/>
                <!-----Start of Products--->
                <div class="row">
                    <div class="col-md-12">
                        <h4>Products: </h4>
                        <div class="product_related_response_here">
                           
                        </div>
                        <div class="table-responsive">
                            <table id="example1" class="table">
                                <tr>
                                    <th colspan="4"></th>
                                    <th style="text-align: right">
                                        <input type="submit" value="Submit" disabled class="btn btn-success">
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-----End of Products--->

                    <br/><br/>

                <!------Start of Payment Info --->
                {{-- <div class="row">
                    <div class="col-md-12"> <h4>Payment Info: </h4> </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reference No</th>
                                        <th>Amount</th>
                                        <th>Credit/Debit</th>
                                        <th>Payment Method</th>
                                        <th>Payment Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div> --}}
                <!------Start of Payment Info --->

            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
