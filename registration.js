// Wait for the document to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Get the signup form element
    const signupForm = document.getElementById("signupForm");

    // Add a submit event listener to the form
    signupForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Get form data
        const formData = new FormData(signupForm);

        // Create an object to hold form data
        const userData = {};
        formData.forEach((value, key) => {
            userData[key] = value;
        });

        // Perform client-side validation (you can add more validation here)
        if (!userData.username || !userData.email || !userData.password) {
            alert("Please fill in all required fields.");
            return;
        }

        // Send an AJAX request to the server for user registration
        fetch("registration.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(userData),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Registration successful
                    alert("Registration successful! You can now log in.");
                    // Redirect to the login page or perform any desired action
                    window.location.href = "login.php";
                } else {
                    // Registration failed, display an error message
                    alert("Registration failed. Please try again.");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
