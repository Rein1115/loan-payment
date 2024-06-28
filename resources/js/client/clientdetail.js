
function base_url(path) {
	return 'http://127.0.0.1:8000' + path;
}
$(document).ready(function() {
    // $('#client_form').on('submit', function(e){
    //     let idval = $('#id').val();
    //     e.preventDefault(); // Prevent the default form submission
    //     var formData = new FormData(this);

    //     Swal.fire({
    //         title: "Are you sure?",
    //         text: "Are you sure you want to save new client?",
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3085d6",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Yes, save it!", 
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             axios.put('clients/'+idval, formData);
    //             .then(response=> {
    //                 var resp = response.data;
    //                 console.log(resp);
    //                if(resp.status == true) {
    //                 Swal.fire({
    //                     title: "Success",
    //                     text: "Client added successfully",
    //                     icon: "success",
    //                 }).then(() => {
    //                     window.location.href = 'http://127.0.0.1:8000/client';
    //                 });
    //                }
    //                else{
    //                 Swal.fire({
    //                     title: "Failed to add client",
    //                     text: resp.message,
    //                     icon: "warning",
    //                 })
    //                }
    //             }).catch((error) => {
    //                 console.error("There was an error making the request:", error);
    //                 Swal.fire({
    //                     title: "Error",
    //                     text: "There was an error making the request.",
    //                     icon: "error",
    //                 });
    //             });
    //         }
    //     })
    // });

    $('#client_form').on('submit', function(e){
        let idval = $('#id').val();
        e.preventDefault(); // Prevent the default form submission
        var formData = new FormData(this);
    
        // Log the FormData content for debugging
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]); 
        }
    
        Swal.fire({
            title: "Are you sure?",
            text: idval && idval !== '0' ? "Are you sure you want to update the client?" : "Are you sure you want to save new client?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, save it!", 
        }).then((result) => {
            if (result.isConfirmed) {
                let request;
    
                // Convert FormData to JSON
                let formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
    
                if (idval && idval !== '0') {
                    // Update existing client
                    request = axios.put(`http://127.0.0.1:8000/clients/${idval}`, formObject, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });

                    console.log(formObject);
                } else {
                    // Create new client
                    const jsonString = JSON.stringify(formObject);
                    request = axios.post('http://127.0.0.1:8000/clients', jsonString, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
    
                    console.log(jsonString);
                }
    
                request.then(response => {
                    var resp = response.data;
                    console.log(response.data);
                    if (resp.status === true) {
                        Swal.fire({
                            title: "Success",
                            text: "Client " + (idval && idval !== '0' ? "updated" : "added") + " successfully",
                            icon: "success",
                        }).then(() => {
                            window.location.href = 'http://127.0.0.1:8000/clients';
                        });
                    } else {
                        Swal.fire({
                            title: "Failed to " + (idval && idval !== '0' ? "update" : "add") + " client",
                            text: resp.message,
                            icon: "warning",
                        });
                    }
                }).catch(error => {
                    console.error("There was an error making the request:", error);
                    Swal.fire({
                        title: "Error",
                        text: "There was an error making the request.",
                        icon: "error",
                    });
                });
            }
        });
    });

    
    
    

    // $('#client_delete').click(function(){
    //     let idval = $('#id').val();
    //     Swal.fire({
    //         title: "Are you sure?",
    //         text: "Do you want to delete client?",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#DD6B55",
    //         confirmButtonText: "Yes",
    //         closeOnConfirm: false
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             axios.delete('test/'+idval)
    //             .then(response=> {
    //                 var resp = response.data;
    //                 console.log(resp);
    //                if(resp.status == true) {
    //                 Swal.fire({
    //                     title: "Success",
    //                     text: "Client deleted successfully",
    //                     icon: "success",
    //                 }).then(() => {
    //                     window.location.href = 'http://127.0.0.1:8000/client';
    //                 });
    //                }
    //                else{
    //                 Swal.fire({
    //                     title: "Failed to add client",
    //                     text: resp.message,
    //                     icon: "warning",
    //                 })
    //                }
    //             }).catch((error) => {
    //                 console.error("There was an error making the request:", error);
    //                 Swal.fire({
    //                     title: "Error",
    //                     text: "There was an error making the request.",
    //                     icon: "error",
    //                 });
    //             });
    //         } 
    //     })
        
    // });

    // $('#client_delete').click(function(){
    //     let idval = $('#id').val();
    //     Swal.fire({
    //         title: "Are you sure?",
    //         text: "Do you want to delete client?",
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#DD6B55",
    //         confirmButtonText: "Yes",
    //         closeOnConfirm: false
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: "{{ url('clients') }}/" + idval,
    //                 type: 'DELETE',
    //                 success: function(response) {
    //                     var resp = response;
    //                     console.log(resp);
    //                     if(resp.status == true) {
    //                         Swal.fire({
    //                             title: "Success",
    //                             text: "Client deleted successfully",
    //                             icon: "success",
    //                         }).then(() => {
    //                             window.location.href = 'http://127.0.0.1:8000/client';
    //                         });
    //                     }
    //                     else {
    //                         Swal.fire({
    //                             title: "Failed to delete client",
    //                             text: resp.message,
    //                             icon: "warning",
    //                         });
    //                     }
    //                 },
    //                 error: function(error) {
    //                     console.error("There was an error making the request:", error);
    //                     Swal.fire({
    //                         title: "Error",
    //                         text: "There was an error making the request.",
    //                         icon: "error",
    //                     });
    //                 }
    //             });
    //         }
    //     });
    // });
    
});


