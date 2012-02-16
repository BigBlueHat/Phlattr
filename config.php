<?php
class ConfigFlattr extends ConfigBase
{
    public static function up()
    {
        self::$CLIENT_ID = '6HwOyaYyEK9t7oBLACNCBbUQ1gpMUnhRVEwjFkHaVGtSVVtmo7PQ9Aw0GMCr0K8M';
        self::$CLIENT_SECRET = require_once '.flattr_secret.php';

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

