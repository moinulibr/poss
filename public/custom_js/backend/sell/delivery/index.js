    
//-----------------------------------------------------------------------
    $(document).on('click','.singleSellInvoiceWiseDelivery',function(e){
        e.preventDefault();
        var url = $('.sellProductDeliveryInvoiceWiseModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                if(response.status == true)
                {
                    $('#sellProductDeliveryModal').html(response.html).modal('show');
                    $('.product_related_response_here').html(response.product);
                }
            }
        });
    });
//-----------------------------------------------------------------------

