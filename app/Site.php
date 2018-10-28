<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\ValidatorTrait;
use \Carbon\Carbon;

class Site extends Model 
{
    use ValidatorTrait;

    const DATE_FORMAT = 'd m Y'; // PHP's date format

    private $_option=[], $_date_format=null;
    protected $table = 'site';

    static function rules($model=null) {
        $rules = [
            'id_user'       => 'integer|required',
            'id_template'   => 'integer|required',
            'url_name'      => 'string|required|unique:site,url_name',
            //'page_title'    => 'string|required',
            'option'        => 'string|nullable',
        ];

        // custom rules for updating models
        if ($model != null)
            $rules['url_name'] .= ','.$model->id;

        return $rules;
    }

    public $fillable = [
        'id_user',
        'id_template',
        'url_name',
        //'page_title',
        'option',
    ];

    /* Default value for site options */
    static $option_default = [
        "bride_short_name"      => "",
        "bride_full_name"       => "",
        "groom_short_name"      => "",
        "groom_full_name"       => "",
        "bride_father_name"     => "",
        "bride_mother_name"     => "",
        "groom_father_name"     => "",
        "groom_mother_name"     => "",
        "event_title"           => "Fulanah & Fulan",
        "event_date"            => "17-8-1945",
        "event_loc_1_name"      => "Gedung ABC",
        "event_loc_1_city"      => "Kota Bandung",
        "event_loc_1_address"   => "Jl. Jalan no 1",
        "event_loc_1_lat"       => "",
        "event_loc_1_long"      => "",
        "event_loc_same"        => true,
        "event_loc_2_name"      => "Gedung DEF",
        "event_loc_2_city"      => "Kota Bandung",
        "event_loc_2_address"   => "Jl. Jalan no. 1",
        "event_loc_2_lat"       => "",
        "event_loc_2_long"      => "",
        "event_1_title"         => "Akad Nikah",
        "event_1_time"          => "8.00-10.00",
        "event_2_title"         => "Resepsi",
        "event_2_time"          => "11.00-13.00",
        "template_specific"     => "",
    ];

    // ------------------- METHODS --------------------
    public function __construct(array $attributes = []) {
        $this->option = json_encode(self::$option_default);
     
        parent::__construct($attributes);
    } 

    // ------------------- CUSTOM MUTATOR --------------------
    public function getOptionDataAttribute() {
        if (empty($this->_option)) 
            $this->_option = json_decode($this->option);
        return $this->_option;
    }

    public function getDateFormatAttribute() {
        if (empty($this->_date_format))
            $this->_date_format = Carbon::createFromFormat('d-m-Y',$this->option_data->event_date);
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
