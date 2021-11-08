var Name,Email,Website,Preference,Comments="";
var Availability,Gender=[];
var Nameerr,Emailerr,Websiteerr,Gendererr,Preferr,Availerr,Commenterr="";
var genderChecked,availChecked=false;
var i=0;
var genderVal="";
var availVal=[];

document.addEventListener("DOMContentLoaded", 
                            function (){

                                console.log('dom loaded');
                                
                                
                                Name= document.querySelector("input[name='name']");
                                Nameerr=document.querySelector(".nameerr");
                                
                                
                                Email=document.querySelector("input[name='email']");
                                Emailerr=document.querySelector(".emailerr");
                            
                                
                                Website=document.querySelector("input[name='website']");
                                Websiteerr=document.querySelector(".websiteerr");
                               
                                
                                Gender=document.getElementsByName('gender');
                                Gendererr=document.querySelector(".gendererr");
                                
                                
                                Comments=document.querySelector("textarea");
                                Commenterr=document.querySelector(".commenterr");
                                
                                
                                Preference=document.querySelector("select[name='preference']");
                                Preferr=document.querySelector(".preferr");
                                
                                Availability=document.getElementsByClassName("check");
                                console.log(Availability);
                                Availerr=document.querySelector(".availerr");
                                
                                
                                document.querySelector(".subbutton").addEventListener("click",validate_form);
                                document.querySelector(".resbutton").addEventListener("click",reset_form);

                            }






);


function validate_form(e){
    availVal=[];
    console.log('validation started');
    clearErrors();    
    for(i=0;i<Gender.length;i++){
        if(Gender[i].checked){
            genderChecked=true;
            genderVal=Gender[i].value;
            break;
            
        }
     
    }
    for(i=0;i<Availability.length;i++){
        if(Availability[i].checked){
            availChecked=true;
            availVal = availVal+Availability[i].value;

        }
    }
    
    display_values();
    if (Name.value.length == 0){
        Nameerr.textContent= "Name is required";
        e.preventDefault();   //Stop php execution since there are javascript errors
        
    }

    if (Email.value.length == 0){
        Emailerr.textContent= "Email is required";
        e.preventDefault();   //Stop php execution since there are javascript errors
        
    }    
    
    if (Website.value.length == 0){
        Websiteerr.textContent= "Website is required";
        e.preventDefault();   //Stop php execution since there are javascript errors
        
    }

    
    if (!genderChecked){
        Gendererr.textContent= "Gender is required";
        e.preventDefault();   //Stop php execution since there are javascript errors
        
    }

    if (!availChecked){
        Availerr.textContent= "Availability is required";
        e.preventDefault();   //Stop php execution since there are javascript errors
        
    }

    if (Preference.value.length == 0){
        Preferr.innerText= "Preference is required";
        e.preventDefault();   //Stop php execution since there are javascript errors
        
    }

    if (Comments.value.length > 50){
        Commenterr.textContent= "Comments can not be > 50 characters";
        e.preventDefault();   //Stop php execution since there are javascript errors
        
    }


}

function clearErrors(){

    Nameerr.textContent="";
    Emailerr.textContent="";
    Websiteerr.textContent="";
    Gendererr.textContent="";
    Preferr.textContent="";
    Availerr.textContent="";
    Commenterr.textContent="";


}


function reset_form(e){


    e.preventDefault(); 
    console.log('Resetting');
    Name.value="";
    Email.value="",
    Gender.value="";
    Website.value="";
    Comments.value="";
    for (i=0;i<Gender.length;i++){
        Gender[i].checked=false;
    }
    Preference.value="";
    for (i=0;i<Availability.length;i++){
        Availability[i].checked=false;
    }
    
}

function display_values(){
    console.log(Name.value);
    console.log(Email.value);
    console.log(Website.value);
    console.log(genderVal);
    console.log(Comments.value);
    console.log(Preference.value);
    console.log(availVal);
    
                                
}