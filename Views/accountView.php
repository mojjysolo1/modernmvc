<?php
/*if(!isset($_SESSION['aid']) || !isset($_SESSION['org_code'])){

  $_SESSION['sys_response']= array("<button type='button' class='btn btn-danger btn-block'>Access Denied</button>");

  echo "<script>location.href='".$_SESSION['SITE_FOLDER']."/home';</script>";
  header("location:".$_SESSION['SITE_FOLDER']."/home");

  exit;

}
*/
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <link href="jquery-ui.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script>

   var loadnum=4;
    var startload=0;
    var defaultNum=4;
    var tableRowSelected='';
    var showNotesAciveButton=''; 
    var toogleShowNotes=0;
    var hidechkbox='';

    var databaseTableColumn1='';
    var databaseTableColumn2='';

    </script>
   
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
          
            <ul class="nav menu">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="home"></span>
                  Dashboard 
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="home"></span>
                  Dashboard 
                </a>
              </li>

              <li>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>PATIENTS</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
              </li>
             
              <li class="nav-item" id='manage_patients'>
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Manage Patients
                </a>
              </li>
              <li class="nav-item" id='add_patients'>
                <a class="nav-link" href="#">
                  <span data-feather="shopping-cart"></span>
                  Add Patient
                </a>
              </li>
             
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>TRAINEES</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>

            <ul class="nav flex-column mb-2 menu">
              <li class="nav-item" id='manage_trainees'>
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Manage Trainees
                </a>
              </li>
              <li class="nav-item" id='add_trainee'>
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Add Trainee
                </a>
              </li>
              <li class="nav-item">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>PLACES</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
              </li>
              <li class="nav-item" id='view_district'>
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  view District
                </a>
              </li>
              <li class="nav-item" id='view_facilities'>
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  view Health Facilities
                </a>
              </li>
              <li class="nav-item" id='view_projects'>
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  view Projects
                </a>
              </li>
              <li class="nav-item">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>ASSOCIATIONS</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
              </li>
              <li class="nav-item" id='view_relationship'>
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Add Relationships
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-1 px-2 px-4" style="margin-left:15%;">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>

          <div class='container custBGcolor2'>
<!--First row-->
<div class='row'>
<div class='col' id='responseContent'>

</div>
</div>
<!--Second row-->
<div class='row'>
<div class='col' id='loaderContent'>

</div>
</div>

<!--Third row-->
<div class='row'>
<div class='col-sm-12' id='content'>

</div>
</div>

</div>


         
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.js" ></script>
    <script src="./js/bootstrap/bootstrap.js"></script>
    <script src="./js/popper.js"></script>
    <script src="jquery-ui.js"></script>
    <!-- Icons -->
    <script src="./js/feather.min.js"></script>
    <script>
      feather.replace();
      
      var loaderImg="<div class='spinner-grow bg-success' style='margin-left:41%; margin-top:13%; width:200px; height:200px;' role='status'><span class='sr-only'>Loading...</span></div>";

$(document).ready(function(){
  $('.sidebar-sticky').css('height','calc(150vh - 48px)');
})

      $( "#tabs" ).tabs();

$(".menu li").click(function(){
         
	loadnum=defaultNum;
startload=0;
var caseValue=$(this).prop("id");

	$.ajax({
		url:'./',
		type:'post',
		data:{choose:'datasheets',opt:caseValue,opt4:loadnum,opt5:startload},
		beforeSend: function(){
      $('.container #content').html(loaderImg);
		},
		success: function(sentdata){
			$('.container #content').html('');
			$('.container #content').html(sentdata);
      
			//hideShowTableColumns(hidechkbox);
		}
	})
  $("#responseContent").html('');
});
//	menuListColorBehaviours(menuAssPeriodSelected);
//districtFormSubmit
function submitRelationshipForms(event,formID,optValue){
  event.preventDefault();

  var form = $('#'+formID)[0];

var data = new FormData(form);
// If you want to add an extra field for the FormData
data.append("opt",optValue);

// disabled the submit button
$("#"+formID+"Submit").prop("disabled", true);

$.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: "./datasheets",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) {

        $("#responseContent").html(data);
       // console.log("SUCCESS : ", data);
       $("#"+formID+"Submit").prop("disabled", false);

    },
    error: function (e) {

        $("#responseContent").text(e.responseText);
        $("#"+formID+"Submit").prop("disabled", false);

    }
});

}
/*$("#districtFormSubmit").click(function (event) {
  event.preventDefault();

  return alert('hi');



var form = $('#districtForm')[0];

var data = new FormData(form);
// If you want to add an extra field for the FormData
data.append("opt", "insert_district");

// disabled the submit button
$("#districtFormSubmit").prop("disabled", true);

$.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: "./datasheets",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) {

        $("#responseContent").html(data);
        console.log("SUCCESS : ", data);
        $("#districtFormSubmit").prop("disabled", false);

    },
    error: function (e) {

        $("#responseContent").text(e.responseText);
        console.log("ERROR : ", e);
        $("#districtFormSubmit").prop("disabled", false);

    }
});

});*/
//districtFormSubmit
     
      </script>
  </body>
</html>
