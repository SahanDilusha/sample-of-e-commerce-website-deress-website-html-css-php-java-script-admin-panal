<?php 

class GenerateOtp
{
    public final static function generateOTP($otpLength)
    {
        $characters = "0123456789098765432165436789075312344535743451215414257679800";
        $otp = "";

        for ($i = 0; $i < $otpLength; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $otp;
    }
}

?>