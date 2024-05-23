function addStudent()
{

    let table = document.getElementById("table table-hover");

    let txtFirstName = document.getElementById('firstname');
    let txtLastName = document.getElementById('lastname');
    let txtEmail = document.getElementById('email');

    let tbody = document.getElementsByTagName('tbody')[0];
    let tr = document.createElement('tr');

    let td1 = document.createElement('td');
    td1.innerText = txtFirstName.value; 
    tr.appendChild(td1);

    let td2 = document.createElement('td');
    td2.innerText = txtLastName.value; 
    tr.appendChild(td2);

    let td3 = document.createElement('td');
    td3.innerText = txtEmail.value; 
    tr.appendChild(td3);

    let td4 = document.createElement('td');
    td4.innerHTML = `<button onclick="removeStudent(this)" class="btn btn-danger btn-sm">Delete</button>`;
    tr.appendChild(td4);

    tbody.appendChild(tr);

    let firstname = txtFirstName.value;
    let lastname = txtLastName.value;
    let email = txtEmail.value;
    let errorMsg = '';

    if (firstname == null || firstname == '')
    {
        errorMsg = 'Please enter your first name'
    }
    else if (lastname == null || lastname == '')
    {
        errorMsg = 'Please enter your last name'
    }
    else if (email == null || email == '')
    {
        errorMsg = 'Please enter your email'
    }
    else if (!email.includes('@'))
    {
        errorMsg = 'Your email is not correct';
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

function removeStudent(aButton)
{
    let td = aButton.parentElement;
    let tr = td.parentElement;
    tr.remove();
}