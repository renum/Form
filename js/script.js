var Name;
var Nameerr;

document.addEventListener("DOMContentLoaded", 
                            function (){
                                
                                Name= document.querySelector("input[name='name']");
                                Nameerr=document.querySelector(".nameerr");
                                Email=document.querySelector("input[name='email']");
                                Emailerr=document.querySelector(".emailerr");
                                Website=document.querySelector("input[name='website']");
                                Websiteerr=document.querySelector(".websiteerr");
                                Gender=document.querySelector("input[name='gender']");
                                Gendererr=document.querySelector(".gendererr");
                                document.querySelector(".subbutton").addEventListener("click",validate_form);

                            }






);


function validate_form(e){
    console.log('validation started');
    clearErrors();
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

}

function clearErrors(){

    Nameerr.textContent="";
    Emailerr.textContent="";
    Websiteerr.textContent="";


}