<?php
$fname = $lname = $email = $phone = $dob = $gender = $yop = $address = "";
$skills = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Form Validation</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="form-container">
        <form id="registrationForm">
            <h2>Registration Form</h2>

            <label>First Name:</label>
            <input type="text" id="Fname" name="Fname" value="<?php echo $fname ?>">
            <span class="error" id="fnameErr"></span>

            <label>Last Name:</label>
            <input type="text" id="Lname" name="Lname" value="<?php echo $lname ?>">
            <span class="error" id="lnameErr"></span>

            <label>Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email ?>">
            <span class="error" id="emailErr"></span>

            <label>Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone ?>">
            <span class="error" id="phoneErr"></span>

            <label>Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $dob ?>">
            <span class="error" id="dobErr"></span>

            <label>Gender:</label>
            <label><input type="radio" name="gender" value="male"> Male</label>
            <label><input type="radio" name="gender" value="female"> Female</label>
            <span class="error" id="genderErr"></span>

            <label>Year of Passing:</label>
            <select name="YOP" id="YOP">
                <option value="disabled">Select Year</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
            </select>
            <span class="error" id="yopErr"></span>

            <label>Skills:</label>
            <label><input type="checkbox" name="skills[]" value="HTML"> HTML</label>
            <label><input type="checkbox" name="skills[]" value="CSS"> CSS</label>
            <label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label>
            <span class="error" id="skillsErr"></span>

            <label>Address:</label>
            <textarea id="address" name="address"></textarea>
            <span class="error" id="addressErr"></span>

            <input type="submit" value="Submit">
            <div id="result"></div>
        </form>
    </div>

    <script>
        // Client-side validation
        document.getElementById("registrationForm").addEventListener("submit", function(e) {
            e.preventDefault();
            let hasError = false;

            // Clear previous errors
            ["fnameErr", "lnameErr", "emailErr", "phoneErr", "dobErr", "genderErr", "yopErr", "skillsErr", "addressErr"].forEach(id => {
                document.getElementById(id).textContent = "";
            });
            document.getElementById("result").textContent = "";

            // Validate fields
            const fname = document.getElementById("Fname").value.trim();
            if (!/^[a-zA-Z-' ]+$/.test(fname)) {
                document.getElementById("fnameErr").textContent = "Invalid characters";
                hasError = true;
            }

            const lname = document.getElementById("Lname").value.trim();
            if (!/^[a-zA-Z-' ]+$/.test(lname)) {
                document.getElementById("lnameErr").textContent = "Invalid characters";
                hasError = true;
            }

            const email = document.getElementById("email").value.trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById("emailErr").textContent = "Invalid email";
                hasError = true;
            }

            const phone = document.getElementById("phone").value.trim();
            if (!/^[0-9]{10}$/.test(phone)) {
                document.getElementById("phoneErr").textContent = "Invalid phone";
                hasError = true;
            }

            const dob = document.getElementById("dob").value;
            if (dob === "") {
                document.getElementById("dobErr").textContent = "Required";
                hasError = true;
            }

            const gender = document.querySelector("input[name='gender']:checked");
            if (!gender) {
                document.getElementById("genderErr").textContent = "Required";
                hasError = true;
            }

            const yop = document.getElementById("YOP").value;
            if (yop === "disabled") {
                document.getElementById("yopErr").textContent = "Select year";
                hasError = true;
            }

            const skills = document.querySelectorAll("input[name='skills[]']:checked");
            if (skills.length === 0) {
                document.getElementById("skillsErr").textContent = "Select at least one";
                hasError = true;
            }

            const address = document.getElementById("address").value.trim();
            if (address === "") {
                document.getElementById("addressErr").textContent = "Required";
                hasError = true;
            }

            if (hasError) return;

            const form = document.getElementById("registrationForm");
            let formData = new FormData(form);

            fetch("finalprocess.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {

                    document.getElementById("result").innerHTML = data;

                });
        });
    </script>
</body>

</html>