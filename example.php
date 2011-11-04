<?php

if( isset( $_POST['location'] ) )
{
    /**
     * Include the Weather lib
     */
    require_once( 'lib/Google/Weather.php' );
    
    $weather = new Google_Weather();
    $weather->setLocation( $_POST['location'] )->call();
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Google Weather API</title>
    </head>
    <body>
        
        <style type="text/css">
            <!--
                
                body{
                    color: #3F3636;
                    font-size: 12px;
                    font-weight: normal;
                }
                
                form, h1 {
                    margin: 10px;
                    text-align: center;
                }
                
                div#result {
                    background-color: #D3CFCF;
                    border: 1px solid #3d3d3d;
                    margin: 10px 0;
                    padding: 10px;
                }
                
            -->
        </style>
        
        <h1>Search location below:</h1>
        <form method="post" action="#">
            <input type="text" name="location" value="" />
            <input type="submit" value="Search" name="send" />
        </form>
        <div id="result">
            <?php if( isset( $weather ) ): ?>
            
            <p><?php echo $weather->current_conditions->condition['data'] ?></p>
            
            <?php endif ?>            
        </div>
    </body>
</html>