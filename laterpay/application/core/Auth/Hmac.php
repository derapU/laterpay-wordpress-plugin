<?php

/**
 * Auth_Hmac provide tokenizer uses openssl extension
 */
class Auth_Hmac {

    const VALID_PERIOD = 86400;// 24 hrs

    protected static $_instance = null;
    protected static $privateKey = null;
    protected static $hashAlgo = 'sha224';
    protected static $useBase64 = false;

    /**
     * constructor for class Token
     *
     * @param string  $privateKey File name of private pem key
     * @param bool    $isPacked   key must be packed
     *
     * @return void
     */
    public function __construct( $privateKey = null, $isPacked = false ) {
        if ( ( $privateKey === null ) && ( self::$privateKey === null ) ) {

            if ( defined( 'LATERPAY_HMAC_KEY_SECRET' ) ) {
                self::$privateKey = LATERPAY_HMAC_KEY_SECRET;
            } else {
                if ( defined( 'LATERPAY_HMAC_KEY_BYTECODE' ) ) {
                    self::$privateKey = pack( 'H*', LATERPAY_HMAC_KEY_BYTECODE );
                } else {
                    throw new Exception( 'no secret key for token generator' );
                }
            }
        } else {
            if ( $isPacked ) {
                self::$privateKey = pack( 'H*', $privateKey );
            } else {
                self::$privateKey = $privateKey;
            }
        }
    }

    /**
     * sign data
     *
     * @param string|array $data Date for generate sign, all data will glue with '|' string
     *
     * @return string|boolean
     */
    public function sign( $data ) {
        if ( is_array( $data ) ) {
            $data = implode( '', $data );
        }

        $crypt = new Crypt_Hash( self::$hashAlgo );
        $crypt->setKey( self::$privateKey );
        $hash = bin2hex( $crypt->hash( $data ) );

        return $hash;
    }

    /**
     * verify data and sign
     *
     * @param string|array $data Verifyng data
     * @param string  $sign Sign string
     *
     * @return number|boolean
     */
    public function verify( $data, $sign ) {
        $signV = $this->sign( $data );

        return ( !empty( $sign ) ) && ( $sign === $signV );
    }

    /**
     * generate token based on phone and time
     *
     * @param string  $data
     * @param string  $ts   Unix timestamp of token
     *
     * @return string
     */
    public function getToken( $data, $ts ) {
        $ts = $ts;
        $fresult = $this->sign( array( $data, $ts ) );
        if ( self::$useBase64 ) {
            $fresult = base64_encode( $fresult );
            $fresult = strtr( $fresult, '+/', '-_' );
            $fresult = urlencode( $fresult );
        }

        return $fresult;
    }

    /**
     * Validate token
     *
     * @param string  $data  data
     * @param string  $ts    Time in seconds
     * @param string  $token Token string
     *
     * @return boolean
     */
    public function validateToken( $data, $ts, $token ) {
        $now = time();

        $fresult = false;
        if ( ( $now - $ts ) < self::VALID_PERIOD ) {
            if ( self::$useBase64 ) {
                $temp = urldecode( $token );
                $temp = strtr( $temp, '-_', '+/' );
                $temp = base64_decode( $temp );
            } else {
                $temp = $token;
            }
            $fresult = ( $this->verify( array( $data ), $temp ) );
        }

        return $fresult;
    }

    /**
     * Retrieve instance
     *
     * @return Auth_Hmac
     */
    public static function getInstance() {
        if ( null === self::$_instance ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Preprocess parameters
     *
     * @param array   $params array params
     * @return string query params
     */
    public static function getQuery( $params ) {
        unset( $params['hmac'] );

        // get the keys in alphabetical order
        $keys = array_keys( $params );
        sort( $keys );
        $query_pairs = array( );
        foreach ( $keys as $key ) {
            $aux = $params[$key];
            // FIXME: LaterPay API expect article_id=123&article_id=124, why do not use HTTP format: article_id[0]=123&article_id[1]=124?
            if ( !is_array( $aux ) ) {
                $aux = array( $aux );
            }
            sort( $aux );
            foreach ( $aux as $value ) {
                $query_pairs[] = urlencode( $key ) . '=' . urlencode( $value );
            }
        }

        // build the querystring
        $querystr = join( '&', $query_pairs );

        return $querystr;
    }

}
