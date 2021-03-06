<?php


class staff {
    private $staffId;
    private $email;
    private $password;
    private $username;
    private $admin;
    private $active;
    private $dateCreated;
    private $firstName;
    private $lastName;
    private $profilePic;

    
    function __get($email) {
        return $this->$email;
    }
    
    function __set($email, $value) {
        $this->$email = $value;
    }
    
    public function __destruct() {
        //this is destruct the object one the object is completed it process :)
    }
    
    function __construct($staffId, $email, $password, $username, $admin, $active, $dateCreated, $firstName, $lastName, $profilePic) {
        $this->staffId = $staffId;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->admin = $admin;
        $this->active = $active;
        $this->dateCreated = $dateCreated;
        $this->$firstName = $firstName;
        $this->$lastName = $lastName;
        $this->$profilePic = $profilePic;

    }
    public static function GetCurrPassword($staff_id){ //retrieve current user password 
        $con =$GLOBALS["con"];
        $sql="SELECT password FROM user where staff_id = $staff_id";
        $result = mysqli_query($con,$sql);
        return $result; 

    }
    public static function  GetStaffInfoByEmail($email)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT staff_id,user_name,email, password, admin, active, date_created FROM user WHERE email = UPPER('$email')";
        $result = mysqli_query($con, $sql);       
        return $result;
    }
    public static function CheckStaffEmail($email) //this function will check for staff password
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT staff_id,active FROM user WHERE email = UPPER('$email')";
        $result = mysqli_query($con, $sql);       
        return $result;
    }
    public static function CheckStaffPassword($password)//this function will check for staff email
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT staff_id FROM user WHERE password = UPPER('$password')";
        $result = mysqli_query($con, $sql);       
        return $result;
    }
    public static function AddHash($staff_id, $password)
    {
        //this function will hash the password and update the record in the table
        $con = $GLOBALS["con"];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "update user set password = '$hash_password' where staff_id = $staff_id";
        echo $sql;
        mysqli_query($con, $sql);
        if(mysqli_affected_rows($con) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function CheckHashAndRedirect($email,$password)
    {
        //this function will decrypt the hashed password and verify with the password
        //if the password is correct then enter into index
        //password is wrong then go to login 
        $con = $GLOBALS["con"];
        $result = self::GetStaffInfoByEmail($email);
        if($val = mysqli_fetch_array($result))
        {
            
            if(password_verify($password, $val["password"]))
            {
                  $staff_id = self::SetStaffSession(self::GetStaffInfoByEmail($email));
                  $msg ="Sucess";                  
                  header("location:index.php");
            }
            else
            {
               
                $msg = "Incorrect Password. Please Try again!" ;
                header("location:login.php?loginError=$msg");
            }
        }
    }
    static function staffLogin($staff) {
        $con = $GLOBALS["con"];        
        $email = self::CheckStaffEmail($staff->email);//execute the function 
        $password = self::CheckStaffPassword($staff->password);//execute the function    
        
        if(mysqli_num_rows($email) > 0) //check the email is correct and proceed
        {
            if(self::CheckActive($staff->email))
            {
                if(mysqli_num_rows($password) > 0)//check the password is correct and proceed
                { 
                    //set the session and get the staff id to save time
                    $staff_id = self::SetStaffSession(self::GetStaffInfoByEmail($staff->email));
                    if(self::AddHash($staff_id,$staff->password)) //add the hash password and update the table
                    {      
                        header("location:index.php");
                    }
                    else
                    {
                        echo "failure";
                    }                
                }
                else
                {
                    self::CheckHashAndRedirect($staff->email, $staff->password);//check for the hashed password or wrong password
                }  
            }
            else
            {
                $msg = "Not an Active User" ;
                header("location:login.php?loginError=$msg");
            }       
                     
        }//end of first if
        else
        {
            $msg = "Email not found. Please Try again!" ;
            header("location:login.php?loginError=$msg");
        }        
    }
    public static function CheckActive($email)
    {
        $result = self::CheckStaffEmail($email);
        while($val = mysqli_fetch_array($result))
        {
            $active = $val["active"];
            if($active == 1)
            {
                return true;
            }
            return false;
        }
    }
    static function SetStaffSession($staff)
    {
        if(mysqli_num_rows($staff) != null)
        {
            if($val = mysqli_fetch_array($staff))
            {
                $_SESSION["admin"] = $val["admin"];
                $_SESSION["staff_name"] =$val["user_name"];
                $_SESSION["staff_id"] = $val["staff_id"];
                $_SESSION["message"] = "Welcome, ".$val["user_name"];
                $_SESSION["active"] = $val["active"];
                $_SESSION["notifications"] = "on";
                return $val["staff_id"];
            }
        }
    }
    
    static function getStaffByUserID($userEmail) {
        
    }

    public static function GetStaffAdminNumber($staffId)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT admin FROM user WHERE staff_id = $staffId";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        return $row[0];
    }
    
    public static function DisplayAllUsers()
    {
        $con = $GLOBALS["con"];
        $sql = "Select staff_id, user_name, active, admin, date_format(date_created, '%m/%d/%y') as date_created from user";       
        $count = 0;
        $color = "";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            while($val = mysqli_fetch_array($result))
            {
                $staff_id = $val["staff_id"];
                $name = strtoupper($val ["user_name"]);
                $date_created = $val["date_created"];
                $active = $val["active"];      
                $admin = $val["admin"];
                $adminColor = "";

                if($active == 0)
                {
                    $color = "<a href= \"#\" onclick=\"ActDeactivate_user(event,$staff_id,1)\"class= \"btn btn-danger btn-md\">Deactive</a>";
                }
                else
                {
                    $color = "<a href= \"#\" onclick=\"ActDeactivate_user(event,$staff_id,0)\" class= \"btn btn-success btn-md\">Active</a>";
                }

                //display admin status
                if($admin == 1)
                {
                   $adminColor="<button class=\"btn btn-md btn-success\" onclick=\"ActDeactiveAdmin(event,$staff_id,0 )\">Active Admin</button>";
                }
                else if($admin == 2)
                {
                    $adminColor="<button class=\"btn btn-md btn-dark\">Super Admin</button>";
                }
                else 
                {
                    $adminColor="<button class=\"btn btn-md btn-warning\" onclick=\"ActDeactiveAdmin(event,$staff_id,1 )\">Make Admin</button>";
                }

                $count +=1;
                echo "<tr>
                <td>$count</td>
                <td>$name</td>                
                <td>$date_created</td>
                <td>$adminColor</td>
                <td align = \"right\">$color</td>
                </tr>";
            }           
        }
        else
        {
            echo "<tr>
            <td>#</td>
            <td>No users</td>
            <td>Null</td>
            <td align = \"right\">Null</td>
            </tr>";
        }
    }

    public static function SetActiveAndDeactive($staff_id,$active)
    {
        $con = $GLOBALS["con"];
        $sql = "update user set active = $active where staff_id =$staff_id  ";
        echo $sql;
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) > 0)
        {
            return true;
        }
        return false;
    }

    public static function getUserInfo(){
        $con = $GLOBALS["con"];
        $user = $_SESSION["staff_id"];
        $sql = "SELECT first_name, last_name, email, staff_id from user where staff_id = $user";
        $result = mysqli_query($con,$sql); 
        $row = mysqli_fetch_assoc($result);

        $sql2 = "SELECT user_phone_no from user_phone where user_id = $user";
        $result2 = mysqli_query($con,$sql2); 
        $row2 = mysqli_fetch_assoc($result2);

        echo "<strong>Name: </strong>" . $row['first_name'] . " " . $row['last_name'] . "<br>"
        .  "<strong>Email: </strong>" . $row['email'] . "<br><strong> Phone Number</strong>: " 
        . $row2['user_phone_no'];
    }

    public static function SetActiveAndDeactiveAdmin($staff_id, $admin)
    {
        $con = $GLOBALS["con"];
        $sql = "update user set admin = $admin where staff_id =$staff_id  ";
        echo $sql;
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) > 0)
        {
            return true;
        }
        return false;
    }
    public static function changePassword($sessId, $curPass, $newPass, $verifyNewPass){
        $con = $GLOBALS["con"];
       
        $sql ="SELECT password from user WHERE staff_id = '$sessId'";
        $result = mysqli_query($con,$sql); 
        $row = mysqli_fetch_assoc($result);    
        $PASS = $row["password"];
            //if DB pass is equal to curr pass entered 
        if(password_verify($curPass,$PASS)){    
                //if user wrote new pass correct both times
            if($newPass == $verifyNewPass){
                //update
                $sql2 = "UPDATE user set password = '$newPass' WHERE staff_id = '$sessId' "; 
                $result2= mysqli_query($con, $sql2);
                //echo "password updated";
                session_destroy();
                $msg = "Password Updated! Please log in. ";  
                header("location:login.php?loginError=$msg");
            } 
            else{
               // echo "passwords do not match";
               $msg = "Passwords do not match. Please try again." ;
               header("location:user_profile.php?Error=$msg");
            }
        }
        else{
           // echo "you are not entering the correct password";
           $msg = "Incorrect Password. Please Try again!" ;
           header("location:user_profile.php?Error=$msg");
         
        }    
    
    } //end changePassword

    public static function changeEmail ($sessId,$password, $newEmail){
        $con = $GLOBALS["con"];
        $sql ="SELECT password from user WHERE staff_id = '$sessId'";
        $result = mysqli_query($con,$sql); 
        $row = mysqli_fetch_assoc($result);    
        $PASS = $row["password"];
            //if DB pass is equal to curr pass entered 
        if(password_verify($password,$PASS)){    
            $sqlEmail = "UPDATE user set email = '$newEmail' where staff_id = '$sessId'";
            mysqli_query($con, $sqlEmail);
            $_SESSION["message"] = "Email Updated!";  
            header("location:dashboard.php");
        }
        else{
            $msg = "Incorrect Password. Please Try again!" ;
            header("location:user_profile.php?Error=$msg");
        }
    }
    public static function changePhone ($sessId,$password, $newPhone){
        $con = $GLOBALS["con"];
        $sql ="SELECT password from user WHERE staff_id = '$sessId'";
        $result = mysqli_query($con,$sql); 
        $row = mysqli_fetch_assoc($result);    
        $PASS = $row["password"];
        if(is_numeric($newPhone)){
            //if DB pass is equal to curr pass entered 
            if(password_verify($password,$PASS)){    
                $sqlPhone = "UPDATE user_phone set user_phone_no = $newPhone where user_id = '$sessId'";
                mysqli_query($con, $sqlPhone);
                $_SESSION["message"] = "Phone Updated!";  
                header("location:dashboard.php");
            }
            else{
                $msg = "Incorrect Password. Please Try again!" ;
                header("location:user_profile.php?Error=$msg");
            }
        }
        else{
            $msg = "please enter a real phone number" ;
            header("location:user_profile.php?Error=$msg");
        }
    }
   // public static function changeNotifications($sessId, $on, $sms, $email){
       
        
    //}

    public static function notifsOnOff($on){  
        $user = $_SESSION["staff_id"];
        $con = $GLOBALS["con"];
        $sql ="update user SET notificationsON = '$on' where staff_id = $user";
        $result = mysqli_query($con,$sql); 
        $row = mysqli_fetch_assoc($result); 
        $_SESSION["message"] = "Notification are " .  $on;  
        header("location:dashboard.php");
        
    }

    //Check Email
    public static function CheckEmailPassword($email)
    {
        $result = self::CheckStaffEmail($email);
        if(mysqli_num_rows($result) > 0)
        {
            return true;
        }
        else{
            return false;
        }
    
    }

    //Check and insert code
    public static function CheckAndInsertCode($email, $code)
    {
        $con = $GLOBALS["con"];
        $sql ="Select code_id from password_reset where email = LOWER('$email')";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            // $code = password_hash($code, PASSWORD_DEFAULT);
            $update_code = "update password_reset set code = $code where email = LOWER('$email')";
            if(mysqli_query($con, $update_code))
            {
                return true;
            }
        }
        else{
        //    echo $email.$code;
            // $code = password_hash($code, PASSWORD_DEFAULT);
            $insert_code ="Insert into password_reset (email,code) values ('$email', $code)";
            mysqli_query($con,$insert_code);
            if(mysqli_affected_rows($con) > 0)
            {
                return true;
            }
        }
        
    }

    public static function CheckCode($mail, $code)
    {
        $con = $GLOBALS["con"];
        $sql = "Select code_id from password_reset where code = $code and email = LOWER('$mail')";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            return true;
        }
        return false;
    }

    public static function UpdatePassword($email, $password)
    {
        $con = $GLOBALS["con"];
        $code_id = 0;
        $sql = "select code_id from password_reset where email = LOWER('$email')";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            if($val = mysqli_fetch_array($result))
            {
                $code_id = $val["code_id"];
            }
        }
        $pwdSql = "delete from password_reset where code_id = $code_id";
        if(mysqli_query($con, $pwdSql))
        {
                return true;
        }
        return false;           
       
    }
}