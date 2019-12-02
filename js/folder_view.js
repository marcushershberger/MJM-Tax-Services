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

// These functions deal with AJAX calls for dynamic content changes

var user_id = 0;

// Get files for a specified user (id)
function getFiles(id) {
  user_id = id;
  getActivities(id);
  var request = new XMLHttpRequest();
  // If id is 0, get all user folders instead of files
  var obj = "obj=" + id.toString();
  var url = id == 0 ? "folder_view.php" : "file_view.php";
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("files").innerHTML = return_data;
      }
  }
  request.send(obj);
}

// Get year folders for a specified user (id)
function getYearFolders(id) {
  getActivities(id);
  user_id = id;
  var request = new XMLHttpRequest();
  var obj = "obj=" + id.toString();
  var url = "year_folder_view.php";
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("files").innerHTML = return_data;
      }
  }
  request.send(obj);
}

// Get recent activites log for specified user
function getActivities(id) {
  var request = new XMLHttpRequest();
  var obj = "obj=" + id.toString();
  // If id is 0, get recent activity log for all users.
  var url = id == 0 ? "user_activity_all.php" : "user_activity.php";
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("activity").innerHTML = return_data;
      }
  }
  request.send(obj);
}
