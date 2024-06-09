
//Cài đặt ajax cho tất cả các request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function removeRow(id,url) {
    if(confirm('Bạn có chắc chắn muốn xóa không?')) {
        $.ajax({
            url: url,
            type: 'delete',
            datatype: 'JSON',
            data: {id: id},
            success: function (response) {
                console.log(response);
            }
        });
    }
}



