function showSuggestion(str) {
    if(str.length == 0){
        document.getElementById("suggestionBox").innerHTML = "";
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "autocomplete.php?q="+str, true);
    xhr.onload = function(){
        if(this.status == 200){
            document.getElementById("suggestionBox").innerHTML = this.responseText;
        }
    };
    xhr.send();
}