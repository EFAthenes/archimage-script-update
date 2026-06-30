<?php
/*
 * @license AGPL-3.0
 * 
 * @copyright Copyright (c) 2026 EFA, Ecole française d'athènes, EFAthenes.
 *
 * @author Louis Mulot <louis.mulot@efa.gr>
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
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 * 
 */
declare(strict_types=1);
/**
 * Archimage update script from 26.05 to 26.06
 *
 * Usage:
 *   sudo -u www-data php updateVersion.php /path/to/current/installation
 */
const VERSION = '26.06';
const REQUIRED_PREVIOUS_VERSION = '26.05';
const RELEASE_URL = 'https://github.com/EFAthenes/archimage/releases/download/26.6/archimage_26.6.zip';

const VALIDATION_TEXT = 'YES';

$sqlQueries = [
    "ALTER TABLE `documents` DROP `periode`, DROP `periode_enreg`;",
   // "ALTER TABLE `documents` DROP COLUMN IF EXISTS `periode`, DROP COLUMN IF EXISTS `periode_enreg`;",
    "ALTER TABLE `documents` CHANGE `id_doi` `id_doi` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `id_ark` `id_ark` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL;",
    "ALTER TABLE `documents` CHANGE `doc_originel` `doc_originel` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `publication` `publication` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `lieu_conserv` `lieu_conserv` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `fichier_import` `fichier_import` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL COMMENT '';",
    "ALTER TABLE `documents` CHANGE `desc1` `desc1` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc2` `desc2` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc3` `desc3` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc4` `desc4` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc5` `desc5` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc6` `desc6` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc7` `desc7` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc8` `desc8` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc9` `desc9` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc10` `desc10` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc11` `desc11` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc12` `desc12` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc13` `desc13` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc14` `desc14` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc15` `desc15` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc16` `desc16` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc17` `desc17` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc18` `desc18` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc19` `desc19` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL, CHANGE `desc20` `desc20` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL;",
    "ALTER TABLE `archives_manuscrites` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `audio` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `auteurs` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `chronique` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `collections` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `documents` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `domaines` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `droits` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `enregistrements` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `ensembles` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `estampage` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `etat_conservation` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `excel` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `filemaker` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `fonctions` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `format` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `groupes_d_acces` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `kapp_groups` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `kapp_ktokens` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `kapp_language` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `kapp_roles` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `kapp_users_connections` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `kapp_users_details` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `kapp_users` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_archives_langues` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_auteurs_documents` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_docs_domaines` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_documents_collections` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_documents_documents` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_documents_langues` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_documents_liasses` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_documents_secteurs` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_documents_sujets` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_documents_tags` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_estampage_nature_inscription` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_fonctions_auteurs` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_groupe_d_acces_droit` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_kapp_roles_groups` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_kapp_users_groups` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_natures_documents` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_periodes_documents` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_periodes_enreg_documents` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_phototheque_orientation` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_planotheque_orientation` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_publications_documents` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `klink_users_groupes_d_acces` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `langues` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `liasses` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `manifestations` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `missions` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `modifications` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `nature_inscription` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `natures` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `niveaux_desc` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `orientation` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `pays` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `periodes` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `phototheque` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `planotheque` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `publications` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `recherche_index` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `regions` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `secteurs` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `sites` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `sujets` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `tags` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `troisd` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `types_docs` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `types_modifications` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `types` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `video` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
    "ALTER TABLE `word` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;",
];

$phpScripts = [
    'doDb.php build',
    'doDb.php clean_cache',
];

$preserveItems = [
    'Archimage2/config/',
    'Archimage2/template/',
    'Archimage2/www/css/',
    'Archimage2/www/images/',
    'Archimage2/www/img/',
    'Archimage2/www/js/',
];

/**
 * Basic helpers
 */
function logMessage(string $message): void
{
    echo 'Archimage:[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
}

function fail(string $message): never
{
    fwrite(STDERR, 'Archimage:ERROR: ' . $message . PHP_EOL);
    exit(1);
}

