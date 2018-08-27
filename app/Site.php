<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ValidatorTrait;
use \Carbon\Carbon;

class Site extends Model 
{
    use ValidatorTrait;

    const DATE_FORMAT = 'd m Y'; // PHP's date format

    private $_option=[], $_date_format=null;
    protected $table = 'site';

    static $rules = [
        'id_user'       => 'integer|required',
        'id_template'   => 'integer|required',
        'url_name'      => 'string|required',
        'page_title'    => 'string|required',
        'option'        => 'string|nullable',
    ];
    public $fillable = [
        'id_user',
        'id_template',
        'url_name',
        'page_title',
        'option',
    ];

    /* Default value for site options */
    static $option_default = [
        "names" => [
            "bride" => "",
            "bride_full" => "",
            "groom" => "",
            "groom_full" => "",
            "bride_father" => "",
            "bride_mother" => "",
            "groom_father" => "",
            "groom_mother" => "",
        ],
        "event" => [
            "main_title" => "",
            "date" => "17-8-1945",
            "location" => [
                "address" => "",
                "city" => "",
                "country" => "",
                "coordinate" => "",
            ],
            "1" => [
                "title" => "Akad Nikah",
                "time" => "8.00-10.00",
            ],
            "2" => [
                "title" => "Resepsi",
                "time" => "11.00-13.00",
            ],
        ],
        "template_specific" => "",
    ];

    // ------------------- CUSTOM MUTATOR --------------------
    public function getOptionDataAttribute() {
        if (empty($this->_option)) 
            $this->_option = json_decode($this->option);
        return $this->_option;
    }

    public function getDateFormatAttribute() {
        if (empty($this->_date_format))
            $this->_date_format = Carbon::createFromFormat('d-m-Y',$this->option_data->date);
        return $this->_date_format;
    } 

    // ------------------- RELATIONS --------------------
    public function user() {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function template() {
        return $this->hasOne('App\Template', 'id', 'id_template');
    }
}
