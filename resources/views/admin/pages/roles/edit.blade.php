@extends('admin.layout.admin')

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
                                        <li class="breadcrumb-item"><a href="/home">الرئيسية </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('roles.index')}}">كل صلاحية   </a>
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
                                        <div class="card-header">
                                            <h4 class="card-title" id="basic-layout-form">أضافة صلاحية   </h4>
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

                                            <div class="card-body">

                                                <form class="form"
                                                      action="{{route('roles.update',$roles -> id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                               <h4 class="form-section"><i class="ft-home"></i>بيانات  الصلاحية  </h4>
                                                 <div class="row">
                                                           <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="name">اسم الصلاحية </label>
                                                     <input id="name" class="form-control"
                                                             readonly placeholder="اسم الخاتمه "
                                                             required type="text" value="{{ $roles->name }}">

                                                            </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                </div>
                                                                @foreach ($permissions as $value)
                                                                 <div class="col-lg-6">
                                                                         <div class="form-group">
                                                                            <label class="checkbox-inline">
                                                                                    <input  class="chk_box"
                                                                                            type="checkbox"
                                                                                            name="permissions[]" value ="{{$value->id}}"  {{ in_array($value->id ,$rolePermissions)? 'checked' : '' }}>
                                                                                    {{ $value->view_name }}
                                                                            </label>
                                                                        </div>
                                                                     </div>
                                                             @endforeach
                                                    </div>
                                                   <div class="form-actions">
                                                        <button type="button" class="btn btn-warning mr-1"
                                                                onclick="history.back();"><i class="ft-x"></i> تراجع
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="la la-check-square-o"></i> حفظ
                                                        </button>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </form>
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
