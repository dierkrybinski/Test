<?php

declare(strict_types=1);


class FormularTest extends ipsmodule
{

    use MySQL\StubsCommonLib;
    use MySQLLocalLib;
    /**
     * Interne Funktion des SDK.
     */
    public function Create()
    {
        parent::Create();

        $this->RegisterPropertyString('Host', '');
        $this->RegisterPropertyString('Username', '');
        $this->RegisterPropertyString('Password', '');
        $this->RegisterPropertyString('Database', 'IPS_LOG');
		
		$this->Login();

		
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

        //$ConfigVars = json_decode($this->ReadPropertyString('Variables'), true);
 
        return json_encode($form);
    }
    
    private $isConnected = false;

    protected function Login()
    {
		$server = $this->ReadPropertyString('Host');
        //$port = $this->ReadPropertyInteger('port');
        $user = $this->ReadPropertyString('Username');
        $password = $this->ReadPropertyString('Password');
        $database = $this->ReadPropertyString('Database');
        
		//if ($this->ReadPropertyString('Host') == '') {
        //    return false;
        //}
		
		        $this->SendDebug(__FUNCTION__, 'open database ' . $database . '@' . $this->ReadPropertyString('Host') . ':' . '(user=' . $user . ')', 0);

        $dbHandle = new mysqli($server, $user, $password, $database, "3306");
        if ($dbHandle->connect_errno) 
		{
            $this->SendDebug(__FUNCTION__, " => can't open database", 0);
            IPS_LogMessage("MYSQL:","can't open database " . $database . '@' . $server . ': ' . $dbHandle->connect_error . "\n");
        //if (!$this->isConnected) {
         //   $this->SendDebug('Connect [' . $_IPS['THREAD'] . ']', 'Start ' . sprintf('%.3f', ((microtime(true) - $this->Runtime) * 1000)) . ' ms', 0);
         //   $this->DB = @new \mysqli('p:' . $this->ReadPropertyString('Host'), $this->ReadPropertyString('Username'), $this->ReadPropertyString('Password'));
         //   if ($this->DB->connect_errno == 0) {
         //       $this->isConnected = true;
         //       $this->SendDebug('Login [' . $_IPS['THREAD'] . ']', sprintf('%.3f', ((microtime(true) - $this->Runtime) * 1000)) . ' ms', 0);
         //       return true;
         //   }
            return false;
        }
        return true;
    }
}

/* @} */
