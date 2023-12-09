<?php
function validate_message($message)
{
    // function to check if message is correct (must have at least 10 characters (after trimming))
    // $check = explode(" ", trim($message));
    // if (count($check) < 10) {
    //     return "Message must be at least 10 caracters long";
    // } else {
    //     return "";
    // }
    if (strlen(trim($message)) < 10) {
        return "Message must be at least 10 characters long";
    } else {
        return "";
    }

}
function validate_username($username)
{
    if ($username == "") {
        return "Please enter a username"; 
    } elseif (!ctype_alnum(trim($username))) {
        // includes number and wword
        return "Username should contain only letters and numbers";
    } else {
        return "";
    }
}
function validate_email($email)
{
    // function to check if email is correct (must contain '@')
    //cách 1:
    $ky_tu_can_kiem_tra = "@";
    if ($email == "") {
        return "Please enter an email";
    } elseif (strpos(trim($email), $ky_tu_can_kiem_tra) == false) {
        return "email must contain '@'";
    } else {
        return "";
    }

    //cách 2:
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     return "Invalid email";
    // } else {
    //     return "";
    // }
}

$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";
$username = "";
$email = "";
$message = "";
$form_valid = false;

$bool = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Here is the list of error messages that can be displayed:
    //
    // "Message must be at least 10 caracters long"
    // "You must accept the Terms of Service"
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    // "Please enter an email"
    // "email must contain '@'"
    $message_error = validate_message($_POST['message']);
    $user_error = validate_username($_POST['username']);
    $email_error = validate_email($_POST['email']);
    $terms_error = empty($_POST['terms']) ? "You must accept the Terms of Service" : "";

    if ($message_error == "" && $user_error == "" && $email_error == "" && $terms_error == "") {
        $form_valid = true;
        $username = $_POST['username'];
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
    }

}





?>

<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username" id="name">
            <small class="form-text text-danger">
                <?php echo $user_error; ?>
            </small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email" id="email">
            <small class="form-text text-danger">
                <?php echo $email_error; ?>
            </small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control" id="message"></textarea>
        <small class="form-text text-danger">
            <?php echo $message_error; ?>
        </small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms"> <label for="terms">I
            accept the Terms of Service</label>
        <small class="form-text text-danger">
            <?php echo $terms_error; ?>
        </small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
    </div>
</form>

<hr>

<?php
if ($form_valid):
    ?>
    <div class="card">
        <div class="card-header">
            <p>
                <?php echo $username; ?>
            </p>
            <p>
                <?php echo $email; ?>
            </p>
        </div>
        <div class="card-body">
            <p class="card-text">
                <?php echo $message; ?>
            </p>
        </div>
    </div>
    <?php
endif;
?>