function runCommand(string $command, ?string $workingDirectory = null): void
{
    logMessage("Running: {$command}");

    $previousDirectory = getcwd();

    if ($previousDirectory === false) {
        fail('Cannot determine current working directory.');
    }

    if ($workingDirectory !== null) {
        if (!is_dir($workingDirectory)) {
            fail("Working directory does not exist: {$workingDirectory}");
        }

        if (!chdir($workingDirectory)) {
            fail("Cannot change working directory to: {$workingDirectory}");
        }
    }

    passthru($command, $exitCode);

    if ($workingDirectory !== null) {
        chdir($previousDirectory);
    }

    if ($exitCode !== 0) {
        fail("Command failed with exit code {$exitCode}");
    }
}

function recursiveCopy(string $source, string $destination): void
{
    if (is_file($source))
    {
        $parent = dirname($destination);

        if (!is_dir($parent))
        {
            mkdir($parent, 0775, true);
        }

        copy($source, $destination);
        return;
    }

    if (!is_dir($destination))
    {
        mkdir($destination, 0775, true);
    }

    $items = scandir($source);

    if ($items === false)
    {
        fail("Cannot read directory: {$source}");
    }

    foreach ($items as $item)
    {
        if ($item === '.' || $item === '..')
        {
            continue;
        }

        recursiveCopy(
                $source . DIRECTORY_SEPARATOR . $item,
                $destination . DIRECTORY_SEPARATOR . $item
        );
    }
}

function recursiveDelete(string $path): void
{
    if (!file_exists($path))
    {
        return;
    }

    if (is_file($path) || is_link($path))
    {
        unlink($path);
        return;
    }

    $items = scandir($path);

    if ($items === false)
    {
        fail("Cannot read directory: {$path}");
    }

    foreach ($items as $item)
    {
        if ($item === '.' || $item === '..')
        {
            continue;
        }

        recursiveDelete($path . DIRECTORY_SEPARATOR . $item);
    }

    rmdir($path);
}

function shouldExclude(string $relativePath, array $preserveItems): bool
{
    $relativePath = trim(str_replace('\\', '/', $relativePath), '/');

    foreach ($preserveItems as $preserveItem)
    {
        $preserveItem = trim(str_replace('\\', '/', $preserveItem), '/');

        if ($relativePath === $preserveItem || str_starts_with($relativePath, $preserveItem . '/'))
        {
            return true;
        }
    }

    return false;
}

function syncDirectory(string $source, string $destination, array $preserveItems): void
{
    $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item)
    {
        /** @var SplFileInfo $item */
        $sourcePath = $item->getPathname();
        $relativePath = substr($sourcePath, strlen($source) + 1);
        $relativePath = str_replace('\\', '/', $relativePath);

        if (shouldExclude($relativePath, $preserveItems))
        {
            logMessage("Preserved: {$relativePath}");
            continue;
        }

        $targetPath = $destination . DIRECTORY_SEPARATOR . $relativePath;

        if ($item->isDir())
        {
            if (!is_dir($targetPath))
            {
                mkdir($targetPath, 0775, true);
            }
        }
        else
        {
            $parent = dirname($targetPath);

            if (!is_dir($parent))
            {
                mkdir($parent, 0775, true);
            }

            copy($sourcePath, $targetPath);
        }
    }
}

function getCurrentVersion(string $installationDir): string
{
    $versionFile = $installationDir . '/Archimage2/version.txt';

    if (!is_file($versionFile)) {
        fail("Version file not found: {$versionFile}");
    }

    $content = trim((string) file_get_contents($versionFile));

    if ($content === '') {
        fail("Version file is empty: {$versionFile}");
    }

    $parts = explode(';', $content);

    $version = trim($parts[0] ?? '');

    if ($version === '') {
        fail("Cannot read current version from: {$versionFile}");
    }

    return $version;
}

function requireCurrentVersion(string $installationDir, string $expectedVersion): void
{
    $currentVersion = getCurrentVersion($installationDir);

    if ($currentVersion !== $expectedVersion) {
        fail(
            "This updater can only be launched from version {$expectedVersion}. " .
            "Current detected version is {$currentVersion}."
        );
    }

    logMessage("Current version check OK: {$currentVersion}");
}

