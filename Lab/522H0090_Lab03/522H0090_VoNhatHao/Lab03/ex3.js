document.addEventListener('DOMContentLoaded', function() 
{
    const messageInput = document.getElementById('message');
    const colorSelect = document.getElementById('color');
    const boldCheckbox = document.getElementById('bold');
    const italicCheckbox = document.getElementById('italic');
    const underlineCheckbox = document.getElementById('underline');
    const alertBox = document.querySelector('.alert');

    function updateAlertBox() 
    {
        let newText = messageInput.value;
        let newColor = colorSelect.value.toLowerCase();
        let newStyle = '';
        if (boldCheckbox.checked) newStyle += 'font-weight: bold;';
        if (italicCheckbox.checked) newStyle += 'font-style: italic;';
        if (underlineCheckbox.checked) newStyle += 'text-decoration: underline;';

        alertBox.style.cssText = newStyle;
        alertBox.textContent = newText || "This text will be changed immediately when typing new text.";
        alertBox.style.color = newColor;
    }

    

    messageInput.addEventListener('input', updateAlertBox);
    colorSelect.addEventListener('change', updateAlertBox);
    boldCheckbox.addEventListener('change', updateAlertBox);
    italicCheckbox.addEventListener('change', updateAlertBox);
    underlineCheckbox.addEventListener('change', updateAlertBox);

    function restoreDefaults() 
    {
        messageInput.value = '';
        colorSelect.value = 'Black';
        boldCheckbox.checked = false;
        italicCheckbox.checked = false;
        underlineCheckbox.checked = false;
        updateAlertBox();
    }

    const restoreButton = document.querySelector('button.btn-success');
    restoreButton.addEventListener('click', restoreDefaults);

   
    updateAlertBox();
});
