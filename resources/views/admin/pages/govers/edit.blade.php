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
                                <li class="breadcrumb-item"><a href="{{route('government.index')}}">كل محافظة   </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل محافظة
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
                                    <h4 class="card-title" id="basic-layout-form">تعديل اسم المحافظة  </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>

                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('government.update',$govers -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <h4 class="form-section"><i class="ft-home"></i>بيانات  المحافظة  </h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> الاسم  </label>
                                                        <input type="text" value="{{$govers->name_gover}}" id="title"
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="name_gover">
                                                        @error("name_gover")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label for="projectinput1">  أختار الدوله
                                                        </label>
                                                        <select id="sel_count"
                                                                class="form-control selectpicker" data-live-search="true"
                                                                name="Country_id">
                                                            <option value="{{$govers->Country_id}}"> {{$govers-> countryg -> name_coun }}

                                                        @if(count($countries) > 0)
                                                                @foreach($countries as $corp)
                                                                    <option value="{{$corp->id}}"> {{$corp->name_coun}}
                                                                    </option>

                                                                @endforeach
                                                            @else
                                                                <option value="" disabled>لايوجد مدينة</option>
                                                            @endif
                                                        </select>
                                                        @error("Country_id")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">  أختار الاقليم
                                                        </label>

                                                        <select
                                                            class="form-control" id ="terr"
                                                            name="Territory_id">
                                                            <option value="{{$govers->Territory_id}}"> {{$govers-> TerritoryG -> name_terr }}

                                                                                     </select>
                                                        @error("Territory_id")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function(){

            $('#sel_count').change(function(){
                $('#terr').empty();

                var id = $( "#sel_count" ).val();
                $.ajax({
                    url: '/getTerritory/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }
                        if(len > 0){
                            // Read data and create <option >
                            for(var i=0; i<len; i++){
                                // var id = response['data'][i].id;
                                var id = response['data'][i].id; // subject id
                                var name = (response['data'][i].name_terr) ; // subject name
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $("#terr").append(option);
                                //  $('#sub').append(sub);
                            }
                        }
                    }
                }); //end ajax
            });//end on change
        });
    </script>
@endsection
