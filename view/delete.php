


<?php



if (mysqli_affected_rows() == 1) 
{
?>

            <strong>Book Has Been Deleted</strong><br /><br />

<?php
 } else { 
?>

            <strong>Deletion Failed</strong><br /><br />


<?php
} 
?>
