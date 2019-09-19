/*
MJM Tax Services
This software is a management system for tax-related documents, used by tax consultants and their clients.
Copyright (C) 2019 Marcus Hershberger and Tyler Snodderly

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
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
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,25})");
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

function valEmail() {
    var email = document.getElementById("email").value;
    var regex = new RegExp("[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$");

    if (regex.test(email)) {
        document.getElementById("email").style.borderColor = "green";
    } else {
        document.getElementById("email").style.borderColor = "red";
    }
}

//TODO: Maybe instead of button, make an eye with slash through it.
function showPass() {
    var passwordInput = document.getElementById('pass');
    var passwordInput2 = document.getElementById('passVerif');


    if (passwordInput.type === "password"){
        passwordInput.type = "text";
        passwordInput2.type = "text";

    }
    else {
        passwordInput.type = "password";
        passwordInput2.type = "password";
    }
}
