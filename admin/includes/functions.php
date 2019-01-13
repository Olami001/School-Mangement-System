 <?php

    if ( (session_status() == 1) || (session_id() == '') ) {
        session_start();
    }
    
    $con = mysqli_connect('localhost', 'root', '', 'uhrms');
    if($con){
            
    }else{
        die('No Connection Found!');
    }

    function myClean($data) {
        $data = @trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function isLoggedIn(){
        if(isset($_SESSION['stud_ID']) && strlen($_SESSION['stud_ID']) > 0){
        }else{
            session_destroy();
            redirect('../index.php');
        }
    }
    
function isAdminLoggedIn(){
        if(isset($_SESSION['admin_ID']) && strlen($_SESSION['admin_ID']) > 0){
        }else{
            session_destroy();
            redirect('../adminlogin.php');
        }
    }

    function redirect($filename) {
        if (headers_sent()){
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$filename.'";';
            echo '</script>';
        }else {            
            header('Location: '.$filename);
        }
    }
    
    function doLogin($param1, $param2) {
        global $con;
        $v = $con;
        $q = "SELECT * FROM tbl_stud_info WHERE reg_no = '".$param1."' AND password = '".$param2."'";
        $q2 = mysqli_query($v, $q);
        if(mysqli_num_rows($q2) > 0){
            $row = mysqli_fetch_assoc($q2);
            $_SESSION['stud_ID']  =  $row['stud_ID'];
            //$_SESSION['prv'] = $row['prvID'];     
            return 1;
        }else{
            return 0;
        }
    }

function doAdminLogin($param1, $param2) {
        global $con;
        $v = $con;
        $q = "SELECT * FROM tbl_admin WHERE pno = '".$param1."' AND password = '".$param2."'";
        $q2 = mysqli_query($v, $q);
        if(mysqli_num_rows($q2) > 0){
            $row = mysqli_fetch_assoc($q2);
            $_SESSION['admin_ID']  =  $row['admin_ID'];
            $_SESSION['hierachy'] = $row['hierachy'];
            $_SESSION['adeptID'] = $row['adeptID'];
            $_SESSION['afacID'] = $row['afacID'];     
            return 1;
        }else{
            return 0;
        }
    }

    function doUser($param1, $param2) {
        global $con;
        $v = $con;
        $q = "INSERT INTO tbl_admin (username, password) VALUES ('".$param1."', '".$param2."')";
        $q2 = mysqli_query($v, $q);
        if($q2){
            return 1;
        }else{
            return 0;
        }
    }
    
     function doDelete($param1) {
        global $con;
        $v = $con;
        $q = "DELETE FROM tbl_link_activity WHERE activity_ID = '".$param1."'";
        $q2 = mysqli_query($v, $q);
        if($q2){   
            return 1;
        }else{
            return 0;
        }
    }

function getAllAdmin(){
        global $con;
        $v = $con;
        $r = '';
        
            $q = "SELECT * FROM tbl_admin INNER JOIN tbl_hierachy ON tbl_admin.hierachy=tbl_hierachy.hierachyID INNER JOIN tblfaculty ON tbl_admin.afacID=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_admin.adeptID=tbldepartment.deptID";
        $q2 = mysqli_query($v, $q) or die(mysqli_error($v));
        
        $sn=0;
        if(mysqli_num_rows($q2) > 0){
        $sn++; //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                
                $r .= '
                    <tr class="odd gradeX">
                        <td>'.$row['pno'].'</td>
                        <td> '.$row['fname'].'  </td>
                        <td> '.$row['hierachy_name'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a onclick="return confirm('.'Are You sure want to delete'.')" href="delete_admin.php?id='.$row['admin_ID'].'" title="Delete">Delete</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="5">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    return $r;
}

function getAllFact(){
        global $con;
        $v = $con;
        $r = '';
        
            $q = "SELECT * FROM tblfaculty ORDER BY name";
        $q2 = mysqli_query($v, $q) or die(mysqli_error($v));
        
        $sn=0;
        if(mysqli_num_rows($q2) > 0){
         //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td>'.$sn.'</td>
                        <td> '.$row['name'].'  </td>
                        <td>
                            <a href="delete_fac.php?id='.$row['facultyid'].'" title="Delete">Delete</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="5">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    return $r;
}

function getAllDept(){
        global $con;
        $v = $con;
        $r = '';
        
            $q = "SELECT * FROM tbldepartment INNER JOIN tblfaculty ON tbldepartment.facultyid=tblfaculty.facultyid ORDER BY dept_name";
        $q2 = mysqli_query($v, $q) or die(mysqli_error($v));
        
        $sn=0;
        if(mysqli_num_rows($q2) > 0){
         //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td>'.$sn.'</td>
                        <td> '.$row['dept_name'].'  </td>
                        <td> '.$row['name'].'  </td>
                        <td>
                            <a href="delete_dept.php?id='.$row['deptID'].'" title="Delete">Delete</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="5">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    return $r;
}

function getOtherCourses($hie,$dept,$fac){
        global $con;
        $v = $con;
        $r = '';
        
            $q = "SELECT * FROM tbl_stud_info INNER JOIN tbl_course_taken ON tbl_stud_info.stud_ID=tbl_course_taken.studID INNER JOIN tbldepartment ON tbl_course_taken.deptID=tbldepartment.deptID WHERE tbl_course_taken.deptID='$dept' AND tbl_course_taken.c_cleared=0";
        $q2 = mysqli_query($v, $q) or die(mysqli_error($v));
        
        $sn=0;
        if(mysqli_num_rows($q2) > 0){
        $sn++; //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                
                $r .= '
                    <tr class="odd gradeX">
                        <td>'.$sn.'</td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_other_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="5">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    return $r;
}


    function getUclrStudents($hie,$dept,$fac){
        global $con;
        $v = $con;
        
        if ($hie==1) {
            $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID WHERE tbl_stud_info.faculty='$fac' AND tbl_stud_info.faculty_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){
        $sn++; //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                
                $r .= '
                    <tr class="odd gradeX">
                        <td>'.$sn.'</td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="5">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    } elseif ($hie==2) {
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID WHERE tbl_stud_info.dept='$dept' AND tbl_stud_info.dept_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){ 
        $sn++;//<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td>'.$sn.'</td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    } elseif($hie==3){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.libry_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                       <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==4){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.clinic_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$sn.'  </td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==5){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.hostel_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn =0;
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$sn.'  </td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==6){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.sports_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$sn.'  </td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                       <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==7){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.sad_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$sn.'  </td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==8){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.acct_c=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$sn.'  </td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        <td>
                            <a href="view_stud.php?id='.$row['stud_ID'].'" title="view">View</a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    else{
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID WHERE cleared=0";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $sn++;
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$sn.'  </td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
        return $r;
    }

    function getOtherClrdStudents($hie,$dept,$fac){
        global $con;
        $v = $con;
            $q = "SELECT * FROM tbl_stud_info INNER JOIN tbl_course_taken ON tbl_stud_info.stud_ID=tbl_course_taken.studID INNER JOIN tbldepartment ON tbl_course_taken.deptID=tbldepartment.deptID WHERE tbl_course_taken.deptID='$dept' AND tbl_course_taken.c_cleared=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){
        $sn++; //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                
                $r .= '
                    <tr class="odd gradeX">
                        <td>'.$sn.'</td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="4">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    return $r;
}

    function getClrStudents($hie,$dept,$fac){
        global $con;
        $v = $con;
        
        if ($hie==1) {
            $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID WHERE tbl_stud_info.faculty='$fac' AND tbl_stud_info.faculty_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        $sn=0;
        if(mysqli_num_rows($q2) > 0){
        $sn++; //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                
                $r .= '
                    <tr class="odd gradeX">
                        <td>$sn</td>
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="5">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    } elseif ($hie==2) {
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID WHERE tbl_stud_info.dept='$dept' AND tbl_stud_info.dept_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    } elseif($hie==3){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.libry_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==4){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.clinic_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==5){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.hostel_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                       <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==6){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.sports_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==7){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.sad_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    elseif($hie==8){
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.acct_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                        
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <center><div style="color: red;"> No Student Record Found!</div></center>
                    </td>
                </tr>';
        }
    }
    else{
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID AND tbl_stud_info.acct_c=1";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['reg_no'].'  </td>
                        <td> '.$row['sname'].' '.$row['oname'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['dept_name'].' </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div style="color: red;"> No Student Found!</div>
                    </td>
                </tr>';
        }
    }
        return $r;
    }
    function loadNavigation($hie){
        if ($hie==0) {
        echo'<a href="index.php">Uncleared Students</a>&nbsp;||&nbsp;<a href="cleared.php">Cleared Students</a>&nbsp;||&nbsp;<a href="admin.php">Administrators</a>&nbsp;||&nbsp;<a href="faculty.php">Faculties</a>&nbsp;||&nbsp;<a href="dept.php">Departments</a><br>';
        }else{
        echo'<a href="index.php">View Uncleared Students</a>&nbsp;||&nbsp;<a href="cleared.php">View Cleared Students</a>&nbsp;';
    }
}
    
    function getAllUser(){
        global $con;
        $v = $con;
        $q = "SELECT tbl_admin.*, tbl_priviledge.* FROM tbl_admin INNER JOIN tbl_priviledge ON tbl_admin.prvID=tbl_priviledge.prv_ID";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['admin_name'].' </td>
                        <td> '.$row['username'].'  </td>
                        <td> '.$row['password'].'  </td>
                        <td> '.$row['prv_name'].'  </td>
                    ';
                $r.= '
                    <td><a href="insert_admin.php?id='.$row['id'].'" class="btn btn-success" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="del_user.php?id='.$row['id'].'" class="btn btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No User Account Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

function getStudentDetails($id){
        global $con;
        $v = $con;
        $q = "SELECT * FROM tbl_stud_info INNER JOIN tblfaculty ON tbl_stud_info.faculty=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_stud_info.dept=tbldepartment.deptID WHERE stud_ID='$id'";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                <tr class="odd gradeX">
                        <th> REG NUMBER </th>
                        <td> '.$row['reg_no'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> FULL NAME </th>
                        <td> '.$row['oname'].' '.$row['sname'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> FACULTY </th>
                        <td> '.$row['name'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> DEPARTMENT </th>
                        <td> '.$row['dept_name'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> PHONE NUMBER </th>
                        <td> '.$row['phone'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> EMAIL ADDRESS </th>
                        <td> '.$row['email'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> SESSION OF GRADUATION </th>
                        <td> '.$row['hostel'].'  </td>
                    </tr>
                        
                    ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No User Account Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

function getAdminDetails($id){
        global $con;
        $v = $con;
        $q = "SELECT * FROM tbl_admin INNER JOIN tblfaculty ON tbl_admin.afacID=tblfaculty.facultyid INNER JOIN tbldepartment ON tbl_admin.adeptID=tbldepartment.deptID WHERE admin_ID='$id'";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                <tr class="odd gradeX">
                        <th> P_NO </th>
                        <td> '.$row['pno'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> FULL NAME </th>
                        <td> '.$row['fname'].'</td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> FACULTY </th>
                        <td> '.$row['name'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> DEPARTMENT </th>
                        <td> '.$row['dept_name'].'  </td>
                    </tr>
                    <tr class="odd gradeX">
                        <th> PASSWORD </th>
                        <td> '.$row['password'].'  </td>
                    </tr>
                        
                    ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No User Account Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

    function getUser($id){
        global $con;
        $v = $con;
        $q = "SELECT *  FROM tbl_stud_info WHERE stud_ID='$id'";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $sname = $row['sname'];
                $oname = $row['oname'];
                $username = $row['reg_no'];
            }
        $r = $username;
    }
     return $r;
    }

    function getAdminUser($id){
        global $con;
        $v = $con;
        $q = "SELECT *  FROM tbl_admin WHERE admin_ID='$id'";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $fname = $row['fname'];
               // $oname = $row['oname'];
            }
        $r = $fname;
    }

        return $r;
    }

    function getApplyStatus($id){
        global $con;
        $v = $con;
        $q = "SELECT *  FROM tbl_stud_info WHERE stud_ID = '$id' ";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $applied = $row['applied'];
            }
            if ($applied==0){
        return 0;
        }
            else{
                return 1;
            }
    }
}

    function getAllFac(){
        global $con;
        $v = $con;
        $q = "SELECT *  FROM tbl_stud_info WHERE stud_ID = '$id' ";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['fac_name'].'  </td>
                    ';
                $r.= '
                    <td><a href="insert_faculty.php?id='.$row['facultyid'].'" class="btn btn-success" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="del_faculties.php?id='.$row['facultyid'].'" class="btn btn-danger" title="Edit"><i class="glyphicon glyphicon-trash"></i></a></i></a></td></tr>';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No User Form Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

function checkClearedCells($stud){
        global $con;
        $v = $con;
        $q = "SELECT *  FROM tbl_stud_info WHERE stud_ID = '$stud' ";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                if ($row['dept_c']==1 && $row['libry_c']==1  && $row['faculty_c']==1 && $row['clinic_c']==1 && $row['hostel_c']==1 && $row['sports_c']==1 && $row['sad_c']==1 && $row['acct_c']==1) {
                    $q1 = mysqli_query($v, "UPDATE tbl_stud_info SET cleared=1 WHERE stud_ID='$stud'");
                }
            }
        }
    }

function isClearedStud($id){
        global $con;
        $v = $con;
        $q = "SELECT *  FROM tbl_stud_info WHERE stud_ID = '$id' ";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                if ($row['cleared']==1)
                return 1;
            else return 0;
            }
        }
    }

    function getAllDept1(){
        global $con;
        $v = $con;
        $q = "SELECT *  FROM tbldepartment ORDER BY dept_name";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['dept_name'].'  </td>
                    ';
                $r.= '
                    <td><a href="insert_dept.php?id='.$row['deptID'].'" class="btn btn-success" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="del_dept.php?id='.$row['deptID'].'" class="btn btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No User Account Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

    function getRankById($id){
        global $con;
        $v = $con;
        $q = "SELECT rankname FROM rank WHERE rankid='".$id."'";
        $q2 = mysqli_query($v, $q);
        $row = mysqli_fetch_assoc($q2);
        return $row['rankname'];
    }
    
     function isUsernameExist($uname){
        global $con;
        $v = $con;
        $q = "SELECT username  FROM tbl_admin WHERE username='".$uname."'";
        $q2 = mysqli_query($v, $q);
        if(mysqli_num_rows($q2) == 0){
            return 1;
        }else{
            return 0;
        }
    }

    function getStateById($id){
        global $con;
        $v = $con;
        $q = "SELECT statename FROM state WHERE stateid='".$id."'";
        $q2 = mysqli_query($v, $q);
        $row = mysqli_fetch_assoc($q2);
        return $row['statename'];
    }

    function countAllEmployee(){
        global $con;
        $v = $con;
        $q = "SELECT COUNT(*) AS count FROM tbl_insert_linkage";
        $q2 = mysqli_query($v, $q);
        $row = mysqli_fetch_assoc($q2);
        return $row['count'];
    }

    function loadStatusIntoCombo($param_cat=''){
        $r_v = '';
        $val = array('Active', 'Inactive');
        $cat_found=false;
        $r_v .= "<option value = '-1'>-- Select Status --</option>";
        for ($i=0; $i<count($val); $i++){
            if($val[$i] == $param_cat){
                $r_v .= "<option value='" . $val[$i] . "' selected='selected'>" . $val[$i] . "</option>";
                $cat_found = true;
            }else{
                $r_v .= "<option value='" . $val[$i] . "'>" . $val[$i]. "</option>";
            }
        }
        return $r_v;
    }

function loadRemarkIntoCombo($param_cat=''){
        $r_v = '';
        $val = array('Excellent', 'Good', 'Fair', 'Poor');
        $cat_found=false;
        $r_v .= "<option value = '-1'>-- Select Remark --</option>";
        for ($i=0; $i<count($val); $i++){
            if($val[$i] == $param_cat){
                $r_v .= "<option value='" . $val[$i] . "' selected='selected'>" . $val[$i] . "</option>";
                $cat_found = true;
            }else{
                $r_v .= "<option value='" . $val[$i] . "'>" . $val[$i]. "</option>";
            }
        }
        return $r_v;
    }
function loadRenewalIntoCombo($param_cat=''){
        $r_v = '';
        $val = array('Open', 'Close');
        $cat_found=false;
        $r_v .= "<option value = '-1'>-- Select Renewal --</option>";
        for ($i=0; $i<count($val); $i++){
            if($val[$i] == $param_cat){
                $r_v .= "<option value='" . $val[$i] . "' selected='selected'>" . $val[$i] . "</option>";
                $cat_found = true;
            }else{
                $r_v .= "<option value='" . $val[$i] . "'>" . $val[$i]. "</option>";
            }
        }
        return $r_v;
    }

    function loadTitleIntoCombo(){
        $r_v = '';
        $val = array('Excellent', 'Good', 'Fair', 'Poor');
        $cat_found=false;
        //$r_v .= "<option value = '-1'>-- Select Title --</option>";
        for ($i=0; $i<count($val); $i++){
            if($val[$i] == $param_cat){
                $r_v .= "<input type='checkbox' name='actvity[]' value='" . $val[$i] . "' checked/>". $val[$i];
                $cat_found = true;
            }else{
                $r_v .= "<input type='checkbox' name='actvity[]' value='" . $val[$i] . "'/>". $val[$i];
            }
        }
        return $r_v;
    }
function getActivity($val, $expld){
        for ($i=0; $i < count($val); $i++) { 
                       if ($val[$i]==$expld) {
                           echo "checked=checked";
                       }
                   }           
    }       

function loadHierachyIntoCombo($param_cat=''){
        global $con;
        $v = $con;
        $r_v = '';

        $q = "SELECT * FROM tbl_hierachy ORDER BY hierachyID";
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Hierachy --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['hierachyID'] == $param_cat){
                    $r_v .= "<option value='" . $row['hierachyID'] . "' selected='selected'>" . $row['hierachy_name'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['hierachyID'] . "'>" . $row['hierachy_name'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in Hierachy table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }

function loadOrgIntoCombo($param_cat=''){
        global $con;
        $v = $con;
        $r_v = '';

        $q = "SELECT * FROM tbl_organization ORDER BY org_name";
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Organization Name --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['org_id'] == $param_cat){
                    $r_v .= "<option value='" . $row['org_id'] . "' selected='selected'>" . $row['org_name'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['org_id'] . "'>" . $row['org_name'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in Organization table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }


function loadActivityIntoCombo($param_cat=''){
        global $con;
        $v = $con;
        $r_v = '';

        $q = "SELECT * FROM tbl_link_activity";
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Linkage Activity --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['activity_ID'] == $param_cat){
                    $r_v .= "<option value='" . $row['activity_ID'] . "' selected='selected'>" . $row['activity_name'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['activity_ID'] . "'>" . $row['activity_name'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in Activity Table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }

    function loadRegionIntoCombo($param_cat=''){
        global $con;
        $v = $con;
        $r_v = '';

        $q = "SELECT * FROM continent ORDER BY continent_name";
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Region --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['continent_ID'] == $param_cat){
                    $r_v .= "<option value='" . $row['continent_ID'] . "' selected='selected'>" . $row['continent_name'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['continent_ID'] . "'>" . $row['continent_name'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in Continent table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }

function loadPrvIntoCombo($param_cat=''){
        global $con;
        $v = $con;
        $r_v = '';

        $q = "SELECT * FROM tbl_priviledge ORDER BY prv_name";
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Priviledge --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['prv_ID'] == $param_cat){
                    $r_v .= "<option value='" . $row['prv_ID'] . "' selected='selected'>" . $row['prv_name'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['prv_ID'] . "'>" . $row['prv_name'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in priviledge table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }

function loadFacultyIntoCombo($param_cat=''){
        global $con;
        $v = $con;
        $r_v = '';

        $q = "SELECT *  FROM faculty_dept_tb ORDER BY Faculty";
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Faculty --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['id'] == $param_cat){
                    $r_v .= "<option value='" . $row['id'] . "' selected='selected'>" . $row['Faculty'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['id'] . "'>" . $row['Faculty'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in Faculty table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }

function loadDeptIntoCombo($param_cat=''){
        global $con;
        $v = $con;
        $r_v = '';

        $q = "SELECT * FROM dept_tb ORDER BY department";
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Department --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['id'] == $param_cat){
                    $r_v .= "<option value='" . $row['deptID'] . "' selected='selected'>" . $row['depertment'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['deptID'] . "'>" . $row['depertment'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in Faculty table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }

function checkClearedStud12($stud){
        global $con;
        $v = $con;
        $r_v = '';

        $q = 'SELECT * FROM tbl_stud_info WHERE stud_ID="'.$stud.'"';;
        $query = mysqli_query($v, $q);
        $total_rows_found = mysqli_num_rows($query);
        $cat_found=false;
        if ($total_rows_found > 0) {
            $r_v .= "<option value = '-1'>-- Select Country --</option>";
            while ($row = mysqli_fetch_assoc($query)){
                if($row['id'] == $param_cat){
                    $r_v .= "<option value='" . $row['id'] . "' selected='selected'>" . $row['country'] . "</option>";
                    $cat_found = true;
                }else{
                    $r_v .= "<option value='" . $row['id'] . "'>" . $row['country'] . "</option>";
                }
            }
        }else{
            $r_v = "<option value = '-1'>No data in Continent table</option>";
        }//end if ($total_rows_found == 1)

        return $r_v;
    }

    function generateRandomString($length = 5) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

    function insertRecord($regno, $sname, $oname, $hostel, $selection, $dept, $phone, $email,$passkey){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tbl_stud_info (reg_no, sname, oname, faculty, dept, phone, email, hostel,password)
              VALUES("'.$regno.'", "'.$sname.'", "'.$oname.'", "'.$selection.'", "'.$dept.'", "'.$phone.'", "'.$email.'",  "'.$hostel.'", "'.$passkey.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

function insertAdmin($pno, $fname, $password, $hierachy, $selection, $dept){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tbl_admin (fname, hierachy, pno, password, afacID, adeptID)
              VALUES("'.$fname.'", "'.$hierachy.'", "'.$pno.'", "'.$password.'", "'.$selection.'", "'.$dept.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

function insertFac($fac){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tblfaculty (name) VALUES("'.$fac.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

    function insertObj($linkageID, $obj){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tbl_objective (linkID, obj_name)
              VALUES("'.$linkageID.'", "'.$obj.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

    function insertDept($id, $dept){
        global $con;
        $v = $con;
        foreach($dept as $depart){
                $sql4 = "INSERT INTO tbl_course_taken (studID, deptID) VALUES('".$id."','".$depart."')";
                $q4 = mysqli_query($v,$sql4) or die(mysqli_error($v));

            }
        if($q4){
            $q5 = mysqli_query($v, "UPDATE tbl_stud_info SET applied=1 WHERE stud_ID='$id'");
            echo "0";
        }else{
            echo "1";
        }
    }

    function updateDept1($id, $fac, $dept){
        global $con;
        $v = $con;
        $q = 'UPDATE tbldepartment SET
         facultyid="'.$fac.'",
         dept_name="'.$dept.'"
         WHERE deptID="'.$id.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function insertDepartment($dept,$selection){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tbldepartment(dept_name, facultyid) VALUES ("'.$dept.'","'.$selection.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

    function updateFac($id, $fac){
        global $con;
        $v = $con;
        $q = 'UPDATE tblfaculty SET
         fac_name="'.$fac.'"
         WHERE facultyid="'.$id.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function insertActivity($activity){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tbl_link_activity(activity_name) VALUES ("'.$activity.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

    function checkClearedStud11($stud){
        global $con;
        $v = $con;
        $q = 'SELECT * FROM tbl_stud_info WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);

         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function insertOrg($org){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tbl_organization(org_name) VALUES ("'.$org.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

    function updateFaculty($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         faculty_c=1, fac_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateOtherCourse($stud,$dept){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_course_taken SET
         c_cleared=1, date_cleared=CURDATE()
         WHERE deptID = "'.$dept.'" AND studID="'.$stud.'"';
         $q2 = mysqli_query($v, $q) or die(mysqli_error($v));
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateDept($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         dept_c=1, dept_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateLibry($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         libry_c=1, libry_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateClinic($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         clinic_c=1, clinic_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateHostel($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         hostel_c=1, hostel_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateSports($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         sports_c=1, sports_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateSad($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         sad_c=1, sad_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function updateAcct($stud,$id){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_stud_info SET
         acct_c=1, acct_admin=CURDATE()
         WHERE stud_ID="'.$stud.'"';
         $q2 = mysqli_query($v, $q) or die(mysqli_error($v));
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

function insertUser($name, $uname, $password, $prv){
        global $con;
        $v = $con;
        $q = 'INSERT INTO tbl_admin(admin_name, username, password, prvID) VALUES ("'.$name.'","'.$uname.'","'.$password.'","'.$prv.'")';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
        }
    }

    function updateUser($id, $name, $uname, $password, $prv){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_admin SET
         admin_name="'.$name.'",
         username="'.$uname.'",
         password="'.$password.'",
         prvID="'.$prv.'"
         WHERE id="'.$id.'"';
         $q2 = mysqli_query($v, $q);
         if($q2){
            echo "0";
        }else{
            echo "1";
    }
}

    function updateRecord($linkageID, $linkTitle, $org, $doc, $docb, $duration, $status, $objective, $linkac, $selection, $disproduct1, $dissubproduct1, $ac_name, $ac_phone, $ac_email, $ac_addr, $c_name, $c_phone, $c_email, $c_addr){
        global $con;
        $v = $con;
        $q = 'UPDATE tbl_insert_linkage
                  SET
                  link_title="'.$linkTitle.'",
                  orgID="'.$org.'",
                  date_commence="'.$doc.'",
                  completion_date="'.$docb.'",
                  duration="'.$duration.'",
                  status="'.$status.'",
                  objective="'.$objective.'",
                  link_activity="'.$linkac.'",
                  continentID="'.$selection.'",
                  regionsID="'.$disproduct1.'",
                  subregionsID="'.$dissubproduct1.'",
                  linkabu_name="'.$ac_name.'",
                  linkabu_phone="'.$ac_phone.'",
                  linkabu_email="'.$ac_email.'" ,
                  linkabu_address="'.$ac_addr.'",
                  linkorg_name="'.$c_name.'",
                  linkorg_phone="'.$c_phone.'",
                  linkorg_email="'.$c_email.'",
                  linkorg_address="'.$c_addr.'"
                  WHERE linkage_id = "'.$linkageID.'"';
        $q2 = mysqli_query($v, $q);
        if($q2){
            echo "0";
        }else{
            echo "1";
            //echo mysqli_error();
        }
    }

function getByNature($nature){
        global $con;
        $v = $con;
        $q = "SELECT tbl_insert_linkage.*, tbl_link_nature.*, tbl_organization.*, tbl_link_activity.*, continent.*, regions.*, subregions.* FROM tbl_insert_linkage INNER JOIN tbl_link_nature ON tbl_insert_linkage.natureID=tbl_link_nature.nature_id INNER JOIN tbl_organization ON tbl_insert_linkage.orgID=tbl_organization.org_id INNER JOIN tbl_link_activity ON tbl_insert_linkage.activityID=tbl_link_activity.activity_ID INNER JOIN continent ON tbl_insert_linkage.continentID=continent.continent_ID INNER JOIN regions on tbl_insert_linkage.regionsID=regions.id INNER JOIN subregions ON tbl_insert_linkage.subregionsID=subregions.id WHERE tbl_insert_linkage.natureID='$nature'";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['link_title'].' </td>
                        <td> '.$row['nature_name'].' </td>
                        <td> '.$row['org_name'].'  </td>
                        <td> '.$row['status'].' </td>
                        <td>
                            <a href="view_linkage.php?id='.$row['linkage_id'].'" class="btn btn-info" title="View"><i class="glyphicon glyphicon-book"></i></a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No Inserted Linkage Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

    function getByOrg($org){
        global $con;
        $v = $con;
        $q = "SELECT tbl_insert_linkage.*, tbl_organization.*, continent.*, regions.*, subregions.* FROM tbl_insert_linkage INNER JOIN tbl_organization ON tbl_insert_linkage.orgID=tbl_organization.org_id INNER JOIN continent ON tbl_insert_linkage.continentID=continent.continent_ID INNER JOIN regions on tbl_insert_linkage.regionsID=regions.id INNER JOIN subregions ON tbl_insert_linkage.subregionsID=subregions.id WHERE tbl_insert_linkage.orgID='$org'";
        $q2 = mysqli_query($v, $q) or die(mysqli_error());
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['org_name'].'  </td>
                        <td> '.$row['link_title'].' </td>
                        <td> '.$row['status'].' </td>
                        <td>
                            <a href="view_linkage.php?id='.$row['linkage_id'].'" class="btn btn-info" title="View"><i class="glyphicon glyphicon-book"></i></a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No Inserted Linkage Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

function getByDuration($duration){
        global $con;
        $v = $con;
        $q = "SELECT tbl_insert_linkage.*, tbl_organization.*, continent.*, regions.*, subregions.* FROM tbl_insert_linkage INNER JOIN tbl_organization ON tbl_insert_linkage.orgID=tbl_organization.org_id INNER JOIN continent ON tbl_insert_linkage.continentID=continent.continent_ID INNER JOIN regions on tbl_insert_linkage.regionsID=regions.id INNER JOIN subregions ON tbl_insert_linkage.subregionsID=subregions.id WHERE tbl_insert_linkage.duration='$duration'";
        $q2 = mysqli_query($v, $q) or die(mysqli_error());
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['org_name'].'  </td>
                        <td> '.$row['link_title'].' </td>
                        <td> '.$row['status'].' </td>
                        <td>
                            <a href="view_linkage.php?id='.$row['linkage_id'].'" class="btn btn-info" title="View"><i class="glyphicon glyphicon-book"></i></a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No Inserted Linkage Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

function getByStatus($status){
        global $con;
        $v = $con;
        $q = "SELECT tbl_insert_linkage.*, tbl_organization.*, continent.*, regions.*, subregions.* FROM tbl_insert_linkage INNER JOIN tbl_organization ON tbl_insert_linkage.orgID=tbl_organization.org_id INNER JOIN continent ON tbl_insert_linkage.continentID=continent.continent_ID INNER JOIN regions on tbl_insert_linkage.regionsID=regions.id INNER JOIN subregions ON tbl_insert_linkage.subregionsID=subregions.id WHERE tbl_insert_linkage.status='$status'";
        $q2 = mysqli_query($v, $q) or die(mysqli_error());
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                         <td> '.$row['org_name'].'  </td>
                        <td> '.$row['link_title'].' </td>
                        <td> '.$row['status'].' </td>
                        <td>
                            <a href="view_linkage.php?id='.$row['linkage_id'].'" class="btn btn-info" title="View"><i class="glyphicon glyphicon-book"></i></a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No Inserted Linkage Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

    function getByContinent($continent){
        global $con;
        $v = $con;
        $q = "SELECT tbl_insert_linkage.*, tbl_organization.*, continent.*, regions.*, subregions.* FROM tbl_insert_linkage INNER JOIN tbl_organization ON tbl_insert_linkage.orgID=tbl_organization.org_id INNER JOIN continent ON tbl_insert_linkage.continentID=continent.continent_ID INNER JOIN regions on tbl_insert_linkage.regionsID=regions.id INNER JOIN subregions ON tbl_insert_linkage.subregionsID=subregions.id WHERE tbl_insert_linkage.continentID='$continent'";
        $q2 = mysqli_query($v, $q);
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //echo $continent; //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['org_name'].'  </td>
                        <td> '.$row['link_title'].' </td>
                        <td> '.$row['status'].' </td>
                        <td>
                            <a href="view_linkage.php?id='.$row['linkage_id'].'" class="btn btn-info" title="View"><i class="glyphicon glyphicon-book"></i></a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No Inserted Linkage Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }

function getByCountry($country){
        global $con;
        $v = $con;
        $q = "SELECT tbl_insert_linkage.*, tbl_organization.*, continent.*, regions.*, subregions.* FROM tbl_insert_linkage INNER JOIN tbl_organization ON tbl_insert_linkage.orgID=tbl_organization.org_id INNER JOIN continent ON tbl_insert_linkage.continentID=continent.continent_ID INNER JOIN regions on tbl_insert_linkage.regionsID=regions.id INNER JOIN subregions ON tbl_insert_linkage.subregionsID=subregions.id WHERE tbl_insert_linkage.regionsID='$country'";
        $q2 = mysqli_query($v, $q) or die(mysqli_error());
        $r = '';
        if(mysqli_num_rows($q2) > 0){ //echo $continent; //<td> '.getRankById($row['rankid']).' </td>
            while($row = mysqli_fetch_assoc($q2)){
                $r .= '
                    <tr class="odd gradeX">
                        <td> '.$row['org_name'].'  </td>
                        <td> '.$row['link_title'].' </td>
                        <td> '.$row['status'].' </td>
                        <td>
                            <a href="view_linkage.php?id='.$row['linkage_id'].'" class="btn btn-info" title="View"><i class="glyphicon glyphicon-book"></i></a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $r .= '
                  <tr class="odd gradeX">
                    <td colspan="8">
                        <div class="alert alert-danger text-center"> No Inserted Linkage Found!</div>
                    </td>
                </tr>';
        }

        return $r;
    }
    
function getFaculties($fac){
for ($i=0; $i <count($fac) ; $i++) { 
            if(count($fac>0)) {
                $fact= $fac.', ';
            }
             return $fact;
        }

}

 function insertEval($remark,$linkageID,$beneficiary,$renewal,$percentage=array(),$obj_id=array())
 {
     global $con;
     $v = $con;
     $q = 'INSERT INTO tbl_evaluation (remark,linkID,benef,renewal)
              VALUES("'. $remark . '", "' . $linkageID . '", "' . $beneficiary . '", "' . $renewal . '")';
     $q2 = mysqli_query($v, $q)  or die(mysqli_error($v));
     if ($q2) {
         echo "0";
         $sql3 = "SELECT LAST_INSERT_ID() as eval_id FROM tbl_evaluation";
         $q3 = mysqli_query($v, $sql3);
         $fetch = mysqli_fetch_assoc($q3);
         $eval_id = $fetch['eval_id'];
         //insert into objectives table

         for($i=0;$i<count($percentage);$i++){
             $sql4 = "INSERT INTO tbl_percentage VALUES('','" . $obj_id[$i] . "','" . $eval_id . "','".$percentage[$i]."')";
             $q4 = mysqli_query($v, $sql4) or die(mysqli_error($v));
             if($q4){
                 echo 0;
             }

         }



     }
 }