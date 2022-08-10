<div class="modal fade text-left" id="payment-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel11" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('admin.sell.regular.pos.store.data.from.sell.cart')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel11">Payment</h3>
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
                    <table class="table right-table">
                        <tbody>
                            <tr class="d-flex align-items-center justify-content-between">
                                <th class="border-0 px-0 font-size-lg mb-0 font-size-bold text-primary">
                                    Total Amount to Pay :
                                </th>
                                <td class="border-0 justify-content-end d-flex text-primary font-size-lg font-size-bold px-0 font-size-lg mb-0 font-size-bold text-primary">
                                    $722
                                </td>
                            </tr>
                            <tr class="d-flex align-items-center justify-content-between">
                                <th class="border-0 px-0 font-size-lg mb-0 font-size-bold text-primary">
                                    Payment Mode :
                                </th>
                                <td class="border-0 justify-content-end d-flex text-primary font-size-lg font-size-bold px-0 font-size-lg mb-0 font-size-bold text-primary">
                                    Cash
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="text-body">Received Amount</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="number" class="form-control" value="$1000" placeholder="Enter Amount " />
                                </fieldset>
                                <div class="p-3 bg-light-dark d-flex justify-content-between border-bottom">
                                    <h5 class="font-size-bold mb-0">Amount to Return :</h5>
                                    <h5 class="font-size-bold mb-0">-$20</h5>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="text-body">Note (If any)</label>
                                <fieldset class="form-label-group">
                                    <textarea class="form-control fixed-size" id="horizontalTextarea" rows="5" placeholder="Enter Note"></textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
                            <div class="col-md-6 text-right">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </from>
        </div>
    </div>
</div>