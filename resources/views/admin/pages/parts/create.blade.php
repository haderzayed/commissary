<div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title" id="formModalCenterTitle">اضافة ختمة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form role="form" id="add_item_form" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title_id">أسم الجزء  </label>
                    <select id="title_id" class="form-control"
                            name="title_id">

                        @foreach($namehezp as $item)
                            <option value="{{$item->id}}">{{ $item->title }}</option>
                        @endforeach
                    </select>

                </div>


                <div class="form-group">
                    <label for="image">صور الجزء</label>

                    <select name="image[]" id="image" multiple>
                        @foreach($quranimages as $item)
                            <option value="{{$item->id}}">{{ $item->name }}</option>
                        @endforeach

                    </select>


                </div>
            </div>


            <!-- /.card-body -->
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
        <button type="submit" class="btn btn-primary" id="submit_form">حفظ</button>
    </div>
</div>

<script>
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery('#submit_form').click(() => {
        jQuery('#add_item_form').submit()
    })

    jQuery('#add_item_form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: `{{ route('part.store') }}`,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status === true) {
                    sweetAlert('عملية ناجحة', response.msg);
                    jQuery('.modal').modal('hide');
                    let new_item = `<tr id="item_${response.data.id}">
                                    <td>${response.data.title_id}</td>
                                    <td>
                                        <button type="button" class="btn btn-info edit-year" onclick="edit_item(${response.data.id})" data-toggle="modal" data-target="#formModal">تعديل</button>
                                        <button type="button" class="btn btn-danger delete-year" onclick="delete_item(${response.data.id})">
                                            حذف
                                        </button>
                                    </td>
                                </tr>`
                    let all_items = jQuery('#all_items')
                    all_items.prepend(new_item)
                    jQuery('#not_element').hide()

                } else {
                    if(typeof(response.msg) == "object") {
                        sweetAlert('خطأ', response.msg.toString())
                    } else {
                        sweetAlert('خطأ', response.msg)
                    }
                }
            },
        })
    })
</script>
