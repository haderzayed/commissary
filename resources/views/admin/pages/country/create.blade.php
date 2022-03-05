@extends('admin.layout.admin')
@section('title', 'لوحة التحكم | الستخدمين')
@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('country.index')}}"> كل الدول </a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
{{--                                <div class="card-header">--}}
{{--                                    <h4 class="card-title" id="basic-layout-form"> اضافة الدوله </h4>--}}
{{--                                    <a class="heading-elements-toggle"><i--}}
{{--                                            class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                                    <div class="heading-elements">--}}
{{--                                        <ul class="list-inline mb-0">--}}
{{--                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
{{--                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
{{--                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
{{--                                            <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('country.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>  أضافة دوله  </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم الدوله  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder="الاسم"
                                                                   name="name_coun">
                                                            @error("name_coun")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  الوصف </label>
                                                            <textarea type="text"
                                                                   class="form-control"
                                                                   placeholder=" الوصف "
                                                                   name="decs">

                                                            </textarea>

                                                            @error("decs")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-actions">
                                                        <button type="button" class="btn btn-warning mr-1"
                                                                onclick="history.back();">
                                                            <i class="ft-x"></i> تراجع
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="la la-check-square-o"></i> حفظ
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection
