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

// Functions that deal with the user list and file tables
// Only available to admin users

// Ask for confirmation before deleting
function startDelete(div, userId) {
  div.innerHTML = "Confirm";
  div.onclick = function() { deleteUser(div, userId); };
}

// AJAX call to delete the specified user (userId)
function deleteUser(div, userId) {
  var request = new XMLHttpRequest();
  var obj = "obj=" + userId.toString();
  var url = "deleteUser.php"
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
          div.innerHTML = "Deleted";
          div.style.backgroundColor = "gray";
          div.onclick = function() {};
          getFiles(0);
      }
  }
  request.send(obj);
}

// Ask for confirmation before deleting file
function startDeleteFile(button, fileId) {
  button.style.backgroundColor = "#CD6053";
  button.onclick = function() { deleteFile(fileId); };
}

// AJAX call to delete specified file (fileId)
function deleteFile(fileId) {
  var request = new XMLHttpRequest();
  var obj = "obj=" + fileId.toString();
  var url = "deleteFile.php"
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
          getFiles(user_id);
      }
  }
  request.send(obj);
}

// AJAX call to retrieve information about specified user (userId)
function displayInfo(userId) {
  var request = new XMLHttpRequest();
  var obj = "obj=" + userId.toString();
  var url = "userInfo.php"
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
          var holder = document.createElement("div");
          holder.className = "infoHolder";
          holder.id = "holder";
          holder.innerHTML = request.responseText;
          document.body.appendChild(holder);
      }
  }
  request.send(obj);
}

// Close the information box when the X is clicked
function removeInfo() {
  var holder = document.getElementById("holder");
  holder.innerHTML = "";
  holder.parentNode.removeChild(holder);
}
