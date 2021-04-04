<?php
class Field {
    public static $fully_valid = true;
    public $value;
    public $class;

    function __construct($post_key, $regex) {
        $this->value = isset($_POST[$post_key]) ? $_POST[$post_key]:null;
        $is_valid = isset($this->value) ? preg_match_all($regex, $this->value):true;
        self::$fully_valid &= $is_valid && isset($this->value);
        $this->class = $this->getClass($is_valid);
    }

    function __toString(): string {
        return $this->value;
    }

    function getClass($is_valid): string {
        return $is_valid? 'valid':'invalid';
    }
}

$name = new Field('name', '/^[^\d]{2,}$/');
$email = new Field('email', '/^\b[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i');
$username = new Field('username', '/^.{5,}$/i');
$password = new Field('password', '/^.{8,}$/i');
$confirm_password = new Field('confirm_password', "/^$password/");
$date_of_birth = new Field('date_of_birth', '/^\d{2}\.\d{2}\.\d{4}$/');
$gender = new Field('gender', '/^Male|Female$/i');
$marital_status = new Field('marital_status', '/^Single|Married|Divorced|Widowed$/i');
$address = new Field('address', '/^.+$/');
$city = new Field('city', '/^.+$/');
$postal_code = new Field('postal_code', '/^\d{6}$/');
$home_phone = new Field('home_phone', '/^\d{2}[ -]\d{7}$/');
$mobile_phone = new Field('mobile_phone', '/^\d{2}[ -]\d{7}$/');
$credit_card_number = new Field('credit_card_number', '/^(\d{4}[ -]){3}\d{4}$/');
$credit_card_expiry_date = new Field('credit_card_expiry_date', '/^\d{2}\.\d{2}\.\d{4}$/');
$monthly_salary = new Field('monthly_salary', '/^UZS \d{0,3}(,\d{3})*\.\d{2}$/i');
$web_site_url = new Field('web_site_url', '/^(http|https):\/\/[a-z]+[a-z0-9~\-._]+\.[a-z]{2,4}(\/[a-z0-9~\-._%]*)*$/i');
$overall_gpa = new Field('overall_gpa', '/^[0-3]\.*[0-9]*$/');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Validating Forms</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php if(Field::$fully_valid) { ?>
    <h1>Thank you for form submission</h1>
<?php } else { ?>
    <form action="index.php" method="POST">
        <h1>Registration Form</h1>

        <p>This form validates user input and then displays "Thank You" page.</p>

        <hr />

        <h2>Please, fill below fields correctly</h2>

        <dl>
            <dt>Name</dt>
            <dd class="<?= $name->class ?>">
                <input type="text" name="name" value="<?= $name->value ?>">
                <p>This field is required. It has to contain at least 2 chars. It should not contain any number.</p>
            </dd>
        </dl>
        <dl>
            <dt>Email</dt>
            <dd class="<?= $email->class ?>">
                <input type="text" name="email" value="<?= $email->value ?>">
                <p>This field is required. It should correspond to email format.</p>
            </dd>
        </dl>
        <dl>
            <dt>Username</dt>
            <dd class="<?= $username->class ?>">
                <input type="text" name="username" value="<?= $username->value ?>">
                <p>This field is required. It has to contain at least 5 chars.</p>
            </dd>
        </dl>
        <dl>
            <dt>Password</dt>
            <dd class="<?= $password->class ?>">
                <input type="text" name="password" value="<?= $password->value ?>">
                <p>This field is required. It has to contain at least 8 chars.</p>
            </dd>
        </dl>
        <dl>
            <dt>Confirm Password</dt>
            <dd class="<?= $confirm_password->class ?>">
                <input type="text" name="confirm_password" value="<?= $confirm_password->value ?>">
                <p>This field is required. It has to be equal to Password field.</p>
            </dd>
        </dl>
        <dl>
            <dt>Date of Birth</dt>
            <dd class="<?= $date_of_birth->class ?>">
                <input type="text" name="date_of_birth" value="<?= $date_of_birth->value ?>">
                <p>Date should be written in dd.MM.yyyy format. For ex, 07.03.2019</p>
            </dd>
        </dl>
        <dl>
            <dt>Gender</dt>
            <dd class="<?= $gender->class ?>">
                <input type="text" name="gender" value="<?= $gender->value ?>">
                <p>Only 2 options accepted: Male, Female.</p>
            </dd>
        </dl>
        <dl>
            <dt>Marital Status</dt>
            <dd class="<?= $marital_status->class ?>">
                <input type="text" name="marital_status" value="<?= $marital_status->value ?>">
                <p>Only 4 options accepted: Single, Married, Divorced, Widowed</p>
            </dd>
        </dl>
        <dl>
            <dt>Address</dt>
            <dd class="<?= $address->class ?>">
                <input type="text" name="address" value="<?= $address->value ?>">
                <p>This is required field.</p>
            </dd>
        </dl>
        <dl>
            <dt>City</dt>
            <dd class="<?= $city->class ?>">
                <input type="text" name="city" value="<?= $city->value ?>">
                <p>This is required field.</p>
            </dd>
        </dl>
        <dl>
            <dt>Postal Code</dt>
            <dd class="<?= $postal_code->class ?>">
                <input type="text" name="postal_code" value="<?= $postal_code->value ?>">
                <p>This is required field. It should follow 6 digit format. For ex, 100011</p>
            </dd>
        </dl>
        <dl>
            <dt>Home Phone</dt>
            <dd class="<?= $home_phone->class ?>">
                <input type="text" name="home_phone" value="<?= $home_phone->value ?>">
                <p>This is required field. It should follow 9 digit format. For ex, 97 1234567</p>
            </dd>
        </dl>
        <dl>
            <dt>Mobile Phone</dt>
            <dd class="<?= $mobile_phone->class ?>">
                <input type="text" name="mobile_phone" value="<?= $mobile_phone->value ?>">
                <p>This is required field. It should follow 9 digit format. For ex, 97 1234567</p>
            </dd>
        </dl>
        <dl>
            <dt>Credit Card Number</dt>
            <dd class="<?= $credit_card_number->class ?>">
                <input type="text" name="credit_card_number" value="<?= $credit_card_number->value ?>">
                <p>This is required field. It should follow 16 digit format. For ex, 1234 1234 1234 1234</p>
            </dd>
        </dl>
        <dl>
            <dt>Credit Card Expiry Date</dt>
            <dd class="<?= $credit_card_expiry_date->class ?>">
                <input type="text" name="credit_card_expiry_date" value="<?= $credit_card_expiry_date->value ?>">
                <p>This is required field. Date should be written in dd.MM.yyyy format. For ex, 07.03.2019</p>
            </dd>
        </dl>
        <dl>
            <dt>Monthly Salary</dt>
            <dd class="<?= $monthly_salary->class ?>">
                <input type="text" name="monthly_salary" value="<?= $monthly_salary->value ?>">
                <p>This is required field. It should be written in following format UZS 200,000.00</p>
            </dd>
        </dl>
        <dl>
            <dt>Web Site URL</dt>
            <dd class="<?= $web_site_url->class ?>">
                <input type="text" name="web_site_url" value="<?= $web_site_url->value ?>">
                <p>This is required field. It should match URL format. For ex, http://github.com</p>
            </dd>
        </dl>
        <dl>
            <dt>Overall GPA</dt>
            <dd class="<?= $overall_gpa->class ?>">
                <input type="text" name="overall_gpa" value="<?= $overall_gpa->value ?>">
                <p>This is required field. It should be a floating point number less than 4.</p>
            </dd>
        </dl>

        <input type="submit" value="Register">
    </form>
<?php } ?>

</body>
</html>
