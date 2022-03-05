@extends('admin.layout.admin')
@section('title', 'لوحة التحكم | الختمات')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">لوحة التحكم</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item">الاجزاء</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            @include('flash::message')
            <!-- Small boxes (Stat box) -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">جميع الاجزاء</h3>
                                <a id="add_new_item" class="btn btn-primary" data-target="#formModal" data-toggle="modal"
                                   href="#">انشاء</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed table-striped">
                                    <thead>
                                    <tr>
                                        <th>أسم الجزء </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="all_items">
                                    @forelse($parts as $item)
                                        <tr id="item_{{$item->id}}">
                                            <td>{{ $item->nameparts->title }}</td>
                                            <td>
                                                <a href="#" class="btn btn-info" onclick="edit_item({{ $item->id }})" data-target="#formModal" data-toggle="modal">تعديل</a>
                                                <a href="#" class="btn btn-danger delete-year" onclick="delete_item({{ $item->id }})">حذف</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="not_element">
                                            <td colspan="6">لا يوجد صور حتى الان</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                                <div class="mr-2 mt-2">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <!-- Modal -->
                <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>

        jQuery('#add_new_item').click((e) => {
            e.preventDefault()
            jQuery.ajax({
                type: "GET",
                url: `{{ route('part.create') }}`,
                success: function (response) {
                    jQuery('.modal-dialog').html(response);
                }
            });
        })

        function edit_item(id) {
            $.ajax({
                type: "GET",
                url: `{{ URL::to('admin/part') }}/${id}/edit`,
                success: function (response) {
                    jQuery('.modal-dialog').html(response);
                }
            });
        }


        function delete_item(id){
            Swal({
                title_id: 'هل أنت متأكد ؟',
                type: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                allowOutsideClick: true,
                allowEscapeKey: true,
                allowEnterKey: true,
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:'POST',
                        url: `{{ url('admin/part') }}/${id}/destroy`,
                        data: {_token:'{{csrf_token()}}'},
                        success: (response) => {
                            if (response.status === true) {
                                sweetAlert('success', response.msg);
                                jQuery("#item_" + id).remove();
                                jQuery(".modal").hide();
                            } else {
                                sweetAlert('خطأ', response.msg)
                            }
                        },
                    })

                }
            })
        }


    </script>
@stop
