<?php

namespace App\Helpers;

use App\Helpers\CurlHelper;
use App\Models\RuleScore;

class CheckSiak
{
    private $_ruleScore;
    public function __construct()
    {
        $this->_ruleScore = new RuleScore;

    }
    public static function exec($data)
    {
        // dd($data['user_identity_card_number']);
        $data = array(
            "nik" => isset($data['user_nik']) ? $data['user_nik'] : "",
            "no_kk" => isset($data['user_kk']) ? $data['user_kk'] : "",
            "nama_lgkp" => isset($data['user_nama']) ? strtoupper($data['user_nama']) : "",
            "jenis_klmin" => isset($jenis_klmin) ? ucwords($jenis_klmin) : "",
            "tmpt_lhr" => isset($tmpt_lhr) ? strtoupper($tmpt_lhr) : "",
            "tgl_lhr" => isset($data['user_formatted_birth_date']) ? $data['user_formatted_birth_date'] : "",
            "status_kawin" => isset($status_kawin) ? strtoupper($status_kawin) : "",
            "jenis_pkrjn" => isset($jenis_pkrjn) ? strtoupper($jenis_pkrjn) : "",
            "alamat" => isset($alamat) ? strtoupper($alamat) : "",
            "no_prop" => isset($nomor_prop) ? $nomor_prop : "",
            "no_kab" => isset($nomor_kab) ? $nomor_kab : "",
            "no_kec" => isset($nomor_kec) ? $nomor_kec : "",
            "no_kel" => isset($nomor_kel) ? $nomor_kel : "",
            "prop_name" => isset($prop_name) ? strtoupper($prop_name) : "",
            "kab_name" => isset($kab_name) ? strtoupper($kab_name) : "",
            "kec_name" => isset($kec_name) ? strtoupper($kec_name) : "",
            "kel_name" => isset($kel_name) ? strtoupper($kel_name) : "",
            "no_rw" => isset($no_rw) ? strtoupper($no_rw) : "",
            "no_rt" => isset($no_rt) ? strtoupper($no_rt) : "",
        );

        $query = http_build_query($data);
        $url = 'https://mantra.cimahikota.go.id/json/diskominfo/s_dwh/fn_check_penduduk_by_nik';

        $result = CurlHelper::exec(
            'POST',
            $url,
            $query,
            [
                'Content-Type:application/x-www-form-urlencoded',
                'User-Agent:MANTRA',
                'AccessKey:nmjzu2a490'
            ],
        );

        dd($result);

        $jsonResult = json_decode($result['body'], true)['content'][0];
        $score = 0;

        $message = [];

        if ($jsonResult['RESPONSE_CODE'] == 1) {
            //sesuai
            $_ruleScore = new RuleScore;
            $rule = $_ruleScore->getList(array('start' => 0, 'limit' => 100), [], '');

            foreach ($rule as $key => $value) {


                $idscore = substr($jsonResult[$value->rule_score_id], 0, 6);

                if ($idscore === "Sesuai") {
                    $score += $value->rule_score;
                } else {
                    $message[] = $value->description;
                }
            }

            $scoreRes = array(
                "reponse_code" => "200",
                "message" => "SIAK access successfuly",
                "message_score" => implode(", ", $message),
                "score" => $score,
            );
        } else {
            $scoreRes = array(
                "reponse_code" => "400",
                "message" => "SIAK access failed",
                "message_score" => "",
                "score" => $score,
            );
        }

        return $scoreRes;
    }

}