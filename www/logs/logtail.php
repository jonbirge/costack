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
echo "<tr><th>IP Address</th><th>Identity</th><th>User</th><th>Date and Time</th><th>Request</th><th>Status</th><th>Size</th></tr>";

// Process each line
foreach ($lastLines as $line) {
    // Parsing the line with a regular expression
    preg_match('/(\S+) (\S+) (\S+) \[(.+?)\] \"(.*?)\" (\S+) (\S+)/', $line, $matches);

    echo "<tr>";
    for ($i = 1; $i <= 7; $i++) {
        echo "<td>" . htmlspecialchars($matches[$i] ?? '-') . "</td>";
    }
    echo "</tr>";
}

echo "</table>";

?>

