<!--
 - This project allows the user to register multiple students for school.
 - 
 - Names: Nathanael Nading
 -        Aaron Adams
 -        Zakariya Sh-Adam
 - Date:  April 15, 2020
-->

<html>

<head>
  <link rel="stylesheet" href="index.css">
  <title>Student Registration Form</title>
</head>

<body>
  <center>
    <h3>STUDENT REGISTRATION FORM</h3>

    <div id="message">
      <?php
        if (array_key_exists('message', $_GET)) {
          echo str_replace('<', '', $_GET['message']);
        }
      ?>
    </div>

    <form action='addToDatabase.php' method='post'>
      <table align="center" cellpadding="10">

        <!----- First Name ---------------------------------------------------------->
        <tr>
          <td>FIRST NAME</td>
          <td><input type="text" name="First_Name" maxlength="30" />
            *(max 30 characters a-z and A-Z)
          </td>
        </tr>

        <!----- Last Name ---------------------------------------------------------->
        <tr>
          <td>LAST NAME</td>
          <td><input type="text" name="Last_Name" maxlength="30" />
            *(max 30 characters a-z and A-Z)
          </td>
        </tr>

        <!----- Date Of Birth -------------------------------------------------------->
        <tr>
          <td>DATE OF BIRTH</td>

          <td>
            <select name="Birthday_Day" id="Birthday_Day">
              <option value="-1">Day:</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>

              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>

              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>

              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>

              <option value="31">31</option>
            </select>

            <select id="Birthday_Month" name="Birthday_Month">
              <option value="-1">Month:</option>
              <option value="January">Jan</option>
              <option value="February">Feb</option>
              <option value="March">Mar</option>
              <option value="April">Apr</option>
              <option value="May">May</option>
              <option value="June">Jun</option>
              <option value="July">Jul</option>
              <option value="August">Aug</option>
              <option value="September">Sep</option>
              <option value="October">Oct</option>
              <option value="November">Nov</option>
              <option value="December">Dec</option>
            </select>

            <select name="Birthday_Year" id="Birthday_Year">
              <option value="-1">Year:</option>
              <?php
                for ($i = date("Y"); $i >= 1945; $i--) {
                  echo "<option value=" . $i . ">" . $i . "</option>";
                }
              ?>
            </select>
          </td>
        </tr>

        <!----- Email Id ---------------------------------------------------------->
        <tr>
          <td>EMAIL ID</td>
          <td><input type="text" name="Email_Id" maxlength="100" /></td>
        </tr>

        <!----- Mobile Number ---------------------------------------------------------->
        <tr>
          <td>MOBILE NUMBER</td>
          <td>
            <input type="text" name="Mobile_Number" maxlength="10" />
            (10 digit number)
          </td>
        </tr>

        <!----- Gender ----------------------------------------------------------->
        <tr>
          <td>GENDER</td>
          <td>
            Male <input type="radio" name="Gender" value="Male" />
            Female <input type="radio" name="Gender" value="Female" />
          </td>
        </tr>

        <!----- Address ---------------------------------------------------------->
        <tr>
          <td>ADDRESS <br /><br /><br /></td>
          <td><textarea name="Address" rows="4" cols="30"></textarea></td>
        </tr>

        <!----- City ---------------------------------------------------------->
        <tr>
          <td>CITY</td>
          <td><input type="text" name="City" maxlength="30" />
            (max 30 characters a-z and A-Z)
          </td>
        </tr>

        <!----- State ---------------------------------------------------------->
        <tr>
          <td>STATE</td>
          <td><input type="text" name="State" maxlength="2" />
            (must be 2 characters long)
          </td>
        </tr>

        <!----- Zip Code ---------------------------------------------------------->
        <tr>
          <td>ZIP CODE</td>
          <td><input type="text" name="Zip_Code" maxlength="6" />
            (6 digit number)
          </td>
        </tr>

        <!----- Country ---------------------------------------------------------->
        <tr>
          <td>COUNTRY</td>
          <td>
            <select name='Country'>
              <option value='-1'>Country</option>
              <option value='The United States of America'>The United States of America</option>
              <option value='Canada'>Canada</option>
            </select>
          </td>
        </tr>

        <!----- Courses ---------------------------------------------------------->
        <tr>
          <td>COURSES</td>
          <td>
            <input type='checkbox' name='Courses[]' value='BSAD 127'>BSAD 127</input>
            <input type='checkbox' name='Courses[]' value='CHEM 107'>CHEM 107</input>
            <input type='checkbox' name='Courses[]' value='COLL 100'>COLL 100</input>
            <input type='checkbox' name='Courses[]' value='COMM 100'>COMM 100</input>
            <input type='checkbox' name='Courses[]' value='CSIS 110'>CSIS 110</input>
            <input type='checkbox' name='Courses[]' value='CSIS 115'>CSIS 115</input>
            <input type='checkbox' name='Courses[]' value='CSIS 123'>CSIS 123</input>
            <input type='checkbox' name='Courses[]' value='CSIS 128'>CSIS 128</input>
            <input type='checkbox' name='Courses[]' value='CSIS 143'>CSIS 143</input>
            <input type='checkbox' name='Courses[]' value='CSIS 152'>CSIS 152</input>
            <input type='checkbox' name='Courses[]' value='CSIS 161'>CSIS 161</input>
            <input type='checkbox' name='Courses[]' value='CSIS 170'>CSIS 170</input>
            <input type='checkbox' name='Courses[]' value='CSIS 222'>CSIS 222</input>
            <input type='checkbox' name='Courses[]' value='CSIS 223'>CSIS 223</input>
            <input type='checkbox' name='Courses[]' value='CSIS 228'>CSIS 228</input>
            <input type='checkbox' name='Courses[]' value='CSIS 279'>CSIS 279</input>
            <input type='checkbox' name='Courses[]' value='CSIS 290'>CSIS 290</input>
            <input type='checkbox' name='Courses[]' value='ENGL 101'>ENGL 101</input>
            <input type='checkbox' name='Courses[]' value='ENGL 215'>ENGL 215</input>
            <input type='checkbox' name='Courses[]' value='ENGL 218'>ENGL 218</input>
            <input type='checkbox' name='Courses[]' value='HIST 121'>HIST 121</input>
            <input type='checkbox' name='Courses[]' value='MATH 120'>MATH 120</input>
          </td>
        </tr>

        <!----- Submit and Reset ------------------------------------------------->
        <tr>
          <td colspan="2" align="center">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
          </td>
        </tr>
      </table>
    </form>
    <script src='index.js'></script>
</body>

</html>