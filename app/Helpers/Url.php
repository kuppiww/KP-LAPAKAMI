<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL as u;

class Url {

    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function generateReportUrl() {
        return config('template.report_path');
    }

}