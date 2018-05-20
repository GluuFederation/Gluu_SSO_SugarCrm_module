<?php
	/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

	/**
	 * @copyright Copyright (c) 2017, Gluu Inc. (https://gluu.org/)
	 * @license	  MIT   License      : <http://opensource.org/licenses/MIT>
	 *
	 * @package	  OpenID Connect SSO Module by Gluu
	 * @category  Module for SugarCrm
	 * @version   3.0.1
	 *
	 * @author    Gluu Inc.          : <https://gluu.org>
	 * @link      Oxd site           : <https://oxd.gluu.org>
	 * @link      Documentation      : <https://gluu.org/docs/oxd/3.0.1/plugin/sugarcrm/>
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
	$manifest = array(
	    'acceptable_sugar_flavors' => array('CE', 'PRO', 'CORP', 'ENT', 'ULT'),
	    'acceptable_sugar_versions' => array(
	        'exact_matches' => array(),
	        'regex_matches' => array(
	            0 => '6\\.5\\.(.*?)',
	            1 => '6\\.7\\.(.*?)',
	            2 => '7\\.2\\.(.*?)',
	            3 => '7\\.2\\.(.*?)\\.(.*?)',
	            4 => '7\\.5\\.(.*?)\\.(.*?)',
	            5 => '7\\.6\\.(.*?)\\.(.*?)'
	        )
	    ),
	    'author' => 'Gluu',
	    'description' => 'This module will enable you to authenticate users against any standard OpenID Connect Provider.',
	    'icon' => '',
	    'is_uninstallable' => true,
	    'name' => 'OpenID Connect SSO by Gluu',
	    'published_date' => '2017-02-18 20:45:04',
	    'type' => 'module',
	    'version' => '3.1.2',
	    'remove_tables' => 'prompt',
	
	);
	
	$installdefs = array (
	    'id'=> 'gluusso',
	  'copy' =>
	  array (
	    array (
	      'from' => '<basepath>/custom/modules/Users/Login.php',
	      'to' => 'custom/modules/Users/Login.php',
	    ),
	    array (
	       'from' => '<basepath>/custom/modules/Users/Logout.php',
	       'to' => 'custom/modules/Users/Logout.php',
	    ),
	    array (
	      'from' => '<basepath>/custom/include/globalControlLinks.php',
	      'to' => 'custom/include/globalControlLinks.php',
	    ),
	      array (
	          'from' => '<basepath>/custom/application/Ext/Include/modules.ext.php',
	          'to' => 'custom/application/Ext/Include/modules.ext.php',
	      ),
	      array (
	          'from' => '<basepath>/modules/Gluussos',
	          'to' => 'modules/Gluussos',
	      ),
	      array (
	          'from' => '<basepath>/gluu.php',
	          'to' => 'gluu.php',
	      ),
	      array (
	          'from' => '<basepath>/gluu_logout.php',
	          'to' => 'gluu_logout.php',
	      ),
	  ),
	);




