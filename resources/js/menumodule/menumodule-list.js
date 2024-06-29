$(document).ready(function(){
// Datatable
    var table;
        table = $('#mytable').DataTable({
        ajax: function(data, callback, settings) {
            $('#spinner').show();
            axios.get('menumodule', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(response) {
                var data = response.data.response;
                callback({ data: data });
            })
            .catch(function(error) {
                console.log(error);
            });
        },
        columns: [
            { data: 'description' },  
            { data: 'icon' },
            { data: 'route' },
            { data: 'sort' },
            { data: 'type' },
            {
                data: null,
                render: function (data, type, row) {
                return '<button id="details"    class="btn btn-primary btn-details" data-area="'+data.id+'" data-details = "'+data.id+'""><i class="bi bi-eye"></i></button>' +
                    '<button class="btn btn-danger btn-delete" data-delete = "'+data.id+'" ><i class="bi bi-trash"></i></button>';

                }
            }
        ],
        dom: 'Bfrtip', 
        buttons: [
            'copy', 'excel', 'pdf',
            {
                text: 'Add Menumodule',            
                action: function (e, dt, node, config) {
                    $('#modalsaveupdate').modal('show');
                    $('#modalsaveupdate input').val('');  
                    // getAreas('area/fetch',0)
                    $('#modalsaveupdate select').val(null).trigger('change');
                    $('#modalsaveupdate .btn-saveupdate').attr('id','save').removeAttr('data-id').text('Save');
                }
            }
        ]
    });

        $('#mytable').on('click','.btn-details',function(){
            var id = $(this).data('details');
            $('#modalsaveupdate .btn-saveupdate').removeAttr('id','save').text('text');
            $('#modalsaveupdate').modal('show');
            $('#modalsaveupdate .btn-saveupdate').attr('id','update').attr('data-id',id).text('Update');
            $('#idval').val(id);

        axios.get('menumodule/'+id )
        .then(response=>{
            var data = response.data.response;
            // console.log(data);
            $('#description').val(data[0].description);
            $('#icon').val(data[0].icon);
            $('#route').val(data[0].route);
            $('#sort').val(data[0].sort);
            $('#type').val(data[0].type);
        })
        });

        $('#mytable').on('click','.btn-delete',function(){
            var id = $(this).data('delete');

            alert(id);
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to delete menumodule?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('menumodule/'+id )
                    .then(response=>{
                        console.log(response);
                        var resp = response.data;  

                        if (resp.success === true) {
                            Swal.fire({
                                title: "Success",
                                text: resp.response,
                                icon: "success",
                            }).then(() => {
                              
                            
                                table.ajax.reload();
                            });
                        }
                    })
                }
            })
        });
});


$(document).on('click','#save, #update', function() {
    if (this.id === 'save') {

        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to save new collector?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, save it!",
        }).then((result) => {
            if (result.isConfirmed) {
                var data ={
                    description: $('#description').val(),
                    icon : $('#icon').val(),
                    route:  $('#route').val(),
                    sort : $('#sort').val(),
                    type : $('#type').val()
                }
                axios.post('menumodule/',data)
                .then(response=>{
                    var resp = response.data;            
                    if (resp.success === true) {
                            console.log(resp.response);
                            Swal.fire({
                                title: "Success",
                                text: resp.response,
                                icon: "success",
                            }).then(() => {
                              
                                $('#modalsaveupdate').modal('hide');
                                table.ajax.reload();
                            });
                     }
                    else{
                        let errorMessage = '';
                        for (let key in resp.response) {
                            if (resp.response.hasOwnProperty(key)) {
                                errorMessage += `${resp.response[key]}\n`;
                            }
                        }
                        console.log(resp);
                        Swal.fire({
                            title: "Error",
                            text:   errorMessage ? errorMessage.trim() : resp.response ,
                            icon: "error",
                        }).then(() => {
                            // location.reload();
                            $('#modalsaveupdate').modal('hide');
                            table.ajax.reload();
                        });
                    }
                }).catch((error) => {
                    console.error("There was an error making the request:", error);
                });
            }
        });
    } else if (this.id === 'update') {
        let id =   $('#idval').val();
        
        var data ={
            description: $('#description').val(),
            icon : $('#icon').val(),
            route:  $('#route').val(),
            sort : $('#sort').val(),
            type : $('#type').val()
        }
        axios.put('menumodule/'+id,data)
        .then(response=>{
            var resp = response.data;
            if(resp.success === true){
                console.log(resp.response);
            }
            else{
                console.log(resp.response);
            }
        }).catch((error) => {
            console.error("There was an error making the request:", error);
        });
    }
    else{
        alert('ayaw usba bai!!!');
    }
    $('#idval').val('');

});