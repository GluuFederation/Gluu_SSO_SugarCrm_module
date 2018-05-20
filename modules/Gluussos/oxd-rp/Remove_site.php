<?php

/**
 * Gluu-oxd-library
 *
 * An open source application library for PHP
 *
 *
 * @copyright Copyright (c) 2017, Gluu Inc. (https://gluu.org/)
 * @license	  MIT   License            : <http://opensource.org/licenses/MIT>
 *
 * @package	  Oxd Library by Gluu
 * @category  Library, Api
 * @version   3.1.2
 *
 * @author    Gluu Inc.          : <https://gluu.org>
 * @link      Oxd site           : <https://oxd.gluu.org>
 * @link      Documentation      : <https://oxd.gluu.org/docs/libraries/php/>
 * @director  Mike Schwartz      : <mike@gluu.org>
 * @support   Support email      : <support@gluu.org>
 * @developer Volodya Karapetyan : <https://github.com/karapetyan88> <mr.karapetyan88@gmail.com>
 *

 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017, Gluu inc, USA, Austin
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */
/**
 * Client Remove_site class
 *
 * Class is connecting to oxd-server via socket, and registering site in gluu server.
 *
 * @package		  Gluu-oxd-library
 * @subpackage	Libraries
 * @category	  Relying Party (RP) and User Managed Access (UMA)\
 * @see	        Client_OXD_RP
 * @see	        Oxd_RP_config
 */

require_once 'Client_OXD_RP.php';

class Remove_site extends Client_OXD_RP {
    /*     * start parameter for request!* */

    /**
     * @var string $request_oxd_id Need to get after registration site in gluu-server
     */
    private $request_oxd_id = null;

    /**
     * @var string $request_protection_access_token access token for each request
     */
    private $request_protection_access_token = null;
    /*     * end request parameter* */

    /*     * start parameter for response!* */

    /**
     * @var string $request_oxd_id Need to get after registration site in gluu-server
     */
    private $response_oxd_id = null;

    public function __construct() {
        parent::__construct(); // TODO: Change the autogenerated stub
    }

    /**
     * @return string
     */
    public function getRequestOxdId() {
        return $this->request_oxd_id;
    }

    /**
     * @param string $request_oxd_id
     * @return	void
     */
    public function setRequestOxdId($request_oxd_id) {
        $this->request_oxd_id = $request_oxd_id;
    }

    /**
     * @return string
     */
    function getRequest_protection_access_token() {
        return $this->request_protection_access_token;
    }

    /**
     * @param string $request_protection_access_token
     * @return void
     */
    function setRequest_protection_access_token($request_protection_access_token) {
        $this->request_protection_access_token = $request_protection_access_token;
    }

    /**
     * @return string
     */
    public function getResponseOxdId() {
        $this->response_oxd_id = $this->getResponseData()->oxd_id;
        return $this->response_oxd_id;
    }

    /**
     * Protocol command to oxd server
     * @return void
     */
    public function setCommand() {
        $this->command = 'remove_site';
    }

    /**
     * Protocol parameter to oxd server
     * @return void
     */
    public function setParams() {
        $this->params = array(
            "oxd_id" => $this->getRequestOxdId(),
            "protection_access_token" => $this->getRequest_protection_access_token()
        );
    }

}