
$(document).ready(function(){
    // Datatable
    var table;
      table = $('#mytable').DataTable({
        ajax: function(data, callback, settings) {
            $('#spinner').show();
            axios.get('collector', {
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
            { data: 'fullname' },  
            { data: 'areacode' },
            {
                data: null,
                render: function (data, type, row) {
                 return '<button id="details"  class="btn btn-primary btn-details" data-area="'+data.areacode+'" data-details = "'+data.ids+'""><i class="bi bi-eye"></i></button>' +
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
                    $('#modalsaveupdate input').val('');  
                    getAreas('area/fetch',0)
                    $('#modalsaveupdate select').val(null).trigger('change');
                    $('#modalsaveupdate .btn-saveupdate').attr('id','save').removeAttr('data-id').text('Save');

                    // $('#areatable').();
                }
            }
        ]
    });

    // Details
    $('#mytable').on('click','.btn-details',function(){
            var id = $(this).data('details');
            $('#modalsaveupdate .btn-saveupdate').removeAttr('id','save').text('text');
            $('#modalsaveupdate').modal('show');
            $('#modalsaveupdate .btn-saveupdate').attr('id','update').attr('data-id',id).text('Update');
            $('#idval').val(id);

        axios.get('collector/'+id )
        .then(response=>{
            var data = response.data.response;
            // console.log(data);
            $('#fname').val(data[0].fname);
            $('#mname').val(data[0].mname);
            $('#lname').val(data[0].lname);
            var code = data[0].areacode; 
            getAreas('area/fetch',code);
            areabelong(code);   
        })
    }); 
});
// save and update
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

                var data = {
                    fname: $('#fname').val(),
                    mname : $('#mname').val(),
                    lname : $('#lname').val(),
                    fullname : $('#fname').val()+" "+$('#mname').val() + " " + $('#lname').val(),
                    areaid: 2
                }
                axios.post('collector/',data)
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
        let cid =   $('#idval').val();
        var data = {
            fname: $('#fname').val(),
            mname : $('#mname').val(),
            lname : $('#lname').val(),
            fullname : $('#fname').val()+" "+$('#mname').val() + " " + $('#lname').val(),
            areaid: 2
        }
        axios.put('collector/'+cid,data)
        .then(response=>{
            var resp = response.data
;            if(resp.success === true){
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

$('#areaid').on('change', function() {
    let areaid = $(this).val();
    let code = $(this).find('option:selected').text();
    
    areatable('area', areaid);
    areabelong(code);
    
});


function getAreas(url, code) {
    axios.get(`${url}/${code}`)
        .then(response => {
            console.log('populate dropdown', response.data);

            // Check if response.data and response.data.response exist
            if (!response.data) {
                throw new Error('Invalid response format');
            }

            // Get the response data
            var data = response.data.areas;
            var acode = response.data.arecode;

            // Remove duplicates based on the areacode
            const distinctData = data.filter((item, index, self) =>
                index === self.findIndex(t => t.areacode === item.areacode)
            );

            // Get the select element by its ID
            const selectElement = document.getElementById('areaid');

            if (acode) {
                selectElement.innerHTML = "<option value='' disabled selected>Select Area</option>";
            }
            // Clear any existing options

            // Populate the select element with the filtered distinct data
            distinctData.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.text = item.areacode;            
                selectElement.appendChild(option);
            });

          $(selectElement).find('option[contains="' + acode + '"]').prop('selected', true);



            // Call another function to handle the table
            areatable(url, code);
        })
        .catch(error => {
            console.error('There was an error fetching the areas!', error);
        });
}


function areatable(url,code){
    // console.log(url + ' ' + code);
    axios.get(`${url}/${code}`)
            .then(function(response) {
                var data = response.data.response;

            })
            .catch(function(error) {
                console.log(error);
            });
}

function areabelong(code){
    // console.log("code"+ " "+code);

    axios.get('area/fetch/'+code)
    .then(function(response) {
        var data = response.data.belong;
        // console.log( response);
        $('#areatable tbody').empty();  


            
            data.forEach(function(item) {
                var row = `<tr>
                    <td>${item.municipality}</td>
                    <td>${item.barangay}</td>
                    <td>${item.purok}</td>
    
                </tr>`;
                $('#areatable tbody').append(row);
            });     


            // if(){
                
            // }
    })
    .catch(function(error) {
        console.log(error);
    });
}
