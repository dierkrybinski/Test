<?php

declare(strict_types=1);


class FormularTest extends ipsmodule
{


    /**
     * Interne Funktion des SDK.
     */
    public function Create()
    {
        parent::Create();

        $this->RegisterPropertyString('Host', '');
        $this->RegisterPropertyString('Username', '');
        $this->RegisterPropertyString('Password', '');
        $this->RegisterPropertyString('Database', 'IPSLOG');
        $this->RegisterPropertyString('Variables', json_encode([]));
        $this->RegisterTimer('LogData', 0, 'ACmySQL_LogData($_IPS[\'TARGET\']);');
        $this->Vars = [];
        $this->Buffer = [];
		
		        if (!$this->Login()) {
            echo $this->Translate('Cannot connect to database.');
            $this->SetStatus(IS_EBASE + 2);
            return;
        }
    }

    /**
     * Interne Funktion des SDK.
     */
    public function ApplyChanges()
    {
        parent::ApplyChanges();

    }

    /**
     * Interne Funktion des SDK.
     */
    public function GetConfigurationForm()
    {
        $form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);

        $ConfigVars = json_decode($this->ReadPropertyString('Variables'), true);
 
        return json_encode($form);
    }
    
        /**
     * Interne Funktion des SDK.
     */
    public function FTest($NR)
    {
        $myfile = fopen("c:\\programdata\\symcon\\webfront\\user\\newfile.txt", "w") or die("Unable to open file!");
        $txt = "<!DOCTYPE html>\n";
        fwrite($myfile, $txt);
        $txt = "<html lang=\"de\">\n";
        fwrite($myfile, $txt);
        $txt = "<body>\n";
        fwrite($myfile, $txt);
        $txt = "<table>\n";
        fwrite($myfile, $txt);
        $txt = "<tr>\n";
        fwrite($myfile, $txt);
        $txt = "<td>02</td><td>0a</td>\n";
        fwrite($myfile, $txt);
        $txt = "</tr>\n";
        fwrite($myfile, $txt);
        $txt = "</tabele>\n";
        fwrite($myfile, $txt);
        $txt = "</body>\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        $Result = $NR + $NR;
        return json_encode($Result);
    }
	
	private $isConnected = false;

    protected function Login()
    {
        if ($this->ReadPropertyString('Host') == '') {
            return false;
        }
        if (!$this->isConnected) {
            $this->SendDebug('Connect [' . $_IPS['THREAD'] . ']', 'Start ' . sprintf('%.3f', ((microtime(true) - $this->Runtime) * 1000)) . ' ms', 0);
			$connectionInfo = array( "Database"=>"IPSLOG", "UID"=>"HA\\Administrator", "PWD"=>"JeTgDr#1981");
            $this->DB = $conn = sqlsrv_connect( "HASQL01\\IPS", $connectionInfo);
			print_r( sqlsrv_errors(), true);
			echo $this->Translate('$conn: ' . $conn);
			if ($conn)
			{ 
				return true;
			}
            if ($this->DB->connect_errno == 0) {
                $this->isConnected = true;
                $this->SendDebug('Login [' . $_IPS['THREAD'] . ']', sprintf('%.3f', ((microtime(true) - $this->Runtime) * 1000)) . ' ms', 0);
                return true;
            }
            return false;
        }
        return true;
    }
    

}

/* @} */
