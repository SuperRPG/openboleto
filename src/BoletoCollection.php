<?php

namespace OpenBoleto;

class BoletoCollection
{
    public $items;

    private function GetHtmlHeader(): string 
    {
        $resource_path = __DIR__ . '/../resources';

        return '
        <html lang="pt-BR">

        <head>
           <meta charset="UTF-8">
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
           <title>TGA Sistemas Boletos</title>
           <style type="text/css">'
           . file_get_contents($resource_path . "/css/styles.css") .
           '</style>
        </head> 
        <body>';       
    }


    public function getOutput()
    {
        $result = $this->GetHtmlHeader();
        foreach($this->items as $boleto)
        {  
            try 
            {
                $result .= $boleto->getOutput();
            } 
            catch (Exception $e)
            {
                echo $e->getMessage();
                die;
            }
        }

        return $result . '
        </body>
        </html>';
    }

    function __construct($boletos)
    {
        $this->items = $boletos;
    }

    public function IsEmpty(): bool {
        return (count($this->items) == 0);
    }
}

?>