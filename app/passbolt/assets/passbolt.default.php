<?php
/**
 * Passbolt ~ Open source password manager for teams
 * Copyright (c) Passbolt SA (https://www.passbolt.com)
 *
 * Licensed under GNU Affero General Public License version 3 of the or any later version.
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Passbolt SA (https://www.passbolt.com)
 * @license       https://opensource.org/licenses/AGPL-3.0 AGPL License
 * @link          https://www.passbolt.com Passbolt(tm)
 * @since         2.0.0
 */
/**
 * PASSBOLT CONFIGURATION FILE TEMPLATE
 *
 * By default passbolt tries to use the environment variables or falls back to the default values as
 * defined in default.php. You can use passbolt.default.php as a basis to set your own configuration
 * without using environment variables.
 *
 * 1. copy/paste passbolt.default.php to passbolt.php
 * 2. set the variables in the App section
 * 3. set the variables in the passbolt section
 *
 * To see all available options, you can refer to the default.php file, and modify passsbolt.php accordingly.
 * Do not modify default.php or you may break your upgrade process.
 *
 * Read more about how to install passbolt: https://www.passbolt.com/help/tech/install
 * Any issue, check out our FAQ: https://www.passbolt.com/faq
 * An installation issue? Ask for help to the community: https://community.passbolt.com/
 */
return [

    'App' => [
        'fullBaseUrl' => 'https://goinfinite.local',
    ],
    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'datasource_username',
            'password' => 'datasource_password',
            'database' => 'datasource_database',
        ],
    ],
    'Email' => [
        'default' => [
            'from' => ['smtp_from' => 'Passbolt'],
        ],
    ],
    'EmailTransport' => [
        'default' => [
            'host' => 'smtp_host',
            'port' => smtp_port,
            'username' => 'smtp_username',
            'password' => 'smtp_password',
            'tls' => true,
        ],
    ],
    'passbolt' => [
        'email' => [
            'validate' => [
                'mx' => true,
            ],
        ],
        'gpg' => [
            'serverKey' => [
                'fingerprint' => 'gpg_fingerprint',
            ],
        ],
        'security' => [
            'smtpSettings' => [
                'endpointsDisabled' => true,
            ]
        ],
        'ssl' => [
            'force' => true,
        ],
    ],
];
