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
                    <label for="title">العنوان  </label>
                    <input id="title" class="form-control"
                           name="title" placeholder=" العنوان"
                           required type="text" value="{{ old('title') }}">

                </div>


                <div class="form-group">
                    <label for="image">صورة </label>
                    <input id="image" class="form-control"
                           name="image"
                           required type="file">

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
            url: `{{ route('sliders.store') }}`,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status === true) {
                    sweetAlert('عملية ناجحة', response.msg);
                    jQuery('.modal').modal('hide');
                    let new_item = `<tr id="item_${response.data.id}">
                                    <td>${response.data.title}</td>
                                      <td>
                                        <a href="${window.location.origin}/${response.data.image}" target="_blank">
                                            <img width="100" height="100" src="${window.location.origin}/${response.data.image}">
                                        </a>
                                    </td>                                    <td>
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
