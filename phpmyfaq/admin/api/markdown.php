<?php

/**
 * Private phpMyFAQ Admin API: Markdown Ajax Parser.
 *
 * This Source Code Form is subject to the terms of the Mozilla Public License,
 * v. 2.0. If a copy of the MPL was not distributed with this file, You can
 * obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package   phpMyFAQ
 * @author    Jerry van Kooten <jerry@jvkooten.info>
 * @author    Thorsten Rinne <thorsten@phpmyfaq.de>
 * @copyright 2015-2023 phpMyFAQ Team
 * @license   https://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 * @link      https://www.phpmyfaq.de
 * @since     2015-03-30
 */

use phpMyFAQ\Filter;
use phpMyFAQ\Helper\HttpHelper;

if (!defined('IS_VALID_PHPMYFAQ')) {
    http_response_code(400);
    exit();
}

$postData = json_decode(file_get_contents('php://input', true));

$answer = Filter::filterVar($postData->text, FILTER_SANITIZE_SPECIAL_CHARS);

$http = new HttpHelper();
$http->addHeader();

$parseDown = new ParsedownExtra();

$http->setStatus(200);
$http->sendJsonWithHeaders(['success' => $parseDown->text($answer)]);
