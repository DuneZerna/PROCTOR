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

namespace OCA\ConfigReport\Command;

use OCA\ConfigReport\ReportDataCollector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package OCA\ConfigReport\Command
 */
class ConfigReport extends Command {

	/**
	 * @var ReportDataCollector
	 */
	private $reportDataCollector;

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int
	 */
	public function run(InputInterface $input, OutputInterface $output) {
		$this->reportDataCollector = new ReportDataCollector(
			\OC::$server->getIntegrityCodeChecker(),
			\OC::$server->getUserManager(),
			\OC::$server->getGroupManager(),
			\OC_Util::getVersion(),
			\OC_Util::getVersionString(),
			\OC_Util::getEditionString(),
			\OCP\User::getDisplayName(),
			\OC::$server->getSystemConfig(),
			\OC::$server->getAppConfig(),
			\OC::$server->getDatabaseConnection()
		);

		return parent::run($input, $output); // TODO: Change the autogenerated stub
	}

	protected function configure() {
		$this
			->setName('configreport:generate')
			->setDescription('generates a configreport');
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$output->writeln($this->reportDataCollector->getReportJson());
	}
}
