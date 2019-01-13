<?php

include('includes/config.php');

$state_all = mysqli_query($con, "select DISTINCT name from lga where 1");
$lga_all = mysqli_query($con, "select * from lga");

                            ?>
<div >
              <label >State of Origin <span class="required">*</span></label>
              <div  id="state_fm_g">             
                  
              <select name="state_origin"  id="state_select">
                                            <option>Select a State</option>
                                           <?php while ($srow = mysqli_fetch_assoc($state_all)) { ?>
                                                <option value="<?= $srow['name'] ?>"><?= $srow['name'] ?></option>
                                            <?php } ?>
                                 
                                            
                                        </select>
              </div>
            </div>

            <div >
              <label >Local Gov't Area <span class="required">*</span></label>
              <div  id="lga_fm_g">             
                  
              <select name="lga"  id="lga_select">
                                            <option value="">Select a Local Government</option>
                                            <?php while ($srow = mysqli_fetch_assoc($lga_all)) { ?>
                                                <option value="<?= $srow['lga'] ?>"
                                                        dir="<?= $srow['name'] ?>"><?= $srow['name'] . ' ' . $srow['lga'] ?></option>
                                            <?php } ?>
                                            
                                        </select>
              </div>
            </div>

             <script src="../data/morris-data.js"></script>
        <script src="../vendor/jquery/jquery.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    `    <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <!-- <script src="../assets/plugins/materialize/js/materialize.js"></script> -->
        <!-- <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script> -->
        <!-- <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script> -->
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
        <!--  <script src="assets/js/pages/ui-modals.js"></script> -->
        <!-- <script src="assets/plugins/google-code-prettify/prettify.js"></script> -->
        <script src="../dist/js/sb-admin-2.js"></script>

<script type="text/javascript">
                $('#lga_fm_g').show();
                
    $('#lga_select option').hide();
    $('#state_select').change(function () {
        $('#lga_select option').hide();
        var this_val = $(this).val();
        $('#lga_select option[dir=' + this_val + ']').show();
        $('#lga_fm_g').show();
        //alert('yes');
    });

            </script>