<?php

/**
 * Copyright (c) 2014 Don Bowman (don.waterloo@gmail.com)
 * This file is licensed under the GNU General Public License, version 2
 * or later.
 */

require_once 'rackspace/vendor/autoload.php';

use OpenCloud\OpenStack;

class OC_User_Keystone extends \OCA\user_external\Base{
        private $url;

	public function __construct($url) {
            $this->url = $url;
            parent::__construct("keystone: " . $url);
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

		OCP\Util::writeLog(
			'user_external',
			'Keysone: ' . $uid, OCP\Util::ERROR
		);
		try {
                    $client = new OpenStack($this->url, array(
                        'username' => $uid,
                        'password' => $password,
                        'tenantName' => $uid
                    ));
                    $client->authenticate();
                } catch (Exception $e) {
			OCP\Util::writeLog(
				'user_external',
				'Keysone exception: ' . $uid, OCP\Util::ERROR
			);
                    return false;
                }
                $this->storeUser($uid);
		OCP\Util::writeLog(
			'user_external',
			'Keysone OK: ' . $uid, OCP\Util::ERROR
		);
                return $uid;
	}

}
