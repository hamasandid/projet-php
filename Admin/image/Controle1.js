function validateForm() {
  console.log("validateForm called");
    var NomS = document.getElementById("NomS").value;
    var NbPlaces = document.getElementById("NbPlaces").value;

  

    var NomSError = document.getElementById("noms-error");
    var NbPlacesError = document.getElementById("nbP-error");

  
    var isValid = true;
  


    // Validate nom film
    if (NomS.length < 3) {
      NomSError.innerHTML = "Nom Film must be at least 3 characters";
      isValid = false;
    } else {
      NomSError.innerHTML = "";
    }


    // Validate nb places
    if (NbPlaces < 0 ) {
      NbPlacesError.innerHTML = "Places number must be Positive";
    isValid = false;
  } else {
    NbPlacesError.innerHTML = "";
  }

    return isValid;
  }
  