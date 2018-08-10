				</main>
				<!-- Fin main -->
		  	</div>
		  	<!-- Fin .row -->
		</div>
		<!-- Fin .container-fluid -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap4.min.js"></script>

		<!-- Icons -->
		<script src="assets/js/feather.min.js"></script>
		<script>
			feather.replace();
			$(document).ready(function() {
				$.extend( true, $.fn.dataTable.defaults, {
					"language": {
						"url": "assets/js/dataTables.spanish.json"
					}
				});

				$('#datatable').DataTable();
			});
		</script>
	</body>
</html>