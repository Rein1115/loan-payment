
var tbl_loans;
show_loans();
function show_loans() {
    if(tbl_loans){
        tbl_loans.destroy();
    }
    tbl_loans = $('#tbl_loans').DataTable({
        destroy: true,
        pageLength: 10,
        responsive: true,
        ajax: {
            url: 'loan-applications/'+0,
            data: null,
            type: 'GET',
            dataSrc: 'data',
        },
        deferRender: true,
        columns: [
            { data: 'loanid', title: 'Trans No.'},
            {
                data: null,
                title: 'Name',
                render: function (data, type, row) {
                    return `${row.firstname} ${row.middlename || ''} ${row.lastname}`.trim();
                }
            },
            { data: 'loanAmount', title: 'Loan Amount' },
            { data: 'period_days', title: 'Period Days' },
            { data: 'term', title: 'Term' },
            { data: 'interest_per_month', title: 'Interest' },
            { data: 'total_amount', title: 'Total Amount' },
            { data: null,
                title: 'Options',
                render: function (data, type, row) {
                    return `<a href="/loan-applications/${row.loanid}" class="btn btn-primary btn-sm font-base mt-1">
                    <i class="bi bi-eye-fill"></i>
                    </a>
                    <a href="/loan-applications/${row.loanid}/edit" class="btn btn-warning btn-sm font-base mt-1 text-white">
                    <i class="bi bi-pencil-square"></i>
                    </a>`;
                }},






               
        
        ]
    })
}