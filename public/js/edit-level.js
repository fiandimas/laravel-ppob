function get(id){
  
    $.ajax({
      type: 'get',
      url: 'localhost:8000/admin/level/show/'+id,
      dataType: 'json',
      success: function(data){
        console.log(data);
      }
    })
}