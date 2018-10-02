<?php
/**
 * @copyright Copyright (c) 2016, ownCloud GmbH.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

namespace OCA\ConfigReport;
use OC\IntegrityCheck\Checker;
use OC\SystemConfig;
use OC\User\Manager;
use OCP\IAppConfig;
use OCP\IDBConnection;
use OCP\IGroupManager;
use OCP\IUser;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @package OCA\ConfigReport\Report
 */
class ReportDataCollector {

	/**
	 * @var Checker
	 */
	private $integrityChecker;

	/**
	 * @var Manager
	 */
	private $userManager;

	/**
	 * @var IGroupManager
	 */
	private $groupManager;

	/**
	 * @var string
	 */
	private $licenseKey;

	/**
	 * @var array
	 */
	private $version;

	/**
	 * @var string
	 */
	private $versionString;

	/**
	 * @var string
	 */
	private $editionString;

	/**
	 * @var string
	 */
	private $displayName;

	/**
	 * @var \OC\SystemConfig
	 */
	private $systemConfig;

	/**
	 * @var array
	 */
	private $appConfigData;

	/**
	 * @var array
	 */
	private $apps;

	/**
	 * @var IAppConfig
	 */
	private $appConfig;

	/** @var IDBConnection */
	private $connection;

	/**
	 * @param Checker $integrityChecker
	 * @param Manager $userManager
	 * @param IGroupManager $groupManager
	 * @param array $version
	 * @param string $versionString
	 * @param string $editionString
	 * @param string $displayName
	 * @param SystemConfig $systemConfig
	 * @param IAppConfig $appConfig
	 * @param IDBConnection $connection
	 */
	public function __construct(
		Checker $integrityChecker,
		Manager $userManager,
		IGroupManager $groupManager,
		array $version,
		$versionString,
		$editionString,
		$displayName,
		SystemConfig $systemConfig,
		IAppConfig $appConfig,
		IDBConnection $connection
	) {
		$this->integrityChecker = $integrityChecker;
		$this->userManager = $userManager;
		$this->groupManager = $groupManager;
		$this->licenseKey = \OCP\IConfig::SENSITIVE_VALUE;

		$this->version = $version;
		$this->versionString = $versionString;
		$this->editionString = $editionString;
		$this->displayName = $displayName;

		$this->systemConfig = $systemConfig;
		$this->apps = \OC_App::listAllApps();
		$this->appConfig = $appConfig;
		$this->connection = $connection;

		$event = new GenericEvent();
		$this->appConfigData = \OC::$server->getEventDispatcher()->dispatch('OCA\ConfigReport::loadData', $event);
	}

	/**
	 * @param int $options
	 * @param int $depth
	 * @return string
	 */
	public function getReportJson($options = JSON_PRETTY_PRINT, $depth = 512) {
		return \json_encode($this->getReport(), $options, $depth);
	}

	/**
	 * @param array $report
	 */
	public function addEventListenerReportData(&$report) {
		foreach ($this->appConfigData->getArguments() as $index) {
			foreach ($index as $innerKey => $innerVal) {
				if (!\array_key_exists($innerKey, $report)) {
					$report[$innerKey] = $innerVal;
				}
			}
		}
	}

	/**
	 * @return array
	 */
	public function getReport() {
		// TODO: add l10n (unused right now)
		$l = \OC::$server->getL10N('config_report');

		$report = [
			'basic' => $this->getBasicDetailArray(),
			'stats' => $this->getStatsDetailArray(),
			'config' => $this->getSystemConfigDetailArray(),
			'integritychecker' => $this->getIntegrityCheckerDetailArray(),
			'core' => $this->getCoreConfigArray(),
			'apps' => $this->getAppsDetailArray(),
			'migrations' => $this->getOcMigrationArray(),
			'phpinfo' => $this->getPhpInfoDetailArray()
		];

		//Now apps can add their values to report array
		$this->addEventListenerReportData($report);

		return $report;
	}

	/**
	 * @return array
	 */
	private function getIntegrityCheckerDetailArray() {
		return [
			'passing' => $this->integrityChecker->hasPassedCheck(),
			'enabled' => $this->integrityChecker->isCodeCheckEnforced(),
			'result' => $this->integrityChecker->getResults(),
		];
	}

	/**
	 * Basic report data
	 * @return array
	 */
	private function getBasicDetailArray() {
		return [
			'license key' => $this->licenseKey,
			'date' => \date('r'),
			'ownCloud version' => \implode('.', $this->version),
			'ownCloud version string' => $this->versionString,
			'ownCloud edition' => $this->editionString,
			'server OS' => PHP_OS,
			'server OS version' => \php_uname(),
			'server SAPI' => \php_sapi_name(),
			'webserver version' => $_SERVER['SERVER_SOFTWARE'],
			'hostname' => $_SERVER['HTTP_HOST'],
			'logged-in user' => $this->displayName,
		];
	}

