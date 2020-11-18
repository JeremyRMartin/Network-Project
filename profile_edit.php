<?PHP
// Connection to database variables //
$server = "localhost";
$username = "andrew";
$password = "networkproject";
$database = "users";

// Connecting to the database //
$connection = mysqli_connect($server, $username, $password, $database);

// Checking for database errors //
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Checking for POST data from the browser //
if (isset($_POST['submit'])) {

    // Address two variable for apartments and suite numbers //
    $address_two = " ";

    /* Checking for variables in POST method; if field is not empty, assign a value
     * HTML Special Chars is used to protect against XSS (Cross Site Scripting)
     * Prepares the strings for entry to the database
     */
    if (!empty($_POST['first_name'])) {
        $first_name = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['first_name']));
        setcookie("first_name", $_POST["first_name"], time() + 3600 * 24);
    }

    if (!empty($_POST['last_name'])) {
        $last_name = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['last_name']));
        setcookie("last_name", $_POST["last_name"], time() + 3600 * 24);
    }

    if (!empty($_POST['username'])) {
        $username = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['username']));
        setcookie("username", $_POST["username"], time() + 3600 * 24);
    }

    if (!empty($_POST['password'])) {
        $password = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['password']));
        setcookie("password", $_POST["password"], time() + 3600 * 24);
    }

    if (!empty($_POST['email'])) {
        $email = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['email']));
        setcookie("email", $_POST["email"], time() + 3600 * 24);
    }

    if (!empty($_POST['address'])) {
        $address = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['address']));
        setcookie("address", $_POST["address"], time() + 3600 * 24);
    }

    if (!empty($_POST['address_two'])) {
        $address_two = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['address_two']));
        setcookie("address_two", $_POST["address_two"], time() + 3600 * 24);
    }

    if (!empty($_POST['state'])) {
        $state = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['state']));
        setcookie("state", $_POST["state"], time() + 3600 * 24);
    }

    if (!empty($_POST['city'])) {
        $city = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['city']));
        setcookie("city", $_POST["city"], time() + 3600 * 24);
    }

    if (!empty($_POST['zip'])) {
        $zip = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['zip']));
        setcookie("zip", $_POST["zip"], time() + 3600 * 24);
    }
    // End of checking for variables in POST and assigning variables values //

    // SQL query to enter to the database //
    $query = "UPDATE ACCOUNTS 
                SET first_name ='$first_name', last_name='$last_name', username='$username', password='$password', email='$email',
                address='$address', address_two = '$address_two', city='$city', state='$state', zip= '$zip'
                WHERE user_id='$user_id'";

        // If successful query to the database, go to profile page; otherwise, throw an error //
        if (mysqli_query($connection, $query)) {
            header('location: profile.php');
        } else {
            echo "Connection error: " . mysqli_connect_error();
        }





}
    ?>

<!DOCTYPE html>
<html lang="en">

<!--Head-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="./core.css">
    <link rel="stylesheet" href="./profile.css">
    <title>Profile</title>
</head>
<!--End of head-->

<!--Body-->
<body>

<!--Header-->
<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="./library.php" class="navbar-brand d-flex align-items-center">
                <strong>Library</strong>
            </a>
        </div>
    </div>
</header>
<!--End of header-->

