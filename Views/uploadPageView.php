<?php
session_start();

/*if(!isset($_SESSION['uid']) || !isset($_SESSION['pos_code']) ){
    $_SESSION['sys_response']= array("<button type='button' class='btn btn-danger btn-block'>Access Denied</button>");
    echo "<script>location.href='".$_SESSION['SITE_FOLDER']."/datacore_home';</script>";
    header("location:".$_SESSION['SITE_FOLDER']."/datacore_home");
    exit;
  }*/

$months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December'); 
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <link rel="icon" href="./images/honeybee_icon.png" type="image/png" sizes="16x16" >
    <title>Gospelhive FlowerBee</title>

   <!-- <link rel="icon" href="./images/dit_icon_logo.png" type="image/png" sizes="16x16" >-->

    <!-- Bootstrap core CSS -->
 <!-- Bootstrap core CSS -->
 <link  href="./css/bootstrap/bootstrap.css"  type="text/css" rel="stylesheet">

<link href="./jquery-ui.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="./jquery-ui.css" rel="stylesheet">

    <script src="./js/jquery.js"></script>
    <script src="./jquery-ui.js"></script>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
    <script src="./js/bootstrap.min.js"></script>
    
<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">

<script>
    var album_id='';
    var ass_id='';
    var inc_num=1;
    </script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
      .bckground{
        
        /*background: rgb(148,5,38,0.8);

background: linear-gradient(90deg, rgba(148,5,38,1) 0%, rgba(255,255,255,1) 54%, rgba(148,5,38,1) 100%);*/
background: rgb(24, 23, 23);
background: linear-gradient(90deg, rgba(148,148,148,1) 0%, rgba(255,255,255,1) 54%, rgba(148,148,148,1) 100%);

      }

      .jdesign{

        background:url('./images/faceonly.png') no-repeat 50% 50%;
border-radius:12px;
background-color:rgb(255,255,255,0.7);

border-radius:12px;
/*background-color:rgba(139,206,242,0.3);*/
border:1px solid #79b1cd;
box-shadow:rgba(139,206,250,0) 2px 2px 2px 3px;

color:#fff;
font-size:16px;
height:calc(110vh - 40px);
overflow-y:auto;
}

  #dialog-link {

padding: .4em 1em .4em 20px;

text-decoration: none;

position: relative;

}

#dialog-link span.ui-icon {

margin: 0 5px 0 0;

position: absolute;

left: .2em;

top: 50%;

margin-top: -8px;

}   

.padding_one{
    padding:1px;
}
    </style>
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100 bckground">

  <div id="dialog" title="Detailed Info" class='bg-dark text-light'></div>
    <!-- Begin page content -->
<main role="main" class="flex-shrink-0">

  <div class="container text-center">
  <h5 class="demoHeaders font-weight-bold">UPLOAD ASSESSMENT TRAINING PACKAGES</h5>