	/**
	 * @return array
	 */
	private function getStatsDetailArray() {
		$users = [];
		$this->userManager->callForAllUsers(function (IUser $user) use (&$users) {
			if (!isset($users[$user->getBackendClassName()])) {
				$users[$user->getBackendClassName()] = ['count' => 0, 'seen' => 0, 'logged in (30 days)' => 0];
			}
			$users[$user->getBackendClassName()]['count']++;
			if ($user->getLastLogin() > 0) {
				$users[$user->getBackendClassName()]['seen']++;
				if ($user->getLastLogin() > \strtotime('-30 days')) {
					$users[$user->getBackendClassName()]['logged in (30 days)']++;
				}
			}
		});

		$groupCount = [];
		$groups = $this->groupManager->search('');
		foreach ($groups as $group) {
			$backendName = \get_class($group->getBackend());
			if (!isset($groupCount[$backendName])) {
				$groupCount[$backendName] = 0;
			}
			$groupCount[$backendName]++;
		}

		return [
			'users' => $users,
			'groups' => $groupCount,
		];
	}
	/**
	* @return array
	*/
	private function getSystemConfigDetailArray() {
		$keys = $this->systemConfig->getKeys();
		$result = [];
		foreach ($keys as $key) {
			$result[$key] = $this->systemConfig->getFilteredValue($key);
		}

		return $result;
	}

	/**
	 * Sanitize values from the given hash array by removing
	 * sensitive values
	 *
	 * @param array $values hash array
	 * @return array sanitized array
	 */
	private function sanitizeValues($values) {
		foreach ($values as $key => $value) {
			if (\stripos($key, 'password') !== false) {
				$values[$key] = \OCP\IConfig::SENSITIVE_VALUE;
			}
		}
		return $values;
	}

	/**
	 * @return array
	 */
	private function getCoreConfigArray() {
		// Get core config data
		$appConfig = $this->appConfig->getValues('core', false);
		// this one is reported separately already
		unset($appConfig['oc.integritycheck.checker']);
		return $this->sanitizeValues($appConfig);
	}
	/**
	 * @return array
	 */
	private function getAppsDetailArray() {
		// Get app data
		foreach ($this->apps as &$app) {
			if ($app['active']) {
				$appConfig = $this->appConfig->getValues($app['id'], false);
				$app['appconfig'] = $this->sanitizeValues($appConfig);
			}
		}
		return $this->apps;
	}

	/**
	 * @return array
	 */
	private function getOcMigrationArray() {
		//Get data from oc_migrations table
		$queryBuilder = $this->connection->getQueryBuilder();
		$results = $queryBuilder
			->select('app', 'version')
			->from('migrations')
			->execute()
			->fetchAll();

		return $results;
	}

	/**
	 * @return array
	 */
	private function getPhpInfoDetailArray() {
		$sensitiveServerConfigs = [
			'HTTP_COOKIE',
			'PATH',
			'Cookie',
			'include_path',
		];

		// Get the phpinfo, parse it, and record it (parts from http://www.php.net/manual/en/function.phpinfo.php#87463)
		\ob_start();
		\phpinfo(-1);

		$phpinfo = \preg_replace(
			['#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
				'#<h1>Configuration</h1>#', "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
				"#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
				'#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
				. '<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
				'#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
				'#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
				"# +#", '#<tr>#', '#</tr>#'],
			['$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
				'<h2>PHP Configuration</h2>' . "\n" . '<tr><td>PHP Version</td><td>$2</td></tr>' .
				"\n" . '<tr><td>PHP Egg</td><td>$1</td></tr>',
				'<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
				'<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
				'<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'],
			\ob_get_clean());

		$sections = \explode('<h2>', \strip_tags($phpinfo, '<h2><th><td>'));
		unset($sections[0]);

		$result = [];
		$sensitiveServerConfigs = \array_flip($sensitiveServerConfigs);
		foreach ($sections as $section) {
			$n = \substr($section, 0, \strpos($section, '</h2>'));
			if ($n === 'PHP Variables') {
				continue;
			}
			\preg_match_all(
				'#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#',
				$section, $matches, PREG_SET_ORDER);
			foreach ($matches as $match) {
				if (isset($sensitiveServerConfigs[$match[1]])) {
					continue;
					// filter all key which contain 'password'
				}
				if (!isset($match[3])) {
					$value = isset($match[2]) ? $match[2] : null;
				} elseif ($match[2] == $match[3]) {
					$value = $match[2];
				} else {
					$value = \array_slice($match, 2);
				}
				$result[$n][$match[1]] = $value;
			}
		}

		return $result;
	}
}
