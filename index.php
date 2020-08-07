
<?php

include('database_connection.php');
?>

<html>
 <head>
  <title>Only Display after filter in Jquery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
 </head>
 <body>
  <div class="container box">
   <h3 align="center">Custom Search in jQuery Datatables using PHP Ajax</h3>
   <br />
   <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
     <div class="form-group">
      <select  id="student_id" class="form-control" required>
       <option value="">Select Gender</option>
       <option value="Bank">Bank</option>
       <option value="Cash">Cash</option>
      </select>
     </div>
     <div class="form-group" align="center">
      <button type="button" name="filter" id="filter" class="btn btn-info">Search</button>
     </div>
    </div>
    <div class="col-md-4"></div>
   </div>
   <div class="table-responsive">
    <table id="student_wise_transportation" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>Bank / CR Serial Number</th>
        <th>Months Details</th>
        <th>Total Months</th>
        <th>Year</th>
        <th>Payment Type</th>
        <th>Transportation Fee</th>
        <th>Paid Date</th>
      </tr>
     </thead>
    </table>
    <br />
    <br />
    <br />
   </div>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  function fill_datatable(student_id){
   $('#student_wise_transportation').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order": [[ 0, "desc" ]],
    "lengthChange": false,
    "searching" : false,
    "ajax" : {
     url:"fetch.php",
     type:"POST",
     data:{
      student_id:student_id
     }
    }
   });
  }
  
$('#filter').click(function(){
    var student_id = $('#student_id').val();
    if (student_id !='') {
      $('#student_wise_transportation').DataTable().destroy();
      fill_datatable(student_id);
    }else{
      alert('faka');
      $('#student_wise_transportation').DataTable().destroy();
      fill_datatable();
    }
});
 });
 
</script>