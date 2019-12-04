<?php


namespace App\Helpers;


class PasswordCheck
{
    /**
     * Check password
     * @param string password
     *
     * @return array error
     */
    public static function passwordCheck($password){
        $passwordErr = '';
        // 半角英数字をそれぞれ1種類以上含む
        if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{'.PASSWORD_MIN_LEN.',100}+\z/i', $password) === false ||
            preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{'.PASSWORD_MIN_LEN.',100}+\z/i', $password) === 0) {
            $passwordErr = '※半角英数字を1種類以上含む'.PASSWORD_MIN_LEN.'文字以上で設定ください。 <br />';
        }
        // ブラックリストチェック
        if(in_array(mb_strtolower($password), self::blacklist())){
            $passwordErr = '※ 推測されやすいパスワードが入力されております。パスワードの安全性を高めるために、複雑なパスワードを入力ください。 <br />';
        }
        return $passwordErr;
    }
    /**
     * Words Blacklist
     *
     * @return array
     */
    protected function blacklist(){
        $blacklist = array(
            '123456',    'password',  '12345678',  'qwerty',    '12345',     '123456789',  'letmein',  '1234567',   'football',  'iloveyou',  'admin',     'welcome',   'monkey',   'login',      'abc123',
            'starwars',  '123123',    'dragon',    'passw0rd',  'master',    'hello',      'freedom',  'whatever',  'qazwsx',    'trustno1',  '654321',    'jordan23',  'harley',   'password1',  '1234',
            'robert',    'matthew',   'jordan',    'asshole',   'daniel',    'andrew',     'lakers',   'andrea',    'buster',    'joshua',    '1qaz2wsx',  '12341234',  'ferrari',  'cheese',     'computer',
            'corvette',  'blahblah',  'george',    'mercedes',  '121212',    'maverick',   'fuckyou',  'nicole',    'hunter',    'sunshine',  'tigger',    '1989',      'merlin',   'ranger',     'solo',
            'banana',    'chelsea',   'summer',    '1990',      '1991',      'phoenix',    'amanda',   'cookie',    'ashley',    'bandit',    'killer',    'aaaaaa',    'pepper',   'jessica',    'zaq1zaq1',
            'jennifer',  'test',      'hockey',    'dallas',    'passwor',   'michelle',  'admin123',   'pussy',    'pass',      'asdf',      'william',   'soccer',    'london',   '1q2w3e',     '1992',
            'biteme',    'maggie',    'querty',    'rangers',   'charlie',   'martin',     'ginger',   'golfer',    'yankees',   'thunder'
        );
        return $blacklist;
    }
}
