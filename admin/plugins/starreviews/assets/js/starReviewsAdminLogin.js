$(document).ready(function() {

$.get("login.php?check=login", function ( data ) {
  if(data=='true') {
    window.location = 'index.php';
  }
});

/* Validate and process the login form */          
$.validate({
  form : '#form-login',
  onSuccess : function () { // If validation is valid we process the form 
    
    
    var username = $("#username").val();
    var password = $("#password").val();
    var dataString = 'username=' + username + '&password=' + password;
        
    /* Make ajax call to our PHP file to save the review & rating */
    $.ajax({
        
      type : "POST",
      url : "login.php", // our php login 
      data : dataString,
      cache : false,
      beforeSend: function() {
        $('.loading').html('<img src="../img/ajax-loader.gif" />');
      },
      success : function (data) {				
        if(data=='true') {
          window.location = 'index.php';    
        } else {
          $(".loading").hide();

          $(".error-msg").fadeIn(1500);
          
          $("#username").focus(function () {
            $(".error-msg").hide();
          });
        }
      }
          
    });
        
    return false;

  }
});
});