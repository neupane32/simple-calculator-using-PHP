<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <div class="calculator">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="number" name="num01" placeholder="Number one" required>
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="division">/</option>
            </select>
            <input type="number" name="num02" placeholder="Number two" required>
            <button type="submit">Calculate</button>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Grab data from inputs
        $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
        $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);

        // Error handlers
        $errors = false;

        if (empty($num01) || empty($num02) || empty($operator)) {
            echo "<p class='calc-error'>Fill in all fields!</p>";
            $errors = true;
        }

        if (!is_numeric($num01) || !is_numeric($num02)) {
            echo "<p class='calc-error'>Only write a number.</p>";
            $errors = true;
        }

        // Calculate the number if no error
        if (!$errors) {
            $value = 0;
            switch ($operator) {
                case "add":
                    $value = $num01 + $num02;
                    break;
                case "subtract":
                    $value = $num01 - $num02;
                    break;
                case "multiply":
                    $value = $num01 * $num02;
                    break;
                case "division":
                    if ($num02 != 0) {
                        $value = $num01 / $num02;
                    } else {
                        echo "<p class='calc-error'>Cannot divide by zero.</p>";
                        $errors = true;
                    }
                    break;
                default:
                    echo "<p class='calc-error'>Something went wrong.</p>";
                    $errors = true;
            }
            if (!$errors) {
                echo "<p class='calc-result'>Result = " . $value . "</p>";
            }
        }
    }
    ?>
</body>
</html>
