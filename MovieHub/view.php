<?php
    include ('includes/session.php');
    
    $page_title = 'Search';
    include ('includes/header.php');
    //include ('includes/cart.css');
    
    //include ('search.php');
    
    
    echo '<h1>About this movie</h1>';
    
    require_once ('mysqli_connect.php');
    
    
    $ID = $_POST['view'];//title
    
    
    
    $query = "SELECT Title as t, Price as p, Description as d, Genre as g, tags as ta FROM Movies WHERE ID = '" . $ID . "' ";
   
    $result = @\mysqli_query($dbc, $query);
    
    $row = mysqli_fetch_row($result);
    $_SESSION['row'] = $row;
    $t = $row[0];
    
    
    //Displaying results
    echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">';
    
    echo '<tr> <td>Title: '.$row[0].'</td> <td>Price: '.$row[1].'</td> <td>Descrption: '.$row[2].'</td> <td>Genre: '.$row[3].'</td><td>Tags: '.$row[4].'</td></tr>';
    
    echo '</table>';
    
    echo '<br>';
    
//    if($_GET['button']){ add(); }
//
//       function add(){
//
        //if (isset($_POST['added'])) {
        //$row = $_SESSION['row'];
        
        
        $q = "INSERT INTO Cart (title, price, description, genre, tags) VALUES ('$t', '$row[1]', '$row[2]', '$row[3]', '$row[4]')";
        
        $r = @\mysqli_query($dbc, $q);
        
        if ($r) {
            
            echo '<h1>Great!</h1>
            <p>The movie was added to your cart</p><p><br /></p>';
            
        } else {
            echo '<h1>System Error</h1>
            <p class="error">Movie could not be added. We apologize for any inconvenience.</p>';
                
                echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
        }
       // }
           
       //}
    
    
    //btn btn-sm btn-primary
    ?>
 <button id="button" class="btn btn-sm btn-primary" type="button" name="test" id="test" value="<?php if (isset($_POST['added'])) echo $_POST['added']; ?>" onclick='location.href="?button=1"'>Add To Cart</button>

<?php


    mysqli_close($dbc);
    
    //echo '<div id="info" title="Basic"><p>Info</p></div>';
    //echo '<script>   function show(){  alert("Added to Cart "); }    </script>';
    
    
    include ('includes/footer.html');
        
    ?>


