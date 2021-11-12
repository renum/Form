
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP form</title>
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
    <?php require 'connection_config.php'; ?>
    <?php
        
        $name = $email = $website = $comment = $gender = $preference= $availability[]= "";
        $nameerr = $emailerr = $gendererr= $commenterr= $websiteerr= $preferr= $availerr= "";
    
        $form_validated="";
        //Form validation begin
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            //Validate Name
            if (empty($_POST["name"])){
                
                $nameerr="Name is missing.";
                $form_validated=false;
                
            }
                
            else{
            
                $name=test_input($_POST["name"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
                    $nameerr="Only letters and whitespaces allowed";
                    $form_validated=false;
                    
                }
                

            }
            
            //Validate email

            if (empty($_POST["email"])){
                
                $emailerr="Email is missing.";
                $form_validated=false;
                
            }
                
            else{
                $email=test_input($_POST["email"]);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailerr="Not a valid email";
                    $form_validated=false;
                    
                }
               
            }

            //Validate website

            if(!empty($_POST["website"]))
            {

                $website=test_input($_POST["website"]);
                if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                    $websiteerr="Invalid URL";
                    $form_validated=false;
                    
                }
               
            }
            

            //Validate comments

            $comment=test_input($_POST["comment"]);
            if(strlen($comment) > 50){
                $commenterr="Comment can not be > 50 characters.";
                $form_validated=false;
                
            }
        
            //Validate gender

            if (empty($_POST["gender"])){
                
                $gendererr="Gender is missing.";
                $form_validated=false;
            }
                
            else{
                $gender=test_input($_POST["gender"]);
                
                
            }

            
            //Validate Preference

            if (empty($_POST["preference"])){
                $preferr="Please enter shift preference.";
                $form_validated=false;
            }
            else{
                $preference=test_input($_POST["preference"]);
                
            }



            //Validate Availability


            if(empty($_POST["jan"]) && empty($_POST["feb"]) && empty($_POST["march"])  ){
                $availerr="Please check availability.";
                $form_validated=false;
            }
            else{

                $availability =array((!empty($_POST["jan"])?$_POST["jan"]:""),
                                    (!empty($_POST["feb"])?$_POST["feb"]:""),
                                    (!empty($_POST["march"])?$_POST["march"]:"")
                                    );
                        
            }

            //Validate if name and email already exists

            $name_email_Exists=Check_name_email_existing($name,$email);
        
            if(isset($name_email_Exists)){
                if ($name_email_Exists == true){
                    $nameerr= $emailerr= "This name and email already exists in our database.";
                    $form_validated =false; 
                }
            }

            if ($form_validated!== false){
                $form_validated =true;   
            }
        }
        
        //Form validation end
            


        function test_input($data){
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }  
        
        //Query name and email to check if the combination already exists in db
           
        function Check_name_email_existing($name,$email){
               
            global $servername,$dbname,$username,$password;
                        
            $sql="SELECT * FROM $dbname.CandDetails WHERE Name='$name' and Email='$email'";
            
            try{
        
                $conn=new PDO("mysql:host=$servername;dbName=$dbname",$username,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //set PDO error mode to exception                 
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                $result1=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result1_data= $stmt->fetchAll();
                if (count($result1_data) > 0){
                    return true;
                }
                else{
                    return false;
                }
                
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }

            $conn=null;


        }

    ?>  



    <div class="container"> 
         <h1>Registration form</h1>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="mainerrormsg"><span>*Required field</span></div><br/><br/>
            <div class="form-element">
                <label for="name">Name:</label>
                <div class="form-val">
                    <input  type="text" name="name" placeholder="Enter your name here" value="<?php echo $name;?>">
                    <span class="errormsg nameerr">*<?php echo $nameerr;?></span>
                </div>
                
            </div><br/>

            <div class="form-element">
                <label for="email">Email:</label>
                <div class="form-val">
                    <input  type="text" name="email" placeholder="xxx.yyy@zzmail.com" value="<?php echo $email;?>">                   
                    <span class="errormsg emailerr">*<?php echo $emailerr;?></span>
                </div>
                
            </div><br/>
            <div class="form-element">
                <label for="website"> Website:</label>
                <div class="form-val">
                    <input  type="text" name="website" placeholder="Enter your website URL here" value="<?php echo $website;?>">
                    <span class="errormsg websiteerr"><?php echo $websiteerr;?></span>
                </div>
            </div><br/>
            <div class="form-element">
                <label for="comment">Comment:</label>
                <div class="form-val">
                    <textarea name="comment" rows="5" cols="40" placeholder="Enter your comments here"><?php echo $comment;?></textarea>
                    <span class="errormsg commenterr"><?php echo $commenterr;?></span>
                </div>
            </div><br/>

            <div class="form-element">
                <label for="gender">Gender:</label>
                <div class="form-val">
                    
                    <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked";?>>Female<br/>
                    <input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked";?>>Male<br/>
                    <input type="radio" name="gender" value="other" <?php if (isset($gender) && $gender=="other") echo "checked";?>>Other
                                       
                </div>
                <span class="errormsg gendererr">*<?php echo $gendererr;?></span>
                
                
            </div><br/>

            <div class="form-element">
                <label for="preference">Shift Preference:</label>
                <div class="form-val">                   
                    <select name="preference">
                        <option value="morning" <?php if(isset($preference)&& $preference=="morning") echo "selected"; ?>>Morning</option>
                        <option value="evening" <?php if(isset($preference)&& $preference=="evening") echo "selected"; ?>>Evening</option>
                        <option value="afternoon" <?php if(isset($preference)&& $preference=="afternoon") echo "selected"; ?>>Afternoon</option>
                        <option value="" <?php if(isset($preference)&& $preference=="") echo "selected"; ?>></option>
                    </select>                                       
                </div>
                <span class="errormsg preferr">*<?php echo $preferr;?></span>                
                
            </div><br/>

            <div class="form-element">
                <label for="availability">Availability Month:</label>
                <div class="form-val">                
                   
                   <input type="checkbox"  class="check" name="jan" value="jan" <?php  if(isset($availability) && in_array("jan",$availability)) echo "checked";?> >Jan<br/>
                   <input type="checkbox" class="check" name="feb" value="feb" <?php  if(isset($availability) && in_array("feb",$availability)) echo "checked";?> >Feb<br/>
                   <input type="checkbox" class="check" name="march" value="march" <?php  if(isset($availability) && in_array("march",$availability)) echo "checked";?> >March<br/>                                       
                </div>
                <span class="errormsg availerr">*<?php echo $availerr;?></span>                                
            </div><br/>




            <div class="buttonbox"> 
                <div class="subbutton"><input type="submit"></div>
                <div class="resbutton"><input type="reset"></div>
            </div>

         </form>

        
    </div>
    


    <?php

        if (isset($form_validated) && ($form_validated==true)){
                Post_form_data($name,$email,$website,$gender,$comment,$preference,$availability);                
                
        }


        //Post form data to db
        function Post_form_data($name,$email,$website,$gender,$comment,$preference,$availability){
            
            global $servername,$dbname,$username,$password;       
            //Transform gender and availability       
            $gen="";
            switch ($gender){
                case "male": 
                    $gen= "M"; 
                    break; 
                case "female": 
                    $gen= "F";
                    break; 
                case "other": 
                    $gen= "O";
                    break;
            };
            $avail=serialize($availability);
            
            //Insert form data
        
            $sql="INSERT INTO $dbname.CandDetails(Name,Email,URL,Gender,Comments,Preference,Availability) VALUES(
                '$name','$email','$website','$gen','$comment','$preference','$avail')";
            try{
                $conn=new PDO("mysql:host=$servername;dbName=$dbname",$username,$password); 
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //set PDO error mode to exception                 
                $conn->exec($sql);
                $last_id=$conn->lastInsertId();  //get ID of last inserted row  
                Display_posted_data($last_id);              
            
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        
            $conn=null;
           
           
        }    
            
        //Display posted data
        function Display_posted_data($last_id){
            global $servername,$dbname,$username,$password;
           
            //Query last inserted data
            
            $sql="SELECT * FROM $dbname.CandDetails WHERE id=$last_id";

            try{

                $conn=new PDO("mysql:host=$servername;dbName=$dbname",$username,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //set PDO error mode to exception                 
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result_data= $stmt->fetchAll();
                
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }

            $conn=null;


            if ($result > 0){
                
                $outputmess="You have been registered successfully with following data.";      
                
                switch ($result_data[0]["Gender"]){
                    case "M": 
                        $outgender= "Male"; 
                        break; 
                    case "F": 
                        $outgender= "Female"; 
                        break; 
                    case "O": 
                        $outgender= "Other"; 
                        break; 
                };                
                

                ?>

                <div class="output"> 
                    <h2><?php echo $outputmess;?></h2>
                    <b>Name:</b>&nbsp;&nbsp;<?php echo $result_data[0]["Name"];?>
                    <br>
                    <b>Email: </b>&nbsp;&nbsp;<?php echo $result_data[0]["Email"];  ?>
                    <br>
                    <b>Website: </b>&nbsp;&nbsp;<?php echo $$result_data[0]["URL"]; ?>
                    <br>
                    <b>Comments: </b>&nbsp;&nbsp;<?php echo $result_data[0]["Comments"];?>
                    <br>
                    <b>Gender: </b>&nbsp;&nbsp;<?php echo $outgender;?>
                    <br>
                    <b>Shift preference: </b>&nbsp;&nbsp;<?php echo $result_data[0]["Preference"];?>
                    <br>
                    <b>Available in month of : </b>&nbsp;&nbsp;
                    <?php 
                    foreach(unserialize($result_data[0]["Availability"]) as $x){
                        echo $x."\t";
                    }
                    ?>
                </div>
                
            <?php    
            }   
           
            
            
        }

           

    ?>
    </body>

    <script type="text/javascript" src="js/script.js"></script>

</html>