function requireUpdatedVersion(string $installationDir, string $expectedVersion): void
{
    $currentVersion = getCurrentVersion($installationDir);

    if ($currentVersion !== $expectedVersion) {
        fail(
            "Update seems incomplete. Expected version {$expectedVersion}, " .
            "but detected {$currentVersion} after file copy."
        );
    }

    logMessage("Updated version check OK: {$currentVersion}");
}

function parseSqlConfig(string $configFile): array
{
    if (!is_file($configFile))
    {
        fail("Config file not found: {$configFile}");
    }

    $content = file_get_contents($configFile);

    if ($content === false)
    {
        fail("Cannot read config file: {$configFile}");
    }

    $params = [];

    $map = [
        'sql_host' => 'host',
        'sql_user' => 'user',
        'sql_database' => 'database',
        'sql_pass' => 'password',
    ];

    foreach ($map as $configKey => $resultKey)
    {
        $pattern = '/ParamManager::getInstance\(\)->' . preg_quote($configKey, '/') . '\s*=\s*([\'"])(.*?)\1\s*;/';

        if (!preg_match($pattern, $content, $matches))
        {
            fail("Cannot find {$configKey} in config.php");
        }

        $params[$resultKey] = stripcslashes($matches[2]);
    }
    
    $enginePattern = '/ParamManager::getInstance\(\)->sql_engine\s*=\s*Sql::\$([A-Z_]+)\s*;/';

    if (preg_match($enginePattern, $content, $matches)) {
        $params['engine'] = strtoupper($matches[1]);
    } else {
        $params['engine'] = 'MYSQL';
    }    
    
    

    return $params;
}

function getUtf8mb4CollationForEngine(string $engine): string
{
    $engine = strtoupper(trim($engine));

    return match ($engine) {
        'MYSQL' => 'utf8mb4_0900_ai_ci',
        'MARIADB' => 'utf8mb4_unicode_ci',
        default => fail("Unsupported SQL engine: {$engine}"),
    };
}

function escapeSqlIdentifier(string $identifier): string
{
    return '`' . str_replace('`', '``', $identifier) . '`';
}

function adaptSqlQueryForEngine(string $query, string $engine): string
{
    $engine = strtoupper(trim($engine));

    if ($engine === 'MARIADB') {
        return str_replace(
            'utf8mb4_0900_ai_ci',
            'utf8mb4_unicode_ci',
            $query
        );
    }

    return $query;
}

