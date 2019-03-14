<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->Model = $this->model('AndroidModel');
    }

}