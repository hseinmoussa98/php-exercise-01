<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
</head>
 
<body>
<?php

    
        if(!empty($_POST)) {
        
            function test_input($data) 
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $salary = test_input($_POST["salary"]);
            $free = test_input($_POST["free"]);
            $radiotype = test_input($_POST["radiotype"]);
            $Tax_amount=0;
        
            if ($radiotype=="Yearly")
        {
            $salary_per_year=$salary;
            $salary_per_month=$salary/12;
            $free_per_year=$free;
            $free_per_month=$free/12;
        }
        if ($radiotype=="Monthly")
        {
            $salary_per_year=$salary*12;
            $salary_per_month=$salary;
            $free_per_year=$free*12;
            $free_per_month=$free;
        }
        if($salary_per_year<10000)
        {
            $final_salary_per_year=$salary_per_year +$free_per_year;
            $final_salary_per_month=$salary_per_month +$free_per_month;
        }
        else
        {$social_security+=0.04*$salary_per_year;

            if($salary_per_year>=10000 && $salary_per_year<25000)
            {   $Tax_amount+=0.11*$salary_per_year;
                $final_salary_per_year=$salary_per_year +$free_per_year-$Tax_amount-$social_security;
                $final_salary_per_month=$salary_per_month +$free_per_month-$Tax_amount/12-$social_security/12;
            }
            if($salary_per_year>=25000 && $salary_per_year<50000)
            {   $Tax_amount+=0.3*$salary_per_year;
                $final_salary_per_year=$salary_per_year +$free_per_year-$Tax_amount-$social_security;
                $final_salary_per_month=$salary_per_month +$free_per_month-$Tax_amount/12-$social_security/12;
            }
            if($salary_per_year>=50000)
            {   $Tax_amount+=0.45*$salary_per_year;
                $final_salary_per_year=$salary_per_year +$free_per_year-$Tax_amount-$social_security;
                $final_salary_per_month=$salary_per_month +$free_per_month-$Tax_amount/12-$social_security/12;
            }
        }
        echo"<div class='here'>";
        echo"<table>";
        echo "<tr><th> </th>";
        echo "<th> Yearly </th>";
        echo "<th> Monthly </th></tr>";

        echo "<tr><th> Total salary </th>";
        echo "<th>". $salary_per_year ."</th>";
        echo "<th> ".$salary_per_month." </th></tr>";

        echo "<tr><th> Tax amount </th>";
        echo "<th>".$Tax_amount ." </th>";
        echo "<th>".$Tax_amount/12 ."</th></tr>";

        echo "<tr><th> Social security fee </th>";
        echo "<th>".$social_security ."</th>";
        echo "<th>".$social_security/12 . "</th></tr>";

        echo "<tr><th> Salary after tax </th>";
        echo "<th>".$final_salary_per_year."</th>";
        echo "<th>".$final_salary_per_year/12 ."</th></tr>";
        echo"</table>";
        echo"</div>";
        exit;
        }
    
?>
  <div id="container">
    <form method="post" action="" id="contactform">
      <div >
        <label for="salary">Salary:</label>
        <input type="number"  placeholder="Enter your salary in USD"  name="salary" id="salary"><br/>
      </div>
      <div >
        <input type="radio" name="radiotype" class="radiotype" value="Yearly"> Yearly
        <input type="radio" name="radiotype" class="radiotype" value="Monthly" > Monthly<br/>
      </div>
      <div >
        <label for="free">Tax Free Allowance:</label>
        <input type="number" id="free" placeholder="Enter Tax Free Allowance in USD" name='free' ><br/>
      </div>
      <input type="submit" class="btn" value="Submit">
    </form>
    <div id="ajax_id"></div>
 
  
  </div>
</body>

<script>
  $(document).ready(function () {
    $('.btn').click(function (e) {
      e.preventDefault();
      var free = $('#free').val();
      var radiotype = $('.radiotype:checked').val();
      var salary = $('#salary').val();
      $.ajax
        ({
          type: "POST",
          url: "index.php",
          data: { "free": free, "radiotype": radiotype, "salary": salary },
          success: function (data) {
            $('#ajax_id').html(data);
           
          }
        });
    });
  });
</script>
 
</html>
