@extends('admin.layout.admin')
@section('title', 'لوحة التحكم | الستخدمين')
@section('content')


{{--    <style>--}}
{{--        #sel_city{--}}
{{--            display:block  !important;--}}
{{--            width:100%--}}
{{--        }--}}
{{--        #sel_count-selectized{--}}
{{--            display: block !important;--}}
{{--            border: none !important;--}}
{{--            width: 100% !important;--}}
{{--        }--}}
{{--        #govers{--}}
{{--            display: block !important;--}}
{{--        }.selectize-control {--}}
{{--            margin-top: -36px;--}}
{{--                 }--}}
{{--    </style>--}}



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
                                <li class="breadcrumb-item"><a href="{{route('users.index')}}">أضافة الطالب</a>
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة عضو </h4>
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
                                        <form class="form" action="{{route('users.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات العضو </h4>



                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم بالكامل (*)</label>
                                                            <input type="text" value="{{session()->exists('data') ? session()->get('data')['fullname'] : ''}}"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="name">
                                                            @if(!empty(session()->get('errors')['fullname']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أسم المستخدم (*)</label>
                                                            <input type="text" value="{{session()->exists('data') ? session()->get('data')['user_name'] : ''}}"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="user_name">
                                                            @if(!empty(session()->get('errors')['user_name']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> رقم الموبيل (*)</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="phone" value="{{session()->exists('data') ? session()->get('data')['mobile'] : ''}}">

                                                            @if(!empty(session()->get('errors')['mobile']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> ألبريد الالكتروني (*)</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="email" value="{{session()->exists('data') ? session()->get('data')['email'] : ''}}">

                                                            @if(!empty(session()->get('errors')['email']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1">المحافظة (*)</label>
                                                            <select name="government" class="form-control" id="gover">
                                                                @if(count($gavers) > 0)
                                                                    <option value=""> من فضلك اختار المحافظة</option>
                                                                    @foreach($gavers as $gaver)
                                                                        <option value="{{$gaver->id}}" {{session()->exists('data') && $gaver->id == session()->get('data')['gavers'] ? 'selected' : 'لا يوجد محافظة'}}>{{$gaver->name_gover}}</option>

                                                                    @endforeach
                                                                @else
                                                                    <option value="" disabled>لايوجد مدينة</option>
                                                                @endif
                                                            </select>
                                                            @if(!empty(session()->get('errors')['gavers']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  أختار المدينه
                                                            </label>
                                                            <select id="city"
                                                                    class="form-control"
                                                                    name="City_id">
                                                                <option value=""> اختار المدينه
                                                                </option>
                                                            </select>
                                                            @error("City_id")
                                                            <span class="text-danger">  {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1">المدينة التى يشرف عليها</label>
                                                            <select name="representative_city_id" id="city_honor"  style='display:block !important;' class="form-control govers">
                                                                {{--                                                                <option value="">اختر المدينة</option>--}}
                                                                {{--                                            @if(!empty($subjectitems) && count($subjectitems) > 0)--}}
                                                                {{--                                                @foreach($subjectitems as $subj)--}}
                                                                {{--                                                    @if($subj->translation_lang === $lang -> abbr)--}}
                                                                {{--                                                        <option value="{{$subj->id}}">{{$subj->subjitm_name}}</option>--}}
                                                                {{--                                                    @endif--}}
                                                                {{--                                                @endforeach--}}
                                                                {{--                                            @else--}}
                                                                {{--                                                <option value="" disabled>ليس هناك تخصصات</option>--}}
                                                                {{--                                            @endif--}}
                                                            </select>

                                                            @if(!empty(session()->get('errors')['representative_city_id']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>



                                                    <div class="class col-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">كلمة المرور (*)</label>
                                                            <input type="password" id="password"
                                                                   class="form-control"
                                                                   name="password" value="{{session()->exists('data') ? session()->get('data')['password'] : ''}}">

                                                            @if(!empty(session()->get('errors')['password']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="projectinput1">رقم البطاقة</label>
                                                            <input type="text"
                                                                   class="form-control" name="id_number" value="{{session()->exists('data') ? session()->get('data')['fb_student'] : ''}}">
                                                            @if(!empty(session()->get('errors')['fb_student']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="projectinput1">الصلاحية</label>

                                                            <select name="role_id" class="form-control" id="sel_city">
                                                                @if(count($roles) > 0)
                                                                    <option value=""> من فضلك اختار الصلاحية</option>
                                                                    @foreach($roles as $role)
                                                                        <option value="{{$role->id}}" {{session()->exists('data') && $role->id == session()->get('data')['role_id'] ? 'selected' : 'لا يوجد محافظة'}}>{{$role->view_name}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" disabled>لايوجد صلاحية</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    </div>


                                                 <div class="row">
                                                     <div class="col-12">
                                                         <div class="form-group mt-1">

                                                             <label><strong>إضافة صلاحيات :</strong></label><br/>
                                                             <select class="selectpicker form-control" multiple data-live-search="true" name="permissions[]">
                                                                 @if(count($permissions) > 0)
                                                                     <option value=""> من فضلك اختار الصلاحية</option>
                                                                @foreach( $permissions as  $permission)
                                                                   <option value="{{$permission->id}}">{{$permission->view_name}}</option>
                                                                 @endforeach
                                                                 @else
                                                                     <option value="" disabled>لايوجد صلاحية</option>
                                                                 @endif
                                                             </select>
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

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>--}}

    <script>
        $(document).ready(function () {
            $('select').selectpicker();

            $('#sel_city').selectize({
                sortField: 'text'
            });
        });
</script>
    <script>
        $(document).ready(function(){

            $('#gover').change(function(){
    alert('fffff');
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
        });
    </script>
@endsection
