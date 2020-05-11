/**
 * This project allows the user to register multiple students for school.
 * 
 * Names: Nathanael Nading
 *        Aaron Adams
 *        Zakariya Sh-Adam
 * Date:  April 15, 2020
 */

var entries = []; // holds the user's list of entries
var form = document.getElementsByTagName("form")[0]; // holds the student registration form
var successMessage = document.getElementById("submitSuccess"); // used to display a success message when the
                                                               // user successfully submits an entry
// a list of state abbreviations
var states = ['AL', 'MO', 'AK', 'MT', 'AZ', 'NE', 'AR', 'NV', 'CA', 'NH', 'CO', 'NJ', 'CT', 'NM', 'DE', 'NY', 'DC', 'NC', 'FL', 'ND', 'GA', 'OH', 'HI', 'OK', 'ID', 'OR', 'IL', 'PA', 'IN', 'RI', 'IA', 'SC', 'KS', 'SD', 'KY', 'TN', 'LA', 'TX', 'ME', 'UT', 'MD', 'VT', 'MA', 'VA', 'MI', 'WA', 'MN', 'WV', 'MS', 'WI', 'WY'];

// when the window loads, add the years from the current year to 1945 as options to the Birthday_Year select element
window.addEventListener('load', (event) => {
  const options = document.getElementById('Birthday_Year');
  let option;

  for (let counter = new Date().getFullYear(); counter >= 1945; counter--) {
    option = document.createElement('option');
    option.value = counter;
    option.textContent = counter;

    options.appendChild(option);
  }
});

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

/**
 * removes the birthday fields from the entry and adds in a new, formatted birthday field
 * @param {Array} entry a list of fields from the form
 * @returns {Array} the list of fields from the form with formatted birthday fields (if applicable)
 */
function formatBirthday(entry) {
  // the submitted fields which are a part of the birthday information
  var dateInfo = entry.filter(field => {
    return field.name === "Birthday_day" || field.name === "Birthday_Month" || field.name === "Birthday_Year";
  });

  // if there are birthday fields, then check which birthday fields there are
  if (dateInfo.length > 0) {
    // if all of the birthday fields are provided, then add all of the birthday information to the entry
    if (dateInfo.length === 3) {
      entry.push({ name: "Birthday", value: `${dateInfo[1].value} ${dateInfo[0].value}, ${dateInfo[2].value}` });
    } else if (dateInfo[0].name === "Birthday_day" && dateInfo[1].name === "Birthday_Month") { // if the birth day and birth month are provided, then format them and add them to the entry
      entry.push({ name: "Birthday", value: `${dateInfo[1].value} ${dateInfo[0].value}` });
    } else if (dateInfo[0].name === "Birthday_Month" && dateInfo[1].name === "Birthday_Year") { // if the birth month and birth year are provided, then format them and add them to the entry
      entry.push({ name: "Birthday", value: `${dateInfo[0].value}, ${dateInfo[1].value}` });
    }
  }

  // remove the birthday fields from the entry
  entry = entry.filter(field => {
    return field.name !== "Birthday_day" && field.name !== "Birthday_Month" && field.name !== "Birthday_Year"
  });

  return entry;
}

// when the submit button is clicked, check the submitted form fields and ensure they include the required fields
// if they do, then allow the form to submit; otherwise, prevent the form from submitting, display an error message,
// and remove the successful submit message
document.querySelector("input[type=submit]").addEventListener("click", (event) => {
  var errorMessage = ensureRequirementsAreMet(Object.entries(event.srcElement.form.elements).map(element => element[1]));

  if (errorMessage !== "Error: not all of the required fields were provided.") {
    event.preventDefault();
    window.alert(errorMessage);
    successMessage.innerHTML = "";
  }
});

// when the form has been subitted and the correct fields have been provided, remove the empty fields, format
// the birthday field, add the entry to the entries list, clear the form, and display a successful submission message
form.addEventListener("submit", (event) => {
  event.preventDefault();

  var entry = Object.entries(event.srcElement.elements).filter((element) => {
    // if the field has a value, it can continue along the chain of checks
    if (element[1].value !== "" && element[1].value !== "-1" && element[1].name !== "") {
      // the field "Gender" is a checkbox; since checkboxes always have a value, this checks if the checkbox is checked
      return element[1].name !== "Gender" || element[1].checked;
    }
    // if the field does not have a value, then remove it from the entries
    return false;
  }).map(element => {
    // returns an easier to use version of the field
    return { name: element[1].name, value: element[1].value };
  });

  entry = formatBirthday(entry);

  entries.push(entry);

  document.querySelector("input[type=reset]").click();
  successMessage.innerHTML = "Entry Submitted Successfully";
});

// when all of the entries are submitted, a final entry is added if there are any fields with a value,
// the entries are checked to see if there are any, and the entries are displayed to the user
document.getElementById("submitAll").addEventListener("click", (event) => {
  // the errorMessage used for the ensureRequirementsAreMet function
  var errorMessage = "Error: not all of the required fields were provided.";

  event.preventDefault();

  var entry = Object.entries(event.srcElement.form.elements).filter((element) => {
    // if the field has a value, it can continue along the chain of checks
    if (element[1].value !== "" && element[1].value !== "-1" && element[1].name !== "") {
      // the field "Gender" is a checkbox; since checkboxes always have a value, this checks if the checkbox is checked
      return element[1].name !== "Gender" || element[1].checked;
    }
    // if the field does not have a value, then remove it from the entries
    return false;
  }).map(element => {
    // returns an easier to use version of the field
    return { name: element[1].name, value: element[1].value };
  });

  entries.push(formatBirthday(entry));

  // if the final entry has no completed fields, then the user just wants to submit the already created entries, so the last entry is deleted
  if (entries[entries.length - 1].length === 0) {
    entries.pop();
  } else { // if the final entry has completed fields, ensure they include the required fields
    errorMessage = ensureRequirementsAreMet(Object.entries(event.srcElement.form.elements).map(element => element[1]));
  }

  // if not all of the required fields were filled, display an error message
  if (errorMessage !== "Error: not all of the required fields were provided.") {
    entries.pop();
    window.alert(errorMessage);
    successMessage.innerHTML = "";
  } else if (entries.length === 0) { // if there have been no entries submitted, display an error message
    window.alert("Error: no entries have been submitted.");
    successMessage.innerHTML = "";
  } else { // if the required fields were filled format and display the entries
    var entriesString = "";
    // fills the entries string with a formatted version of the submitted entries
    entries.forEach(entry => {
      entry.forEach((field) => {
        entriesString += `<div style='font-family:TimesNewRoman;color:grey;font-size:11pt;font-style:normal;font-weight:bold;text-align:center;background-color:lightskyblue;'>
            ${field.name.replace("_", " ")}: ${field.value}
            </div>`;
      });
      entriesString += "<br />";
    });

    // display the entries string as HTML
    document.write(entriesString);
    document.getElementsByTagName('html')[0].style.backgroundColor = 'gray';
  }
});
