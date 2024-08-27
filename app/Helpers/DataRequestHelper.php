<?php

namespace App\Helpers;

class DataRequestHelper {

    public static function updateStatus($repository, $status, $id) {
        return $repository->updateStatus(DataHelper::_normalizeParams($status, false, true), $id);
    }
}