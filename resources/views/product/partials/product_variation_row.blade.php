
@if(!session('business.enable_price_tax')) 
    @php
        $default = 0;
        $class = 'hide';
    @endphp
@else
    @php
        $default = null;
        $class = '';
    @endphp
@endif

<tr class="variation_row">
    <td>
        {!! Form::select('product_variation[' . $row_index .'][variation_template_id]', $variation_templates, null, ['class' => 'form-control input-sm variation_template', 'required']); !!}
        <input type="hidden" class="row_index" value="{{$row_index}}">
    </td>

    <td>
        <table class="table table-condensed table-bordered blue-header variation_value_table">
            <thead>
            <tr>
                <th> </th>
                <th> </th>
                <th class="{{$class}}">
                    <br/>
                    
                </th>
                <th class="{{$class}}"> </th>
                <th class="{{$class}}"> 
                </th>
                <th> </th>
                <!-- <th><button type="button" class="btn btn-success btn-xs add_variation_value_row">Add +</button></th> -->
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>
                    {!! Form::text('product_variation[' . $row_index .'][variations][0][sub_sku]', null, ['class' => 'form-control input-sm']); !!}
                </td>
                <td>
                    {!! Form::text('product_variation[' . $row_index .'][variations][0][value]', null, ['class' => 'form-control input-sm variation_value_name', 'required']); !!}
                </td>
                <td class="{{$class}}">
                    <div class="width-50 f-left">
                        {!! Form::text('product_variation[' . $row_index .'][variations][0][default_purchase_price]', $default, ['class' => 'form-control input-sm variable_dpp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']); !!}
                    </div>

                    <div class="width-50 f-left">
                        <div class="input-group">
                            {!! Form::text('product_variation[' . $row_index .'][variations][0][dpp_inc_tax]', $default, ['class' => 'form-control input-sm variable_dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); !!}
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                            </span>
                        </div>
                    </div>
                </td>
                <td class="{{$class}}">
                    <div class="input-group">
                        {!! Form::text('product_variation[' . $row_index .'][variations][0][profit_percent]', $profit_percent, ['class' => 'form-control input-sm variable_profit_percent input_number', 'required']); !!}

                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_profit_percent"><i class="fas fa-check-double"></i></button>
                        </span>
                    </div>
                </td>
                <td class="{{$class}}">
                    {!! Form::text('product_variation[' . $row_index .'][variations][0][default_sell_price]', $default, ['class' => 'form-control input-sm variable_dsp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']); !!}

                     {!! Form::text('product_variation[' . $row_index .'][variations][0][sell_price_inc_tax]', $default, ['class' => 'form-control input-sm variable_dsp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); !!}
                </td>
                <!-- <td>{!! Form::file('variation_images_' . $row_index .'_0[]', ['class' => 'variation_images', 'accept' => 'image/*', 'multiple']); !!}</td> -->
                <td>
                    <button type="button" class="btn btn-danger btn-xs remove_variation_value_row">-</button>
                    <input type="hidden" class="variation_row_index" value="0">
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>