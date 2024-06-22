<?php
echo "<h2>Important</h2>"; 
echo "PHP_SELF is <span style='color:red'>".$_SERVER['PHP_SELF']."</span><br>";//Current PHP file name
echo "SERVER_ADDR is <span style='color:red'>".$_SERVER['SERVER_ADDR']."</span><br>";//Getting Current Host Address
echo "SERVER_NAME is <span style='color:red'>".$_SERVER['SERVER_NAME']."</span><br>";//Getting Current Domain Name
echo "REQUEST_METHOD is <span style='color:red'>".$_SERVER['REQUEST_METHOD']."</span><br>";//Getting Request Method
echo "SERVER_PROTOCOL is <span style='color:red'>".$_SERVER['SERVER_PROTOCOL']."</span><br>";//Getting Server Protocol and Version
echo "REQUEST_TIME is <span style='color:red'>".$_SERVER['REQUEST_TIME']."</span><br>";//Getting Request Time
echo "QUERY_STRING is <span style='color:red'>".$_SERVER['QUERY_STRING']."</span><br>";//Getting Query String
echo "DOCUMENT_ROOT is <span style='color:red'>".$_SERVER['DOCUMENT_ROOT']."</span><br>";//Getting Document Root
echo "HTTP_HOST is <span style='color:red'>".$_SERVER['HTTP_HOST']."</span><br>";//Getting HTTP Host
echo "HTTP_USER_AGENT is <span style='color:red'>".$_SERVER['HTTP_USER_AGENT']."</span><br>";//Getting User Agent
echo "SCRIPT_FILENAME is <span style='color:red'>".$_SERVER['SCRIPT_FILENAME']."<span><br>";//Absolute Path of Current File
echo "SERVER_PORT is </span style='color:red'>".$_SERVER['SERVER_PORT']."</span><br>";//Getting Port Number
echo "SCRIPT_NAME is <span style='color:red'>".$_SERVER['SCRIPT_NAME']."</span><br>";//Script File Name
echo "REQUEST_URI is <span style='color:red'>".$_SERVER['REQUEST_URI']."</span><br>";//Request URI
echo "REMOTE_ADDR is <span style='color:red'>".$_SERVER['REMOTE_ADDR']."</span><br>";//Remote Address


echo "<h3>Not frequently use</h3>";
echo "GATEWAY_INTERFACE is <span style='color:red'>".$_SERVER['GATEWAY_INTERFACE']."</span><br>";//Getting Gateway Interface
echo "SERVER_SOFTWARE is <span style='color:red'>".$_SERVER['SERVER_SOFTWARE']."</span>"."<br>";//Getting Server Software
echo "HTTP_ACCEPT is <span style='color:red'>".$_SERVER['HTTP_ACCEPT']."</span>"."<br>";//Server HTTP Accept File Type
echo "HTTP_ACCEPT_ENCODING is <span style='color:red'>".$_SERVER['HTTP_ACCEPT_ENCODING']."</span>"."<br>";//Server http accept gzip df..
echo "HTTP_ACCEPT_LANGUAGE is <span style='color:red'>".$_SERVER['HTTP_ACCEPT_LANGUAGE']."</span>"."<br>";//Server Accept Language EN_US..
echo "HTTP_CONNECTION is <span style='color:red'>".$_SERVER['HTTP_CONNECTION']."</span>"."<br>";// HTTP Connection
echo "REMOTE_PORT is <span style='color:red'>".$_SERVER['REMOTE_PORT']."</span>"."<br>";//Remote Port
echo "SERVER_ADMIN is<span style='color:red'>".$_SERVER['SERVER_ADMIN']."</span>"."<br>";//Server Admin
echo "SERVER_SIGNATURE is <span style='color:red'>".$_SERVER['SERVER_SIGNATURE']."</span>";//Server Signaure




 ?>