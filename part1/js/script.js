// COMP 4621 Assignment 1 - Aditya Subramaniam
// colour changing + contact form validation

var themes = ["theme-court", "theme-river", "theme-sunset", "theme-night"];
var themeNames = ["Court Green", "River Blue", "Sunset Orange", "Night Mode"];
var currentTheme = 0;
var autoTimer = null;

function applyTheme(index) {
    currentTheme = index % themes.length;
    for (var i = 0; i < themes.length; i++) {
        document.body.classList.remove(themes[i]);
    }
    document.body.classList.add(themes[currentTheme]);

    var label = document.getElementById("themeName");
    if (label) {
        label.textContent = "Current colours: " + themeNames[currentTheme];
    }

    // save it so the other pages use the same colours
    try {
        localStorage.setItem("comp4621Theme", currentTheme);
    } catch (e) {}
}

function nextTheme() {
    applyTheme(currentTheme + 1);
}

// keeps switching colours every 2 sec until stopped
function toggleAutoColours() {
    var button = document.getElementById("autoColourBtn");
    if (autoTimer == null) {
        autoTimer = setInterval(nextTheme, 2000);
        button.textContent = "Stop Auto Colours";
    } else {
        clearInterval(autoTimer);
        autoTimer = null;
        button.textContent = "Start Auto Colours";
    }
}

function showError(field, message) {
    var errorSpan = document.getElementById(field.id + "Error");
    if (message) {
        field.classList.add("invalid");
        errorSpan.textContent = message;
    } else {
        field.classList.remove("invalid");
        errorSpan.textContent = "";
    }
}

function validateContactForm(event) {
    var form = document.getElementById("contactForm");
    var fields = ["name", "email", "subject", "message"];
    var labels = { name: "Name", email: "Email", subject: "Subject", message: "Message" };
    var valid = true;
    var firstBadField = null;

    for (var i = 0; i < fields.length; i++) {
        var field = document.getElementById(fields[i]);
        var value = field.value.trim();

        if (value == "") {
            showError(field, labels[fields[i]] + " cannot be left empty.");
            valid = false;
        } else if (fields[i] == "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            showError(field, "Please enter a valid email address (e.g. name@example.com).");
            valid = false;
        } else {
            showError(field, "");
        }

        if (!valid && firstBadField == null) {
            firstBadField = field;
        }
    }

    var status = document.getElementById("formStatus");
    if (!valid) {
        event.preventDefault();
        status.className = "alert error";
        status.textContent = "Please fix the highlighted fields and try again.";
        firstBadField.focus();
        return false;
    }

    // part 1 has no server yet so just show a message
    if (form.getAttribute("data-static") == "true") {
        event.preventDefault();
        status.className = "alert success";
        status.textContent = "Thank you, " + document.getElementById("name").value.trim() +
            "! Your message passed validation.";
        form.reset();
    }
    return true;
}

function start() {
    var saved = 0;
    try {
        saved = parseInt(localStorage.getItem("comp4621Theme")) || 0;
    } catch (e) {}
    applyTheme(saved);
    // stops the colours from fading in when a page first loads
    setTimeout(function () { document.body.classList.remove("preload"); }, 50);

    var nextBtn = document.getElementById("nextColourBtn");
    if (nextBtn) nextBtn.addEventListener("click", nextTheme);

    var autoBtn = document.getElementById("autoColourBtn");
    if (autoBtn) autoBtn.addEventListener("click", toggleAutoColours);

    var form = document.getElementById("contactForm");
    if (form) {
        form.addEventListener("submit", validateContactForm);

        // clear the error once they start typing
        var inputs = form.querySelectorAll("input[type=text], input[type=email], textarea");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener("input", function () {
                if (this.value.trim() != "") showError(this, "");
            });
        }
        form.addEventListener("reset", function () {
            for (var j = 0; j < inputs.length; j++) showError(inputs[j], "");
        });
    }
}

window.addEventListener("load", start);

// hover effect from jquery4.html in the resources
if (window.jQuery) {
    $(document).ready(function () {
        $("#divSocial a img").hover(function () {
            $(this).stop().animate({ top: "-15" });
        }, function () {
            $(this).stop().animate({ top: "0" });
        });
    });
}
