<?php

class TestEnv {

    /**
     * Some Description
     * @param string $sample
     * @return bool
     */
    public function store($sample){
        return is_string($sample);
    }
}