function runSqlQueries(mysqli $mysqli, array $sqlQueries, string $sqlEngine): array
{
    $total = count($sqlQueries);

    $report = [
        'success' => [],
        'warnings' => [],
        'errors' => [],
    ];

    if ($total === 0) {
        logMessage('No SQL query to run.');
        return $report;
    }

    logMessage("Running {$total} SQL queries");

    foreach ($sqlQueries as $index => $query) {
        $queryNumber = $index + 1;
        $query = trim($query);

        if ($query === '') {
            logMessage("SQL query {$queryNumber}/{$total} is empty, skipping.");
            continue;
        }

        $query = adaptSqlQueryForEngine($query, $sqlEngine);
         
        logMessage("Running SQL query {$queryNumber}/{$total}");

        if (!$mysqli->query($query)) {
            $report['errors'][] = [
                'number' => $queryNumber,
                'error_code' => $mysqli->errno,
                'error_message' => $mysqli->error,
                'query' => $query,
            ];

            logMessage("SQL query {$queryNumber}/{$total} failed, continuing.");

            continue;
        }

        $report['success'][] = [
            'number' => $queryNumber,
            'query' => $query,
        ];

        if ($mysqli->warning_count > 0) {
            $warningsResult = $mysqli->query('SHOW WARNINGS');

            if ($warningsResult instanceof mysqli_result) {
                while ($warning = $warningsResult->fetch_assoc()) {
                    $report['warnings'][] = [
                        'number' => $queryNumber,
                        'level' => $warning['Level'] ?? '',
                        'code' => $warning['Code'] ?? '',
                        'message' => $warning['Message'] ?? '',
                        'query' => $query,
                    ];
                }

                $warningsResult->free();
            }
        }
    }

    logMessage('SQL queries completed.');

    return $report;
}
function printSqlReport(array $sqlReport): void
{
    echo PHP_EOL;
    echo "======================================================================" . PHP_EOL;
    echo " SQL UPDATE REPORT" . PHP_EOL;
    echo "======================================================================" . PHP_EOL;
    echo PHP_EOL;

    echo "Successful queries: " . count($sqlReport['success']) . PHP_EOL;
    echo "Warnings: " . count($sqlReport['warnings']) . PHP_EOL;
    echo "Errors: " . count($sqlReport['errors']) . PHP_EOL;
    echo PHP_EOL;

    if (!empty($sqlReport['warnings'])) {
        echo "----------------------------------------------------------------------" . PHP_EOL;
        echo "WARNINGS" . PHP_EOL;
        echo "----------------------------------------------------------------------" . PHP_EOL;

        foreach ($sqlReport['warnings'] as $warning) {
            echo PHP_EOL;
            echo "Query #" . $warning['number'] . PHP_EOL;
            echo "Level: " . $warning['level'] . PHP_EOL;
            echo "Code: " . $warning['code'] . PHP_EOL;
            echo "Message: " . $warning['message'] . PHP_EOL;
            echo "Query:" . PHP_EOL;
            echo $warning['query'] . PHP_EOL;
        }

        echo PHP_EOL;
    }

    if (!empty($sqlReport['errors'])) {
        echo "----------------------------------------------------------------------" . PHP_EOL;
        echo "ERRORS" . PHP_EOL;
        echo "----------------------------------------------------------------------" . PHP_EOL;

        foreach ($sqlReport['errors'] as $error) {
            echo PHP_EOL;
            echo "Query #" . $error['number'] . PHP_EOL;
            echo "Error code: " . $error['error_code'] . PHP_EOL;
            echo "Error message: " . $error['error_message'] . PHP_EOL;
            echo "Query:" . PHP_EOL;
            echo $error['query'] . PHP_EOL;
        }

        echo PHP_EOL;
    }

    echo "======================================================================" . PHP_EOL;
}
function runSqlFile(mysqli $mysqli, string $sqlFile): void
{
    if (!is_file($sqlFile))
    {
        logMessage("SQL file not found, skipping: {$sqlFile}");
        return;
    }

    logMessage("Running SQL file: {$sqlFile}");

    $sql = file_get_contents($sqlFile);

    if ($sql === false)
    {
        fail("Cannot read SQL file: {$sqlFile}");
    }

    if (!$mysqli->multi_query($sql))
    {
        fail("SQL error in {$sqlFile}: " . $mysqli->error);
    }

    do
    {
        if ($result = $mysqli->store_result())
        {
            $result->free();
        }
    } while ($mysqli->more_results() && $mysqli->next_result());

    if ($mysqli->errno)
    {
        fail("SQL error in {$sqlFile}: " . $mysqli->error);
    }
}

/**
 * Start
 */
if (PHP_SAPI !== 'cli')
{
    fail('This script must be launched from command line.');
}

if ($argc < 2)
{
    fail('Usage: php updateVersion.php /path/to/current/installation');
}

if (!class_exists('ZipArchive')) 
{
    fail('PHP Zip extension is required.');
}

$installationDir = rtrim($argv[1], DIRECTORY_SEPARATOR);

if (!is_dir($installationDir))
{
    fail("Installation directory does not exist: {$installationDir}");
}

requireCurrentVersion($installationDir, REQUIRED_PREVIOUS_VERSION);

$configFile = $installationDir . '/Archimage2/config/config.php';

echo PHP_EOL;
echo "======================================================================" . PHP_EOL;
echo " Archimage update to version " . VERSION . PHP_EOL;
echo "======================================================================" . PHP_EOL;
echo PHP_EOL;
echo "Installation directory:" . PHP_EOL;
echo "  {$installationDir}" . PHP_EOL;
echo PHP_EOL;
echo "WARNING:" . PHP_EOL;
echo "  This script does NOT create any backup." . PHP_EOL;
echo "  The administrator is responsible for backing up files and database" . PHP_EOL;
echo "  before launching this update." . PHP_EOL;
echo PHP_EOL;
echo "To continue, type exactly:" . PHP_EOL;
echo "  " . VALIDATION_TEXT . PHP_EOL;
echo PHP_EOL;
echo "> ";

