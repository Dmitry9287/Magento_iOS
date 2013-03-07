<?php

/**
 * Error reporting
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Compilation includes configuration file
 */
define('MAGENTO_ROOT', getcwd());

$compilerConfig = MAGENTO_ROOT . '/includes/config.php';
if (file_exists($compilerConfig)) {
    include $compilerConfig;
}

$mageFilename = MAGENTO_ROOT . '/app/Mage.php';

require_once $mageFilename;

#Varien_Profiler::enable();

if (isset($_SERVER['MAGE_IS_DEVELOPER_MODE'])) {
    Mage::setIsDeveloperMode(true);
}

ini_set('display_errors', 1);

umask(0);

Mage::app();

// Load product collection
$collection = Mage::getModel('sales/order')->getCollection();

$collection->addAttributeToSelect('increment_id');
$collection->addAttributeToSelect('customer_firstname');
$collection->addAttributeToSelect('customer_lastname');
$collection->addAttributeToSelect('grand_total');

foreach ($collection as $order) {

		$orders[] = array(
			"increment_id" => "#" . $order->getData('increment_id'),
			"name" => $order->getCustomerName(),
			"grand_total" => $order->getData('grand_total')
			 );

}

$docJson['orders'] = $orders;

header('Content-Type: application/json; charset=utf-8');

echo(json_encode($docJson));