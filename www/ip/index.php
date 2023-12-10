<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>HTTP Client Info</title>
</head>
<body>
    <div class="container">
        <h1>HTTP Client Info</h1>
        <table>
            <tr>
                <th>Information</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>IP Address:</td>
                <td>
                    <?php
                    if (isset($_SERVER['HTTP_X_REAL_IP'])) {
                        $user_ip = $_SERVER['HTTP_X_REAL_IP'];
                    } else {
                        $user_ip = $_SERVER['REMOTE_ADDR'];
                    }
                    echo $user_ip;
                    ?>
                </td>
            </tr>
            <tr>
                <td>Host Name:</td>
                <td>
                    <?php
                    $host_name = gethostbyaddr($user_ip);
                    echo $host_name;
                    ?>
                </td>
            </tr>
	    <tr>
		<td>Time:</td>
		<td>
		    <?php
		    echo shell_exec('date');
		    ?>
		</td>
	    </tr>
        </table>
    </div>
</body>
</html>

