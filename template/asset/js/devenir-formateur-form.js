
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.\- ]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

jQuery.validator.addMethod("telephone", function(value, element) {
    return this.optional(element) || /^\+?[0-9]*$/i.test(value);
}, "");

  $(".devenir-formateur-form").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      dvnom:{
          required:true,
          minlength: 1,
          maxlength:50,
          alphanumeric:true,
      },
      dvprenom:{
          required:true,
          minlength: 1,
          maxlength:50,
          alphanumeric:true,
      },
      dvadresse:{
          maxlength:50,
          alphanumeric:true,
          required:true,
      },
      dvcodep:{
          maxlength:20,
          digits:true,
          required:true,
      },
     
      dvtel:{
            maxlength:15,
            required:true,
            telephone:true,

      },
      dvpays:{
          maxlength:50,
          required:true,
      },
      dvsiret:{
          maxlength:15,
          required:false,
          digits:true
      },
      dviban:{
          maxlength:34,
          required:true,
          alphanumeric:true
      },
      dvbic:{
          maxlength:11,
          required:true,
          alphanumeric:true
      },
      dventreprise:{
        maxlength:100,
        required:true,
        alphanumeric:true
      },
      dvfile:{
        required:true
      }

  
      
    },
    // Specify validation error messages
    messages: {
      dvnom:{
        maxlength: "Votre nom doit faire au maximum 50 caractères",
        required:"Veuillez remplir ce champs",
        alphanumeric: "Votre nom doit contenir que des lettres ou chiffres ou des tirets"
      },
      dvprenom:{
        maxlength: "Votre prénom doit faire au maximum 50 caractères",
        required:"Veuillez remplir ce champs",
        alphanumeric: "Votre prénom doit contenir que des lettres ou chiffres ou des tirets"
      },
      dvadresse:{
        maxlength: "Votre adresse doit faire au maximum 100 caractères",
        alphanumeric: "Votre adresse doit contenir que des lettres ou chiffres",
        required:"Veuillez remplir ce champs",
      },
      dvcodep:{
        maxlength: "Votre code postal doit faire au maximum 20 caractères",
        digits: "Votre code postal doit contenir que des chiffres",
        required:"Veuillez remplir ce champs",
      },
     
      dvtel:{
          telephone:'Numéro incorrect (Caractères acceptés : nombres et "+")',
          required:"Veuillez remplir ce champs",
          maxlength:"Votre numéro de téléphone doit faire au maximum 15 caractères",
      },
      dvpays:{
          maxlength:"Votre pays doit faire au maximum 50 caractères",
          required:"Veuillez remplir ce champs",
      },
      dvsiret:{
          maxlength:"Votre siret doit contenir au maximum 15 caractères",
          
          digits:"Votre siret ne doit contenir que des chiffres",

      },
      dvfile:{
        required:"Veuillez remplir ce champs",
      },
      dviban:{
          maxlength:"Votre iban doit contenir au maximum 34 caractères",
          required:"Veuillez remplir ce champs",
          alphanumeric:"Votre iban ne doit contenir que des chiffres et des lettres",
      },
      dvbic:{
           maxlength: "Votre bic doit contenir au maximum 11 caractères",
           required:"Veuillez remplir ce champs",
           alphanumeric:"Votre BIC ne doit contenir que des chiffres et des lettres"
      },
      dventreprise:{
        maxlength: "Le nom de votre entreprise doit contenir maximum 100 caractères",
        required:"Veuillez remplir ce champs",
        alphanumeric: "Le nom de votre entreprise doit contenir que des lettres ou chiffres ou des tirets",
     }
      

      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });

  let statutLegal = document.getElementById('dvtype');
  let siretBtn = document.getElementById('siret');
  let entrepriseNom = document.getElementById('entreprise-nom');
  let dvfile = document.getElementById('dvfile-label');

  statutLegal.addEventListener('change',()=>{
      if(statutLegal.value == 'Particulier')
          dvfile.innerHTML =  'Votre pièce d\'identité recto/verso (jpg,jpeg,png,pdf) 3MB<span class = "required">*</span>';
      if(statutLegal.value == 'Professionnel')
          dvfile.innerHTML =  'Votre extrait K-Bis (jpg,jpeg,png,pdf) 3MB<span class = "required">*</span>';
      if(statutLegal.value == 'Auto-entrepreneur')
          dvfile.innerHTML =  'Votre pièce d\'identité recto/verso ou Extrait K (jpg,jpeg,png,pdf) 3MB<span class = "required">*</span>';

      if(statutLegal.value == 'Professionnel' || statutLegal.value == 'Auto-entrepreneur'){
            siretBtn.style.display = 'inline-block';
            entrepriseNom.style.display = 'inline-block';
      }
      
      else{
     
          siretBtn.style.display = 'none';
          entrepriseNom.style.display = 'none';
        }
        
     

  });