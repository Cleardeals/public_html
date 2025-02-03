<footer class="footer"> © Copyrights 2019. Cleardeals. All Rights Reserved</footer>
<script src="assets/vendors/jquery/jquery.min.js"></script> 

<!-- Bootstrap tether Core JavaScript -->
<script src="assets/vendors/bootstrap/js/popper.min.js"></script> 
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script> 
<!--<script src="assets/vendors/moment/moment.js"></script> --> 

<!-- slimscrollbar scrollbar JavaScript --> 
<script src="assets/vendors/ps/perfect-scrollbar.jquery.min.js"></script> 

<!--Wave Effects --> 
<script src="assets/js/waves.js"></script> 

<!--Menu sidebar --> 
<script src="assets/js/sidebarmenu.js"></script> 

<!--stickey kit --> 
<!--<script src="assets/vendors/sticky-kit-master/dist/sticky-kit.min.js"></script> --> 

<!--Custom JavaScript --> 
<script src="assets/js/custom.min.js"></script> 
<script>
$(function() {
	$('#myTables').DataTable();
		var table = $('#example').DataTable({
			"columnDefs": [{
				"visible": false,
				"targets": 2
			}],
			"order": [
				[2, 'asc']
			],
			"displayLength": 25,
			"drawCallback": function(settings) {
				var api = this.api();
				var rows = api.rows({
					page: 'current'
				}).nodes();
				var last = null;
				api.column(2, {
					page: 'current'
				}).data().each(function(group, i) {
					if (last !== group) {
						$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
						last = group;
					}
				});
			}
		});

		//Order by the grouping
		$('#example tbody').on('click', 'tr.group', function() {
			var currentOrder = table.order()[0];
			if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
				table.order([2, 'desc']).draw();
			} else {
				table.order([2, 'asc']).draw();
			}
		});
});


$('#example23').DataTable({
	dom: 'Bfrtip',
	"displayLength": 25,
	buttons: [
		'copy', 'csv', 'excel', 'pdf', 'print'
	]
});
</script>