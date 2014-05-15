<?php

/**
 * http://idm.data.gov/fed_agency.json
 */
define('ORGANIZATION_TO_EXPORT', 'National Science Foundation');

echo "Exporting " . ORGANIZATION_TO_EXPORT . PHP_EOL;

require_once dirname(__DIR__) . '/inc/common.php';

/**
 * Get organization terms, including all children, as Array
 */
$OrgList    = new \CKAN\Core\OrganizationList(AGENCIES_LIST_URL);
$termsArray = $OrgList->getTreeArrayFor(ORGANIZATION_TO_EXPORT);

/**
 * sometimes there is no parent term (ex. Department of Labor)
 */
if (!defined('PARENT_TERM')) {
    define('PARENT_TERM', '_');
}

/**
 * Create results dir for logs and json results
 */
$results_dir = RESULTS_DIR . date('/Ymd-His') . '_TRACKING_' . PARENT_TERM;
mkdir($results_dir);

/**
 * Search for packages by terms found
 */

/**
 * Production
 */
$Importer = new \CKAN\Manager\CkanManager(CKAN_API_URL);

/**
 * Staging
 */
//$Importer = new \CKAN\Manager\CkanManager(CKAN_STAGING_API_URL);

$Importer->export_tracking_by_org_terms($termsArray, $results_dir);

// show running time on finish
timer();