<?php

namespace CKAN\Manager;


/**
 * http://idm.data.gov/fed_agency.json
 */

require_once dirname(__DIR__) . '/inc/common.php';

/**
 * Create results dir for logs
 */
$results_dir = RESULTS_DIR . date('/Ymd-His') . '_TAG_BY_identifier';
mkdir($results_dir);

/**
 * Adding Legacy dms tag
 * Production
 */
$CkanManager = new CkanManager(CKAN_API_URL, CKAN_API_KEY);

/**
 * Staging
 */
//$CkanManager = new CkanManager(CKAN_STAGING_API_URL, CKAN_STAGING_API_KEY);

/**
 * DEV
 */
//$CkanManager = new CkanManager(CKAN_DEV_API_URL, CKAN_DEV_API_KEY);

/**
 * DEV2
 */
//$CkanManager = new CkanManager(CKAN_DEV2_API_URL, CKAN_DEV2_API_KEY);

$CkanManager->tag_by_extra_field('identifier', 'source_datajson_identifier', $results_dir);

// show running time on finish
timer();