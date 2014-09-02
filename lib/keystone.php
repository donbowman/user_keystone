<?php

/**
 * Copyright (c) 2014 Don Bowman (don.waterloo@gmail.com)
 * This file is licensed under the GNU General Public License, version 2
 * or later.
 */

require_once 'php-opencloud/php-opencloud.php';

use OpenCloud\OpenStack;

class OC_User_Keystone extends OC_User_Backend{
        private $url;

	public function __construct($url) {
            $this->url = $url;
	}

	/**
	 * @brief Check if the password is correct
	 * @param $uid The username
	 * @param $password The password
	 * @returns true/false
	 *
	 * Check if the password is correct without logging in the user
	 */
	public function checkPassword($uid, $password) {

		try {
                    $client = new OpenStack($this->url, array(
                        'username' => $uid,
                        'password' => $password,
                        'tenantName' => $uid
                    ));
                    $client->authenticate();
                } catch (Exception $e) {
                    return false;
                }
		try {
			OC_User::createUser($uid, $password);
		} catch (Exception $e) {
		}

		try {
			OC_Group::createGroup($uid);
			OC_Group::addToGroup( $uid, $uid );
		} catch (Exception $e) {
		}

                return $uid;
	}

	public function userExists($uid) {
		return true;
	}
	public function getHome($uid) {
		$path = \OC::$SERVERROOT . '/data/' . $uid;
		return $path;
	}
}
