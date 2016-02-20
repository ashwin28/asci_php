<!DOCTYPE html>
<html>
<head>
  <title>Parsed Email Output</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="asci_style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<script>
  $(document).ready(function(){
    $(".nav-tabs a").click(function(){
      $(this).tab('show');
    });
  });
</script>

<body>
  <?php
    // variables to store valid and invalid emails
    $domainNames = array();
    $inValidEmails = array();

    // get user input and split it into an array
    $userInputArray = preg_split('/[\s]+/', $_POST['userInput']);

    // loop through all emails and get unique domain names  
    foreach($userInputArray as $value){
      // use library function to check for valid emails
      if(filter_var($value, FILTER_VALIDATE_EMAIL)){
        // get everything after the @ sign and change to lowercase
        $temp = strtolower(explode('@', $value)[1]);
        // set new count or add to existing count
        array_key_exists($temp, $domainNames) ? $domainNames[$temp] += 1 : $domainNames[$temp] = 1;
      }else{
        // set new count or add to existing count
        array_key_exists($value, $inValidEmails) ? $inValidEmails[$value] += 1 : $inValidEmails[$value] = 1;
      }
    }
  ?>

  <div class="container">
    <h2>Unique Domain Names</h2>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1">Default</a></li>
      <li><a href="#tab2">Sorted</a></li>
      <li><a href="#tab3">Invalid</a></li>
    </ul>

    <div class="tab-content">
      <div id="tab1" class="tab-pane fade in active">
        <h3>Unsorted List:</h3>
        <ul class="email-list">
        <?php
          // output valid domain names
          foreach($domainNames as $key => $value){
            echo "<li>" . $key . '<span>(count: ' . $value . ')</span></li>';
          }
        ?>
        </ul>
      </div>
      <div id="tab2" class="tab-pane fade">
        <h3>Alphabetical order:</h3>
        <ul class="email-list">
        <?php
          // sort and output valid domain names
          ksort($domainNames);
          foreach($domainNames as $key => $value){
            echo "<li>" . $key . '<span>(count: ' . $value . ')</span></li>';
          }
        ?>
        </ul>
      </div>
      <div id="tab3" class="tab-pane fade">
        <h3>Invalid Emails:</h3>
        <ul class="email-list">
        <?php
          // output invalid domain names
          foreach($inValidEmails as $key => $value){
            echo "<li>" . $key . '</li>';
          }
        ?>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>