<style>

/* The Modal (background) */
.modal1 {
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal1-content {
  background-color: white;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
.modal1-heading{
  color:rgb(15,24,33);
}
/* The Close Button */
.close2 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-top: -24px;
}

.close2:hover,
.close2:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<?php
function mymodal($heading,$body=""){
?>
<div  class="modal1">
  
  <div class="modal1-content">
    <span class="close2" onclick="this.parentNode.parentNode.style.display='none';">&times;</span>
     <div id="modal1-heading">
      <h2>
       <?php  echo $heading;?>
      </h2>
     </div>
     <div id="modal1-body">
      <?=$body?>
     </div>
  </div>

</div>
<?php 
}
?>
