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
        if ($this->ReadPropertyString('Host') == '') {
            return false;
        }
        if (!$this->isConnected) {
            $this->SendDebug('Connect [' . $_IPS['THREAD'] . ']', 'Start ' . sprintf('%.3f', ((microtime(true) - $this->Runtime) * 1000)) . ' ms', 0);
            $this->DB = @new \mysqli('p:' . $this->ReadPropertyString('Host'), $this->ReadPropertyString('Username'), $this->ReadPropertyString('Password'));
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
