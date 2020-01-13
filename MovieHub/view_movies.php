<?php
include ('includes/session.php');

$page_title = 'View the Current Movies';
include ('includes/header.php');


echo '<h1>Movies in Database</h1>';

require_once ('mysqli_connect.php');

    $q = "SELECT Title AS title, Price AS price FROM Movies";
    
$r = @\mysqli_query($dbc, $q);


$num = mysqli_num_rows($r);

if ($num > 0) {
    
    echo "<p>There are currently $num movies in our database.</p>\n";

    echo '<table align="center" cellspacing="3" cellpadding="3" width="75%"><tr><td align="left"><b>Name</b></td><td align="left"><b>Price</b></td></tr>
    ';
    
    // Fetch and print all the records:
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr><td align="left">' . $row['title'] . '</td><td align="left">' . $row['price'] . '</td></tr>
        ';
    }
    
    echo '</table>';
    
    mysqli_free_result ($r);
    
} else {
    
    echo '<p class="error">There are currently no movies in our database.</p>';
    
}

mysqli_close($dbc);

include ('includes/footer.html');
?>

