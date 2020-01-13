<?php
    include ('includes/session.php');
    
    $page_title = 'Add Movie';
    include ('./includes/header.php');
    
    require_once ('mysqli_connect.php');
    
    if (isset($_POST['submitted'])) {
     
        $errors = array();
        
        if (empty($_POST['movie_title'])) {
            $errors[] = 'You forgot to enter the title.';
        } else {
            $title = mysqli_real_escape_string($dbc, trim($_POST['movie_title']));
        }
        
        if (empty($_POST['movie_price'])) {
            $errors[] = 'You forgot to enter the price.';
        } else {
            $price = mysqli_real_escape_string($dbc, trim($_POST['movie_price']));
        }
        
        if (empty($errors)) {
            
            $q = "INSERT INTO Movies ( Title, Price) VALUES ('$title', '$price')";
            $r = @mysqli_query ($dbc, $q);
            if ($r) {
                
                echo '<h1>Done!</h1>
                <p>Movie was added!</p><p><br /></p>';
                
            } else {
                
                echo '<h1>System Error</h1>
                <p class="error">We could not add the movie, sorry.</p>';
                    
                    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
                
            }
            
            mysqli_close($dbc);
            
            include ('includes/footer.html');
            exit();
            
        } else { //if there are error in array
            
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) {
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
            
        }
        
        
    }
    
    
    
?>
<div class="page-header">

<form class="form-signin" role="form" action="add_movies.php" method="post">

    <h2 class="form-signin-heading">Add Movie to Database</h2>

    <input type="normal" class="form-control" placeholder="Title" required autofocus name="movie_title" maxlength="10"value="<?php if (isset($_POST['movie_title'])) echo $_POST['movie_title']; ?>">
    <input type="decimal" class="form-control" placeholder="Price" required name="movie_price" maxlength="5" value="<?php if (isset($_POST['movie_price'])) echo $_POST['movie_price']; ?>">



    <p><button class="btn btn-sm btn-primary" type="submit" name="submit">Add</button></p>
    <input type="hidden" name="submitted" value="TRUE" />
</form>

</div>

<?php
    include ('./includes/footer.html');
?>
