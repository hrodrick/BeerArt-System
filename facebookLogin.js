 var  usrNombre;
 var  usrApellido;
 var  usuario;
 var  usrCorreo;
 var  usrID;
 var usrPicture;

function User(name, surname, email, password)
{

  this.name = name;
  this.surname = surname;
  this.email = email;
  this.password = password;
}

  window.fbAsyncInit = function() {
    FB.init({
    //appId      : '412426999172418',
    appId : '444489365948001',
    //appId : '2257174850975479',
    cookie     : true,
    xfbml      : true,
    version    : 'v2.10'
    });
    FB.AppEvents.logPageView();   
  };

  /* Esta función activa una llamada a Facebook para obtener el estado de inicio de sesión
    y llamar a tu función de devolución de llamada (callback) con el resultado. 
  */
  function checkLoginState() {
    FB.getLoginStatus(  function(response) 
        { statusChangeCallback(response); }
        );
  }

  /* Chequea que el estado del objeto response sea "conectado" (determina si la persona
    realmente se conectó con facebook).
  */

 function statusChangeCallback(response) {
    if (response.status === 'connected') 
    {
        datosPersona();
    } 
    else {
      alert("not connected or not logged into facebook");
    }
  }

  /* Obtiene la información básica de usuario y la almacena en un formato JSON.
    asigna el objeto al contenido del id "user" (el que viene desde el fomulario que llamó)
    y llama al método submit() del id "fb" (el cual es nuestro formulario en sí).
  */

 function datosPersona(){
  FB.api(
    '/me', 'GET', {"fields":"email,first_name,last_name,id,gender"},
      function(response) {
        usrNombre = response.first_name;
        usrApellido =  response.last_name;     
        usrCorreo = response.email;
        usrID = response.id;

        var usuario = new User(usrNombre,usrApellido,usrCorreo,'');
        var usuarioJSON = JSON.stringify(usuario);
        $('#user').val(usuarioJSON);
        $('#fb').submit();
       
    }
  );
}

