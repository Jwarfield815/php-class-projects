<?php
  $First_Name = $_POST["First_Name"]; // will always have a value
  $Last_Name = $_POST["Last_Name"]; // will always have a value

  $Birthday_Day = $_POST["Birthday_Day"];
  $Birthday_Month = $_POST["Birthday_Month"];
  $Birthday_Year = $_POST["Birthday_Year"];

  if ($Birthday_Day == '-1' || $Birthday_Month == '-1' || $Birthday_Year == '-1') {
    $Birthday = '';
  } else {
    $Birthday = $Birthday_Month . ' ' . $Birthday_Day . ', ' . $Birthday_Year;
  }
  
  $Email_Id = $_POST["Email_Id"]; // if unfilled, then it's an empty string
  $Mobile_Number = $_POST["Mobile_Number"]; // if unfilled, then it's an empty string

  if (array_key_exists('Gender', $_POST)) {
    $Gender = $_POST["Gender"];
  } else {
    $Gender = "";
  }

  $Address = $_POST["Address"]; // if unfilled, then it's an empty string
  $City = $_POST["City"]; // if unfilled, then it's an empty string
  $State = $_POST["State"]; // if unfilled, then it's an empty string
  $Zip_Code = $_POST["Zip_Code"]; // if unfilled, then it's an empty string
  $Country = $_POST["Country"]; // if unfilled, then it's '-1' (a string value)

  if (array_key_exists('Courses', $_POST)) {
    $Courses = $_POST["Courses"];
  } else {
    $Courses = [];
  }

  try {
    // add stuff to database
    // note: if any of the above values weren't supplied, they'll be either empty strings or -1, depending on
    // if they're from select statements or not. The only required fields are the first and last names. Finally, all of the
    // fields will at this point match their requirements, so you just have to focus on getting the fields
    // into the database and putting empty fields into the database correctly

    header('Location: index.php?message=Successfully+Submitted');
  } catch (Exception $error) {
    header('Location: index.php?message=' . $error -> getMessage());
  }
?>
