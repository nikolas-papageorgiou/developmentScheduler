

const form = document.getElementById('login-form')
const fullName = document.getElementById('fullName')
const email = document.getElementById('email')
const username = document.getElementById('username')
const password = document.getElementById('password')
const cpassword = document.getElementById('cpassword')

const errorFullName = document.getElementById('errorFullName')
const errorEmail = document.getElementById('errorEmail')
const errorUsername = document.getElementById('errorUsername')
const errorPassword = document.getElementById('errorPassword')
const errorcPassword = document.getElementById('errorcPassword')



form.addEventListener('submit',(e)=>{
    let errors = [];

   

    if(fullName.value ===""||fullName.value== null){
        var message = 'Το Ονομα Χρήστη δεν μπορεί να είναι κενό';
        errors.push('FullNameError');
        errorFullName.innerText = message;
    }else{
        errorFullName.innerText = "";
        var index = errors.indexOf('FullNameError');
        if (index !== -1) {
            errors.splice(index, 1);
            
        }
    }

    if(!isValidEmail(email.value)){
        var message = 'Το email που εισάγετε δεν είναι σωστό';
        errors.push('EmailError');
        errorEmail.innerText = message;
    }else{
        errorEmail.innerText = "";
        var index = errors.indexOf('EmailError');
        if (index !== -1) {
            errors.splice(index, 1);
            
            
        }
    }

    if(username.value ===""||username.value== null){
        var message = 'To username του Χρήστη δεν μπορεί να είναι κενό';
        errors.push('usernameError');
        errorUsername.innerText = message;
    }else{
            errorUsername.innerText = "";
            var index = errors.indexOf('usernameError');
            if (index !== -1) {
                errors.splice(index, 1);
                
            }
    }


    if(password.value===""||password.value==null){
        var message = 'Ο Κωδικός Χρήστη δεν μπορεί να είναι κενό';
        errors.push('passwordError');
        errorPassword.innerText = message;
    }else if((!isValidPassword(password.value))||(!password.value.length>=8)){
        var message = 'Ο Κωδικός Χρήστη πρέπει να περιέχει τουλάχιστον 8 χαρακτήρες, ένα κεφαλαίο γράμμα και έναν αριθμό';
        errors.push('passwordError');
        errorPassword.innerText = message;
    }else{
        errorPassword.innerText = "";
            var index = errors.indexOf('passwordError');
            if (index !== -1) {
                errors.splice(index, 1);
                
            }
    }
    
     if(cpassword.value!==password.value){
        var message = 'Ο κωδικός πρόσβασης δεν ταιριάζει. Παρακαλώ εισάγετε ξανά κωδικός πρόσβασης και κωδικό επιβεβαίωσης.';
        errors.push('cpasswordError');
        errorcPassword.innerText = message;
    }else{
        errorcPassword.innerText = "";
            var index = errors.indexOf('cpasswordError');
            if (index !== -1) {
                errors.splice(index, 1);
            }
    }



    //preventDefault() prevent submit the form before validation
    if(errors.length>0){

        console.log(errors);
        errors=[];
        
        e.preventDefault();
    }
    
    
});

function isValidEmail(email) {
    // Regular expression pattern for validating email addresses
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    // Test the given email against the regex pattern
    return emailRegex.test(email);
}
function isValidPassword(password) {
    // Regular expression pattern for validating email addresses
    var passwordRegex = /^(?=.*[A-Z])(?=.*[0-9]).+$/;
    // Test the given email against the regex pattern
    return passwordRegex.test(password);
}

