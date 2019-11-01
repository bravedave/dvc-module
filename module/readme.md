# [module] Folder

this folder houses your **[module]**.

It is exposed via the nominated namespace

# todo
1. Optionally rename the folder to reflect the name space
2. edit the **composer.json** file to
   a. maintain the reference to this folder if you rename it
   b. designate the namespace
3. re-reun **composer update** to update the autoload files
4. modify the [module]s *controller* to reflect the namespace

*for development*
you will want to update the [application]/controller/home.php
to reference this namespace ..

ready to start development