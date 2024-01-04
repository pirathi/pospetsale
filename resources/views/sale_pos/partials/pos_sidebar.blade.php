<div class="row box box-solid pos_form_totals" style="margin: 0 auto; margin-bottom: 15px;">
	<div class="col-md-12 box-body ">
		<table class="table table-condensed" style="font-size: 18px;">
			<tr>
				<td><b>@lang('sale.item'):</b>&nbsp;
					<span class="total_quantity">0</span></td>
				<td>
					<b>@lang('sale.total'):</b> &nbsp;
					<span class="price_total">0</span>
				</td>
			</tr>
			<tr>
				<td>
					<b>
						@if($is_discount_enabled)
							@lang('sale.discount')
							@show_tooltip(__('tooltip.sale_discount'))
						@endif
						@if($is_rp_enabled)
							{{session('business.rp_name')}}
						@endif
						@if($is_discount_enabled)
							(-):
							@if($edit_discount)
							<i class="fas fa-edit cursor-pointer" id="pos-edit-discount" title="@lang('sale.edit_discount')" aria-hidden="true" data-toggle="modal" data-target="#posEditDiscountModal"></i>
							@endif
						
							<span id="total_discount">0</span>
						@endif
							<input type="hidden" name="discount_type" id="discount_type" value="@if(empty($edit)){{'percentage'}}@else{{$transaction->discount_type}}@endif" data-default="percentage">

							<input type="hidden" name="discount_amount" id="discount_amount" value="@if(empty($edit)) {{@num_format($business_details->default_sales_discount)}} @else {{@num_format($transaction->discount_amount)}} @endif" data-default="{{$business_details->default_sales_discount}}">

							<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="@if(empty($edit)){{'0'}}@else{{$transaction->rp_redeemed}}@endif">

							<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="@if(empty($edit)){{'0'}}@else {{$transaction->rp_redeemed_amount}} @endif">

							</span>
					</b> 
				</td>
				<td class="@if($pos_settings['disable_order_tax'] != 0) hide @endif">
					<span>
						<b>@lang('sale.order_tax')(+): @show_tooltip(__('tooltip.sale_tax'))</b>
						<i class="fas fa-edit cursor-pointer" title="@lang('sale.edit_order_tax')" aria-hidden="true" data-toggle="modal" data-target="#posEditOrderTaxModal" id="pos-edit-tax" ></i> 
						<span id="order_tax">
							@if(empty($edit))
								0
							@else
								{{$transaction->tax_amount}}
							@endif
						</span>

						<input type="hidden" name="tax_rate_id" 
							id="tax_rate_id" 
							value="@if(empty($edit)) {{$business_details->default_sales_tax}} @else {{$transaction->tax_id}} @endif" 
							data-default="{{$business_details->default_sales_tax}}">

						<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="@if(empty($edit)) {{@num_format($business_details->tax_calculation_amount)}} @else {{@num_format(optional($transaction->tax)->amount)}} @endif" data-default="{{$business_details->tax_calculation_amount}}">

					</span>
				</td>
				<td>
					<span>

						<b>@lang('sale.shipping')(+): @show_tooltip(__('tooltip.shipping'))</b> 
						<i class="fas fa-edit cursor-pointer"  title="@lang('sale.shipping')" aria-hidden="true" data-toggle="modal" data-target="#posShippingModal"></i>
						<span id="shipping_charges_amount">0</span>
						<input type="hidden" name="shipping_details" id="shipping_details" value="@if(empty($edit)){{''}}@else{{$transaction->shipping_details}}@endif" data-default="">

						<input type="hidden" name="shipping_address" id="shipping_address" value="@if(empty($edit)){{''}}@else{{$transaction->shipping_address}}@endif">

						<input type="hidden" name="shipping_status" id="shipping_status" value="@if(empty($edit)){{''}}@else{{$transaction->shipping_status}}@endif">

						<input type="hidden" name="delivered_to" id="delivered_to" value="@if(empty($edit)){{''}}@else{{$transaction->delivered_to}}@endif">

						<input type="hidden" name="shipping_charges" id="shipping_charges" value="@if(empty($edit)){{@num_format(0.00)}} @else{{@num_format($transaction->shipping_charges)}} @endif" data-default="0.00">
					</span>
				</td>
				@if(in_array('types_of_service', $enabled_modules))
					<td class="col-sm-3 col-xs-6 d-inline-table">
						<b>@lang('lang_v1.packing_charge')(+):</b>
						<i class="fas fa-edit cursor-pointer service_modal_btn"></i> 
						<span id="packing_charge_text">
							0
						</span>
					</td>
				@endif
				@if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0)
				<td>
					<b id="round_off">@lang('lang_v1.round_off'):</b> <span id="round_off_text">0</span>								
					<input type="hidden" name="round_off_amount" id="round_off_amount" value=0>
				</td>
				@endif
			</tr>
			<tr>
			    <td colspan="2">
        	    <div class="payment-amount-b">
                    @if(!$is_mobile)
            			<h2><b>@lang('sale.total_payable') :</b>
            			<input type="hidden" name="final_total" 
            										id="final_total_input" value=0>
            			<span id="total_payable" class=" text-bold">Rs. 0</span>
            			</h2>
            		@endif
            	</div>
			    </td>
			</tr>
			<tr>
			    <td></td>
			</tr>
		</table>
		
	</div>
