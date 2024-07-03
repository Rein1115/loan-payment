$(document).ready(function() {
    $('#client').select2({
        placeholder: "Select a client",
        width: 'resolve' // Use the width of the element to resolve sizing issues
    });

    $('#loantype').select2({
        placeholder: "Select a loan type",
        width: 'resolve' // Use the width of the element to resolve sizing issues
    })

    $('#interest').on('input', function(){
        updateInterestAmt();
        updateTotalAmount();
        updateDailyDues();
    });

    $('#period_days').on('input', function(){
        updateTerm();
    });

    $('#loan_form').on('submit', function(e){
        let idval = $('#id').val();
        e.preventDefault();
    
        var formData = new FormData(this);
    
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to save this loan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save this loan"
        }).then((result) => {
            if(result.isConfirmed) {
                let request;
    
                let formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
    
                if (idval && idval !== '0') {
                    request = axios.put(`http://127.0.0.1:8000/loan-applications/${idval}`, formObject, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
    
                    console.log(formObject);
                } else {
                    const jsonString = JSON.stringify(formObject);
                    request = axios.post('http://127.0.0.1:8000/loan-applications', jsonString, {
                        headers: { 
                            'Content-Type': 'application/json'
                        }
                    });
                    console.log(jsonString);
                }
    
                request.then(response => {
                    var resp = response.data;
                    console.log(resp);
                    if (resp.status === true) {
                        Swal.fire({
                            title: "Success",
                            text: `${idval && idval !== '0' ? "Loan updated" : "Loan added"} successfully`,
                            icon: "success",
                        }).then(() => {
                            window.location.href = 'http://127.0.0.1:8000/loan-applications';
                        });
                    } else {
                        Swal.fire({
                            title: `Failed to ${idval && idval !== '0' ? "update" : "add"} loan`,
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
    
    
});


function updateInterestAmt() {
    var loanAmt = parseFloat($('#loanamount').val()) || 0;
    var interest = parseFloat($('#interest').val()) || 0;

    var total = loanAmt * interest;
    $('#interest_amount').val(total.toFixed(2));
}

function updateTerm() {
    var periodDays = parseFloat($('#period_days').val()) || 0;

    var totalTerm = periodDays/30;

    $('#term').val(totalTerm.toFixed(2));
}

function updateTotalAmount() {
    var loanAmount = parseFloat($('#loanamount').val()) || 0;
    var interestAmt = parseFloat($('#interest_amount').val()) || 0;

    var totalAmount = loanAmount + interestAmt;

    $('#total_amount').val(totalAmount.toFixed(2));
}

function updateDailyDues() {
    var totalAmount = parseFloat($('#total_amount').val());
    var periodDays = parseFloat($('#period_days').val());
    
    var totalDues = totalAmount/periodDays;

    $('#daily_dues').val(totalDues.toFixed(2));
}