$confirmation = trim((string) fgets(STDIN));

if ($confirmation !== VALIDATION_TEXT)
{
    fail('Update cancelled by user.');
}

logMessage('Reading SQL configuration');

$sqlConfig = parseSqlConfig($configFile);

$utf8mb4Collation = getUtf8mb4CollationForEngine($sqlConfig['engine']);

logMessage("Detected SQL engine: " . $sqlConfig['engine']);
logMessage("Using collation: " . $utf8mb4Collation);

array_unshift(
    $sqlQueries,
    "ALTER DATABASE " . escapeSqlIdentifier($sqlConfig['database']) .
    " CHARACTER SET utf8mb4 COLLATE {$utf8mb4Collation};"
);

logMessage('Connecting to MySQL');

$mysqli = new mysqli(
        $sqlConfig['host'],
        $sqlConfig['user'],
        $sqlConfig['password'],
        $sqlConfig['database']
);

if ($mysqli->connect_errno)
{
    fail('MySQL connection failed: ' . $mysqli->connect_error);
}

if (!$mysqli->set_charset('utf8mb4'))
{
    fail('Cannot set MySQL charset to utf8mb4: ' . $mysqli->error);
}


$tmpDir = sys_get_temp_dir() . '/archimage_update_' . VERSION . '_' . time();
$archiveFile = $tmpDir . '/release.zip';
$extractDir = $tmpDir . '/extract';

mkdir($tmpDir, 0775, true);
mkdir($extractDir, 0775, true);

try
{
    logMessage('Downloading release ' . VERSION);

    $archiveContent = file_get_contents(RELEASE_URL);

    if ($archiveContent === false)
    {
        fail('Cannot download release archive.');
    }

    file_put_contents($archiveFile, $archiveContent);

    logMessage('Extracting release');

    $zip = new ZipArchive();

    if ($zip->open($archiveFile) !== true) {
        fail('Cannot open release zip archive.');
    }

    if (!$zip->extractTo($extractDir)) {
        $zip->close();
        fail('Cannot extract release zip archive.');
    }

    $zip->close();

    $directories = array_values(array_filter(
        glob($extractDir . '/*'),
        'is_dir'
    ));

    if (count($directories) === 1) {
        $newReleaseDir = $directories[0];
    } else {
        $newReleaseDir = $extractDir;
    }

    logMessage("New release directory: {$newReleaseDir}");

    logMessage('Copying new files into installation directory');

    syncDirectory($newReleaseDir, $installationDir, $preserveItems);

    logMessage('Running SQL updates');

    $sqlReport = runSqlQueries($mysqli, $sqlQueries,$sqlConfig['engine']);

    logMessage('Running PHP update scripts');

    foreach ($phpScripts as $phpScript)
    {
        $parts = explode(' ', trim($phpScript));

        $relativeScriptPath = array_shift($parts);

        if ($relativeScriptPath === null || $relativeScriptPath === '')
        {
            continue;
        }

        $scriptPath = $installationDir . '/' . $relativeScriptPath;

        if (!is_file($scriptPath))
        {
            logMessage("PHP script not found, skipping: {$relativeScriptPath}");
            continue;
        }

        $command = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($scriptPath);

        foreach ($parts as $arg)
        {
            $arg = trim($arg);

            if ($arg === '')
            {
                continue;
            }

            $command .= ' ' . escapeshellarg($arg);
        }

        runCommand($command,$installationDir);
    }

    logMessage('Cleaning temporary directory');

    recursiveDelete($tmpDir);
    
    requireUpdatedVersion($installationDir, VERSION);
    
    if (!empty($sqlReport['errors']))
    {
        fail('Update completed with SQL errors. See SQL update report above.');
    }
    else
    {
        logMessage('Update completed successfully.');
    }
} 
catch (Throwable $e)
{
    recursiveDelete($tmpDir);
    fail($e->getMessage());
}
