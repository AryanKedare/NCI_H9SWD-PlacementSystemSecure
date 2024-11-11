<?php
	session_start();
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");
		//$uname = $_POST['email'];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];
		$type = $_POST['type'];
		$sql="";
		function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
		}
		if($type==="Student"){
				$GLOBALS['sql']="SELECT pwd from students where email='".$_POST['uname']."';";
				$result=pg_query($GLOBALS['conn'],$sql);
		}elseif($type==="Company"){
				$GLOBALS['sql']="SELECT pwd from companys where email='".$_POST['uname']."';";
				$result=pg_query($GLOBALS['conn'],$sql);
		}elseif($type==="Admin"){
			$GLOBALS['sql']="SELECT pwd from admins where email='".$_POST['uname']."';";
			$result=pg_query($GLOBALS['conn'],$sql);
		}else{
			
			echo "<SCRIPT type='text/javascript'>
								alert('Wrong username or password to continue as admin');
								window.location.replace(\"index.html\");
							</SCRIPT>";
		}
		
        
       // $result = $GLOBALS['conn']->query($sql);
        if($type==="Student"||$type==="Company"|$type==="Admin"){
        if(pg_num_rows($result) > 0){
            $row=pg_fetch_assoc($result);
            if($row["pwd"]===$pwd){
				if($GLOBALS['type']==="Student"){
					$_SESSION['email']=$GLOBALS['uname'];
					header('Location: student_dash.php');
					echo "<SCRIPT type='text/javascript'>
								window.location.replace(\"student_dash.php\");
							</SCRIPT>";
				}elseif($GLOBALS['type']==="Company"){
					 $_SESSION['email']=$GLOBALS['uname'];
					//header('Location: company_dash.php');
					echo "<SCRIPT type='text/javascript'> 

								window.location.replace(\"company_dash.php\");
							</SCRIPT>";
				}
				elseif($GLOBALS['type']==="Admin"){
					$_SESSION['email']=$GLOBALS['uname'];
					echo "login verified";
					header('Location: admin_dash.php');
				    echo "<SCRIPT type='text/javascript'> 
							   window.location.replace(\"admin_dash.php\");
						   </SCRIPT>";
			   }	
                echo "Login successful <BR>";
            }else{
                echo "<SCRIPT type='text/javascript'> 
								alert('Invalid username or password');
								window.location.replace(\"index.html\");
							</SCRIPT>";
            }

        } 
		else{
           echo "<SCRIPT type='text/javascript'>
								alert('User Does not exist!');
								window.location.replace(\"index.html\");
							</SCRIPT>";
        }
			}
	  echo $_SESSION['email'] . "<BR>";
        //echo $pwd . "<BR>";
    }
		pg_close($conn);
?>