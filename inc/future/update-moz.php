<?php
// Don't allow script to run from another server
if (isset($_SERVER['REMOTE_ADDR'])) die('Permission denied.');

/** The name of the database for WordPress */
define('DB_NAME', 'mckaya6_maappa');

/** MySQL database username */
define('DB_USER', 'mckaya6_maappa');

/** MySQL database password */
define('DB_PASSWORD', '[54P(I1sS9');

/** MySQL hostname */
define('DB_HOST', 'localhost');

include '../lib/moz-api/bootstrap.php';

// Add your accessID here
$AccessID = 'mozscape-81630d005e';
// Add your secretKey here
$SecretKey = '9d55ff8e625591efb7328d29f6dbe32';
// Set the rate limit
$rateLimit = 10;

$authenticator = new Authenticator();
$authenticator->setAccessID($AccessID);
$authenticator->setSecretKey($SecretKey);
$authenticator->setRateLimit($rateLimit);

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
reg_date TIMESTAMP,
domain_name VARCHAR(30) NOT NULL,
page_name VARCHAR(50),
domain_authority INT(10),
page_authority INT(10),
external_links INT(10),
page_name INT(10),
page_name INT(10),

)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();


// Query database for URLs

// Set batch size here
$batchSize = 200;

// Batch URLs
$dbConnector -> setBatchSize($batchSize);
$batchedDomains = $dbConnector->getBatchedURLs($db_urls);


echo "Batch size = $batchSize\n\n";

// Metrics to retrieve (url_metrics_constants.php)
$cols = URLMETRICS_COL_DEFAULT;

// Send batches to Mozscape API
$i = 0;
foreach ($batchedDomains as $objectURL) {
	$i++;

	$urlMetricsService = new URLMetricsService($authenticator);
	$response = $urlMetricsService->getUrlMetrics($objectURL, $cols);

	echo "\n\n";
	print_r($response);
}