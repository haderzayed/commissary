@extends('admin.layout.admin')
@section('title', 'لوحة التحكم | مستخدمين لوحه التحكم')

@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">   الاقاليم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('government.create')}}">اضافه محافظه  </a>
                                </li>
                                <li class="breadcrumb-item active">  كل المحافظات
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
                                    <h4 class="card-title">  المحافظات  </h4>
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

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">

                                            <thead class="">
                                            <tr>
                                                <th>اسم المحافظه </th>
                                                <th> اسم الاقليم</th>
                                                <th> اسم الدوله</th>
                                                <th> كل الاقاليم</th>
                                                <th> كل الدوله</th>

                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
{{--                                            @dd($terrys)--}}
                                            @isset($govers)
                                                @foreach($govers as $terry)
                                                    <tr>

                                                        <td>{{$terry -> name_gover}}</td>
                                                        <td>{{$terry ->TerritoryG -> name_terr  ?? "لا يوجد"}}</td>
                                                        <td>{{$terry ->countryg -> name_coun  ?? "لا يوجد"}}</td>


                                                        <td><a href="{{route('territory.index')}}"
                                                               class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">كل الاقاليم</a>
                                                        </td>
                                                        <td><a href="{{route('country.index')}}"
                                                               class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">كل الدول</a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('government.edit',$terry -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>



                                                                <form method="post" action="{{route('government.destroy',$terry -> id)}}" class="d-inline">
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
                </section>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection
