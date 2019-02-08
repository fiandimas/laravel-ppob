var pageURL = window.location.href;
var lastURLSegment = pageURL.substr(pageURL.lastIndexOf('/') + 1);
document.getElementById('active-dashboard').classList.add('active');
if(pageURL.includes('history')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-history').classList.add('active');
}