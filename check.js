var password = document.getElementById('password');
var cpassword = document.getElementById('cpassword');
var response = document.getElementById('response')
var button = document.getElementById('btn');

cpassword.onkeyup=(event)=>{
    if (password.value == '' || password.value != cpassword.value) {
        response.textContent = 'passwords do not match';
        button.disabled = true;
    }else{
        response.textContent = 'passwords match';
        button.disabled = false;
    }
}

button.onclick = ()=>{
    if(event.target.disabled == true){
        response.textContent = 'passwords do not match';
    }
}
