<?php

//////////////////////////////////////////////////////////////////////////////
// 
// File:	function.qrcode.php
// Project:	QR Code plugin for CMS Made Simple
// Version:	1.02
// Licence:	Free software under the GNU General Public License
//		Google Chart API is trademarked by Google Inc.
//		QR code is trademarked by Denso Wave Inc.
// Web:		http://dev.cmsmadesimple.org/projects/qrcode
// Created:	v1.00, 20110701, Andrea Weichbrodt (wich)
// Updated:	v1.01, 20110702, Andrea Weichbrodt (wich)
//		v1.02, 20111216, Andrea Weichbrodt (wich)
//
//////////////////////////////////////////////////////////////////////////////

function smarty_cms_function_qrcode($params, &$smarty) {

	// Set statics values
	$API = "http://chart.apis.google.com/chart";
	$CHT = "qr";

	// Find the url of current page
	$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
	$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
	$port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
	$current_url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$_SERVER["REQUEST_URI"]; // url of current page

	// Check for commons parameters
	$class = isset($params['class']) ? ' class="' . trim($params['class']) . '"' : ""; // QR Code image CSS class
	$id = isset($params['id']) ? ' id="' . trim($params['id']) . '"' : ""; // QR Code image CSS id
	$size = isset($params['size']) ? trim($params['size']) : "200"; // QR Code image size (if not set use the value 200x200 px)
	$type = isset($params['type']) ? strtolower(trim($params['type'])) : "url"; // QR Code data type (if not set use the url value)

	switch ($type) {
		case "call":
			// Check for specifics parameters and call a phone number
			$phone = isset($params['phone']) ? $params['phone'] : ""; // phone number (needed)
			$data = 'tel:' . $phone; // QR Code data
			$alt = 'Call ' . $phone;
			$title = 'Call ' . $phone;
			break;
		case "email":
			// Check for specifics parameters and send an e-mail message
			$to = isset($params['to']) ? $params['to'] : ""; // e-mail address
			$data = 'mailto:' . $to;
			$data .= '?subject=' . isset($params['subject']) ? $params['subject'] : "";
			$data .= '&amp;body=' . isset($params['body']) ? $params['body'] : $current_url; // QR Code data
			$alt = 'E-mail ' . $to;
			$title = 'E-mail ' . $to;
			break;
		case "mecard":
			// Check for specifics parameters and generate a meCard
			$last_name = isset($params['last_name']) ? $params['last_name'] : ""; // last name (needed)
			$first_name = isset($params['first_name']) ? $params['first_name'] : ""; // first name (needed)
			$data = 'MECARD:';
			$data .= 'N:' . $last_name . ',' . $first_name . ';'; // name
			$data .= isset($params['tel']) ? 'TEL:' . $params['org'] . ';' : ""; // telephone
			$data .= isset($params['email']) ? 'EMAIL:' . $params['email'] . ';' : ""; // e-mail
			$data .= isset($params['note']) ? 'NOTE:' . $params['note'] . ';' : ""; // note or memo
			$data .= isset($params['birthday']) ? 'BDAY:' . $params['birthday'] . ';' : ""; // birthday (YYYYMMDD)
			$data .= 'ADR:,,';
			$data .= (isset($params['address']) ? $params['address'] : "") . ',';
			$data .= (isset($params['city']) ? $params['city'] : "") . ',';
			$data .= (isset($params['state']) ? $params['state'] : "") . ',';
			$data .= (isset($params['pc']) ? $params['pc'] : "") . ',';
			$data .= (isset($params['nation']) ? $params['nation'] : "") . ';'; // complete address
			// $data .= isset($params['web']) ? 'URL:' . str_replace(":", "\:", $params['web']) . ';' : ""; // web (escape on special char ":")
			$data .= isset($params['web']) ? 'URL:' . $params['web'] . ';' : ""; // web
			$data .= ';'; // QR Code data
			$alt = $first_name . ' ' . $last_name . ' meCard';
			$title = $first_name . ' ' . $last_name . ' meCard';
			break;
		case "sms":
			// Check for specifics parameters and send a SMS to a phone number
			$phone = isset($params['phone']) ? $params['phone'] : ""; // phone number
			$text = isset($params['text']) ? $params['text'] : $current_url; // text
			$data = 'smsto:' . $phone . ':' . $text; // QR Code data
			$alt = 'SMS ' . $phone;
			$title = 'SMS ' . $phone;
			break;
		case "text":
			// Check for specifics parameters and insert free text
			$data = isset($params['text']) ? $params['text'] : ""; // QR Code data
			$alt = $data;
			$title = $data;
			break;
		case "url":
			// Check for specifics parameters and open a url in the browser
			$data = isset($params['url']) ? $params['url'] : $current_url; // QR Code data
			$alt = $data;
			$title = $data;
			break;
		case "vcard":
			// Check for specifics parameters and generate a vCard 3.0
			$last_name = isset($params['last_name']) ? $params['last_name'] : ""; // last name (needed)
			$first_name = isset($params['first_name']) ? $params['first_name'] : ""; // first name (needed)
			$data = 'BEGIN:VCARD' . PHP_EOL;
			$data .= 'VERSION:3.0' . PHP_EOL;
			$data .= 'N:' . $last_name . ';' . $first_name . PHP_EOL; // name
			$data .= 'FN:' . $first_name . ' ' . $last_name . PHP_EOL; // formatted name
			$data .= isset($params['org']) ? 'ORG:' . $params['org'] . PHP_EOL : ""; // organization
			$data .= 'ADR;TYPE=WORK:;;';
			$data .= (isset($params['w_address']) ? $params['w_address'] : "") . ';';
			$data .= (isset($params['w_city']) ? $params['w_city'] : "") . ';';
			$data .= (isset($params['w_state']) ? $params['w_state'] : "") . ';';
			$data .= (isset($params['w_pc']) ? $params['w_pc'] : "") . ';';
			$data .= (isset($params['w_nation']) ? $params['w_nation'] : "") . PHP_EOL; // work address
			$data .= 'ADR;TYPE=HOME:;;';
			$data .= (isset($params['h_address']) ? $params['h_address'] : "") . ';';
			$data .= (isset($params['h_city']) ? $params['h_city'] : "") . ';';
			$data .= (isset($params['h_state']) ? $params['h_state'] : "") . ';';
			$data .= (isset($params['h_pc']) ? $params['h_pc'] : "") . ';';
			$data .= (isset($params['h_nation']) ? $params['h_nation'] : "") . PHP_EOL; // home address
			$data .= isset($params['w_tel']) ? 'TEL;TYPE=WORK,VOICE:' . $params['w_tel'] . PHP_EOL : ""; // work telephone
			$data .= isset($params['h_tel']) ? 'TEL;TYPE=HOME,VOICE:' . $params['h_tel'] . PHP_EOL : ""; // home telephone
			$data .= isset($params['w_fax']) ? 'TEL;TYPE=WORK,FAX:' . $params['w_fax'] . PHP_EOL : ""; // work fax
			$data .= isset($params['h_fax']) ? 'TEL;TYPE=HOME,FAX:' . $params['h_fax'] . PHP_EOL : ""; // home fax
			$data .= isset($params['email']) ? 'EMAIL;TYPE=INTERNET,PREF:' . $params['email'] . PHP_EOL : ""; // e-mail
			$data .= isset($params['web']) ? 'URL:' . $params['web'] . PHP_EOL : ""; // web
			$data .= 'END:VCARD'; // QR Code data
			$alt = $first_name . ' ' . $last_name . ' vCard';
			$title = $first_name . ' ' . $last_name . ' vCard';
			break;
		case "wifi":
			// Check for specifics parameters and config a WiFi network (this only works with Android)
			$auth = isset($params['auth']) ? $params['auth'] : "nopass"; // network authentication type (can be WEP, WPA, or NOPASS)
			$ssid = isset($params['ssid']) ? $params['ssid'] : ""; // network SSID
			$pass = isset($params['pass']) ? $params['pass'] : ""; // network password
			$data = 'WIFI:T:' . $auth . ';S:' . $ssid . ';P:' . $pass . ';;'; // QR Code data
			$alt = 'WiFi Network config ' . $ssid . ' (Android)';
			$title = 'WiFi Network config ' . $ssid . ' (Android)';
			break;
		default:
			// Check for specifics parameters and open a url in the browser
			$data = isset($params['url']) ? $params['url'] : $current_url; // QR Code data
			$alt = $data;
			$title = $data;
	}

	// Creation of the image tag with GET metod
	$result = '<img';
	$result .= $class;
	$result .= $id;
	$result .= ' src="' . $API . '?';
	$result .= 'chs=' . $size . 'x' . $size . '&amp;';
	$result .= 'cht=' . $CHT . '&amp;';
	$result .= 'chl=' . urlencode($data) . '"';
	$result .= ' width="' . $size . '"';
	$result .= ' height="' . $size . '"';
	$result .= ' alt="' . htmlentities($alt) . '"';
	$result .= ' title="' . htmlentities($title) . '"';
	$result .= ' />';

	// START DEBUG
	// $result .= '<p>';
	// $result .= 'value of size = ' . $size . '<br />' . PHP_EOL;
	// $result .= 'value of data = ' . urlencode($data) . '<br />' . PHP_EOL;
	// $result .= 'value of alt = ' . htmlentities($alt) . '<br />' . PHP_EOL;
	// $result .= 'value of title = ' . htmlentities($alt);
	// $result .= '</p>';
	// END DEBUG

	return $result;

}

