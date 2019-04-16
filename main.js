const SEC_QUESTIONS = 3;
var chosenQuestions = [,,];

function populateStateDropdown() {
    var states = ['AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','CD','TN','TX','UT','VT','VA','WA','WV','WI','WY'];
    var dropdown = document.getElementById("state");
    for (var i = 0; i < states.length; i++) {
        dropdown.options[i+1] = new Option(states[i], states[i]);
    }
}

function removeSelections(val, id) {
    var id_num = parseInt(id);
    chosenQuestions[id-1] = val;
    for (var i = 1; i <= SEC_QUESTIONS; i++) {
        var select = document.getElementById(i.toString());
        for (var j = 1; j < select.options.length; j++) {
            select.options[j].disabled = chosenQuestions.includes(j.toString());
        }
    }
}

function comparePassword() {
    var pass = document.getElementById("pass").value;
    var passVerif = document.getElementById("passVerif").value;
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    //Password must contain: 1 lowercase, 1 uppercase, 1 number, one special character, must be 8 characters long

    if (strongRegex.test(pass)) {
        document.getElementById("pass").style.borderColor = "green";
        document.getElementById("passVerif").style.borderColor = "green";
        if (pass == passVerif) {
            document.getElementById("pass").style.borderColor = "green";
            document.getElementById("passVerif").style.borderColor = "green";

        } else {
            document.getElementById("pass").style.borderColor = "red";
            document.getElementById("passVerif").style.borderColor = "red";
        }
    } else {
        document.getElementById("pass").style.borderColor = "red";
        document.getElementById("passVerif").style.borderColor = "red";
    }
}

//TODO: Not working.
/*function showPass() {
    var passwordInput = document.getElementById('pass').value;

    if (passwordInput.type == 'password'){
        passwordInput.type='text';

    }
    else{
        passwordInput.type='password';
    }
    }
}*/
