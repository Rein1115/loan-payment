
$(document).ready(function(){
    // Datatable
    $('#mytable').DataTable({
        ajax: function(data, callback, settings) {
            axios.get('collector', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(response) {
                var data = response.data.response;
                console.log(data);
                callback({ data: data });
            })
            .catch(function(error) {
                console.log(error);
            });
        },
        columns: [
            { data: 'fullname' },  
            { data: 'areacode' },
            {
                data: null,
                render: function (data, type, row) {
                 return '<button id="details"  class="btn btn-primary btn-details" data-details = "'+data.ids+'""><i class="bi bi-eye"></i></button>' +
                    '<button class="btn btn-danger" onclick="deleteRow(' + data.ids + ')"><i class="bi bi-trash"></i></button>';
                }
            }
        ],
        dom: 'Bfrtip', 
        buttons: [
            'copy', 'excel', 'pdf',
            {
                text: 'Add Collector',            
                action: function (e, dt, node, config) {
                    $('#modalsaveupdate').modal('show');
                }
            }
        ]
    });

    // Details
    $('#mytable').on('click','.btn-details',function(){
            var id = $(this).data('details');
        axios.get('collector/'+id )
        .then(response=>{
            var data = response.data.response;
            console.log(data);
        })
    });




    // Save



});
