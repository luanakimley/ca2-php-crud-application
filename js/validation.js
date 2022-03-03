function amountValidation() {
  let amount = document.getElementById("amount").value;
  let regex = /^[1-9]\d*(\.\d+)?$/;

  if (amount < 0 || !amount.match(regex)) {
    document.getElementById("amountError").innerHTML =
      "Amount must be a positive number";
    return false;
  } else {
    document.getElementById("amountError").innerHTML = "";
    return true;
  }
}

function paymentTypeValidation() {
  let debitCard = document.getElementById("debitCard").checked;
  let creditCard = document.getElementById("creditCard").checked;
  let cash = document.getElementById("cash").checked;

  if (!debitCard && !creditCard && !cash) {
    document.getElementById("paymentTypeError").innerHTML =
      "You must select a payment type";
    return false;
  } else {
    document.getElementById("paymentTypeError").innerHTML = "";
    return true;
  }
}

function dateValidation() {
  let date = document.getElementById("date").value;

  if (date === "") {
    document.getElementById("dateError").innerHTML = "You must select a date";
    return false;
  } else {
    document.getElementById("dateError").innerHTML = "";
    return true;
  }
}

function validate() {
  return {
    amount: amountValidation(),
    date: dateValidation(),
    paymentType: paymentTypeValidation(),
  };
}

function inputsAllValid() {
  const inputValid = validate();
  const valid = Object.keys(inputValid).every((index) => inputValid[index]);

  if (!valid) {
    document.getElementById("submitButton").disabled = true;
  } else {
    document.getElementById("submitButton").disabled = false;
  }
}
