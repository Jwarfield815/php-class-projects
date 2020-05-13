/**
 * This project allows the user to register students for school.
 * 
 * Names: Nathanael Nading
 *        Aaron Adams
 *        Zakariya Sh-Adam
 * Date:  April 15, 2020
 */

var form = document.getElementsByTagName("form")[0]; // holds the student registration form
var message = document.getElementById("message");       // used to display a message when the
                                                        // user submits an entry
// a list of state abbreviations
var states = ['AL', 'MO', 'AK', 'MT', 'AZ', 'NE', 'AR', 'NV', 'CA', 'NH', 'CO', 'NJ', 'CT', 'NM', 'DE', 'NY', 'DC', 'NC', 'FL', 'ND', 'GA', 'OH', 'HI', 'OK', 'ID', 'OR', 'IL', 'PA', 'IN', 'RI', 'IA', 'SC', 'KS', 'SD', 'KY', 'TN', 'LA', 'TX', 'ME', 'UT', 'MD', 'VT', 'MA', 'VA', 'MI', 'WA', 'MN', 'WV', 'MS', 'WI', 'WY'];

/**
 * takes the fields from the form and ensures the requirements are met, specifically:
 * the required fields (First_Name and Last_Name) are filled
 * the First_Name, Last_Name, City, and State fields are less than 30 characters and use only letters
 * the Mobile_Number field needs to be 10 numbers
 * the Pin_Code field needs to be 6 numbers
 * @param {Array} elements a list of the fields from the form
 * @returns {String} an error message; will be the default value if there is not an error
 */
function ensureRequirementsAreMet(elements) {
  // the message returned at the end of the function
  // if it has changed by the end, then one of the required fields were not filled
  var errorMessage = "Error: not all of the required fields were provided.";

  elements.forEach(element => {
    var { name, value } = element;

    // checks if it is one of the required fields and if the field has a value
    // if the required field is not filled, then it adds to the error message
    if (name === "First_Name" && value === "") {
      errorMessage += "\nYou must include a first name.";
    } if (name === "Last_Name" && value === "") {
      errorMessage += "\nYou must include a last name.";
    } if (errorMessage === 'Error: not all of the required fields were provided.') { // if all the required fields are filled, then we do more, lesser priority checks
      var numOfChars; // holds the number of alphabetical characters in the field
      var numOfNums; // holds the number of numerical characters in the field
      var lengthOfField = value.length || 0; // holds the length of the total field

      // it tries to set numOfChars to the number of alphabetical characters in the field;
      // however, if there are no alphabetical characters, then value.match()[0] will return null,
      // making the .length reference cause an error. Since the error means there are no alphabetical characters,
      // the numOfChars is set to 0
      try {
        var numOfChars = value.match(/^[A-Za-z]+$/)[0].length;
      } catch (e) {
        var numOfChars = 0;
      }

      // it tries to set numOfNums to the number of numerical characters in the field;
      // however, if there are no numerical characters, then value.match()[0] will return null,
      // making the .length reference cause an error. Since the error means there are no numeric characters,
      // the numOfNums is set to 0
      try {
        var numOfNums = value.match(/^[0-9]+$/)[0].length;
      } catch (e) {
        var numOfNums = 0;
      }


      if (name === "Pin_Code" && lengthOfField !== 6 && lengthOfField !== 0) {
        errorMessage = "Error: field Pin_Code must be 6 numbers.";
      } else if ((name === "Mobile_Number" || name === "Pin_Code") && numOfNums < lengthOfField) {
        errorMessage = `Error: field ${name} must use only numbers`;
      } else if (name === "Mobile_Number" && lengthOfField !== 10 && lengthOfField !== 0) {
        errorMessage = "Error: field Mobile Number must be 10 numbers.";
      } else if ((name === "First_Name" || name === "Last_Name" || name === "City") && value.length > 30) {
        errorMessage = `Error: field ${name} must have at least 30 characters.`;
      } else if ((name === "First_Name" || name === "Last_Name" || name === "City" || name === "State") && numOfChars < lengthOfField) {
        errorMessage = `Error: field ${name} must use only letters`;
      } else if (name === 'State' && value.length !== 2 && value.length > 0) {
        errorMessage = 'Error: field State must consist of 2 characters';
      } else if (name === 'State' && value.length === 2 && !states.some(state => state === value.toUpperCase())) {
        errorMessage = 'Error: field State must match a state abbreviation.';
      }
    }
  });

  return errorMessage;
}

// when the submit button is clicked, check the submitted form fields and ensure they include the required fields
// if they do, then allow the form to submit; otherwise, prevent the form from submitting, display an error message,
// and remove the (possibly) successful submit message
document.querySelector("input[type=submit]").addEventListener("click", (event) => {
  var errorMessage = ensureRequirementsAreMet(Object.entries(event.srcElement.form.elements).map(element => element[1]));

  if (errorMessage !== "Error: not all of the required fields were provided.") {
    event.preventDefault();
    window.alert(errorMessage);
    message.textContent = "";
  }
});
