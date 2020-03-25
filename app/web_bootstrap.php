<?php

use App\Core\ServiceBus;
use App\Core\Service\FSMap;
use App\Core\Service\Configuration;

# Call application
ServiceBus::register('fsmap', new FSMap());
ServiceBus::register('conf', new Configuration());
ServiceBus::autoload();
ServiceBus::get('application')->run();

# test
# dump(ServiceBus::instance());