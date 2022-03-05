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
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('city.index')}}"> كل المدن </a>
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

                                        @include('admin.includes.alerts.success')
                                        @include('admin.includes.alerts.errors')
                                        <div class="card-content collapse show">
                                            <div class="card-body">
                                                <form class="form" action="{{route('neighborhood.update',$neighborhood->id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-body">

                                                        <h4 class="form-section"><i class="ft-home"></i>  تعديل حي {{$neighborhood->name }} </h4>

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم الحي   </label>
                                                                    <input type="text" value="{{$neighborhood->name }}"
                                                                           class="form-control"
                                                                           placeholder="الاسم"
                                                                           name="name">
                                                                    @error('name')
                                                                    <span class="text-danger">  {{ $message }}</span>
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
                                                                        @if(count($countries) > 0)
                                                                            <option value=""> من فضلك اختار الدوله</option>
                                                                            @foreach($countries as $corp)
                                                                                <option value="{{$corp->id}}" @if($corp->id==$neighborhood->Country_id) selected @endif> {{$corp->name_coun}} </option>
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>لايوجد مدينة</option>
                                                                        @endif
                                                                    </select>
                                                                    @error("Country_id")
                                                                    <span class="text-danger">  {{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  أختار الاقليم
                                                                    </label>
                                                                    <select id="terr"
                                                                            class="form-control"
                                                                            name="Territory_id">
                                                                        <option value="{{$neighborhood->Territory_id}}">{{$neighborhood -> Territory->name_terr}}
                                                                        </option>
                                                                    </select>
                                                                    @error("Territory_id")
                                                                    <span class="text-danger">  {{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  أختار المحافظة
                                                                    </label>
                                                                    <select id="gover"
                                                                            class="form-control"
                                                                            name="Governorate_id">
                                                                        <option value="{{$neighborhood->Governorate_id}}">{{$neighborhood->Governorate->name_gover}}
                                                                        </option>
                                                                    </select>
                                                                    @error("Governorate_id")
                                                                    <span class="text-danger">  {{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  أختار المدينه
                                                                    </label>
                                                                    <select id="city"
                                                                            class="form-control"
                                                                            name="City_id">
                                                                        <option value="{{$neighborhood->City_id}}">{{$neighborhood -> City->name_city}}
                                                                        </option>
                                                                    </select>
                                                                    @error("City_id")
                                                                    <span class="text-danger">  {{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function(){

            $('#sel_count').change(function(){
                $('#terr').empty();
                $('#gover').empty();
                $('#city').empty();

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


            $('#terr').change(function(){

                $('#gover').empty();

                var id = $( "#terr" ).val();
                $.ajax({
                    url: '/getGovernment/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }
                        if(len > 0){
                            for(var i=0; i<len; i++){
                                // var id = response['data'][i].id;
                                var id = response['data'][i].id; // subject id
                                var name = (response['data'][i].name_gover) ; // subject name
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $("#gover").append(option);
                            }
                        }
                    }
                }); //end ajax
            });//end on change
        });

        $('#gover').change(function(){

            $('#city').empty();

            var id = $( "#gover" ).val();
            $.ajax({
                url: '/get-city/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                        for(var i=0; i<len; i++){
                            // var id = response['data'][i].id;
                            var id = response['data'][i].id; // subject id
                            var name = (response['data'][i].name_city) ; // subject name
                            var option = "<option value='"+id+"'>"+name+"</option>";
                            $("#city").append(option);
                        }
                    }
                }
            }); //end ajax
        });//end on change
    </script>


@endsection
