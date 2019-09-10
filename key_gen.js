function generateKeyRequest() {
    var type = document.getElementById("accountSelection").value;
    var object = {_type: type};
    var obj = "obj=" + JSON.stringify(object);
    var request = new XMLHttpRequest();
    var url = "key_generator.php";
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            document.getElementById("key").value = return_data;
        }
    }
    
    request.send(obj);
}
