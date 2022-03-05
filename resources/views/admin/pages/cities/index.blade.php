@extends('admin.layout.admin')
@section('title', 'لوحة التحكم | مستخدمين لوحه التحكم')

@section('content')
    <div id="content" class="main-content">

        <div class="layout-px-spacing">

            <div class="app-content content">
                <div class="content-wrapper">
                    <div class="content-header row">
                        <div class="content-header-left col-md-6 col-12 mb-2">
                            <h3 class="content-header-title"> المدن </h3>
                            <div class="row breadcrumbs-top">
                                <div class="breadcrumb-wrapper col-12">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('city.create')}}">أضافة مدينة  </a>
                                        </li>
                                        <li class="breadcrumb-item active">  جميع المدن
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-body">
                        <!-- DOM - jQuery events table -->
                        <section id="dom">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">  المدن  </h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        @include('admin.includes.alerts.success')
                                        @include('admin.includes.alerts.errors')
                                        <div class="row layout-top-spacing" id="cancel-row">

                                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                                <div class="widget-content widget-content-area br-6">
                                                    <div class="card-content collapse show">
                                                        <div class="card-body card-dashboard">
                                                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                                                <thead class="">
                                                                <tr>
                                                                    <th>اسم المدينة </th>
                                                                    <th> اسم المحافظه</th>
                                                                    <th>اسم الاقليم </th>
                                                                    <th> اسم الدوله</th>
                                                                    <th> كل الدوله</th>
                                                                    <th>الإجراءات</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @isset($cities)
                                                                    @foreach($cities as $city)
                                                                        <tr>
                                                                            <td>{{$city -> name_city}}</td>
                                                                            <td>{{$city -> Governorate->name_gover}}</td>
                                                                            <td>{{$city -> Territory->name_terr}}</td>
                                                                            <td>{{$city ->Country -> name_coun }}</td>
                                                                            <td><a href="{{route('country.index')}}"
                                                                                   class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">كل الدول</a>
                                                                            </td>

                                                                            <td>
                                                                                <div class="btn-group" role="group"
                                                                                     aria-label="Basic example">
                                                                                    <a href="{{route('city.edit',$city -> id)}}"
                                                                                       class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                                    <form method="post" action="{{route('city.destroy',$city -> id)}}" class="d-inline">
                                                                                        {{ method_field('DELETE') }}
                                                                                        {{ csrf_field() }}
                                                                                        <button     class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</button>
                                                                                    </form>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endisset


                                                                </tbody>
                                                            </table>
                                                            <div class="justify-content-center d-flex">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
