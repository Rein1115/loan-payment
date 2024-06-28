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
                    '<button class="btn btn-danger" onclick="deleteRow(' + data.id + ')"><i class="bi bi-trash"></i></button>';
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
                }
            }
        ]
    });

    $('#mytable').on('click','.btn-details',function(){
        alert(1234);
    });


});
