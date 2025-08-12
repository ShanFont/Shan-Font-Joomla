<?php
/**
 * @package     Shan Font Plugin
 * @subpackage  System
 * @copyright   Copyright (C) 2025 TaiDev. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Application\AdministratorApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\Database\DatabaseDriver;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * Installation script for Shan Font Plugin
 *
 * @since  1.0.0
 */
return new class () implements InstallerScriptInterface {
    /**
     * Minimum Joomla version required to install the extension
     *
     * @var    string
     * @since  1.0.0
     */
    private $minimumJoomla = '4.0.0';

    /**
     * Minimum PHP version required to install the extension
     *
     * @var    string
     * @since  1.0.0
     */
    private $minimumPhp = '7.4.0';

    /**
     * Function called after the extension is installed.
     *
     * @param   InstallerAdapter  $adapter  The adapter calling this method
     *
     * @return  boolean  True on success
     * @since   1.0.0
     */
    public function install(InstallerAdapter $adapter): bool
    {
        $this->showInstallMessage();
        return true;
    }
};

    /**
     * Function called after the extension is updated.
     *
     * @param   InstallerAdapter  $adapter  The adapter calling this method
     *
     * @return  boolean  True on success
     * @since   1.0.0
     */
    public function update(InstallerAdapter $adapter): bool
    {
        $this->showUpdateMessage();
        return true;
    }

    /**
     * Function called after the extension is uninstalled.
     *
     * @param   InstallerAdapter  $adapter  The adapter calling this method
     *
     * @return  boolean  True on success
     * @since   1.0.0
     */
    public function uninstall(InstallerAdapter $adapter): bool
    {
        $this->showUninstallMessage();
        return true;
    }

    /**
     * Function called before any type of action
     *
     * @param   string            $route    Which action is happening (install|uninstall|discover_install|update)
     * @param   InstallerAdapter  $adapter  The adapter calling this method
     *
     * @return  boolean  True on success
     * @since   1.0.0
     */
    public function preflight(string $route, InstallerAdapter $adapter): bool
    {
        // Check for the minimum PHP version before continuing
        if (!empty($this->minimumPhp) && version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
            Factory::getApplication()->enqueueMessage(
                sprintf('PHP %s or later is required. You are running PHP %s.', $this->minimumPhp, PHP_VERSION),
                'error'
            );
            return false;
        }

        // Check for the minimum Joomla version before continuing
        if (!empty($this->minimumJoomla) && version_compare(JVERSION, $this->minimumJoomla, '<')) {
            Factory::getApplication()->enqueueMessage(
                sprintf('Joomla %s or later is required. You are running Joomla %s.', $this->minimumJoomla, JVERSION),
                'error'
            );
            return false;
        }

        return true;
    }

    /**
     * Function called after any type of action
     *
     * @param   string            $route    Which action is happening (install|uninstall|discover_install|update)
     * @param   InstallerAdapter  $adapter  The adapter calling this method
     *
     * @return  boolean  True on success
     * @since   1.0.0
     */
    public function postflight(string $route, InstallerAdapter $adapter): bool
    {
        if ($route === 'install') {
            $this->enablePlugin();
        }

        return true;
    }

    /**
     * Enable the plugin after installation
     *
     * @return  void
     * @since   1.0.0
     */
    private function enablePlugin(): void
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->update('#__extensions')
            ->set($db->quoteName('enabled') . ' = 1')
            ->where($db->quoteName('element') . ' = ' . $db->quote('shanfont'))
            ->where($db->quoteName('folder') . ' = ' . $db->quote('system'))
            ->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));

        $db->setQuery($query);
        $db->execute();
    }

    /**
     * Show installation success message
     *
     * @return  void
     * @since   1.0.0
     */
    private function showInstallMessage(): void
    {
        $message = '
        <div style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center;">
            <h3 style="color: #2e7d32; margin-bottom: 15px;">✅ Shan Font Plugin Installed Successfully!</h3>
            <p style="margin-bottom: 15px;">The Shan Font plugin has been installed and enabled on your website.</p>
            <div style="background: #e8f5e8; border: 1px solid #4caf50; border-radius: 4px; padding: 15px; margin: 15px 0;">
                <h4 style="color: #2e7d32; margin-bottom: 10px;">Quick Setup Active</h4>
                <p style="margin-bottom: 5px;">The plugin is set to <strong>Quick Setup</strong> mode by default.</p>
                <p style="margin-bottom: 0;">Shan fonts will be automatically applied to your entire website.</p>
            </div>
            <p style="margin-bottom: 10px;"><strong>Website:</strong> <a href="https://shanfont.com" target="_blank" style="color: #1976d2;">www.shanfont.com</a></p>
            <p style="margin-bottom: 0; color: #666;"><em>Developed by TaiDev</em></p>
        </div>';

        Factory::getApplication()->enqueueMessage($message, 'message');
    }

    /**
     * Show update success message
     *
     * @return  void
     * @since   1.0.0
     */
    private function showUpdateMessage(): void
    {
        $message = '
        <div style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center;">
            <h3 style="color: #1976d2; margin-bottom: 15px;">🔄 Shan Font Plugin Updated Successfully!</h3>
            <p style="margin-bottom: 15px;">Your Shan Font plugin has been updated to the latest version.</p>
            <p style="margin-bottom: 10px;">All your existing settings have been preserved.</p>
            <p style="margin-bottom: 10px;"><strong>Website:</strong> <a href="https://shanfont.com" target="_blank" style="color: #1976d2;">www.shanfont.com</a></p>
            <p style="margin-bottom: 0; color: #666;"><em>Developed by TaiDev</em></p>
        </div>';

        Factory::getApplication()->enqueueMessage($message, 'message');
    }

    /**
     * Show uninstall message
     *
     * @return  void
     * @since   1.0.0
     */
    private function showUninstallMessage(): void
    {
        $message = '
        <div style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center;">
            <h3 style="color: #d32f2f; margin-bottom: 15px;">❌ Shan Font Plugin Uninstalled</h3>
            <p style="margin-bottom: 15px;">The Shan Font plugin has been removed from your website.</p>
            <p style="margin-bottom: 10px;">Your website fonts will revert to theme defaults.</p>
            <p style="margin-bottom: 10px;">Thank you for using Shan Font!</p>
            <p style="margin-bottom: 0; color: #666;"><em>Developed by TaiDev</em></p>
        </div>';

        Factory::getApplication()->enqueueMessage($message, 'message');
    }