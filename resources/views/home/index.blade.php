@extends('layouts.app')
@section('title', __('home.home'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header content-header-custom">
    <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}
    </h1>
</section>
<!-- Main content -->
<section class="content content-custom no-print">
    <br>
    @if(auth()->user()->can('dashboard.data'))
        @if($is_admin)
        	<div class="row">
                <div class="col-md-4 col-xs-12">
                    @if(count($all_locations) > 1)
                        {!! Form::select('dashboard_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'dashboard_location']); !!}
                    @endif
                </div>
        		<div class="col-md-8 col-xs-12">
                    <div class="form-group pull-right">
                          <div class="input-group">
                            <button type="button" class="btn btn-primary" id="dashboard_date_filter">
                              <span>
                                <i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}
                              </span>
                              <i class="fa fa-caret-down"></i>
                            </button>
                          </div>
                    </div>
        		</div>
        	</div>
    	   <br>
    	   <div class="row row-custom">
            	
        	    <!-- /.col -->
        	    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
        	       <div class="info-box info-box-new-style">
            	        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

            	        <div class="info-box-content">
            	          <span class="info-box-text">{{ __('home.total_sell') }}</span>
            	          <span class="info-box-number total_sell"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
            	        </div>
            	        <!-- /.info-box-content -->
        	       </div>
        	      <!-- /.info-box -->
        	    </div>
        	    <!-- /.col -->
        	    
        	    <!-- /.col -->

    	       <!-- fix for small devices only -->
        	    <!-- <div class="clearfix visible-sm-block"></div> -->
        	    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
        	        <div class="info-box info-box-new-style">
        	           <span class="info-box-icon bg-yellow">
            	        	<i class="ion ion-ios-paper-outline"></i>
            	        	<i class="fa fa-exclamation"></i>
        	           </span>

            	        <div class="info-box-content">
            	          <span class="info-box-text">{{ __('home.invoice_due') }}</span>
            	          <span class="info-box-number invoice_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
            	        </div>
            	        <!-- /.info-box-content -->
        	        </div>
        	      <!-- /.info-box -->
        	    </div>
              <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-red">
                          <i class="fas fa-minus-circle"></i>
                        </span>

                        <div class="info-box-content">
                          <span class="info-box-text">
                            {{ __('lang_v1.expense') }}
                          </span>
                          <span class="info-box-number total_expense"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                  <!-- /.info-box -->
                </div>
    	    <!-- /.col -->
            </div>
          	<div class="row row-custom">
                <!-- expense -->
                
            </div>
            @if(!empty($widgets['after_sale_purchase_totals']))
                @foreach($widgets['after_sale_purchase_totals'] as $widget)
                    {!! $widget !!}
                @endforeach
            @endif
        @endif 
        <!-- end is_admin check -->
         @if(auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
            
            
           
        @endif
      	<!-- sales chart end -->
        @if(!empty($widgets['after_sales_current_fy']))
            @foreach($widgets['after_sales_current_fy'] as $widget)
                {!! $widget !!}
            @endforeach
        @endif
      	<!-- products less than alert quntity -->
      	<div class="row">
            @if(auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
                <div class="col-sm-7">
                    @component('components.widget', ['class' => 'box-warning'])
                      @slot('icon')
                        <i class="fa fa-list text-red" aria-hidden="true"></i>
                      @endslot
                      @slot('title')
                        {{ __('lang_v1.sales_payment_dues') }} 
                        <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                      @endslot
                      <table class="table table-bordered table-striped" id="sales_payment_dues_table">
                        <thead>
                          <tr>
                            <th>@lang( 'contact.customer' )</th>
                            <th>@lang( 'sale.invoice_no' )</th>
                            <th>Transaction Date</th>
                            <th>Next Due Date</th>
                            <th>@lang( 'home.due_amount' )</th>
                            <th>@lang( 'messages.action' )</th>
                          </tr>
                        </thead>
                      </table>
                    @endcomponent
                </div>
            @endif
            @can('purchase.view')
                <div class="col-sm-5">
                    @component('components.widget', ['class' => 'box-danger'])
                      @slot('icon')
                      <i class="fa fa-venus-double text-red" aria-hidden="true"></i>
                      @endslot
                      @slot('title')
                        {{ __('My Dogs Mated Details') }} 
                        <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                      @endslot
                      <table class="table table-bordered table-striped" id="stock_alert_table" style="width: 100%;">
                        <thead>
                          <tr>
                            <th>Dog Name</th>
                            <th>Last Mated Date</th>
                            <th>55 days LMD</th>
                            <th>5.5 Months LMD</th>
                          </tr>
                        </thead>
                      </table>
                    @endcomponent
                </div>
            @endcan
        </div>
        @can('stock_report.view')
            <div class="row">
                <div class=" col-sm-6 ">
                    @component('components.widget', ['class' => 'box-success'])
                      @slot('icon')
                        <i class="fa fa-paw text-red" aria-hidden="true"></i>
                      @endslot
                      @slot('title')
                        {{ __('Pupies Worming Reminder') }} 
                        <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                      @endslot
                      <table class="table table-bordered table-striped" id="pupies_alert_table" style="width: 100%;">
                        <thead>
                          <tr>
                            <th>Puppy Name</th>
                            <th>Date of Birth</th>
                            <th>Worming</th>
                          </tr>
                        </thead>
                      </table>
                    @endcomponent
                </div>
                <!--vaccination -->
                <div class=" col-sm-6 ">
                    @component('components.widget', ['class' => 'box-primary'])
                      @slot('icon')
                      <i class="fa fa-syringe text-red" aria-hidden="true"></i>
                      @endslot
                      @slot('title')
                        {{ __('Vaccination Reminder') }} 
                        <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                      @endslot
                      <table class="table table-bordered table-striped" id="vaccination_alert_table" style="width: 100%;">
                        <thead>
                          <tr>
                            <th>Puppy Name</th>
                            <th>Date of Birth</th>
                            <th>1st Vaccination</th>
                            <th>2nd Vaccination</th>
                          </tr>
                        </thead>
                      </table>
                    @endcomponent
                </div>
      	    </div>
        @endcan


        @if(auth()->user()->can('so.view_all') || auth()->user()->can('so.view_own'))
            <div class="row" @if(!auth()->user()->can('dashboard.data'))style="margin-top: 190px !important;"@endif>
                <div class="col-sm-12">
                    @component('components.widget', ['class' => 'box-warning hide'])
                        @slot('icon')
                            <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                        @endslot
                        @slot('title')
                            {{__('lang_v1.sales_order')}}
                        @endslot
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view" id="sales_order_table">
                                <thead>
                                    <tr>
                                        <th>@lang('messages.action')</th>
                                        <th>@lang('messages.date')</th>
                                        <th>@lang('restaurant.order_no')</th>
                                        <th>@lang('sale.customer_name')</th>
                                        <th>@lang('lang_v1.contact_no')</th>
                                        <th>@lang('sale.location')</th>
                                        <th>@lang('sale.status')</th>
                                        <th>@lang('lang_v1.shipping_status')</th>
                                        <th>@lang('lang_v1.quantity_remaining')</th>
                                        <th>@lang('lang_v1.added_by')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endcomponent
                </div>
            </div>
        @endif
        @if(!empty($common_settings['enable_purchase_order']) && (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own')) )
            <div class="row hide" @if(!auth()->user()->can('dashboard.data'))style="margin-top: 190px !important;"@endif>
                <div class="col-sm-12">
                    @component('components.widget', ['class' => 'box-warning'])
                      @slot('icon')
                          <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                      @endslot
                      @slot('title')
                          @lang('lang_v1.purchase_order')
                      @endslot
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped ajax_view" id="purchase_order_table" style="width: 100%;">
                                  <thead>
                                      <tr>
                                          <th>@lang('messages.action')</th>
                                          <th>@lang('messages.date')</th>
                                          <th>@lang('purchase.ref_no')</th>
                                          <th>@lang('purchase.location')</th>
                                          <th>@lang('purchase.supplier')</th>
                                          <th>@lang('sale.status')</th>
                                          <th>@lang('lang_v1.quantity_remaining')</th>
                                          <th>@lang('lang_v1.added_by')</th>
                                      </tr>
                                  </thead>
                                </table>
                        </div>
                    @endcomponent
                </div>
            </div>
        @endif

        @if(auth()->user()->can('access_pending_shipments_only') || auth()->user()->can('access_shipping') || auth()->user()->can('access_own_shipping') )
            @component('components.widget', ['class' => 'box-warning hide'])
              @slot('icon')
                  <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
              @endslot
              @slot('title')
                  @lang('lang_v1.pending_shipments')
              @endslot
                <div class="table-responsive">
                    <table class="table table-bordered table-striped ajax_view" id="shipments_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.action')</th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('sale.invoice_no')</th>
                                <th>@lang('sale.customer_name')</th>
                                <th>@lang('lang_v1.contact_no')</th>
                                <th>@lang('sale.location')</th>
                                <th>@lang('lang_v1.shipping_status')</th>
                                @if(!empty($custom_labels['shipping']['custom_field_1']))
                                    <th>
                                        {{$custom_labels['shipping']['custom_field_1']}}
                                    </th>
                                @endif
                                @if(!empty($custom_labels['shipping']['custom_field_2']))
                                    <th>
                                        {{$custom_labels['shipping']['custom_field_2']}}
                                    </th>
                                @endif
                                @if(!empty($custom_labels['shipping']['custom_field_3']))
                                    <th>
                                        {{$custom_labels['shipping']['custom_field_3']}}
                                    </th>
                                @endif
                                @if(!empty($custom_labels['shipping']['custom_field_4']))
                                    <th>
                                        {{$custom_labels['shipping']['custom_field_4']}}
                                    </th>
                                @endif
                                @if(!empty($custom_labels['shipping']['custom_field_5']))
                                    <th>
                                        {{$custom_labels['shipping']['custom_field_5']}}
                                    </th>
                                @endif
                                <th>@lang('sale.payment_status')</th>
                                <th>@lang('restaurant.service_staff')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcomponent
        @endif

        @if(!empty($widgets['after_dashboard_reports']))
          @foreach($widgets['after_dashboard_reports'] as $widget)
            {!! $widget !!}
          @endforeach
        @endif

    @endif
   <!-- can('dashboard.data') end -->
</section>
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade edit_pso_status_modal" tabindex="-1" role="dialog"></div>
<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
@stop
@section('javascript')
    <script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    @includeIf('sales_order.common_js')
    @includeIf('purchase_order.common_js')
    @if(!empty($all_locations))
        {!! $sells_chart_1->script() !!}
        {!! $sells_chart_2->script() !!}
    @endif
    <script type="text/javascript">
        sales_order_table = $('#sales_order_table').DataTable({
          processing: true,
          serverSide: true,
          scrollY: "75vh",
          scrollX:        true,
          scrollCollapse: true,
          aaSorting: [[1, 'desc']],
          "ajax": {
              "url": '{{action("SellController@index")}}?sale_type=sales_order',
              "data": function ( d ) {
                  d.for_dashboard_sales_order = true;
              }
          },
          columnDefs: [ {
              "targets": 7,
              "orderable": true,
              "searchable": false
          } ],
          columns: [
              { data: 'action', name: 'action'},
              { data: 'transaction_date', name: 'transaction_date'  },
              { data: 'invoice_no', name: 'invoice_no'},
              { data: 'conatct_name', name: 'conatct_name'},
              { data: 'mobile', name: 'contacts.mobile'},
              { data: 'business_location', name: 'bl.name'},
              { data: 'status', name: 'status'},
              { data: 'shipping_status', name: 'shipping_status'},
              { data: 'so_qty_remaining', name: 'so_qty_remaining', "searchable": false},
              { data: 'added_by', name: 'u.first_name'},
          ]
      });
        @if(!empty($common_settings['enable_purchase_order']))
        $(document).ready( function(){
          //Purchase table
          purchase_order_table = $('#purchase_order_table').DataTable({
              processing: true,
              serverSide: true,
              aaSorting: [[1, 'desc']],
              scrollY: "75vh",
              scrollX:        true,
              scrollCollapse: true,
              ajax: {
                  url: '{{action("PurchaseOrderController@index")}}',
                  data: function(d) {
                      d.from_dashboard = true;
                  },
              },
              columns: [
                  { data: 'action', name: 'action', orderable: false, searchable: false },
                  { data: 'transaction_date', name: 'transaction_date' },
                  { data: 'ref_no', name: 'ref_no' },
                  { data: 'location_name', name: 'BS.name' },
                  { data: 'name', name: 'contacts.name' },
                  { data: 'status', name: 'transactions.status' },
                  { data: 'po_qty_remaining', name: 'po_qty_remaining', "searchable": false},
                  { data: 'added_by', name: 'u.first_name' }
              ]
          });
        })
        @endif

        sell_table = $('#shipments_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            scrollY:        "75vh",
            scrollX:        true,
            scrollCollapse: true,
            "ajax": {
                "url": '{{action("SellController@index")}}',
                "data": function ( d ) {
                    d.only_pending_shipments = true;
                }
            },
            columns: [
                { data: 'action', name: 'action', searchable: false, orderable: false},
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'conatct_name', name: 'conatct_name'},
                { data: 'mobile', name: 'contacts.mobile'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'shipping_status', name: 'shipping_status'},
                @if(!empty($custom_labels['shipping']['custom_field_1']))
                    { data: 'shipping_custom_field_1', name: 'shipping_custom_field_1'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_2']))
                    { data: 'shipping_custom_field_2', name: 'shipping_custom_field_2'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_3']))
                    { data: 'shipping_custom_field_3', name: 'shipping_custom_field_3'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_4']))
                    { data: 'shipping_custom_field_4', name: 'shipping_custom_field_4'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_5']))
                    { data: 'shipping_custom_field_5', name: 'shipping_custom_field_5'},
                @endif
                { data: 'payment_status', name: 'payment_status'},
                { data: 'waiter', name: 'ss.first_name', @if(empty($is_service_staff_enabled)) visible: false @endif }
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#sell_table'));
            },
            createdRow: function( row, data, dataIndex ) {
                $( row ).find('td:eq(4)').attr('class', 'clickable_td');
            }
        });
    </script>
@endsection

