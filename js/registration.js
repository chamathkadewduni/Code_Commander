document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Validation for First Name, Last Name, and Name with Initials (Only Text Allowed)
        const nameFields = ['fname', 'lname'];
        nameFields.forEach(field => {
            const input = document.getElementById(field);
            if (!/^[a-zA-Z ]+$/.test(input.value)) {
                alert(`Please enter only text for ${input.previousElementSibling.innerText}`);
                valid = false;
            }
        });

        // Validation for Phone Number (Positive Numbers Only, Length 10)
        const phoneInput = document.getElementById('phone');
        if (!/^\d{10}$/.test(phoneInput.value)) {
            alert('Please enter a 10-digit positive number for Phone Number');
            valid = false;
        }

        // Validation for National Identity Card No (Max Length 12, Format: 12 digits or 9 digits + 'v' or 'V')
        const nicInput = document.getElementById('nic');
        if (!/^(\d{12}|\d{9}[vV])$/.test(nicInput.value)) {
            alert('Please enter a valid National Identity Card No (12 digits or 9 digits + \'v\' or \'V\')');
            valid = false;
        }

        // Default Email Validation
        const emailInput = document.getElementById('email');
        if (!/^\S+@\S+\.\S+$/.test(emailInput.value)) {
            alert('Please enter a valid email address');
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
    
        var rdbSelf = document.getElementById("self");
        var rdbChild = document.getElementById("child");
        var rdgFor = document.getElementById("rdgFor");
        var rdgIsA = document.getElementById("rdgIsA");
        rdgFor.addEventListener("change", function(event) {
            var item = event.target.value;
            if(item=="child")
            {
                document.getElementById("rdgIsA").style = "display:none";
            }
            else if(item=="self")
            {
                document.getElementById("rdgIsA").style = "display:block";
            }
        });
        rdgIsA.addEventListener("change", function(event) {
            var item = event.target.value;
            const today=new Date();
            var currentYear = today.getFullYear();
            var currentMonth = (today.getMonth() + 1).toString().padStart(2, '0');
            var currentDate = today.getDate().toString().padStart(2, '0');
            
            if(item=="teacher"){
                var maxYear = currentYear - 16;
                document.getElementById("skillsContainer").style = "display:block";
            }
            else if(item=="student"){
                var maxYear = currentYear - 6;
                document.getElementById("skillsContainer").style = "display:none";
            }
                
            document.getElementById("dob").max = maxYear+"-"+currentMonth+"-"+currentDate;
            document.getElementById("dob").defaultValue = maxYear + "-01-01";
        });
        
});

        
        