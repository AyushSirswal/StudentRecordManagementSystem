<!-- Include CSS -->
<link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
<link href="vendors/bootstrap-datepicker.css" rel="stylesheet" media="screen">

<!-- jQuery (required for plugins) -->
<script src="js/jquery.min.js"></script>

<!-- Plugins -->
<script src="vendors/chosen.jquery.min.js"></script>
<script src="vendors/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function () {
        // Initialize chosen dropdown
        $(".chzn-select").chosen();

        // Initialize datepicker
        $(".datepicker").datepicker();

        // Additional plugin initialization can be added here
    });
</script>

<!-- Bootstrap JS (single file containing all components) -->
<script src="js/bootstrap.js"></script>

<!-- DataTables -->
<script src="js/jquery.dataTables.js"></script>
<script src="js/DT_bootstrap.js"></script>
