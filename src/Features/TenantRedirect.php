<?php

use Stancl\Tenancy\TenantManager;
use Stancl\Tenancy\Contracts\Feature;

class TenantRedirect implements Feature
{
    public function bootstrap(TenantManager $tenantManager): void
    {
        RedirectResponse::macro('tenant', function (string $domain) {
            // replace first occurance of hostname fragment with $domain
            $url = $this->getTargetUrl();
            $hostname = parse_url($url, PHP_URL_HOST);
            $position = strpos($url, $hostname);
            $this->setTargetUrl(substr_replace($url, $domain, $position, strlen($hostname)));

            return $this;
        });
    }
}