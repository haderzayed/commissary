@extends('admin.layout.admin')
@section('title', 'لوحة التحكم | مستخدمين لوحه التحكم')
@section('content')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  بيانات المحالات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('store.create')}}">بيانات المحالات</a>
                                </li>
                                <li class="breadcrumb-item active">  بيانات المحالات
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
                                    <h4 class="card-title">بيانات المحالات </h4>
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
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>الاسم  </th>
                                                <th> أسم المجال</th>
                                                <th> رقم الموبيل</th>
                                                <th> التليفون</th>
                                                <th> البريد الالكتروني</th>
                                                <th> أسم المدير</th>
                                                <th> العنوان</th>
                                                <th> اسم صاحب المحل</th>
                                                <th> الموظف</th>
                                                <th> ت الموظف</th>
                                                <th> تاريخ الزياره</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{--                                            @dd($users)--}}
                                            @isset($storsdata)
                                                @foreach($storsdata as $stors)
                                                    <tr>
                                                        <td>{{$stors -> name}}</td>
                                                        <td>{{$stors -> activestore}}</td>
                                                        <td>{{$stors -> mob ?? " لا يوجد"}}</td>
                                                        <td>{{$stors -> tel}}</td>
                                                        <td>{{$stors -> email}}</td>
                                                        <td>{{$stors -> mangeer}}</td>
                                                        <td>{{$stors -> adress}}</td>
                                                        <td>{{$stors -> owner}}</td>
                                                        <td>{{$stors -> employ}}</td>
                                                        <td>{{$stors -> telemploy}}</td>
                                                        <td>{{$stors -> created_at ?? "لا يوجد"}}</td>
{{--                                                        <td>{{$stors -> firstvisit}}</td>--}}
{{--                                                        <td>{{$stors -> anothervisite}}</td>--}}
{{--                                                        <td>{{$stors -> numbranches}}</td>--}}
{{--                                                        <td>{{$stors -> levelstore}}</td>--}}
{{--                                                        <td>{{$stors -> timework}}</td>--}}
{{--                                                        <td>{{$stors -> holidays}}</td>--}}
{{--                                                        <td>{{$stors -> papers}}</td>--}}
{{--                                                        <td>{{$stors -> opinions}}</td>--}}
{{--                                                        <td>{{$stors -> nots}}</td>--}}

                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('store.edit',$stors -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                                                <form method="post" action="{{route('store.destroy', $stors->id)}}" class="d-inline">
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
@endsection
