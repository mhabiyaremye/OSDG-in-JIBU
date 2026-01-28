function downloadCSV() {
    // Trigger a file download by redirecting the browser to a PHP file that handles the CSV download.
    window.location.href = 'download.php';  // Replace 'download.php' with the correct path to your PHP download handler.
}