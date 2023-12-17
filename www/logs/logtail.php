<?php

// Number of lines to read from the end of the file
$n = 16; // You can set this to any desired integer value

// Path to the CLF log file
$logFilePath = 'access.log';

// Function to get the last n lines from the log file
function tailCustom($filePath, $lines = 1) {
    $buffer = 4096;
    $f = fopen($filePath, 'rb');
    fseek($f, -1, SEEK_END);
    if (fread($f, 1) != "\n") $lines -= 1;
    
    $output = '';
    $chunk = '';

    while (ftell($f) > 0 && $lines >= 0) {
        $seek = min(ftell($f), $buffer);
        fseek($f, -$seek, SEEK_CUR);
        $output = ($chunk = fread($f, $seek)) . $output;
        fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
        $lines -= substr_count($chunk, "\n");
    }

    while ($lines++ < 0) {
        $output = substr($output, strpos($output, "\n") + 1);
    }

    fclose($f);
    return trim($output);
}

// Read the last n lines from the file
$lastLines = explode("\n", tailCustom($logFilePath, $n));

// Start the HTML table
echo "<table border='1'>";
echo "<tr><th>IP Address</th><th>Host Name</th><th>Date and Time</th><th>Request</th><th>Status</th><th>Size</th></tr>";

// Process each line
foreach ($lastLines as $line) {
    preg_match('/(\S+) \S+ \S+ \[(.+?)\] \"(.*?)\" (\S+) (\S+)/', $line, $matches);

    if (!empty($matches)) {
        $ip = $matches[1];
        $host = gethostbyaddr($ip); // Lookup the host name from the IP address

        echo "<tr>";
        echo "<td>" . htmlspecialchars($ip) . "</td>";
        echo "<td>" . htmlspecialchars($host) . "</td>";
        for ($i = 2; $i <= 5; $i++) {
            echo "<td>" . htmlspecialchars($matches[$i] ?? '-') . "</td>";
        }
        echo "</tr>";
    }
}

echo "</table>";

?>

