// User point adding request
(function(window, document){

function updatePoints (points) {
    var span = this.parentNode.getElementsByClassName("userpoints-points")[0]
    span.innerHTML = points;
}

function request(url, callback) {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == XMLHttpRequest.DONE) {
            if (request.status != 200) {
                console.log('unsuccessful request');
                return;
            }

            var response = JSON.parse(request.responseText);

            if("undefined" !== typeof response.points) {
                callback(response.points);	
            } else if("undefined" !== typeof response.error) {
                console.log(response.error);
            }
        }
    }

    request.open("GET", url, true);
    request.send();
}

function addUserPoints() {
    var parent = this.parentNode,
        input = parent.getElementsByClassName("userpoints-input")[0],
        user_id = parent.getElementsByClassName("userpoints-user-id")[0];

    if(!Number.isInteger(+input.value) || +input.value <= 0) 
        return;

    request(
         "userpoints/"+user_id.value+"/add/"+input.value, 
         updatePoints.bind(this)
    );
}

var buttons = document.getElementsByClassName("userpoints-add-button");
for(var i=buttons.length;i--;) {
    buttons[i].addEventListener("click", addUserPoints);
}

})(window, document);
