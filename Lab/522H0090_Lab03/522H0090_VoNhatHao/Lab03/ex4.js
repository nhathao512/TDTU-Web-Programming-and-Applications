document.addEventListener('DOMContentLoaded', function() 
{
    const imageList = document.getElementById('imageList');
    const imageDisplay = document.querySelector('img');
    const backButton = document.querySelector('button:nth-of-type(1)');
    const startSlideshowButton = document.querySelector('button:nth-of-type(2)');
    const nextButton = document.querySelector('button:nth-of-type(3)');
    const imageInfo = document.querySelector('p');

    let currentImageIndex = 0;
    let slideshowIntervalId = null;
    let slideshowMode = false;

    function displayImage(index) 
    {
        const selectedImage = imageList.options[index].value;
        imageDisplay.src = "images/" + selectedImage;
        imageInfo.textContent = `${selectedImage} (${index + 1}/${imageList.options.length})`;
    }

    function goToPreviousImage() 
    {
        currentImageIndex = (currentImageIndex - 1 + imageList.options.length) % imageList.options.length;
        displayImage(currentImageIndex);
    }

    function goToNextImage() 
    {
        currentImageIndex = (currentImageIndex + 1) % imageList.options.length;
        displayImage(currentImageIndex);
    }

    function startSlideshow() 
    {
        slideshowMode = true;
        slideshowIntervalId = setInterval(goToNextImage, 1000);
        disableButtons();
        startSlideshowButton.textContent = "Stop slideshow";
    }

    function stopSlideshow() 
    {
        slideshowMode = false;
        clearInterval(slideshowIntervalId);
        enableButtons();
        startSlideshowButton.textContent = "Start slideshow";
    }

    function enableButtons() 
    {
        nextButton.disabled = false;
        backButton.disabled = false;
    }

    function disableButtons() 
    {
        nextButton.disabled = true;
        backButton.disabled = true;
    }

    backButton.addEventListener('click', function() 
    {
        goToPreviousImage();
    });

    nextButton.addEventListener('click', function() 
    {
        goToNextImage();
    });

    startSlideshowButton.addEventListener('click', function() 
    {
        if (slideshowMode) 
        {
            stopSlideshow();
        } else {
            startSlideshow();
        }
    });

    displayImage(currentImageIndex);
});
