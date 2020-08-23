@extends('master')
<script src="/js/jquery.js" ></script>

@section('content')
    {!! NoCaptcha::renderJs() !!}
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
                    <p class="join">{{ trans('index.join_us') }}</p>
                    <img src="/img/contact/Group.svg" />
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">
            <h2 class="textAlignCenter">{{ session()->get('message') }}</h2>
        </div>
    @endif
    <div class="container"  id="contactForm">
        <div class="formBg">
            <h2 class="red @if(session('locale') == 'ar') textAlignRight @endif"> {{ trans('index.join_us_today') }} </h2>
            <p class="@if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.required_fields') }}</p>
            <form id="contactUsForm" method="post" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="@if(session('locale') == 'ar') flexEnd @endif" for="exampleInputEmail1">{{ trans('index.first_name') }}</label>
                            <input name="first_name" type="text" class="form-control" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label class="@if(session('locale') == 'ar') flexEnd @endif" for="exampleInputPassword1">{{ trans('index.last_name') }}</label>
                            <input name="last_name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="@if(session('locale') == 'ar') flexEnd @endif" for="exampleInputPassword1">{{ trans('index.phone_number') }}</label>
                            <input name="phone_number" type="number" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label class="@if(session('locale') == 'ar') flexEnd @endif" for="exampleInputEmail1">{{ trans('index.email_address') }}</label>
                            <input name="email" type="email" class="form-control" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="@if(session('locale') == 'ar') flexEnd @endif" for="exampleInputEmail1">{{ trans('index.subject') }}</label>
                            <input name="subject" type="text" class="form-control" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label class="@if(session('locale') == 'ar') flexEnd @endif" for="exampleInputEmail1">{{ trans('index.message') }}</label>
                            <textarea name="message" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="@if(session('locale') == 'ar') flexEnd @endif" for="exampleInputEmail1">{{ trans('index.upload_a_file') }}</label>
                            <input name="file" type="file" class="form-control-file inputFile">
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! NoCaptcha::display() !!}
                        <div class="forum-group submitButton">
                            <button id="contactUsSubmit" class="contactUsSubmit" type="submit">{{ trans('index.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
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

    <div class="container">
        <div class="centered">
            <h2 class="textAlignCenter">{{ trans('index.ready_to_advertise_with_us') }}</h2>
            <a href="#contactForm"><button class="contactUsNowCta" type="button">{{ trans('index.contact_us_now') }}</button></a>
        </div>
    </div>

@endsection

<script>
    $(document).ready(function(){
        $('#contactUsSubmit').on('click', function () {
            var myForm = $("#contactUsForm");
            if (myForm) {
                $(this).prop('disabled', true);
                $(myForm).submit();
            }
        });
    });
</script>

