<?php
class Header
{

    public array $required_columns;
    public array $other_columns;
    public array $header_columns;

    function __construct() {

        $this->required_columns = [
            "make" => "brand_name",
            "model" => "model_name"
        ];
        $this->other_columns = [
            "colour" => "colour_name",
            "capacity" => "gb_spec_name",
            "network" => "network_name",
            "grade" => "grade_name",
            "condition" => "condition_name"
        ];

        $this->header_columns = array_merge($this->required_columns, $this->other_columns);
    }
}