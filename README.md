# IT490

9/25 14:42

It does not appear that the .conf and .monit files are being used, and it does not seem to impede the flow to have them possibly not being used. Need to ask about their significance. The three .inc files as well as the .ini file are absolutely neccessary for tstRbSrvr.php to function. This has some different output to verify that it has indeed received a message from the Apache2 VM which was driven by the user inputting their credentials. this code as well as the code in Stag will work together to verify that the doItAll() function in the Stag Rabbitclient code, which is called by login.php, runs and prints the server's output to the screen for the website user. The user iputs their data on index.html, it is passed with POST to login.php. Login.php has the code (preceeding the HTML markup) which calls the function that passes the auth credentials to the RabbitVM to be passed to the DB. This function, doItAll(), is almost the entire rabbitClient script wrapped into a single method. Method is just passing dummy code right now though, have to change it to taking the $username and $password as arguments. Right now At this moment SMalishuk is working on the DB end of things and we will attempt to link the whole chain ASAP. 


9/25 14:52

Server needs host.ini to run, excluded this at first.
