<?php

class Cartthrob_Sample_Gateway_ext
{
    public $settings = [];
    public $module_name = 'cartthrob_sample_gateway';

    /**
     * Cartthrob_Sample_Gateway_ext constructor.
     * @param string $settings
     */
    public function __construct($settings = '')
    {
        $this->version = ee('Addon')->get($this->module_name)->getVersion();
        ee()->lang->loadfile($this->module_name);
        ee()->load->add_package_path(PATH_THIRD . 'cartthrob/');
        $this->settings = ee('cartthrob:SettingsService')->settings($this->module_name);
    }

    /**
     * Activate extension
     */
    public function activate_extension()
    {
        ee()->db->insert('extensions', [
            'class' => __CLASS__,
            'method' => 'cartthrob_boot',
            'hook' => 'cartthrob_boot',
            'settings' => serialize($this->settings),
            'priority' => 10,
            'version' => $this->version,
            'enabled' => 'y',
        ]);
    }

    /**
     * @param string $current
     * @return bool
     */
    public function update_extension($current = '')
    {
        if ($current == '' or $current == $this->version) {
            return false;
        }

        ee()->db->where('class', __CLASS__);
        ee()->db->update('extensions', ['version' => $this->version]);
    }

    /**
     * Disable extension
     */
    public function disable_extension()
    {
        ee()->db->where('class', __CLASS__);
        ee()->db->delete('extensions');
    }

    /**
     * Register the payment gateway with the plugin service
     */
    public function cartthrob_boot()
    {
        ee()->lang->load('cartthrob_sample_gateway', $idiom = '', $return = false, $add_suffix = true, $alt_path = __DIR__ . '/');
        ee('cartthrob:PluginService')->register(Cartthrob_sample_gateway::class);
    }
}
