    
$(document).ready(function(){

    getUsers();
    
    function getUsers(){
        axios.get('user/0')
            .then((response) => {
                var data = response.data.response;

                $('table.datatable tbody').empty();

                data.forEach(item => {
                    $('table.datatable tbody').append(`
                        <tr>
                            <td>${item.firstname}</td>
                            <td>${item.lastname}</td>
                            <td>${item.middlename ? item.middlename : ''}</td>
                            <td>${item.username}</td>
                             <td>${item.account_type}</td>
                             <td><button class="btn btn-primary btnDetails" data-id="${item.id}"><i class="bi bi-eye"> </i></button></td>
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
        
        $('#save').addClass('disabled');
        $('#adduser').modal('show');
        $('#adduser input, #account_type').val(''); // Clear all input fields inside #adduser modal
    });
    



    $('#save').on('click',function(){


        let id = $(this).data('id');
        
        if(id == 0){
            var data = {
                firstname : $('#firstname').val(),
                middlename : $('#middlename').val(),
                lastname : $('#lastname').val(),
                username : $('#username').val(),
                password:$('#password').val(),
                confirmpassword: $('#confirmpassword').val(),
                account_type : $('#account_type').val()
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
                        axios.post('user/',data)
                        .then(response =>{
                            var data = response.data;
                            console.log(data);
    
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
        }
        else{
            update();
        }

        
    });


    $('#confirmpassword, #password').on('input', () => {
        // console.log('Please enter your password');

        let inputid = $('#idval').val(id);

        if(inputid == 0){

            if($('#password').val() != $('#confirmpassword').val()) {
                $('#confirmpassword').addClass('is-invalid');
                $('#confirmpassword').removeClass('is-valid');
                $('#save').addClass('disabled');
            }
            else{
                $('#confirmpassword').addClass('is-valid');
                $('#confirmpassword').removeClass('is-invalid');
                $('#save').removeClass('disabled');
    
    
            }
        }

      
    });

            


    $('table.datatable tbody').on('click', '.btnDetails', function() {
       let id = $(this).data('id');

        axios.get('user/' + id)
        .then((response) => {
            var data = response.data.response;
            // console.log(data.response.firstname);

            $('#idval').val(id);
            $('#save').removeClass('disabled').addClass('btn btn-success Update').text('Update').attr('id','update').attr('data-data',id);



            $('#adduser').modal('show');

           $('#firstname').val(data.firstname);
             $('#middlename').val(data.middlename);
            $('#lastname').val(data.lastname);   
           $('#username').val(data.username);
            $('#account_type').val(data.account_type);

            

        })
        .catch((error) => {
            console.error('There was an error making the request:', error);
        });

       
    });


    // Update


    function update(){
        let id = $('#idval').val();

        console.log(id);
        
        var data = {
            id : $('#idval').val(),
            firstname : $('#firstname').val(),
            middlename : $('#middlename').val(),
            lastname : $('#lastname').val(),
            username : $('#username').val(),
            password:$('#password').val(),
            confirmpassword: $('#confirmpassword').val(),
            account_type : $('#account_type').val()
        }
        // console.log(data);
        axios.put('user/' + id, data)
        .then(response=>{
            console.log(response);
        });
    }
  

})

