const form = document.getElementById('form');
form.addEventListener("submit",function(e){
  e.preventDefault();

  $.ajax({
     type: "POST",
     url: "mail.php",
     data: $("#form").serializeArray(),
     dataType: 'json',
     success: function(data)
     {
       if(data.status == "ok"){
         var response = '<div class="success"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>Thanks ' + data.name + ' for sending an email. I will get back to you soon!</div>';
         $("#form").parent().prepend(response);
       } else if(data.status == "error") {
         var response = '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>Sorry not able to send a message.</div>';
         $("#form").parent().prepend(response);
       }
     }
   });

});
