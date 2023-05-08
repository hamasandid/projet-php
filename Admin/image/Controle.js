function validateForm() {
  console.log("validateForm called");
    var NomF = document.getElementById("NomF").value;
    var Desc = document.getElementById("descriptionn").value;


  
  
    var NomFError = document.getElementById("nomf-error");
    var DescError = document.getElementById("desc-error");

  
    var isValid = true;
  
    // Validate nom film
    if (NomF.length < 3) {
      NomFError.innerHTML = "Nom Film must be at least 3 characters";
      isValid = false;
    } else {
      NomFError.innerHTML = "";
    }


     // Validate description
     if (Desc.length < 10) {
      DescError.innerHTML = "Description must be at least 10 characters";
      isValid = false;
    } else {
      DescError.innerHTML = "";
    }   



    return isValid;
  }
  