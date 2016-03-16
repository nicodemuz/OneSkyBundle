<?php

namespace OpenClassrooms\Bundle\OneSkyBundle\Tests\Doubles\OneSky\Api;

use Onesky\Api\Client;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
class ClientMock extends Client
{
    /**
     * @var string
     */
    public static $action;

    /**
     * @var string
     */
    public static $downloadedContent;

    /**
     * @var int
     */
    public static $downloadedCount = 0;

    /**
     * @var int
     */
    public static $downloadedTries;

    /**
     * @var array
     */
    public static $parameters = [];

    public function __construct($downloadedContent = null, $downloadedTries = 0)
    {
        parent::__construct();
        self::$action = null;
        self::$downloadedContent = $downloadedContent;
        self::$downloadedCount = 0;
        self::$downloadedTries = $downloadedTries;
        self::$parameters = [];
    }

    /**
     * @return bool|string
     */
    public function files($action, $parameters)
    {
        self::$action = $action;
        self::$parameters[] = $parameters;

        return true;
    }

    /**
     * @return bool|string
     */
    public function translations($action, $parameters)
    {
        self::$action = $action;
        self::$parameters[] = $parameters;

        if (null !== self::$downloadedContent) {
            return self::$downloadedContent;
        }

        return 'Download : '.++self::$downloadedCount;
    }
}
