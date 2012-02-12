<?php
class ConfigFlattr extends ConfigBase
{
    public static function up()
    {
        self::$CLIENT_ID = 'eAYNE5Njsye7c8wxqXrvKfozdlrn7w6bWUOrQrB9PG6SEtfVgwhQBvgFGySEUOFH';
        self::$CLIENT_SECRET = 'zjZfBqfhXbZsu5dBrkiTGpodN6HyLc5amVgNcmVZnKhIGkaXviH2xW5aTDyuGuvS';

        self::$LOGFILE = '/tmp/flattr-client.log'; // debug log

        self::$SITE_URL = 'https://flattr.com';
        self::$BASE_URL = 'https://api.flattr.com/rest/v2';
        self::$AUTHORIZE_URL = self::$SITE_URL . '/oauth/authorize';
        self::$ACCESS_TOKEN_URL = self::$SITE_URL . '/oauth/token';

        self::$REDIRECT_URI = 'http://phlattr.bigbluehat.com/callback.php';
        self::$DEVELOPER_MODE = false; // more extensive logging using slog; turns of SSL check DANGEROUS!!!
        self::$SCOPES = 'thing flattr';
    }
}

