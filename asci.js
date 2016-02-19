// function to validiate form input
function isValid(){
  if(document.getElementById("user_input").value == ""){
    alert("Please enter some emails or click the autofill button.");
    return false;
  } else if(!findEmail(document.getElementById("user_input").value)){
    alert("Please enter VALID emails or click the autofill button.");
    return false;
  }
  return true;
}

// will return true if input has at least one valid email, sample@example.com
function findEmail(string){
  // split text into array, account for multiple whitespace
  var temp = string.split(/\ +/);

  for (var i in temp){
    // regex for valid email
    if(/\S+@\S+\.\S+/.test(temp[i])){
      return true;
    }
  }
  return false;
}

// sample of 18 emails, 10 good, 8 bad
var sample_input = "bob@example.com fred@example.com suzy@example.com " +
                    "harry@test.com junk hank@hank.co.uk joe@fun.co.uk " +
                    "sally@america.edu        deyashwin@gmail.com goodshow " +
                    "   @     @@@..2..2..2   ok@.@ go@... . ReCipiENt@eXaMPle.cOm " +
                    " ReCipiENt@example.com localpart.ending.with.dot.@long.com";

// function to generate sample input
function autoFillEmails(){
  document.getElementById('user_input').value = sample_input;
  return false;
}
