var tbl_client;
var tbl_samples;
show_client();
function show_client(){
	if(tbl_client){
		tbl_client.destroy();
	}
	tbl_client = $('#tbl_client').DataTable({
        destroy: true,
        pageLength: 10,
        responsive: true,
        ajax: {
            url: "client/list",
            type: "GET",
            dataSrc: 'data'  // Ensure this matches the structure of your JSON response
        },
        deferRender: true,
		columns: [
            {
                data: null,
                title: 'Full Name',
                render: function(data, type, row) {
                    return `${row.firstname} ${row.middlename} ${row.lastname}`;
                }
            },
            { data: 'gender', title: 'Gender' },
            { data: 'present_add', title: 'Present Address' },
            { data: 'contact_no', title: 'Contact Number' },
            { data: 'sp_name', title: 'Spouse Name' },
            { data: 'sp_contact', title: 'Spouse Contact' },
            {
                className: 'width-option-1 text-center',
                width: '15%',
                data: 'id',
                orderable: false,
                title: 'Options',
                render: function(data, type, row, meta) {
                    return `
                        <a href="{{}}/${row.id}" class="btn btn-primary btn-sm font-base mt-1">
						<i class="bi bi-eye-fill"></i>
                        </a>
                    `;
                }
            }
        ]
    });
}


function delete_client(id){
	swal({
		title: "Are you sure?",
		text: "Do you want to delete client?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes",
		closeOnConfirm: false
	},
	function(){
		$.ajax({
			type:"DELETE",
			url:"client/delete/"+id,
			data:{},
			dataType:'json',
			beforeSend:function(){
		},
		success:function(response){
			// console.log(response);
			if (response.status == true) {
				show_client();
				swal("Success", response.message, "success");
			}else{
				console.log(response);
			}
		},
		error: function(error){
			console.log(error);
		}
		});
	});
}
