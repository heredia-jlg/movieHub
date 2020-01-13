<?php
    include ('includes/session.php');
    
    $page_title = 'Search';
    include ('includes/header.php');
    include ('includes/cart.css');
    
    //echo '<script type="text/javascript" src="js/search.js"></script>';
    
    
    echo '<h1>Search</h1>';
    
    require_once ('mysqli_connect.php');
    
    ?>

<form class="form-signin" role="form" action="search.php" method="post">

<p> <input type="normal" class="form-control" placeholder="Movie Title" required name="search" maxlength="40" value="<?php if (isset($_POST['search'])) echo $_POST['search']; ?>" /></p>

<p><button type="submit" name="submit" class="btn btn-sm btn-primary" />Search</button></p>
<input type="hidden" name="submitted" value="TRUE" />
</form>


<?php
        
    if (isset($_POST['submitted'])) {
    
        $q = "SELECT Title AS title, ID as id FROM Movies";
        
        $r = @\mysqli_query($dbc, $q);
        
        $num = mysqli_num_rows($r);
        
        if (!$r) {
            echo '<h1>System Error</h1>
            <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
                
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
        }
 
        
        if (empty($_POST['search'])) {
            $errors[] = 'You forgot to enter your first name.';
        } else {
            $search = ($_POST['search']);
        }
        
        

        echo '<table align="center" cellspacing="3" cellpadding="3" width="75%"><tr><td align="center"><b>Title</b></td></tr>';
        
        $results = FALSE;
        $resultsArray[] = array();
        $index[] = array();
        // Fetch and print all the records:
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                
                //Compare search keyword with string from table of same length
                $klength = strlen($search);
                
                $keyWord = $row['title'];
                $id = $row['id'];
        
                $shortkeyWord = substr($keyWord, 0, $klength );
                
                
                
                if($search == $shortkeyWord)
                {
                    array_push($resultsArray, $keyWord);
                    $results = TRUE;
                    echo '<tr><td align="center" class="movie_result" >' . $keyWord . '<form action="view.php" method="post"><button class="btn btn-sm btn-primary" type="submit" name="view" value="'.$id.'" >View Info</button></form></td>';
                }
                
                $_SESSION['results'] = $resultsArray;
            }
        
        if(!$results)
        {
            echo '<p class="error">We do not have anything with that word :( </p>';
        }
        
        echo '</table>';
        
        mysqli_free_result ($r);



    }
        
    
    mysqli_close($dbc);
    
    //echo '<div id="info" title="Basic"><p>Info</p></div>';
    echo '<script>   function show(){  alert("Added to Cart "); }    </script>';
    
    
    include ('includes/footer.html');
        
    ?>


