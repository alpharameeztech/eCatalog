@extends('master')

@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <div class="contactUsBg">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                </div>
                <div class="col-sm-7">
                    <h1 class="heading">
                        {{ trans('index.contact_us_heading') }}
                    </h1>
                    <p class="subHeading">
                        {{ trans('index.contact_us_sub_heading') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 joinDiv">
                    <p class="join"> Join Us</p>
                    <img src="/img/contact/Group.svg" />
                </div>
            </div>
        </div>
    </div>

    <div class="container advertiseWithUs">
        <h2 class="textAlignCenter">{{ trans('index.benefits_of_advertising_with_us') }}</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="/img/contact/Group 30.svg" />
                <p class="textAlignCenter fontWeightMada">{{ trans('index.reach_a_large_number_of_clients') }}</p>
            </div>
            <div class="col-md-4">
                <img src="/img/contact/Group 29.svg" />
                <p class="textAlignCenter fontWeightMada">{{ trans('index.interested_audience') }}</p>
            </div>
            <div class="col-md-4">
                <img src="/img/contact/Group 31.svg" />
                <p class="textAlignCenter fontWeightMada">{{ trans('index.expand_your_customer_base') }}</p>
            </div>
        </div>
    </div>

    <div class="container whyJoinUs">
        <h2 class="textAlignCenter">{{ trans('index.why_join_us') }}</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="shadowBox">
                    <img src="/img/contact/Rectangle 87.png" />
                    <div class="subContent">
                        <p class="textAlignCenter fontWeightMada">{{ trans('index.interested_customers') }}</p>
                        <p>{{ trans('index.interested_customers_paragraph') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="shadowBox">
                    <img src="/img/contact/Rectangle 88.png" />
                    <div class="subContent">
                        <p class="textAlignCenter fontWeightMada">{{ trans('index.user_friendly_catalog_display') }}</p>
                        <p>{{ trans('index.user_friendly_catalog_display_paragraph') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="shadowBox">
                    <img src="/img/contact/Rectangle 86.png" />
                    <div class="subContent">
                        <p class="textAlignCenter fontWeightMada">{{ trans('index.bigger_reach') }}</p>
                        <p>{{ trans('index.bigger_reach_paragraph') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


