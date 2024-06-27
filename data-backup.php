<?php


// Securely load database configuration from environment variables or a secure file
$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'Sahan@200212010';
$database_name = getenv('DB_NAME') ?: 'krist_db';

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $database_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$conn->set_charset("utf8");

// Fetch all table names
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
} else {
    die("Error fetching tables: " . mysqli_error($conn));
}

// Initialize SQL script variable
$sqlScript = "";
foreach ($tables as $table) {
    // Fetch table structure
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_row($result);
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
    }

    // Fetch table data
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $columnCount = mysqli_num_fields($result);

        // Prepare SQL script for table data
        while ($row = mysqli_fetch_row($result)) {
            $sqlScript .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $columnCount; $j++) {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = str_replace("\n", "\\n", $row[$j]);
                if (isset($row[$j])) {
                    $sqlScript .= '"' . $row[$j] . '"';
                } else {
                    $sqlScript .= 'NULL';
                }
                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }
            }
            $sqlScript .= ");\n";
        }
    }
    $sqlScript .= "\n";
}

// Create and save the backup file
if (!empty($sqlScript)) {
    $backup_file_name = $database_name . '_backup_' . time() . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    if ($fileHandler) {
        fwrite($fileHandler, $sqlScript);
        fclose($fileHandler);

        // Force download of the backup file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_file_name));
        ob_clean();
        flush();
        readfile($backup_file_name);

        // Remove the backup file from the server
        unlink($backup_file_name);
        exit;
    } else {
        die("Error creating backup file.");
    }
} else {
    die("No data to backup.");
}

mysqli_close($conn);
?>
