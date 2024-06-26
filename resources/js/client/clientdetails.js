var tbl_client;
show_client();
function show_client(){
	if(tbl_client){
		tbl_client.destroy();
	}
	tbl_samples = $('#tbl_client').DataTable({
		destroy: true,
		pageLength: 10,
		responsive: true,
		ajax: "{{ route('client.list') }}",
		deferRender: true,
		columns: [
			{
				className: '',
				"data": 'firstname',
				"title": 'Firstname',
			},
			{
				className: '',
				"data": 'middlename',
				"title": 'Middlename',
			},
			{
				className: '',
				"data": 'lastname',
				"title": 'Lastname',
			},
			{
				className: '',
				"data": 'dob',
				"title": 'Dob',
			},
			{
				className: '',
				"data": 'gender',
				"title": 'Gender',
			},
			{
				className: '',
				"data": 'present_add',
				"title": 'Present add',
			},
			{
				className: '',
				"data": 'prov_add',
				"title": 'Prov add',
			},
			
			{
				className: '',
				"data": 'contact_no',
				"title": 'Contact no',
			},
			{
				className: '',
				"data": 'sp_name',
				"title": 'Sp name',
			},
			
			{
				className: '',
				"data": 'sp_contact',
				"title": 'Sp contact',
			},
			
			{
				className: 'width-option-1 text-center',
				width: '15%',
				"data": 'id',
				"orderable": false,
				"title": 'Options',
				"render": function(data, type, row, meta){
					newdata = '';
					newdata += '<a href="{{}}/'+row.id+'" class="btn btn-success btn-sm font-base mt-1" ><i class="fa fa-edit"></i></a> ';
					newdata += ' <button class="btn btn-danger btn-sm font-base mt-1" onclick="delete_client('+row.id+');" type="button"><i class="fa fa-trash"></i></button>';
					return newdata;
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
			url:"{{ route('client.delete') }}/"+id,
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
