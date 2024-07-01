let counter = 0;
$(document).ready(function(){
    var tableModal = $('#appendetails');
    // Datatable
        var table;
            table = $('#mytable').DataTable({
            ajax: function(data, callback, settings) {
                $('#spinner').show();
                axios.get('menufunction', {
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
                { data: 'transNo' },  
                { data: 'description' },
   
                {
                    data: null,
                    render: function (data, type, row) {
                    return '<button id="details"    class="btn btn-primary btn-details" data-area="'+data.transNo+'" data-details = "'+data.transNo+'""><i class="bi bi-eye"></i></button>' +
                        '<button class="btn btn-danger btn-delete" data-delete = "'+data.transNo+'" ><i class="bi bi-trash"></i></button>';
    
                    }
                }
            ],
            dom: 'Bfrtip', 
            buttons: [
                'copy', 'excel', 'pdf',
                {
                    text: 'Add Menumodule',            
                    action: function (e, dt, node, config) {
                        tableModal.empty();
                        $('#modalsaveupdate').modal('show');
                        $('#modalsaveupdate input').val('');  
                      
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

            axios.get('menufunction/'+id )
            .then(response=>{
                console.log(response);
                var data = response.data.response;
                console.log(data);
                $('#transNo').val(data.id);
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
         
            $('#plus').on('click', function () {
                counter++;
                tableModal.append(`
                    <tr class="removeTable${counter}">
                        <th scope="row"> <input id="description${counter}" type="text" class="form-control" name="description" value="" required autocomplete="description"></th>
                        <td> <input id="icon${counter}" type="text" class="form-control" name="icon" value="" required autocomplete="icon"></td>
                        <td> <input id="route${counter}" type="text" class="form-control" name="route" value="" required autocomplete="route"></td>
                        <td> <input id="sort${counter}" type="text" class="form-control" name="sort" value="" required autocomplete="sort"></td>
                        <td> <select id="type${counter}" name="type" class="form-control" required>
                                <option value="" disabled selected>Select type</option>
                                <option value="type1">Type 1</option>
                                <option value="type2">Type 2</option>
                                <option value="type3">Type 3</option>
                            </select>
                        </td>
                        <td> <button class="btn btn-danger deleteTable" data-index="${counter}"><i class="bi bi-trash"></i></button></td>
                    </tr>
                `);
            });

            // diri ko nahunong
            $('#mytable').on('click','.btn-details',function(){
                var id = $(this).data('details');
                tableModal.empty();
                axios.get('menufunction/' + id)
                .then(resp => {
                    var data = resp.data.response;
                    var header = data.text;
                    var ids = data.id;
                    $('#mmodules_id').val(ids);
                    $('#idvalue').val(header);
                    
                    data.data.forEach(item => {
                        counter++;
                        tableModal.append(`
                            <tr class="removeTable${counter}">
                                <th scope="row"> <input id="description${counter}" type="text" class="form-control" name="description" value="${item.description}" required autocomplete="description"></th>
                                <td> <input id="icon${counter}" type="text" class="form-control" name="icon" value="${item.icon
                                }" required autocomplete="icon"></td>
                                <td> <input id="route${counter}" type="text" class="form-control" name="route" value="${item.route}" required autocomplete="route"></td>
                                <td> <input id="sort${counter}" type="text" class="form-control" name="sort" value="${item.sort}" required autocomplete="sort"></td>
                                <td> <select id="type${counter}" name="type" class="form-control" required>
                                        <option value="" disabled selected>Select type</option>
                                        <option value="type1">Type 1</option>
                                        <option value="type2">Type 2</option>
                                        <option value="type3">Type 3</option>
                                    </select>
                                </td>
                                <td> <button class="btn btn-danger deleteTable" data-index="${counter}"><i class="bi bi-trash"></i></button></td>
                            </tr>
                        `);
                    })
                })
            });    
            tableModal.on('click', '.deleteTable',function(){
                var id = $(this).data('index');
                tableModal.find('.removeTable' + id).remove();
            });
    });



    function appendvalue() {
        let dynamic = [];
        for (let i = 1; i <= counter; i++) {
            let data = {
                description: $(`#description${i}`).val(),
                icon: $(`#icon${i}`).val(),
                route: $(`#route${i}`).val(),
                sort: $(`#sort${i}`).val(),
                type: $(`#type${i}`).val(),
            };
            dynamic.push(data);
        }
        // Filter out objects with all properties undefined
        dynamic = dynamic.filter(item => 
            item.description !== undefined || 
            item.icon !== undefined || 
            item.route !== undefined || 
            item.sort !== undefined || 
            item.type !== undefined
        );
    
        return dynamic;
    }
    
    $(document).on('click','#save, #update', function() {
        if (this.id === 'save') {
           var data = appendvalue();

           console.log(data);
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to save new function?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, save it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    var datas = appendvalue();
                    axios.post('menufunction/',{  header : $('#mmodules_id').val(),data : {function : datas }})
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
            let id =  $('#transNo').val();
            var head = $('#mmodules_id').val();
            var data = appendvalue();

           console.log(data);
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to save new function?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, save it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    var datas = appendvalue();
                    axios.put('menufunction/' + id, {  header :head ,data : {function : datas }})
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
        }
        else{
            alert('ayaw usba bai!!!');
        }
        $('#idval').val('');
    
    });