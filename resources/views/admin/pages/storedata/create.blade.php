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
                                <li class="breadcrumb-item"><a href="{{route('store.index')}}">بيانات المحل </a>
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة بيان محل </h4>
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

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('store.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المجال </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أسم المحل  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder=" اسم المحل"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> نشاط المحل  </label>
                                                            <select class="form-control"
                                                                    name="activestore">
                                                                @foreach($corporatefiels as $corp)
                                                                    <option value="{{$corp->id}}"> {{$corp->title}}
                                                                    </option>

                                                                @endforeach
                                                            </select>
                                                            @error("title")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> رقم الموبيل  </label>
                                                            <input type="tel" value=""
                                                                   class="form-control"
                                                                   placeholder="رقم الموبيل"
                                                                   name="mob">
                                                            @error("mob")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تليفون  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder="تليفون"
                                                                   name="tel">
                                                            @error("tel")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> البريد الالكتروني  </label>
                                                            <input type="email" value=""
                                                                   class="form-control"
                                                                   placeholder=" البريد الالكتروني"
                                                                   name="email">
                                                            @error("email")
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
                                                                @if(count($countries) > 0)
                                                                    <option value=""> من فضلك اختار الدوله</option>
                                                                    @foreach($countries as $corp)
                                                                        <option value="{{$corp->id}}"> {{$corp->name_coun}}
                                                                        </option>
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
                                                                <option value=""> اختار الاقليم
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
                                                                <option value=""> اختار المحافظة
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
                                                            <select id="city_sel" class="form-control" name="City_id">
                                                                <option value="0"> اختار المدينه</option>
                                                            </select>
                                                            @error("City_id")
                                                            <span class="text-danger">  {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  أختار الحي
                                                            </label>
                                                            <select id="neigh" class="form-control" name="neighborhood_id">
                                                                <option value=""> اختار الحي</option>
                                                            </select>
                                                            @error("neighborhoods_id")
                                                            <span class="text-danger">  {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> العنوان  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder=" العنوان"
                                                                   name="adress">
                                                            @error("adress")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اوقات العمل  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder="وقت العمل"
                                                                   name="timework">
                                                            @error("timework")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أسم المدير  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder=" اسم المدير"
                                                                   name="mangeer">
                                                            @error("mangeer")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم صاحب المحل  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder=" اسم صاحب المحل"
                                                                   name="owner">
                                                            @error("owner")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أسم الموظف  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder=" اسم الموظف"
                                                                   name="employ">
                                                            @error("employ")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تليفون الموظف  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder="تليفون الموظف"
                                                                   name="telemploy">
                                                            @error("telemploy")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">عدد الفروع  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder=" "
                                                                   name="numbranches">
                                                            @error("numbranches")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">مستوي المحل   </label>
                                                            <select type="text" value=""
                                                                    class="form-control"
                                                                    placeholder=" "
                                                                    name="levelstore">
                                                                <option value="A">A</option>
                                                                <option value="A">B</option>
                                                                <option value="A">C</option>
                                                                <option value="A">D</option>
                                                            </select>
                                                            @error("numbranches")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاجازه الرسميه  </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder=" holidays"
                                                                   name="holidays">
                                                            @error("holidays")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تاريخ  زياره  </label>
                                                            <input type="date" value=""
                                                                   class="form-control"
                                                                   placeholder=" تاريخ الزياره"
                                                                   name="datevisite">
                                                            @error("datevisite")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">هل اول زياره  </label>
                                                            <select  class="form-control"
                                                                     name="firstvisit">


                                                                <option value="yes">نعم</option>
                                                                <option value="no">لا</option>
                                                            </select>
                                                            @error("firstvisit")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">هل في زياره اخري  </label>
                                                            <select  class="form-control"
                                                                     name="anothervisite">


                                                                <option value="yes">نعم</option>
                                                                <option value="no">لا</option>
                                                            </select>

                                                            @error("anothervisite")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> هل تم التعاقد الرسميه  </label>
                                                            <select
                                                                   class="form-control"
                                                                   name="contract">

                                                                <option value="yes">نعم</option>
                                                                <option value="no">لا</option>
                                                            </select>
                                                            @error("contract")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  أسباب عدم التعاقد
                                                            </label>
                                                            <select
                                                                class="form-control"
                                                                name="noncontract">

                                                                @foreach($resontract as $corp)
                                                                    <option value="{{$corp->id}}"> {{$corp->title}}
                                                                    </option>

                                                                @endforeach                                                            </select>
                                                            @error("rcontract")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">المستندات المطلوبه</label>
                                                            <input type="file" value=""
                                                                   class="form-control"
                                                                   name="papers[]" multiple>
                                                            @error("papers")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  راي المندوب </label>
                                                            <textarea type="text"
                                                                      class="form-control"
                                                                      placeholder=" راس المندوب "
                                                                      name="opinions">

                                                            </textarea>

                                                            @error("opinions")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  ملاحطه </label>
                                                            <textarea type="text"
                                                                      class="form-control"
                                                                      placeholder=" الملاحظه "
                                                                      name="nots">

                                                            </textarea>

                                                            @error("nots")
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function(){

            $('#sel_count').change(function(){
                // $('#terr').empty();
                // $('#gover').empty();
                // $('#city_sel').empty();

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

               // $('#gover').empty();

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

            $('#gover').change(function(){

              //  $('#city_sel').empty();

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
                                $("#city_sel").append(option);
                            }
                        }
                    }
                }); //end ajax
            });//end on change

            $('#city_sel').change(function(){
                //$('#neighborhood').empty();
                var id = $( "#city_sel" ).val();
                $.ajax({
                    url: '/get-neighborhood/'+id,
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
                                var neigh = (response['data'][i].name) ; // subject name
                                var option = "<option value='"+id+"'>"+neigh+"</option>";
                                $("#neigh").append(option);
                            }
                        }
                    }
                }); //end ajax
            });//end on change
        });
    </script>
@endsection
