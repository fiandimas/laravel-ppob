var pageURL = window.location.href;
var lastURLSegment = pageURL.substr(pageURL.lastIndexOf('/') + 1);
document.getElementById('active-dashboard').classList.add('active');
if(pageURL.includes('level')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-level').classList.add('active');
  document.getElementById('active-admin').classList.remove('active');
  document.getElementById('active-cost').classList.remove('active');
  document.getElementById('active-customer').classList.remove('active');
  document.getElementById('active-usage').classList.remove('active');
  document.getElementById('active-payment').classList.remove('active');
  document.getElementById('active-history').classList.remove('active');
}else if(pageURL.includes('cost')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-level').classList.remove('active');
  document.getElementById('active-admin').classList.remove('active');
  document.getElementById('active-cost').classList.add('active');
  document.getElementById('active-customer').classList.remove('active');
  document.getElementById('active-usage').classList.remove('active');
  document.getElementById('active-payment').classList.remove('active');
  document.getElementById('active-history').classList.remove('active');
}else if(pageURL == 'http://localhost:8000/admin/admin'){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-level').classList.remove('active');
  document.getElementById('active-admin').classList.add('active');
  document.getElementById('active-cost').classList.remove('active');
  document.getElementById('active-customer').classList.remove('active');
  document.getElementById('active-usage').classList.remove('active');
  document.getElementById('active-payment').classList.remove('active');
  document.getElementById('active-history').classList.remove('active');
}else if(pageURL.includes('customer')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-level').classList.remove('active');
  document.getElementById('active-admin').classList.remove('active');
  document.getElementById('active-cost').classList.remove('active');
  document.getElementById('active-customer').classList.add('active');
  document.getElementById('active-usage').classList.remove('active');
  document.getElementById('active-payment').classList.remove('active');
  document.getElementById('active-history').classList.remove('active');
}else if(pageURL.includes('usage')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-level').classList.remove('active');
  document.getElementById('active-admin').classList.remove('active');
  document.getElementById('active-cost').classList.remove('active');
  document.getElementById('active-customer').classList.remove('active');
  document.getElementById('active-usage').classList.add('active');
  document.getElementById('active-payment').classList.remove('active');
  document.getElementById('active-history').classList.remove('active');
}else if(pageURL.includes('payment')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-level').classList.remove('active');
  document.getElementById('active-admin').classList.remove('active');
  document.getElementById('active-cost').classList.remove('active');
  document.getElementById('active-customer').classList.remove('active');
  document.getElementById('active-usage').classList.remove('active');
  document.getElementById('active-payment').classList.add('active');
  document.getElementById('active-history').classList.remove('active');
}
else if(pageURL.includes('history')){
  document.getElementById('active-dashboard').classList.remove('active');
  document.getElementById('active-level').classList.remove('active');
  document.getElementById('active-admin').classList.remove('active');
  document.getElementById('active-cost').classList.remove('active');
  document.getElementById('active-customer').classList.remove('active');
  document.getElementById('active-usage').classList.remove('active');
  document.getElementById('active-payment').classList.remove('active');
  document.getElementById('active-history').classList.add('active');
}