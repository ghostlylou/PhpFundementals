<input type="text" id="input" name="input" oninput="pressHandler(this.value)">
<p id="error"></p>
<button type="submit" id="submit">Search</button>


<script>
    let error = document.getElementById("error");
    let sButton = document.getElementById("submit");
    let inputField = document.getElementById("input");

    var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    let array = ['1','2','3','4','5','6','7','8','9','0']
    let inputArray;

    function pressHandler(){
        //inputArray = Array.from(inputField.value).forEach(checkRegex);
        checkEmail();
    }

    function checkEmail(){
        if(!inputField.value.match(pattern)){
            error.innerHTML = "yes";
            sButton.disabled = true;
        }
        else{
            error.innerHTML = " ";
            sButton.disabled = false;
        }
    }

    // function checkRegex(value){
    //     if(!array.includes(value)){
    //         error.innerHTML = "You can only put in numbers";
    //         sButton.disabled = true;
    //     }
    //     else{
    //         error.innerHTML = " ";
    //         sButton.disabled= false;
    //     }
    // }
</script>