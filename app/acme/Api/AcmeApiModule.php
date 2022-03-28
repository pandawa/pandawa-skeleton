<?php
declare(strict_types=1);

namespace Acme\Api;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Pandawa\Component\Module\AbstractModule;
use Pandawa\Component\Module\Provider\RouteProviderTrait;
use Symfony\Component\HttpFoundation\IpUtils;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class AcmeApiModule extends AbstractModule
{
    use RouteProviderTrait;

    protected function routes(): array
    {
        return [
            [
                'type'       => 'group',
                'middleware' => 'api',
                'prefix'     => 'api/v{version}',
                'children'   => $this->getCurrentPath() . '/Resources/routes/routes.yaml',
            ],
        ];
    }

    protected function build(): void
    {
        $this->configureRateLimit();
    }

    private function configureRateLimit(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return IpUtils::checkIp($request->ip(), $this->getWhitelistIps())
                ? Limit::none()
                : Limit::perMinute(60)->by($request->ip());
        });
    }

    private function getWhitelistIps(): array
    {
        return [
            '127.0.0.1',
            ...array_filter(explode(',', config('app.whitelist_ips')), 'trim'),
        ];
    }
}
