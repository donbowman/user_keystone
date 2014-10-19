This library allows one to authenticate against keystone (from OpenStack).

To install, place the file in /usr/share/owncloud/apps/user_exernal/lib
and then add this line to owncloud/apps/user_external/appinfo/app.php

    OC::$CLASSPATH['OC_User_Keystone']='user_external/lib/keystone.php';

in config/config.php add a paragraph like this in the middle:
    "user_backends" => array (
        0 => array (
          "class"     => "OC_User_Keystone",
          "arguments" => array (
            0 => 'http[s]://KEYSTONE_HOST/v2.0/'
          ),
        ),
      ),

And, then, every user who can authenticate (in anyway shape or form) against
Keystone can use ownCloud.

it also needs php-opencloud (https://github.com/rackspace/php-opencloud)

    cd /var/www/owncloud/3rdparty/rackspace
    curl -sS https://getcomposer.org/installer | php
    php composer.phar require rackspace/php-opencloud:dev-master

