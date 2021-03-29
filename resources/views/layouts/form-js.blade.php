{!! $builder->scripts() !!}
<script>
    
    // SHOW CREATED FORM 
    function showCreateForm() {
        $('.modal-title, .btn-primary').text('Добавить');
        $('#method').val('POST');
        $('.input').val("").removeClass('is-invalid');
    };

    // SHOW UPDATED FORM
    function showUpdateForm(thisSelector, sectionId) {
        let dataTable = window.LaravelDataTables["dataTableBuilder"].row($(thisSelector).parents('tr')).data();
        $('.input').val(dataTable.title);
        $('#form').attr('action', dataTable.itemUrl);
        $('.modal-title, .btn-primary').text('Изменить');
        $('#method').val('PUT');
    };

    // CREATE OR UPDATE FUNCTION
    function createUpdateItem(event, thisSelector) {
        event.preventDefault();
        let formData = new FormData(thisSelector[0]);
        $.ajax({
            url: thisSelector.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res['status'] == "success") {
                    LaravelDataTables.dataTableBuilder.ajax.reload();
                    $('.modal').modal('hide');
                }
            },
            error: function(err) {
                console.log(err);
                $('.input').addClass('is-invalid');
                $('small').text('Обязательное поле');
            },
        });
    };

    // DELETE FUNCTION
    function deleteItem(thisSelector) {
        dataTable = window.LaravelDataTables["dataTableBuilder"].row($(thisSelector).parents('tr')).data();
        agreeDelete = confirm("Удалить?");
        if (agreeDelete == true) {
            $.ajax({
                type: 'DELETE',
                url: dataTable.itemUrl,
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function(res) {
                    if (res['status'] == 'success') {
                        LaravelDataTables.dataTableBuilder.ajax.reload();
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    };

</script>