<!-- Using PHP cookies to enter data into appropriate fields-->
<div class="container emp-profile profile-tab">
    <form method="POST">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="./images/user.png" alt="Admin" width="860">
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h1>
                        <?php echo $_COOKIE["first_name"] . " " . $_COOKIE["last_name"]; ?>
                    </h1>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" role="tab"
                               aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>
                </div>
                <form class="needs-validation" novalidate>

                <!--First Name-->
                <div class="row">
                    <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="first_name">Current First Name</label>
                        </div>
                        <div class="col-md-4">
                            <p><?php echo $_COOKIE["first_name"]; ?></p>
                        </div>
                    </div>
                        <input type="text" class="form-control" name="first_name" placeholder="Update First Name">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <!--End of first name-->

                    <!--Last Name-->
                    <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="last_name">Current Last Name</label>
                        </div>
                        <div class="col-md-4">
                            <p><?php echo $_COOKIE["last_name"]; ?></p>
                        </div>
                    </div>
                        <input type="text" class="form-control" name="last_name" placeholder="Update Last Name">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>
                <!--End of last name-->

                <!--Username-->
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="username">Current Username</label>
                        </div>
                        <div class="col-md-4">
                            <p><?php echo $_COOKIE["username"]; ?></p>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Update Username" >
                        <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                        </div>
                    </div>
                </div>
                <!--End of username-->

                <!--Password-->
                <div class="mb-3">
                <div class="row">
                        <div class="col-md-4">
                            <label for="password">Current Password</label>
                        </div>
                        <div class="col-md-4">
                            <p><?php 
                            $censoredPassword = substr($_COOKIE["password"],0,1);
                            for ($x = 1; $x < strlen($_COOKIE["password"]); $x++) {
                                $censoredPassword.="*";
                              }
                            echo $censoredPassword; 
                            ?></p>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Update Password" >
                        <div class="invalid-feedback" style="width: 100%;">
                            Your password is required.
                        </div>
                    </div>
                </div>
                <!--End of password-->

                <!--Email-->
                <div class="mb-3">
                <div class="row">
                        <div class="col-md-4">
                            <label for="username">Current Email</label>
                        </div>
                        <div class="col-md-4">
                            <p><?php echo $_COOKIE["email"]; ?></p>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="email" placeholder="Update Email" >
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <!--End of email-->

                <!--Address-->
                <div class="mb-3">
                <div class="row">
                        <div class="col-md-4">
                            <label for="username">Current Address</label>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $_COOKIE["address"]; ?></p>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="address" placeholder="Update Address" >
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <!--Address continued-->
                <div class="mb-3">
                <div class="row">
                        <div class="col-md-8">
                        <label for="address2">Current Address <span class="text-muted">(Optional)</span></label>
                        </div>
                        <div class="col-md-4">
                            <p><?php echo $_COOKIE["address_two"]; ?></p>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="address_two" placeholder="Update Apartment or suite">
                </div>
                <!--End of address continued-->

                <!--City-->
                <div class="row">
                    <div class="col-md-5 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="username">Current City</label>
                        </div>
                        <div class="col-md-12">
                            <p><?php echo $_COOKIE["city"]; ?></p>
                        </div>
                    </div>
                        <input type="text" class="form-control" name="city" placeholder="Update City" >
                        <div class="invalid-feedback">
                            Valid city is required.
                        </div>
                    </div>
                    <!--End of city-->

                    <!--State-->
                    <div class="col-md-4 mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="username">Current State</label>
                            </div>
                            <div class="col-md-12">
                                <p><?php echo $_COOKIE["state"]; ?></p>
                            </div>
                        </div>
                        <select name="state" class="custom-select d-block w-100" >
                            <option value="state">Choose...</option>
                            <option value="Alabama">Alabama</option>
                            <option value="Alaska">Alaska</option>
                            <option value="Arizona">Arizona</option>
                            <option value="Arkansas">Arkansas</option>
                            <option value="California">California</option>
                            <option value="Colorado">Colorado</option>
                            <option value="Connecticut">Connecticut</option>
                            <option value="Delaware">Delaware</option>
                            <option value="Florida">Florida</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="Idaho">Idaho</option>
                            <option value="Illinois">Illinois</option>
                            <option value="Indiana">Indiana</option>
                            <option value="Iowa">Iowa</option>
                            <option value="Kansas">Kansas</option>
                            <option value="Kentucky">Kentucky</option>
                            <option value="Louisiana">Louisiana</option>
                            <option value="Maine">Maine</option>
                            <option value="Maryland">Maryland</option>
                            <option value="Massachusetts">Massachusetts</option>
                            <option value="Michigan">Michigan</option>
                            <option value="Minnesota">Minnesota</option>
                            <option value="Mississippi">Mississippi</option>
                            <option value="Missouri">Missouri</option>
                            <option value="Montana">Montana</option>
                            <option value="Nebraska">Nebraska</option>
                            <option value="Nevada">Nevada</option>
                            <option value="New Hampshire">New Hampshire</option>
                            <option value="New Jersey">New Jersey</option>
                            <option value="New Mexico">New Mexico</option>
                            <option value="New York">New York</option>
                            <option value="North Carolina">North Carolina</option>
                            <option value="North Dakota">North Dakota</option>
                            <option value="Ohio">Ohio</option>
                            <option value="Oklahoma">Oklahoma</option>
                            <option value="Oregon">Oregon</option>
                            <option value="Pennsylvania">Pennsylvania</option>
                            <option value="Rhode Island">Rhode Island</option>
                            <option value="South Carolina">South Carolina</option>
                            <option value="South Dakota">South Dakota</option>
                            <option value="Tennessee">Tennessee</option>
                            <option value="Texas">Texas</option>
                            <option value="Utah">Utah</option>
                            <option value="Vermont">Vermont</option>
                            <option value="Virginia">Virginia</option>
                            <option value="Washington">Washington</option>
                            <option value="West Virginia">West Virginia</option>
                            <option value="Wisconsin">Wisconsin</option>
                            <option value="Wyoming">Wyoming</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <!--End of state-->

                    <!--Zip-->
                    <div class="col-md-3 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="username">Current Zip</label>
                        </div>
                        <div class="col-md-12">
                            <p><?php echo $_COOKIE["zip"]; ?></p>
                        </div>
                    </div>
                        <input type="text" class="form-control" name="zip" placeholder="Update Zip" >
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                    <!--End of zip-->
                </div>
                <!--End of create an account-->

                <!--Continue button-->
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Continue</button>
                <!--End of continue button-->
            </form>
            </div>
        </div>
    </form>
</div>
</body>
</html>