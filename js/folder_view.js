function getFiles(id) {
  getActivities(id);
  var request = new XMLHttpRequest();
  var obj = "obj=" + id.toString();
  var url = "file_view.php";
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

function getActivities(id) {
  var request = new XMLHttpRequest();
  var obj = "obj=" + id.toString();
  var url = "user_activity.php";
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
