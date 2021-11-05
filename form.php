<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP form</title>
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>

    <?php
        $name = $email = $website = $comment = $gender = $preference= $availability= "";
        $nameerr = $emailerr = $gendererr= $commenterr= $websiteerr= $preferr= $availerr= "";
       

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            //Validate Name
            if (empty($_POST["name"])){
                
                $nameerr="Name is missing.";
            }
                
            else{
               
                $name=test_input($_POST["name"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
                    $nameerr="Only letters and whitespaces allowed";
                }

            }
            
            //Validate email

            if (empty($_POST["email"])){
                
                $emailerr="Email is missing.";
            }
                
            else{
                $email=test_input($_POST["email"]);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailerr="Not a valid email";
                }
            }

            //Validate website

            $website=test_input($_POST["website"]);
            if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                $websiteerr="Invalid URL";
            }

            //Validate comments

            $comment=test_input($_POST["comment"]);
            if(strlen($comment) > 100){
                $commenterr="Comment can not be > 100 characters.";
            }


           
            //Validate gender

            if (empty($_POST["gender"])){
                
                $gendererr="Gender is missing.";
            }
                
            else{
                $gender=test_input($_POST["gender"]);
                
            }

            
            //Validate Preference

            if (empty($_POST["preference"])){
                $preferr="Please enter shift preference.";
            }
            else{
                $preference=test_input($_POST["preference"]);
            }



            //Validate Availability


            if(empty($_POST["availability"])){
                $availerr="Please check availability.";
            }
            else{
                $availability=test_input($_POST["availability"]);
            }
            
        }


        function test_input($data){
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
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
                        <option value="morning" <?php if(isset($preference) && $preference=="morning") echo "Morning"; ?>>Morning</option>
                        <option value="evening" <?php if(isset($preference) && $preference=="evening") echo "Evening"; ?>>Evening</option>
                        <option value="afternoon" <?php if(isset($preference) && $preference=="afternoon") echo "Afternoon"; ?>>Afternoon</option>
                    </select>
                                       
                </div>
                <span class="errormsg preferr">*<?php echo $preferr;?></span>
                
                
            </div><br/>

            <div class="form-element">
                <label for="availability">Availability:</label>
                <div class="form-val">
                    
                   <input type="checkbox" name="availability" value="Immedicate">Immediate<br/>
                   <input type="checkbox" name="availability" value="Later">Later<br/>
                                       
                </div>
                <span class="errormsg preferr">*<?php echo $availerr;?></span>
                
                
            </div><br/>




            <div class="buttonbox"> 
                <div class="subbutton"><input type="submit"></div>
                <div class="resbutton"><input type="reset"></div>
            </div>

         </form>
    </div>


    <?php
            
            echo "<h2>Your Input:</h2>";
            echo $name;
            echo "<br>";
            echo $email;
            echo "<br>";
            echo $website;
            echo "<br>";
            echo $comment;
            echo "<br>";
            echo $gender;
            echo "<br>";
            echo $preference;
            echo "<br>";
            echo $availability;
?>

   <script type="text/javascript" src="js/script.js"></script>
  </body>
</html>
