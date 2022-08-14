@extends('layouts.backend.app')
@section('page_title') Sell @endsection
@push('css')
<style>

</style>
@endpush



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->


    <!--**************************************-->
    <!--*********^page title content^*********-->
    <!---page_title_of_content-->    
    @push('page_title_of_content')
        <div class="breadcrumbs layout-navbar-fixed">
            <h4 class="font-weight-bold py-3 mb-0">Sell  </h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Sell</li>
                    <li class="breadcrumb-item active">All Sells</li>
                </ol>
            </div>
            <div class="products">
                <a href="#" class="addCustomerModal">Add Sell</a>
            </div>
        </div>
    @endpush
    <!--*********^page title content^*********-->
    <!--**************************************-->



    <!--#################################################################################-->
    <!--######################^^total content space for this page^^######################-->    
    <div  class="content_space_for_page">
    <!--######################^^total content space for this page^^######################--> 
    <!--#################################################################################-->


        <!-------status message content space for this page------> 
        <div class="status_message_in_content_space">
            @include('layouts.backend.partial.success_error_status_message')
        </div>
        <!-------status message content space for this page------> 


        

        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@--> 
        <div class="real_space_in_content">
        <!-------real space in content------> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@-->     
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->   
        


            <div class="row" style="margin-bottom: 5px;">
                <div class="col-8"></div>
                <div class="col-4">
                    <input type="text" class="form-control search" style="border:1px solid #d2d4d5;" placeholder="Search" autofocus>
                </div>
            </div>
            
            <!-------responsive table------> 
            <div class="sellListAjaxResponseResult">

                @include('backend.sell.sell_details.partial.list')

            </div>
            <!-------responsive table------> 

            

            <!-------add Customer Modal------> 
            <div class="modal fade " id="addCustomerModal"  aria-modal="true"></div>
            <input type="hidden" class="addCustomerModalRoute" value="{{ route('admin.customer.create') }}">
            <!-------add Customer Modal------> 
            

            <!-------edit Customer Modal------> 
            <div class="modal fade " id="editCustomerModal"  aria-modal="true"></div>
            <input type="hidden" class="editCustomerModalRoute" value="{{ route('admin.customer.edit') }}">
            <!-------edit Customer Modal------> 


            <!-------delete Customer Modal------> 
            @include('backend.customer.customer.partial.delete_modal')
            <input type="hidden" class="deleteCustomerModalRoute" value="{{ route('admin.customer.delete') }}">
            <!-------delete Customer Modal------> 
            



        
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@-->     
        </div>
        <!--real space in content--> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@--> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->

    


    <!--#################################################################################-->
    <!--######################^^total content space for this page^^######################-->  
    </div>
    <!--######################^^total content space for this page^^######################--> 
    <!--#################################################################################-->


    {{--Customer list url --}}
    <input type="hidden" class="customerListUrl" value="{{route('admin.sell.regular.sell.list.ajaxresponse')}}">
    {{--Customer list url --}}

<!--=================js=================-->
@push('js')
<!--=================js=================-->
<script src="{{asset('custom_js/backend')}}/sell/sell_details/index.js?v=1"></script>



    
<!--=================js=================-->
@endpush
<!--=================js=================-->



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
