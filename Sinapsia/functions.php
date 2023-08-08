<?php 
function post_request(){
    return ($_SERVER['REQUEST_METHOD']) === 'POST';

}
?>