function showContent(contentId) {
    var contents = document.querySelectorAll('main section');
    for (var i = 0; i < contents.length; i++) {
        contents[i].style.display = 'none';
    }
    document.getElementById(contentId).style.display = 'flex';
}
