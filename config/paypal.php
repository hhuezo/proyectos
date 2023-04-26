<?php
return array(
    // set your paypal credential
    'client_id' => 'AWuvX43gksCo1gwwGxhIE4WJDPkLYsenlBNIaldh6nVt8meJZlZBJFzQyUs4kW13eEyiu0RF8lTL04OL',
    'secret' => 'EPiK5drZCUCYDWAYp0fqt2X-67IL2r-rUaOOmgxPtHQ48H7N33uySWGMnF-8-kKi188Lk86Dz6JO-AXL',

    // 'client_id' => '_78RCTvOIC2wtKaA_RBE9MiJyZKUWumwE1tuMmiWx0dY9iV_S6EDzdMnID9G0C7pUSIrPalPjHD5V',
    // 'secret' => 'EF-HAgFEg7Gdr5uSaf3DtSrniuP05A_sWuanW9ofs2aCQC4RCn3ThgYQ0Isl-EGPEkzzPiL29IKcxrMR',

    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);