function smarty_cms_help_function_qrcode() {
	?>
	<h3>What does this do?</h3>
	<p>Prints QR Code square image representing different kinds of data, by default the complete url of the current page, using Google Chart APIs.</p>
	<p>Let visitors open your site in a smartphone or tablet by reading a QR Code from an image that contains the URL of the current page (or a different one).</p>
	<p>Let visitors call a phone number with a smartphone by reading a QR Code from an image that contains a phone number.</p>
	<p>Let visitors send an E-mail message with a smartphone by reading a QR Code from an image that contains an E-mail address, an E-mail subject and an E-mail body.</p>
	<p>Let visitors send a SMS message to a phone number with a smartphone by reading a QR Code from an image that contains a phone number and a SMS text.</p>
	<p>Let visitors import a contact information in a smartphone by reading a QR Code from an image that contains a vCard version 3.0 or a meCard.<br />Used in conjunction with the output of others modules, e.g. CompanyDirectory or CGUserDirectory, this plugin can provide an easy way to load the user contact info into a mobile phone.</p>
	<p>Let visitors config a WiFi network connection in a smartphone by reading a QR Code from an image that contains the configuration (this only works with Android).</p>
	<p>Useful to retrieve informations from screens or from a printed version of the page.</p>
	<p>Note that some of the features mentioned here may not work properly depending on the OS and applications installed in your mobile phone.</p>
	<h3>How do I use it?</h3>
	<p>Insert the tag into your template or page: <code>{qrcode}</code></p>
	<h3>What parameters does it take?</h3>
	<ul>
		<li><em>(optional)</em> <code>class</code></li>
		<ul>
			<li>Set the CSS class name for the QR Code image tag</li>
			<li>E.g. <code>{qrcode class="MyCssClassName"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>id</code></li>
		<ul>
			<li>Set the CSS id name for the QR Code image tag</li>
			<li>E.g. <code>{qrcode id="MyCssIdName"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>size</code></li>
		<ul>
			<li>Set the base size of the QR Code image in pixel</li>
			<li>Do NOT define to print a QR Code image of 200x200 pixel</li>
			<li>E.g. <code>{qrcode size="300"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>type</code></li>
		<ul>
			<li>Set the type of the data that the QR Code image represents</li>
			<li>Do NOT define, or set to <code>url</code>, to generate a QR Code image that contains a url</li>
			<li>Set to <code>url</code> to generate a QR Code image that contains a url</li>
			<ul>
				<li>In this case the parameter <code>url</code> is optional, use it to set the complete url of the page the QR Code image represents</li>
				<li>Do NOT define the parameter <code>url</code> to print a QR Code image of the current page</li>
				<li>E.g. <code>{qrcode}</code> is equivalent to <code>{qrcode type="url"}</code> open the url of current page</li>
				<li>E.g. <code>{qrcode url="http://www.anotherpage.ext"}</code> is equivalent to <code>{qrcode type="url" url="http://www.anotherpage.ext"}</code> open the url of another page or domain</li>
			</ul>
			<li>Set to <code>call</code> to generate a QR Code image for call a telephone number</li>
			<ul>
				<li>In this case the parameter <code>phone</code> (telephone number) is needed</li>
				<li>E.g. <code>{qrcode type="call" phone="+390000000000"}</code></li>
			</ul>
			<li>Set to <code>email</code> to generate a QR Code image for send an E-mail message, with subject and body, to an E-mail address</li>
			<ul>
				<li>In this case the parameter <code>to</code> (e-mail address) is optional</li>
				<li>In this case the parameter <code>subject</code> (e-mail subject) is optional</li>
				<li>In this case the parameter <code>body</code> (e-mail body) is optional</li>
				<li>Do NOT define the parameter <code>body</code> to insert in the e-mail body the url of the current page</li>
				<li>E.g. <code>{qrcode type="email" to="user@domain.ext" subject="MySubject" body="Hallo world!"}</code></li>
				<li>E.g. <code>{qrcode type="email" to="user@domain.ext" subject="MySubject"}</code> send the url of current page</li>
			</ul>
			<li>Set to <code>mecard</code> to generate a QR Code image that contains contact informations in meCard format</li>
			<ul>
				<li>In this case the parameter <code>last_name</code> (last name) is needed</li>
				<li>In this case the parameter <code>first_name</code> (first_name) is needed</li>
				<li>In this case the parameter <code>address</code> (street address) is optional</li>
				<li>In this case the parameter <code>city</code> (city) is optional</li>
				<li>In this case the parameter <code>state</code> (state) is optional</li>
				<li>In this case the parameter <code>pc</code> (postal code) is optional</li>
				<li>In this case the parameter <code>nation</code> (nation) is optional</li>
				<li>In this case the parameter <code>tel</code> (telephone number) is optional</li>
				<li>In this case the parameter <code>email</code> (e-mail address) is optional</li>
				<li>In this case the parameter <code>web</code> (internet web page) is optional</li>
				<li>In this case the parameter <code>birthday</code> (birthday in format YYYYMMDD) is optional</li>
				<li>In this case the parameter <code>note</code> (note or memo) is optional</li>
				<li>E.g. <code>{qrcode type="mecard" first_name="MyFirstName" last_name="MyLastName"}</code></li>
				<li>E.g. <code>{qrcode type="mecard" first_name="MyFirstName" last_name="MyLastName" address="MyStreet" city="MyCity" state="MyState" pc="12345" nation="MyNation" tel="+39.000.0000000" email="user@domain.ext" web="http://www.domain.ext" birthday="YYYYMMDD" note="MyNoteOrMemo"}</code></li>
			</ul>
			<li>Set to <code>sms</code> to generate a QR Code image for send a SMS message to a telephone number</li>
			<ul>
				<li>In this case the parameter <code>phone</code> (telephone number) is optional</li>
				<li>In this case the parameter <code>text</code> (text message) is optional</li>
				<li>Do NOT define the parameter <code>text</code> to insert in the text message the url of the current page</li>
				<li>E.g. <code>{qrcode type="sms" phone="+390000000000" text="Hallo world!"}</code></li>
				<li>E.g. <code>{qrcode type="sms" phone="+390000000000"}</code> send the url of current page</li>
			</ul>
			<li>Set to <code>text</code> to generate a QR Code image that contents some text</li>
			<ul>
				<li>You can use this in conjunction with the output of others modules or plugins</li>
				<li>In this case the parameter <code>text</code> (text message) is needed</li>
				<li>E.g. <code>{qrcode type="text" text="Hallo world!"}</code></li>
			</ul>
			
			<li>Set to <code>vcard</code> to generate a QR Code image that contains contact informations in vCard (3.0) format</li>
			<ul>
				<li>In this case the parameter <code>last_name</code> (last name) is needed</li>
				<li>In this case the parameter <code>first_name</code> (first_name) is needed</li>
				<li>In this case the parameter <code>org</code> (organization) is optional</li>
				<li>In this case the parameter <code>w_address</code> (work street address) is optional</li>
				<li>In this case the parameter <code>w_city</code> (work city) is optional</li>
				<li>In this case the parameter <code>w_state</code> (work state) is optional</li>
				<li>In this case the parameter <code>w_pc</code> (work postal code) is optional</li>
				<li>In this case the parameter <code>w_nation</code> (work nation) is optional</li>
				<li>In this case the parameter <code>w_tel</code> (work telephone number) is optional</li>
				<li>In this case the parameter <code>w_fax</code> (work fax number) is optional</li>
				<li>In this case the parameter <code>h_address</code> (home street address) is optional</li>
				<li>In this case the parameter <code>h_city</code> (home city) is optional</li>
				<li>In this case the parameter <code>h_state</code> (home state) is optional</li>
				<li>In this case the parameter <code>h_pc</code> (home postal code) is optional</li>
				<li>In this case the parameter <code>h_nation</code> (home nation) is optional</li>
				<li>In this case the parameter <code>h_tel</code> (home telephone number) is optional</li>
				<li>In this case the parameter <code>h_fax</code> (home fax number) is optional</li>
				<li>In this case the parameter <code>email</code> (e-mail address) is optional</li>
				<li>In this case the parameter <code>web</code> (internet web page) is optional</li>
				<li>E.g. <code>{qrcode type="vcard" first_name="MyFirstName" last_name="MyLastName"}</code></li>
				<li>E.g. <code>{qrcode type="vcard" first_name="MyFirstName" last_name="MyLastName" org="MyCompany" w_address="MyStreet" w_city="MyCity" w_state="MyState" w_pc="12345" w_nation="MyNation" w_tel="+39.000.0000000" w_fax="+39.000.0000000" email="user@domain.ext" web="http://www.domain.ext"}</code></li>
			</ul>
			<li>Set to <code>wifi</code> to generate a QR Code image that contains the configuration of a WiFi network connection (this only works with Android)</li>
			<ul>
				<li>In this case the parameter <code>ssid</code> (network SSID name) is needed</li>
				<li>In this case the parameter <code>auth</code> (network authentication type) is optional and possible values are <code>WEP</code> for WEP networks, <code>WPA</code> for WPA/WPA2 networks, <code>nopass</code> for open networks (if not set the <code>nopass</code> value is set by default)</li>
				<li>In this case the parameter <code>pass</code> (network password) is optional</li>
				<li>E.g. <code>{qrcode type="wifi" auth="WPA" ssid="MyNetworkSSID" pass="MyNetworkPassword"}</code></li>
			</ul>
		</ul>
	</ul>
	<?php
}

function smarty_cms_about_function_qrcode() {
	?>
	<p>Author: Andrea Weichbrodt (wich) <a href="http://www.weichbrodt.it" target="_blank">www.weichbrodt.it</a></p>
	<p>Version: 1.02</p>
	<p>Update: Check for updates for this plugin at the <a href="http://dev.cmsmadesimple.org/projects/qrcode" target="_blank">CMS Made Simple Forge page</a></p>
	<p>Feature Requests: If you want to add others functionality, please let me know by opening a new feature request in the dedicated <strong>Feature Requests tab</strong> of the <a href="http://dev.cmsmadesimple.org/projects/qrcode" target="_blank">CMS Made Simple Forge page</a> for this plugin</p>
	<p>Bugs: If you want to submit a new bug, please let me know by opening a new bug in the dedicated <strong>Bug Tracker tab</strong> of the <a href="http://dev.cmsmadesimple.org/projects/qrcode" target="_blank">CMS Made Simple Forge page</a> for this plugin</p>
	<p>Licence: Free software under the GNU General Public License, Google Chart API is trademarked by Google Inc., QR code is trademarked by Denso Wave Inc.</p>
	<p>Change History:</p>
	<ul>
		<li>Version 1.02 released on 20111216 by Andrea Weichbrodt (wich)</li>
		<ul>
			<li>Implemented functionality for call a phone number, added specifics parameters</li>
			<li>Implemented functionality for send an E-mail message, added specifics parameters</li>
			<li>Implemented functionality for generate a meCard, added specifics parameters</li>
			<li>Implemented functionality for send a SMS message, added specifics parameters</li>
			<li>Implemented functionality for insert a text, added specifics parameters</li>
			<li>Implemented functionality for generate a vCard, added specifics parameters</li>
			<li>Implemented functionality for config a WiFi network connection, added specifics parameters (this only works with Android)</li>
			<li>Added the optional <code>class</code> parameter to set the CSS class name for the QR Code image tag</li>
			<li>Added the optional <code>id</code> parameter to set the CSS id name for the QR Code image tag</li>
			<li>Updated help and about text</li>
		</ul>
		<li>Version 1.01 released on 20110702 by Andrea Weichbrodt (wich)</li>
		<ul>
			<li>Added the optional <code>url</code> parameter</li>
			<li>Updated help and about text</li>
		</ul>
		<li>Version 1.00 released on 20110701 by Andrea Weichbrodt (wich)</li>
		<ul>
			<li>First release</li>
		</ul>
	</ul>
	<?php
}
?>
