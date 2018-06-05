window.onload = function(){
    var searchElement = document.querySelector('.wrap_acf_search');
    var searchOLD = document.getElementById('posts-filter');
    var parentDiv = searchOLD.parentNode;
    parentDiv.insertBefore(searchElement,searchOLD);
    searchElement.setAttribute('style',"display:block");
}