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
function generateKeyRequest() {
    var type = document.getElementById("accountSelection").value - 1;
    var object = {_type: type};
    var obj = "obj=" + JSON.stringify(object);
    var request = new XMLHttpRequest();
    var url = "key_generator.php";
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            //Auto-populating textarea for message to be edited and sent.
            var message_data = "Hi, you have been invited to join MJM consulting... etc. Your registration key is " + request.responseText + ". You can also visit 10.178.40.49/branch/MJM-Tax-Services/signup.php?key=" + request.responseText;
            document.getElementById("key").value = return_data;
            document.getElementById("message").value = message_data;
        }
    }
    
    request.send(obj);
}
