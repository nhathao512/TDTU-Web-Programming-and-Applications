function validateData()
{
    let txtEmail = document.getElementById('email');
    let txtPwd = document.getElementById('pwd');

    let email = txtEmail.value;
    let pwd = txtPwd.value;
    let errorMsg = '';

    if (email == null || email == '')
    {
        errorMsg = 'Please enter your email';
    }
    else if (!email.includes('@'))
    {
        errorMsg = 'Your email is not correct';
    }
    else if (pwd == null || pwd == '')
    {
        errorMsg = 'Please enter your password';
    }
    else if (pwd.length < 6)
    {
        errorMsg = 'Your password must contain at least 6 characters';
    }

    let lbErrorMsg = document.getElementsByClassName('errorMessage')[0];
    lbErrorMsg.innerText = errorMsg;
    if (errorMsg != '')
    {
        lbErrorMsg.classList.remove('d-none');
        return false;
    }
    lbErrorMsg.classList.add('d-none');
    return true;
}