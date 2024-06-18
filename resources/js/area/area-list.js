    
$(document).ready(function(){

    getUsers();
    
    function getUsers(){
        axios.get('area/0')
            .then((response) => {
                var data = response.data.response;

                $('table.datatable tbody').empty();

                data.forEach(item => {
                    $('table.datatable tbody').append(`
                        <tr>
                            <td>${item.areacode}</td>
                            <td>${item.municipality}</td>
                            <td>${item.barangay}</td>
                            <td>${item.purok}</td>
                             <td><button class="btn btn-primary btnDetails"id="details" data-id="${item.id}"><i class="bi bi-eye"> </i></button></td>
                        </tr>
                    `);
                });

                // Initialize DataTable (or reinitialize it if needed)
                if ($.fn.DataTable.isDataTable('table.datatable')) {
                    $('table.datatable').DataTable().clear().destroy();
                }
                $('table.datatable').DataTable();

            })
            .catch((error) => {
                console.error('There was an error making the request:', error);
            });
    }

    $('#btnShowNewModal').on('click', () => {

        $('#update')
            .removeClass('Update btn-success')
            .addClass('btn btn-primary')
            .text('Save')
            .attr('id', 'save')
            .removeAttr('data-data'); 
            
        $('#addarea').modal('show');
        $('#addarea input').val('');
      
    });
    



    $('#save').on('click',function(){

        let id = $(this).data('id');
        
            var data = {
                addareacode : $('#addareacode').val(),
                municipality : $('#municipality').val(),
                barangay : $('#barangay').val(),
                purok : $('#purok').val()
            }
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => { 
                    if(result.isConfirmed){
                        axios.post('area/',data)
                        .then(response =>{
                            var data = response.data;
                  
    
                            if(data.success){
                                Swal.fire({
                                    title: "Save",
                                    text: data.response,
                                    icon: "success"
                                  });
                            }else{
                                Swal.fire({
                                    title: "Error",
                                    text: data.response,
                                    icon: "error"
                                  });
                            }
    
                        })
                    }
              });

    });

    $('table.datatable tbody ').on('click', '.btnDetails', function() {
       var id = $(this).data('id');

       console.log(id);

        axios.get('area/' + id)
        .then((response) => {
            var data = response.data.response;

            $('#idval').val(id);
            $('#save').addClass('btn btn-success Update').text('Update').attr('id','update').attr('data-data',id);
            $('#addarea').modal('show');
            $('#addareacode').val(data.areacode),
            $('#municipality').val(data.municipality),
            $('#barangay').val(data.barangay),
            $('#purok').val(data.purok)
        })
        .catch((error) => {
            console.error('There was an error making the request:', error);
        });

       
    });


    $('#update').on('click','.Update',function(){
        let id = $(this).data('data');

        console.log(id);
        
        var data = {
            addareacode : $('#addareacode').val(),
            municipality : $('#municipality').val(),
            barangay : $('#barangay').val(),
            purok : $('#purok').val()
        }
        // console.log(data);
        axios.put('area/' + id, data)
        .then(response=>{
            console.log(response);
        });
    })

  

})

