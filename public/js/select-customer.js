var pageURL = window.location.href;
var lastURLSegment = pageURL.substr(pageURL.lastIndexOf('/') + 1);
document.getElementById('active-dashboard').classList.add('active');
if(pageURL.includes('bill')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-bill').classList.add('active');
}