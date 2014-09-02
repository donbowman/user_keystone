This library allows one to authenticate against keystone (from OpenStack).

To install, place the files in /usr/share/owncloud/apps/user_keystone

in config/config.php, place a line like this near the top:

    require_once('/usr/share/owncloud/apps/user_keystone/lib/keystone.php');

and then add a paragraph like this in the middle:

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

Watch out that a reconfigure can wipe the require_once() line.
