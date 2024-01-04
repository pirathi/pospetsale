@extends('layouts.home')
@section('title', config('app.name', 'ultimatePOS'))

@section('content')
    <style type="text/css">
        .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                margin-top: 0;
            }
        .title {
                font-size: 84px;
            }
        .tagline {
                font-size:25px;
                font-weight: 300;
                text-align: center;
            }
            
            .tit {
                display: block !important;
            }

        @media only screen and (max-width: 600px) {
            .title{
                font-size: 38px;
            }
            .tagline {
                font-size:18px;
            }
        }
    </style>
    <div class="titler" style="font-weight: 600 !important;">
        <center>
        <!--<h1 class="tit"> Wintech POS</h1><br>-->
        <div class="title flex-center" style="font-weight: 600 !important;">
           <img src="{{ url('img/logopos.png') }}" alt="logo" style="width:30%;">
        </div>
        <h2 class="tit"> Best ERP, Stock Management, Point of Sale & Invoicing Application</h2>
        <img src="{{ url('img/pos.jpg') }}" alt="logo" style="width: 60%;margin-top: 15px;">
        
        </center >
    </div>
    <div class="title flex-center" style="font-weight: 600 !important;">
       <img src="{{ url('img/pp.png') }}" alt="logo" style="width:100%;">
    </div>
    <!--<p class="tagline">-->
    <!--    {{ env('APP_TITLE', '') }}-->
    <!--</p>-->
@endsection
            