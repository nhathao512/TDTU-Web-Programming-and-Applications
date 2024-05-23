document.addEventListener('DOMContentLoaded', function() 
{
  var showMore = document.getElementById('showMore');
  var moreIn4 = document.getElementById('moreIn4');
  
  if (showMore && moreIn4) 
  {
    moreIn4.style.display = 'none';
    
    showMore.addEventListener('click', function() 
    {
      if (moreIn4.style.display === 'none') 
      {
        moreIn4.style.display = 'block';
        showMore.textContent = 'Hide';
      } 
      else 
      {
        moreIn4.style.display = 'none';
        showMore.textContent = 'Show More';
      }
    });
  }
});