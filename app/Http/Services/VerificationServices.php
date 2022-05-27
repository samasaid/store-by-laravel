<?php

namespace App\Http\Services;

use App\Models\UsersVerfication;



class VerificationServices
{
   /** set OTP code for mobile
     * @param $data
     *
     * @return UsersVerfication
     */
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        UsersVerfication::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return UsersVerfication::create($data);
    }
    public function getSMSVerifyMessageByAppName( $code)
    {
            $message = " is your verification code for your account";
             return $code.$message;
    }

}
