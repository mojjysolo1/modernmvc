<?php

trait ErrorTrait{

    
    public function getError()
    {
        $format_error=<<<HTML
        <pre style='background:#343a40; font-size:18px; padding:2px;border-radius:5px; width:100%;'>
          <span style='color:#f14e4e;'>Msg: $this->message</span>
          <span style='color:#04ca04;'>File: $this->file</span>
          <span style='color:#bbbffd;'>Line: $this->line</span>
          <span style='color:orange;'>Route: $_SERVER[REQUEST_URI]</span>
          </pre>
      HTML;
        return $format_error;
  
    }

    public function getPlainError()
    {
        $format_error=<<<HTML
        Msg: $this->message
         File: $this->file
         Line: $this->line
         Route: $_SERVER[REQUEST_URI]
      HTML;
        return $format_error;
  
    }
}

