document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('ca_password');
    const verifyInput = document.getElementById('ca_verify_password');
    const createBtn = document.getElementById('createAccountBtn');
    const passwordHelp = document.getElementById('passwordHelp');
    const verifyHelp = document.getElementById('verifyHelp');

    function validate() {
        let passVal = passwordInput.value;
        let verifyVal = verifyInput.value;
        let valid = true;

        // Check password length >= 8
        if (passVal.length < 8) {
            passwordHelp.textContent = "Password must be at least 8 characters long.";
            valid = false;
        } else if (!/\d/.test(passVal)) {
            // Check if password contains at least one number
            passwordHelp.textContent = "Password must contain at least one number.";
            valid = false;
        } else {
            passwordHelp.textContent = "";
        }

        // Check if password and verify password match
        if (passVal !== verifyVal) {
            verifyHelp.textContent = "Passwords do not match.";
            valid = false;
        } else {
            verifyHelp.textContent = "";
        }

        // Enable or disable the create account button based on validity
        createBtn.disabled = !valid;
    }

    // Add event listeners for real-time validation
    if (passwordInput && verifyInput && createBtn) {
        passwordInput.addEventListener('input', validate);
        verifyInput.addEventListener('input', validate);
    }
});