</div>

<div class="row" id="featured_products_box" style="display: none;">
@if(!empty($featured_products))
	@include('sale_pos.partials.featured_products')
@endif
</div>
<div class="row ">
	@if(!empty($categories))
		<div class="col-md-4" id="product_category_div">
			<select class="select2" id="product_category" style="width:100% !important">

				<option value="all">@lang('lang_v1.all_category')</option>

				@foreach($categories as $category)
					<option value="{{$category['id']}}">{{$category['name']}}</option>
				@endforeach

				@foreach($categories as $category)
					@if(!empty($category['sub_categories']))
						<optgroup label="{{$category['name']}}">
							@foreach($category['sub_categories'] as $sc)
								<i class="fa fa-minus"></i> <option value="{{$sc['id']}}">{{$sc['name']}}</option>
							@endforeach
						</optgroup>
					@endif
				@endforeach
			</select>
		</div>
	@endif

	@if(!empty($brands))
		<div class="col-sm-4" id="product_brand_div">
			{!! Form::select('size', $brands, null, ['id' => 'product_brand', 'class' => 'select2', 'name' => null, 'style' => 'width:100% !important']) !!}
		</div>
	@endif

	<!-- used in repair : filter for service/product -->
	<div class="col-md-6 hide" id="product_service_div">
		{!! Form::select('is_enabled_stock', ['' => __('messages.all'), 'product' => __('sale.product'), 'service' => __('lang_v1.service')], null, ['id' => 'is_enabled_stock', 'class' => 'select2', 'name' => null, 'style' => 'width:100% !important']) !!}
	</div>

	<div class="col-sm-4 @if(empty($featured_products)) hide @endif" id="feature_product_div">
		<button type="button" class="btn btn-primary btn-flat" id="show_featured_products">@lang('lang_v1.featured_products')</button>
	</div>
</div>
<br>
<div class="row" >
	<input type="hidden" id="suggestion_page" value="1">
	<div class="col-md-12">
		<div class="eq-height-row plbdy bg-white py-5" id="product_list_body"></div>
	    
    	<div class=" text-center" id="suggestion_page_loader" style="display: none;">
    		<i class="fa fa-spinner fa-spin fa-2x"></i>
    	</div>
	</div>
</div>

<style>
    .plbdy {
        padding: 10px 0 !important;
    }
    
    #product_list_body {
        max-height: 50vh;
        
    }
</style>