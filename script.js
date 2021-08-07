let action = document.querySelector("#action_operator");
let operator_fields = document.querySelector(".operator_fields");
let operator = document.getElementById("operator_id");

function HideOperator() {
    let selind = document.getElementById("action_operator").options.selectedIndex;
    if (action.options[selind].value == 1) {
        operator.style.display = "block";
        operator_fields.style.display = "block";
    } else if (action.options[selind].value == 0) {
        operator.style.display = "none";
        operator_fields.style.display = "block";
    } else if (action.options[selind].value == 2) {
        operator.style.display = "block";
        operator_fields.style.display = "none";
    }
}

action.onchange = function () {
    HideOperator();
}


let action_user = document.querySelector("#action_user");
let user_fields = document.querySelector(".user_fields");
let user = document.getElementById("id_user");

function HideUser() {
    let selind = document.getElementById("action_user").options.selectedIndex;
    if (action_user.options[selind].value == 1) {
        user.style.display = "block";
        user_fields.style.display = "block";
    } else if (action_user.options[selind].value == 0) {
        user.style.display = "none";
        user_fields.style.display = "block";
    } else if (action_user.options[selind].value == 2) {
        user.style.display = "block";
        user_fields.style.display = "none";
    }
}

action_user.onchange = function () {
    HideUser();
}

let action_calls = document.querySelector("#action_calls");
let calls_fields = document.querySelector(".calls_fields");
let call = document.getElementById("id_calls");

function HideCalls() {
    let selind = document.getElementById("action_calls").options.selectedIndex;
    if (action_calls.options[selind].value == 1) {
        call.style.display = "block";
        calls_fields.style.display = "block";
    } else if (action_calls.options[selind].value == 0) {
        call.style.display = "none";
        calls_fields.style.display = "block";
    } else if (action_calls.options[selind].value == 2) {
        call.style.display = "block";
        calls_fields.style.display = "none";
    }
}

action_calls.onchange = function () {
    HideCalls();
}