<div id="tabs" class='jdesign'>
	<ul>
		<li ><a href="#tabs-1">INSERT NEW ATP</a></li>
		<li ><a href="#tabs-2">INSERT NEW OCCUPATION</a></li>
	</ul>

	<div id="tabs-1" class='text-dark'>
  <!--------------------------------INSERT NEW ATP----------------------------------------->
  <form id='atpForm' method='post' enctype='multipart/form-data'>

     <!--------------------------------row 1------------------------------->
     <div class="form-row text-dark">
       
       <div class="form-group col-12 mt-0 p-0" id='atpFormResponse'></div>
     
     <div class="form-group col">
     <!--<label for='cand_assmt' class='float-left'>Assessment Period</label> -->
     <input type="text" onkeyup="populateAssmtPeriodList(this.value)" onchange="dataListSelectAssmt();" autocomplete="off" required class="form-control bg-transparent border border-dark text-dark" name='atp_occp' id="atp_occp" placeholder='Search Occupation'  list='list_occp' >
 
     <datalist id='list_occp'></datalist>
 
     
     </div>
 
     </div>
      <!--------------------------------ends row 1------------------------------->
      <!--------------------------------row 2------------------------------->
      <div class="form-row text-dark">
 
      <div class="form-group col-3">

 <label for='atp_pats' class='float-left'>ATP Paticipants: </label>
 <br/><br/><textarea class="form-control bg-transparent border border-dark text-dark" id='atp_pats' name='atp_pats' placeholder='Paticipants'></textarea>
 
 </div>
 
 <div class="form-group col-3">
 
 <label for='atp_staff' class='float-left'>ATP Personel/Staff: </label>
 <br/><br/><textarea class="form-control bg-transparent border border-dark text-dark" id='atp_staff' name='atp_staff' placeholder='Personel'></textarea>
 
 </div>
 
 <div class="form-group col-3">
 <label for='cand_prog_start' class='float-left'>Workshop Start: </label>
 <input type="date" class="form-control bg-transparent border border-dark text-dark" id="atp_start" name='atp_start' >
 </div>
 
 <div class="form-group col-3">
 <label for='cand_prog_end' class='float-left'>Workshop End: </label>
 <input type="date" class="form-control bg-transparent border border-dark text-dark" id="atp_end" name='atp_end'>
 </div>
 
 </div>
 <!--------------------------------ends row 2------------------------------->
 
 <!--------------------------------row 3------------------------------->
 <div class="form-row text-dark">
 <!------row 3 column1 LEFT--------------->
 <div class="col text-dark">

 <div class="form-row">
 <label for='atp_file' class='float-left'>ATP file: </label>
 <input type="file" class="form-control bg-transparent border border-dark text-dark" id="atp_file" placeholder='atp_file' name='atp_file'>
 
 </div>
 
 
 </div>
 <!------row 3  column1 LEFT--------------->
 <!------row 3 column2 RIGHT--------------->
 <div class="col text-dark pl-3">

 <div class="form-row">
 <label for='atp_status' class='float-left'>ATP Status: </label>
 <select class="form-control bg-transparent border border-dark text-dark" required name='atp_status' id="atp_status">
    <option selected value=''>Choose</option>
    <option value='unavailable'>Unavailable</option>
    <option value='development'>Under development</option>
    <option value='review'>Under review</option>
    <option value='completed'>Completed</option>
    </select>
 
 </div>
 
 
 </div>
 <!------row 3 column2 RIGHT--------------->

 </div>
 <!--------------------------------ends row 3------------------------------->
 <!--------------------------------row 4------------------------------->
 <div class="form-row text-dark">
 <div class="col-12 ">
 <button class='btn btn-primary w-25' style='margin-top:10px;' onclick="submitForm(event,'atpForm','new_ATP','atpFormResponse');">submit</button>
 </div>
 </div>
 <!--------------------------------row 4------------------------------->

   </form>
<!--------------------------------ENDS NEW ATP----------------------------------------->

</div>
    <!--ends tab-1-->

	<div id="tabs-2" class='text-dark'>
      <!--------------------------------INSERT NEW OCCUPATION----------------------------------------->
      <form id='occpForm' method='post' enctype='multipart/form-data'>
      
  <div class="form-row">

  <div class="form-group col-12 mt-0 p-0" id='occpFormResponse'></div>

    <div class="form-group col">
      <label for="occp_Levels">Levels</label>
        <select class="form-control bg-transparent border border-dark text-dark" required name='occp_Levels' id="occp_Levels">
        <option selected value=''>Levels</option>
        <option value='level 1'>Level 1</option>
        <option value='level 2'>Level 2</option>
        <option value='level 3'>Level 3</option>
        <option value='level 4'>Level 4</option>
        <option value='level 5'>Level 5</option>
        </select>
    </div>

    <div class="form-group col">
      <label for="occp_occp">Occupation</label>
      <input type="text" class="form-control" id="occp_occp" required name='occp_occp' placeholder="Occupation">
    </div>
    <div class="form-group col">
      <label for="occp_initial">Initial</label>
      <input type="text" class="form-control" id="occp_initial" name='occp_initial' placeholder="Initial">
    </div>
  </div>
  
  
  <button type="submit" class="btn btn-primary w-25" onclick="submitForm(event,'occpForm','new_OCCPN','occpFormResponse');" >Submit</button>


<!--------------------------------row 4------------------------------->
    </form>
     <!--------------------------------ENDS NEW  OCCUPATION----------------------------------------->
    </div>
</div>
  </div>

</main>

<footer class="footer mt-auto py-1">
  <div class="container text-center">
    <span class="text-dark"><?php echo $_SESSION['FOOTER']; ?></span>
  </div>
</footer>
<script src="./js/feather.min.js"></script>
<script src="./js/upload.js"></script>
</body>
</html>
