function populateStateDropdown() {
    var states = ['AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','CD','TN','TX','UT','VT','VA','WA','WV','WI','WY'];
    var dropdown = document.getElementById("state");
    for (var i = 0; i < states.length; i++) {
        dropdown.options[i+1] = new Option(states[i], states[i]);
    }
}
