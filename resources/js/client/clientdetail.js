// document.getElementById('client_form_btn').addEventListener('click', function(event) {
//     event.preventDefault(); // Prevent the default form submission
//     const form = document.getElementById('client_form');
//     const formData = new FormData(form);
//     const url = form.action;
//     axios.post(url, formData)
//         .then(response => {
//             console.log('Form submitted successfully:', response);
//             // Handle success - you can redirect or show a success message here
//         })
//         .catch(error => {
//             console.error('Error submitting form:', error);
//             // Handle error - show error message to the user
//         });
// });

$(document).ready(function() {
    $('#client_form').on('submit', function(e){
        let idval = $('#id').val();
        e.preventDefault(); // Prevent the default form submission
        var formData = new FormData(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to save new client?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, save it!", 
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('client/save/'+idval, formData)
                .then(response=> {
                    var resp = response.data;
                    console.log(resp);
                   if(resp.status == true) {
                    Swal.fire({
                        title: "Success",
                        text: "Client added successfully",
                        icon: "success",
                    }).then(() => {
                        window.location.href = 'http://127.0.0.1:8000/client';
                    });
                   }
                   else{
                    Swal.fire({
                        title: "Failed to add client",
                        text: resp.message,
                        icon: "warning",
                    })
                   }
                }).catch((error) => {
                    console.error("There was an error making the request:", error);
                    Swal.fire({
                        title: "Error",
                        text: "There was an error making the request.",
                        icon: "error",
                    });
                });
            }
        })
    })
});


