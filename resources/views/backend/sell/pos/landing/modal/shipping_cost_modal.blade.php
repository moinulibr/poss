<div class="modal fade text-left" id="discountpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel122" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel122">Add Discount</h3>
                <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
                    <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            fill-rule="evenodd"
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                        ></path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 " style="margin-bottom:4px;">
                        <div class="p-3 bg-light-dark d-flex justify-content-between border-bottom">
                            <h5 class="font-size-bold mb-0">Subtotal:</h5>
                            <h5 class="font-size-bold mb-0">
                                <span class="subtotalFromSellCartList">0</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="text-body">Discount Amount </label>
                        <fieldset class="form-group mb-3 d-flex">
                            <input type="text" name="invoice_discount_amount" class="invoice_discount_amount form-control bg-white inputFieldValidatedOnlyNumeric" placeholder="Enter Discount" />
                        </fieldset>
                        <span class="invoice_discount_amount_error_message" style="color:red;margin: auto 40%;"></span>
                    </div>
                    <div class="col-12">
                        <label class="text-body">Discount Type</label>
                        <fieldset class="form-group mb-3 d-flex">
                            <select name="invoice_discount_type" class="invoice_discount_type form-control bg-white"  style="width: 65%;">
                                <option value="">No Discount</option>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                            <span class="bg-light-dark  btn ml-2  pt-1 pb-1 d-flex align-items-center justify-content-center" style="width: 35%;">
                                <strong class="invoice_totoal_discount_amount">0</strong>
                            </span>
                        </fieldset>
                        <span class="invoice_discount_amount_error_message" style="color:red;margin: auto 40%;"></span>
                    </div>
                   
                    <div class="col-12">
                        <div class="p-1 bg-light-dark d-flex justify-content-between border-bottom">
                            <div class="bg-light-dark" style="padding-top: 5px;">
                                <h5 class="font-size-bold mb-0">Subtotal after discount:
                                    <strong class="invoice_subtotal_after_discount" style="padding-left: 4px;">0</strong>
                                </h5>
                            </div>
                            <a href="javascript:void(0)" class="invoice_discount_apply btn-secondary btn ml-2 white pt-1 pb-1 d-flex align-items-center justify-content-center">Apply</a>
                        </div>
                        Total Profit: <span class="totalInvoiceProfit"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






    <div class="modal fade text-left" id="shippingcost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1444" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel1444">Add Shipping Cost</h3>
                    <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                fill-rule="evenodd"
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Customer</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="text" class="form-control" placeholder="Enter Customer " value="David Jones" disabled />
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Shipping Address</label>
                                <fieldset class="form-group mb-3">
                                    <select class="js-example-basic-single js-states form-control bg-transparent p-0 border-0" name="state">
                                        <option value="AL">928 Johnsaon Dr Columbo,MD 21044</option>

                                        <option value="WY">933 Johnsaon Dr Columbo,MD 21044</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Shipping Charges</label>
                                <fieldset class="form-group mb-3">
                                    <input type="number" name="text" class="form-control" placeholder="Enter Shipping Charges" />
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Shipping Status</label>
                                <fieldset class="form-group mb-3">
                                    <select class="js-example-basic-single js-states form-control bg-transparent p-0 border-0" name="state">
                                        <option value="AL">Packed</option>

                                        <option value="WY">Open</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="text-body">Shipping Charges</label>
                                <fieldset class="form-label-group">
                                    <textarea class="form-control fixed-size" rows="5" placeholder="Textarea"></textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
                            <div class="col-md-6 text-right">
                                <a href="#" class="btn btn-primary">Update Order</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>