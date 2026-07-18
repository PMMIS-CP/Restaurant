<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'confirm_password' => [
        'title' => 'Confirm Password',
        'page_title' => 'Authentication',
        'message' => 'This section requires security verification. Please enter your password to continue.',
        'label' => 'Password',
        'placeholder' => 'Enter your password',
        'button' => 'Confirm Password',
        'back_link' => '← Back to previous page',
    ],

    'forgot_password' => [
        'title' => 'Forgot Password',
        'page_title' => 'Password Recovery',
        'message' => 'Enter your email to receive a recovery link.',
        'email_label' => 'Email',
        'send_link' => 'Send Link',
        'back_to_login' => 'Back to login',
    ],

    'reset_password' => [
        'title' => 'Reset Password',
        'page_title' => 'Set New Password',
        'email_label' => 'Email',
        'new_password_label' => 'New Password',
        'confirm_password_label' => 'Confirm Password',
        'button' => 'Reset Password',
    ],

    'verify_email' => [
        'title' => 'Verify Email',
        'page_title' => 'Verify Email Address',
        'link_sent' => 'A verification link has been sent to your email.',
        'not_received' => 'If you did not receive the email, click the button below to resend it.',
        'new_link_sent' => 'A new link has been sent.',
        'resend_link' => 'Resend Verification Link',
        'logout' => 'Logout',
    ],

    'login' => [
        'page_title' => 'Login',
        'phone_label' => 'Mobile Number',
        'phone_placeholder' => '09xxxxxxxxx',
        'phone_title' => 'Mobile number must be 11 digits and start with 09',
        'continue_button' => 'Continue',
        'verified_phone_label' => 'Mobile Number:',
        'edit_phone' => 'Edit Number',
        'name_label' => 'Name',
        'family_label' => 'Family Name',
        'email_label_optional' => 'Email (Optional)',
        'password_label' => 'Password',
        'password_confirmation_label' => 'Confirm Password',
        'get_verification_code' => 'Get Verification Code',
        'code_4_digit_label' => '4-Digit Code',
        'code_4_digit_placeholder' => '4-Digit Code',
        'verify_and_register' => 'Verify & Register',
        'resend_code' => 'Resend Code',
        'login_button' => 'Login',
        'forgot_password' => 'Forgot Password',
        'reset_code_sent' => 'Verification code sent to your number.',
        'verify_code' => 'Verify Code',
        'new_password_label' => 'New Password',
        'new_password_confirmation_label' => 'Confirm New Password',
        'set_new_password' => 'Set New Password',

        'js_invalid_phone' => 'Mobile number is invalid.',
        'js_checking' => 'Checking...',
        'js_server_error' => 'Server communication error.',
        'js_continue' => 'Continue',
        'js_name_family_required' => 'Name and Family Name are required.',
        'js_password_required' => 'Password is required.',
        'js_password_min' => 'Password must be at least 6 characters.',
        'js_password_mismatch' => 'Password and confirmation do not match.',
        'js_invalid_email' => 'Invalid email format.',
        'js_validating' => 'Validating...',
        'js_get_code' => 'Get Verification Code',
        'js_sending_code' => 'Sending code...',
        'js_code_sent' => 'Verification code sent to :phone.',
        'js_wait' => 'Please wait a moment.',
        'js_send_code_error' => 'Error sending verification code.',
        'js_code_required' => 'Please enter the 4-digit code.',
        'js_verifying' => 'Verifying...',
        'js_invalid_code' => 'Invalid code.',
        'js_network_error' => 'Network error. Please try again.',
        'js_verify_register' => 'Verify & Register',
        'js_enter_password' => 'Please enter your password.',
        'js_logging_in' => 'Logging in...',
        'js_wrong_credentials' => 'Login credentials incorrect.',
        'js_login' => 'Login',
        'js_send_reset_code_error' => 'Error sending code.',
        'js_fill_both_fields' => 'Please fill both fields.',
        'js_saving' => 'Saving...',
        'js_password_change_error' => 'Error changing password.',
        'js_set_password' => 'Set New Password',
        'js_invalid_data' => 'Invalid data provided.',
        'js_email' => 'Email',
        'js_password' => 'Password',
        'js_name' => 'Name',
        'js_family' => 'Family',
        'js_code' => 'Code',
        'js_expired' => 'Expired',
    ],
];