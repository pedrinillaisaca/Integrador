

function distancia() {
    console.log("Pedro")
    window.onload = function() {
        init();
        doSomethingElse();
      };
      var input = document.getElementsByTagName("h3");
      var inputList = Array.prototype.slice.call(input);
      alert(inputList.length);
      for(i = 0;i < input.length; i++){
        ShowResults(i,input[i].innerHTML);
    }
}

function ShowResults(origen, value) {
    alert(origen + '---' + value);
 } 