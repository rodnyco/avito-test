<?php
declare(strict_types=1);

namespace App;

use DI\Container;
use PDO;
use App\Repository\AdRepository;
use App\Service\AdService;

class ContainerBuilder
{
    private Container $container;
    private array     $settings;

    public function __construct(array $settings)
    {
        $this->container = new Container();
        $this->settings = $settings['settings'];
    }

    public function createContainer(): Container
    {
        $this->setDatabase();
        $this->setAdRepository();
        $this->setAdService();
        return $this->container;
    }

    private function setDatabase(): void
    {
        $this->container->set('db', function (): PDO {
            $dbConfig = $this->settings['db'];
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;port=%s;charset=utf8',
                $dbConfig['host'],
                $dbConfig['name'],
                $dbConfig['port']
            );
            $pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $pdo;
        });
    }

    private function setAdRepository(): void
    {
        $this->container->set('ad_repository', function (): adRepository {
           return new AdRepository($this->container->get('db'));
        });
    }

    private function setAdService(): void
    {
        $this->container->set('ad_service', function (): adService {
           return new AdService($this->container->get('ad_repository'));
        });
    }
}