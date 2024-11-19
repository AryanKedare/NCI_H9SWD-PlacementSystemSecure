function validatestudentForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var dob = document.getElementById('dob').value;
    var branch = document.getElementById('branch').value;
    var year = document.getElementById('year').value;
    var cpi = document.getElementById('cpi').value;
    var twelfth = document.getElementById('12p').value;
    var tenth = document.getElementById('10p').value;
    var pwd = document.getElementById('pwd').value;
    var phone = document.getElementById('phone').value;
    var degree = document.getElementById('degree').value;

    // Name validation
    if (!/^[a-zA-Z\s]+$/.test(name)) {
        alert("Name should contain only letters and spaces");
        return false;
    }

    // Email validation
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }

    // Date of birth validation
    var today = new Date();
    var birthDate = new Date(dob);
    var age = today.getFullYear() - birthDate.getFullYear();
    if (age < 17 || age > 27) {
        alert("Age should be between 17 and 27 years");
        return false;
    }

    // Branch validation
    if (branch === "") {
        alert("Please select a branch");
        return false;
    }

    // Year validation
    if (year < 2000 || year > 2100) {
        alert("Please enter a valid year of passing out");
        return false;
    }

    // CPI validation
    if (cpi < 0 || cpi > 10) {
        alert("CPI should be between 0 and 10");
        return false;
    }

    // 12th and 10th percentage validation
    if (twelfth < 0 || twelfth > 100 || tenth < 0 || tenth > 100) {
        alert("Percentage should be between 0 and 100");
        return false;
    }

    // Password validation
    if (pwd.length < 6) {
        alert("Password should be at least 6 characters long");
        return false;
    }

    // Phone number validation
    if (!/^\d{10}$/.test(phone)) {
        alert("Please enter a valid 10-digit phone number");
        return false;
    }

    // Degree validation
    if (degree === "") {
        alert("Please select a course");
        return false;
    }

    return true;
}

function validatecompanyForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var pwd = document.getElementById('pwd').value;
    var phone = document.getElementById('phone').value;
    var location = document.getElementById('location').value;
    var ceo = document.getElementById('ceo').value;
    var cto = document.getElementById('cto').value;
    var hr = document.getElementById('hr').value;
    var worth = document.getElementById('worth').value;
    var found = document.getElementById('found').value;
    var founder = document.getElementById('founder').value;

    // Name validation
    if (!/^[a-zA-Z0-9\s]+$/.test(name)) {
        alert("Company name should contain only letters, numbers, and spaces");
        return false;
    }

    // Email validation
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }

    // Password validation
    if (pwd.length < 8) {
        alert("Password should be at least 8 characters long");
        return false;
    }

    // Phone number validation
    if (!/^\d{10}$/.test(phone)) {
        alert("Please enter a valid 10-digit phone number");
        return false;
    }

    // Location validation
    if (!/^[a-zA-Z\s]+$/.test(location)) {
        alert("Location should contain only letters and spaces");
        return false;
    }

    // CEO, CTO, HR, Founder validation
    if (!/^[a-zA-Z\s]+$/.test(ceo) || !/^[a-zA-Z\s]+$/.test(cto) || !/^[a-zA-Z\s]+$/.test(hr) || !/^[a-zA-Z\s]+$/.test(founder)) {
        alert("Names should contain only letters and spaces");
        return false;
    }

    // Net Worth validation
    if (isNaN(worth) || worth < 0) {
        alert("Net Worth should be a positive number");
        return false;
    }

    // Founded date validation
    var foundDate = new Date(found);
    var today = new Date();
    if (foundDate > today) {
        alert("Founded date cannot be in the future");
        return false;
    }

    return true;
}