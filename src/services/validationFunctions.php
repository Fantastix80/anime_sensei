<?php

// This class allows you to do some simple verifications on strings. Useful when you need to check forms inputs
class validationFunctions {
    private string $data;

    // The constructor will set the attribute to the string we will need to apply some verifications on
    public function __construct(string $data) {
        $this->data = $data;
    }

    // This function will return the string because this attribute is private
    public function getData(): string {
        return $this->data;
    }

    // This function will check if the string is not blank
    public function isNotBlank(): bool
    {
        return !empty($this->data);
    }

    // This function will check if the length of the string is bigger or equal to the value in parameter
    public function minLength(int $value): bool
    {
        $response = false;
        if (strlen($this->data) >= $value) {
            $response = true;
        }

        return $response;
    }

    // This function will check if the length of the string is lower or equal to the value in parameter
    public function maxLength(int $value): bool
    {
        $response = false;
        if (strlen($this->data) <= $value) {
            $response = true;
        }

        return $response;
    }

    // This function will check if the email has the right format (contains at least 1 @ and 1 .)
    public function isEmailValid(): bool
    {
        $response = false;

        $format = boolval(preg_match('/^\S+@\S+\.\S+$/', $this->data));

        if($format && strlen($this->data) >= 6 && strlen($this->data) <= 60)
        {
            $response = true;
        }

        return $response;
    }

    // This function will check if the password contains at least 1 uppercase, 1 lowercase and 1 number
    public function isPasswordValid(): bool
    {
        $response = false;

        $uppercase = boolval(preg_match('/[A-Z]/', $this->data));
        $lowercase = boolval(preg_match('/[a-z]/', $this->data));
        $number = boolval(preg_match('/\d/', $this->data));

        if(strlen($this->data) >= 8 && strlen($this->data) < 50 && $lowercase && $uppercase && $number) {
            $response = true;
        }

        return $response;
    }
}

?>