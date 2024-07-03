
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

    $('#client_form').on('submit', function(e) {
        let idval = $('#id').val();
        e.preventDefault(); // Prevent the default form submission
    
        const form = document.getElementById('client_form');
        const formData = {};
    
        // Function to convert file to Base64
        function fileToBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = error => reject(error);
            });
        }
    
        async function processForm() {
            // Get all input elements
            const inputs = form.querySelectorAll('input');
            for (const input of inputs) {
                if (input.type === 'file' && input.files.length > 0) {
                    // Convert file to Base64
                    
                    formData[input.name] = await fileToBase64(input.files[0]);
                } else {
                    formData[input.name] = input.value;
                }
            }
    
            // Get all select elements
            const selects = form.querySelectorAll('select');
            selects.forEach(select => {
                formData[select.name] = select.value;
            });
    
            // Get all textarea elements
            const textareas = form.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                formData[textarea.name] = textarea.value;
            });
    
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
    
                    if (idval && idval !== '0') {
                        // Update existing client
                        request = axios.put(`http://127.0.0.1:8000/clients/${idval}`, formData, {
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        });
                    } else {
                        // Create new client
                        request = axios.post('http://127.0.0.1:8000/clients', formData, {
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        });
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
        }
    
        processForm();
    });

    
    // Function to check file size and display SweetAlert2 if file is too large
    function checkFileSize(file) {
        const maxSize = 5 * 1024 * 1024; // 5 MB in bytes
        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'The selected file exceeds the maximum size of 5 MB.',
            });
            return false;
        }
        return true;
    }

    function checkFileType(file) {
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'];
        if (!validImageTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid File Type',
                text: 'The selected file is not a valid image. Please select an image file.',
            });
            return false;
        }
        return true;
    }

    document.getElementById('client_pic').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (!checkFileSize(file) || !checkFileType(file)) {
            // Clear the input if the file is too large or not an image
            event.target.value = '';
            return;
        }

        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('client_pic_img').src = e.target.result;
        };
        
        // Read the file as a data URL
        reader.readAsDataURL(file);
    });
    
    document.getElementById('client_add_sketch').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (!checkFileSize(file) || !checkFileType(file)) {
            // Clear the input if the file is too large or not an image
            event.target.value = '';
            return;
        }

        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('client_sketch_img').src = e.target.result;
        };
        
        // Read the file as a data URL
        reader.readAsDataURL(file);
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


