@extends('admin.layout.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('store.create')}}">تعديل بيانات المحل </a>
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل بيانات المحل  </h4>
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
                                              action="{{route('store.update',$stordata -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <h4 class="form-section"><i class="ft-home"></i>بيانات  مجالات المحلات  </h4>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> أسم المحل  </label>
                                                        <input type="text" value="{{$stordata->name}}"
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
                                                            <option value="{{$stordata->activestore}}">{{$stordata->activestore}}</option>
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
                                                        <input type="tel" value="{{$stordata->mob}}"
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
                                                        <input type="text" value="{{$stordata->tel}}"
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
                                                        <input type="email" value="{{$stordata->email}}"
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
                                                        <label for="projectinput1"> العنوان  </label>
                                                        <input type="text" value="{{$stordata->adress}}"
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
                                                        <input type="text" value="{{$stordata->timework}}"
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
                                                        <input type="text" value="{{$stordata->mangeer}}"
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
                                                        <input type="text" value="{{$stordata->owner}}"
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
                                                        <input type="text" value="{{$stordata->employ}}"
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
                                                        <input type="text" value="{{$stordata->telemploy}}"
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
                                                        <input type="text" value="{{$stordata->numbranches}}"
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
                                                        <select
                                                                class="form-control"
                                                                placeholder=" "
                                                                name="numbranches">
                                                            <option value="{{$stordata->numbranches}}">{{$stordata->numbranches}}</option>
                                                            <option value="A">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                        </select>
                                                        @error("numbranches")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> الاجازه الرسميه  </label>
                                                        <input type="text" value="{{$stordata->holidays}}"
                                                               class="form-control"
                                                               placeholder="الاجازات الرسمية"
                                                               name="holidays">
                                                        @error("holidays")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> تاريخ  زياره  </label>
                                                        <input type="date" value="{{$stordata->datevisite}}"
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
                                                        <select  class="form-control" name="firstvisit">
                                                            <option value="{{$stordata->firstvisit}}"> {{$stordata->firstvisit}} </option>
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

                                                            <option value="{{$stordata->anothervisite}}"> {{$stordata->anothervisite}} </option>

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
                                                            <option value="{{$stordata->contract}}">{{$stordata->contract}}</option>

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
                                                                    name="rcontract">
                                                                   <option value="{{$stordata->rcontract}}">{{$stordata->rcontract}}</option>
                                                                    @foreach($resontract as $corp)
                                                                        <option value="{{$corp->id}}"> {{$corp->title}}
                                                                        </option>

                                                                    @endforeach   </select>
                                                                @error("rcontract")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                @enderror
                                                            </div>

                                                    </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">المستندات المطلوبه</label>
                                                        <input type="file" value="{{$stordata->papers}}"
                                                               class="form-control"
                                                               name="papers">
                                                        @error("papers")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">  راي المندوب </label>
                                                        <textarea
                                                                  class="form-control"
                                                                  placeholder=" راس المندوب "
                                                                  name="opinions">{{$stordata->opinions}}
                                                            </textarea>

                                                        @error("opinions")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">  ملاحطه </label>
                                                        <textarea
                                                                  class="form-control"
                                                                  placeholder=" الملاحظه "
                                                                  name="nots">{{$stordata->nots}}
                                                            </textarea>

                                                        @error("nots")
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

@endsection
