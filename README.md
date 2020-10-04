# IT490
# logging module

10/3 23:45

Just did some minor updates to the logging module, I was unable to test it when i wrote the files a few days ago because my internet had been cut out, we will be testing 
monday and tuesday at any rate. 

As i am reading over what I wrote again, I am seeing a problem. As its written now the rabbit server will always overwrite its own file if the one sent to it is different, so we are going
to have to make it so that it will only overwrite its existing file if the one that is sent is LONGER than the one it currently has i.e. the sent one has a new entry. 
Right now it just compares them with sha_1 for equivalency, so we will just have to change that to give a length of the file in some metric and decide based on that. 
