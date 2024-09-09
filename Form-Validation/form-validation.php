<?php
// Define an array to store errors
$errors = [];

// Function to validate form data
function validate_form($data) {
    global $errors;

    // Validate name
    if (empty($data['name'])) {
        $errors['name'] = "Name is required.";
    } elseif (strlen($data['name']) < 2 || strlen($data['name']) > 50) {
        $errors['name'] = "Name must be between 2 and 50 characters.";
    }

    // Validate email
    if (empty($data['email'])) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate age (optional, but must be at least 18 if provided)
    if (!empty($data['age']) && (!is_numeric($data['age']) || $data['age'] < 18)) {
        $errors['age'] = "Age must be 18 or older.";
    }

    // Validate password
    if (empty($data['password'])) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($data['password']) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }

    // Validate confirm password
    if (empty($data['confirm_password'])) {
        $errors['confirm_password'] = "Confirm password is required.";
    } elseif ($data['password'] !== $data['confirm_password']) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    return empty($errors); // Return true if no errors
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (validate_form($_POST)) {
        echo "Form is valid!";
    }
}
?>
