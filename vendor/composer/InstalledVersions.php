<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;








class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => 'ddec962b9c90d497686a6fff9bf92de2b82fbd22',
    'name' => 'laravel/laravel',
  ),
  'versions' => 
  array (
    'acacha/ace-template-laravel' => 
    array (
      'pretty_version' => '0.1.4.1',
      'version' => '0.1.4.1',
      'aliases' => 
      array (
      ),
      'reference' => '1b378445b73c86c77fe72533ed6376cf0bcca3a6',
    ),
    'barryvdh/laravel-debugbar' => 
    array (
      'pretty_version' => 'v3.2.3',
      'version' => '3.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '5fcba4cc8e92a230b13b99c1083fc22ba8a5c479',
    ),
    'barryvdh/laravel-dompdf' => 
    array (
      'pretty_version' => 'v0.8.4',
      'version' => '0.8.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '3fd817065e1c820b1ddace8b2bf65ca45088df4f',
    ),
    'bigfish/pdf417' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '481b7b890371b6ebaa9cd872e019593eb189f255',
    ),
    'components/font-awesome' => 
    array (
      'pretty_version' => '5.12.1',
      'version' => '5.12.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f033e952d0e20684443c0466045deae61fd4e733',
    ),
    'cordoval/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'davedevelopment/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'dnoegel/php-xdg-base-dir' => 
    array (
      'pretty_version' => '0.1',
      'version' => '0.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '265b8593498b997dc2d31e75b89f053b5cc9621a',
    ),
    'doctrine/annotations' => 
    array (
      'pretty_version' => 'v1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '54cacc9b81758b14e3ce750f205a393d52339e97',
    ),
    'doctrine/cache' => 
    array (
      'pretty_version' => 'v1.6.2',
      'version' => '1.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'eb152c5100571c7a45470ff2a35095ab3f3b900b',
    ),
    'doctrine/collections' => 
    array (
      'pretty_version' => 'v1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1a4fb7e902202c33cce8c55989b945612943c2ba',
    ),
    'doctrine/common' => 
    array (
      'pretty_version' => 'v2.7.3',
      'version' => '2.7.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '4acb8f89626baafede6ee5475bc5844096eba8a9',
    ),
    'doctrine/dbal' => 
    array (
      'pretty_version' => 'v2.5.13',
      'version' => '2.5.13.0',
      'aliases' => 
      array (
      ),
      'reference' => '729340d8d1eec8f01bff708e12e449a3415af873',
    ),
    'doctrine/inflector' => 
    array (
      'pretty_version' => 'v1.2.0',
      'version' => '1.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e11d84c6e018beedd929cff5220969a3c6d1d462',
    ),
    'doctrine/instantiator' => 
    array (
      'pretty_version' => '1.0.5',
      'version' => '1.0.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '8e884e78f9f0eb1329e445619e04456e64d8051d',
    ),
    'doctrine/lexer' => 
    array (
      'pretty_version' => 'v1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '83893c552fd2045dd78aef794c31e694c37c0b8c',
    ),
    'dompdf/dompdf' => 
    array (
      'pretty_version' => 'v0.8.3',
      'version' => '0.8.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '75f13c700009be21a1965dc2c5b68a8708c22ba2',
    ),
    'egulias/email-validator' => 
    array (
      'pretty_version' => '2.1.7',
      'version' => '2.1.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '709f21f92707308cdf8f9bcfa1af4cb26586521e',
    ),
    'erusev/parsedown' => 
    array (
      'pretty_version' => '1.7.1',
      'version' => '1.7.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '92e9c27ba0e74b8b028b111d1b6f956a15c01fc1',
    ),
    'fideloper/proxy' => 
    array (
      'pretty_version' => '3.3.4',
      'version' => '3.3.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '9cdf6f118af58d89764249bbcc7bb260c132924f',
    ),
    'filp/whoops' => 
    array (
      'pretty_version' => '2.3.1',
      'version' => '2.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bc0fd11bc455cc20ee4b5edabc63ebbf859324c7',
    ),
    'fzaninotto/faker' => 
    array (
      'pretty_version' => 'v1.8.0',
      'version' => '1.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f72816b43e74063c8b10357394b6bba8cb1c10de',
    ),
    'guzzlehttp/psr7' => 
    array (
      'pretty_version' => '1.7.0',
      'version' => '1.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '53330f47520498c0ae1f61f7e2c90f55690c06a3',
    ),
    'hamcrest/hamcrest-php' => 
    array (
      'pretty_version' => 'v1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b37020aa976fa52d3de9aa904aa2522dc518f79c',
    ),
    'illuminate/auth' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/broadcasting' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/bus' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/cache' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/config' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/console' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/container' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/contracts' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/cookie' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/database' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/encryption' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/events' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/filesystem' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/hashing' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/http' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/log' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/mail' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/notifications' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/pagination' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/pipeline' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/queue' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/redis' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/routing' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/session' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/support' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/translation' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/validation' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'illuminate/view' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.5.45',
      ),
    ),
    'intervention/image' => 
    array (
      'pretty_version' => '2.5.1',
      'version' => '2.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'abbf18d5ab8367f96b3205ca3c89fb2fa598c69e',
    ),
    'jakub-onderka/php-console-color' => 
    array (
      'pretty_version' => 'v0.2',
      'version' => '0.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd5deaecff52a0d61ccb613bb3804088da0307191',
    ),
    'jakub-onderka/php-console-highlighter' => 
    array (
      'pretty_version' => 'v0.4',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9f7a229a69d52506914b4bc61bfdb199d90c5547',
    ),
    'jenssegers/date' => 
    array (
      'pretty_version' => 'v3.5.0',
      'version' => '3.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '58393b0544fc2525b3fcd02aa4c989857107e05a',
    ),
    'kodova/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'laracasts/utilities' => 
    array (
      'pretty_version' => '3.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '298fb3c6f29901a4550c4f98b57c05f368341d04',
    ),
    'laravel-validation-rules/phone' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '786d7aaeaeb79fc5a423c678d8a094fe4a11678d',
    ),
    'laravel/framework' => 
    array (
      'pretty_version' => 'v5.5.45',
      'version' => '5.5.45.0',
      'aliases' => 
      array (
      ),
      'reference' => '52c79ecf54b6168a54730ccb6c4c9f3561732a80',
    ),
    'laravel/laravel' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => 'ddec962b9c90d497686a6fff9bf92de2b82fbd22',
    ),
    'laravel/tinker' => 
    array (
      'pretty_version' => 'v1.0.8',
      'version' => '1.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cafbf598a90acde68985660e79b2b03c5609a405',
    ),
    'league/flysystem' => 
    array (
      'pretty_version' => '1.0.50',
      'version' => '1.0.50.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dab4e7624efa543a943be978008f439c333f2249',
    ),
    'maddhatter/laravel-fullcalendar' => 
    array (
      'pretty_version' => 'v1.3.0',
      'version' => '1.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6502ee3eee2d506d58fa37864af8f2003c9aaca1',
    ),
    'maximebf/debugbar' => 
    array (
      'pretty_version' => 'v1.15.0',
      'version' => '1.15.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '30e7d60937ee5f1320975ca9bc7bcdd44d500f07',
    ),
    'mercuryseries/flashy' => 
    array (
      'pretty_version' => '1.0.2',
      'version' => '1.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '58cfe7989d9a06dc0ebc5d83918833464caabfb6',
    ),
    'milon/barcode' => 
    array (
      'pretty_version' => '5.3.6',
      'version' => '5.3.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ca2f3efbf46142ff7f7afe3b0f3660ea4a067576',
    ),
    'mockery/mockery' => 
    array (
      'pretty_version' => '0.9.11',
      'version' => '0.9.11.0',
      'aliases' => 
      array (
      ),
      'reference' => 'be9bf28d8e57d67883cba9fcadfcff8caab667f8',
    ),
    'monolog/monolog' => 
    array (
      'pretty_version' => '1.24.0',
      'version' => '1.24.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bfc9ebb28f97e7a24c45bdc3f0ff482e47bb0266',
    ),
    'mtdowling/cron-expression' => 
    array (
      'pretty_version' => 'v1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '9504fa9ea681b586028adaaa0877db4aecf32bad',
    ),
    'myclabs/deep-copy' => 
    array (
      'pretty_version' => '1.7.0',
      'version' => '1.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3b8a3a99ba1f6a3952ac2747d989303cbd6b7a3e',
    ),
    'nesbot/carbon' => 
    array (
      'pretty_version' => '1.36.2',
      'version' => '1.36.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cd324b98bc30290f233dd0e75e6ce49f7ab2a6c9',
    ),
    'nikic/php-parser' => 
    array (
      'pretty_version' => 'v4.2.1',
      'version' => '4.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5221f49a608808c1e4d436df32884cbc1b821ac0',
    ),
    'paragonie/random_compat' => 
    array (
      'pretty_version' => 'v9.99.99',
      'version' => '9.99.99.0',
      'aliases' => 
      array (
      ),
      'reference' => '84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
    ),
    'phar-io/manifest' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2df402786ab5368a0169091f61a7c1e0eb6852d0',
    ),
    'phar-io/version' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a70c0ced4be299a63d32fa96d9281d03e94041df',
    ),
    'phenx/php-font-lib' => 
    array (
      'pretty_version' => '0.5.1',
      'version' => '0.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '760148820110a1ae0936e5cc35851e25a938bc97',
    ),
    'phenx/php-svg-lib' => 
    array (
      'pretty_version' => 'v0.3.2',
      'version' => '0.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ccc46ef6340d4b8a4a68047e68d8501ea961442c',
    ),
    'phpdocumentor/reflection-common' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '21bdeb5f65d7ebf9f43b1b25d404f87deab5bfb6',
    ),
    'phpdocumentor/reflection-docblock' => 
    array (
      'pretty_version' => '4.3.0',
      'version' => '4.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '94fd0001232e47129dd3504189fa1c7225010d08',
    ),
    'phpdocumentor/type-resolver' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9c977708995954784726e25d0cd1dddf4e65b0f7',
    ),
    'phpspec/prophecy' => 
    array (
      'pretty_version' => '1.8.0',
      'version' => '1.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '4ba436b55987b4bf311cb7c6ba82aa528aac0a06',
    ),
    'phpunit/php-code-coverage' => 
    array (
      'pretty_version' => '5.3.2',
      'version' => '5.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c89677919c5dd6d3b3852f230a663118762218ac',
    ),
    'phpunit/php-file-iterator' => 
    array (
      'pretty_version' => '1.4.5',
      'version' => '1.4.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '730b01bc3e867237eaac355e06a36b85dd93a8b4',
    ),
    'phpunit/php-text-template' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
    ),
    'phpunit/php-timer' => 
    array (
      'pretty_version' => '1.0.9',
      'version' => '1.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '3dcf38ca72b158baf0bc245e9184d3fdffa9c46f',
    ),
    'phpunit/php-token-stream' => 
    array (
      'pretty_version' => '2.0.2',
      'version' => '2.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '791198a2c6254db10131eecfe8c06670700904db',
    ),
    'phpunit/phpunit' => 
    array (
      'pretty_version' => '6.5.14',
      'version' => '6.5.14.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bac23fe7ff13dbdb461481f706f0e9fe746334b7',
    ),
    'phpunit/phpunit-mock-objects' => 
    array (
      'pretty_version' => '5.0.10',
      'version' => '5.0.10.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cd1cf05c553ecfec36b170070573e540b67d3f1f',
    ),
    'psr/container' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
    ),
    'psr/http-message-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6c001f1daafa3a3ac1d8ff69ee4db8e799a654dd',
    ),
    'psr/log-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
        1 => '1.0.0',
      ),
    ),
    'psr/simple-cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
    ),
    'psy/psysh' => 
    array (
      'pretty_version' => 'v0.9.9',
      'version' => '0.9.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '9aaf29575bb8293206bb0420c1e1c87ff2ffa94e',
    ),
    'ralouphie/getallheaders' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '120b605dfeb996808c31b6477290a714d356e822',
    ),
    'ramsey/uuid' => 
    array (
      'pretty_version' => '3.8.0',
      'version' => '3.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd09ea80159c1929d75b3f9c60504d613aeb4a1e3',
    ),
    'rhumsaa/uuid' => 
    array (
      'replaced' => 
      array (
        0 => '3.8.0',
      ),
    ),
    'sabberworm/php-css-parser' => 
    array (
      'pretty_version' => '8.1.0',
      'version' => '8.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '850cbbcbe7fbb155387a151ea562897a67e242ef',
    ),
    'sebastian/code-unit-reverse-lookup' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '4419fcdb5eabb9caa61a27c7a1db532a6b55dd18',
    ),
    'sebastian/comparator' => 
    array (
      'pretty_version' => '2.1.3',
      'version' => '2.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '34369daee48eafb2651bea869b4b15d75ccc35f9',
    ),
    'sebastian/diff' => 
    array (
      'pretty_version' => '2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '347c1d8b49c5c3ee30c7040ea6fc446790e6bddd',
    ),
    'sebastian/environment' => 
    array (
      'pretty_version' => '3.1.0',
      'version' => '3.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cd0871b3975fb7fc44d11314fd1ee20925fce4f5',
    ),
    'sebastian/exporter' => 
    array (
      'pretty_version' => '3.1.0',
      'version' => '3.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '234199f4528de6d12aaa58b612e98f7d36adb937',
    ),
    'sebastian/global-state' => 
    array (
      'pretty_version' => '2.0.0',
      'version' => '2.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
    ),
    'sebastian/object-enumerator' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '7cfd9e65d11ffb5af41198476395774d4c8a84c5',
    ),
    'sebastian/object-reflector' => 
    array (
      'pretty_version' => '1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '773f97c67f28de00d397be301821b06708fca0be',
    ),
    'sebastian/recursion-context' => 
    array (
      'pretty_version' => '3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5b0cd723502bac3b006cbf3dbf7a1e3fcefe4fa8',
    ),
    'sebastian/resource-operations' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ce990bb21759f94aeafd30209e8cfcdfa8bc3f52',
    ),
    'sebastian/version' => 
    array (
      'pretty_version' => '2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '99732be0ddb3361e16ad77b68ba41efc8e979019',
    ),
    'swiftmailer/swiftmailer' => 
    array (
      'pretty_version' => 'v6.2.0',
      'version' => '6.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6fa3232ff9d3f8237c0fae4b7ff05e1baa4cd707',
    ),
    'symfony/console' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '71ce77f37af0c5ffb9590e43cc4f70e426945c5e',
    ),
    'symfony/css-selector' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '8ca29297c29b64fb3a1a135e71cb25f67f9fdccf',
    ),
    'symfony/debug' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '8d8a9e877b3fcdc50ddecf8dcea146059753f782',
    ),
    'symfony/event-dispatcher' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ec625e2fff7f584eeb91754821807317b2e79236',
    ),
    'symfony/finder' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fcdde4aa38f48190ce70d782c166f23930084f9b',
    ),
    'symfony/http-foundation' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '9a96d77ceb1fd913c9d4a89e8a7e1be87604be8a',
    ),
    'symfony/http-kernel' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '0362368c761cb8d9c79e56ab0db61d2c692db594',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e3d826245268269cd66f8326bd8bc066687b4a19',
    ),
    'symfony/polyfill-iconv' => 
    array (
      'pretty_version' => 'v1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '97001cfc283484c9691769f51cdf25259037eba2',
    ),
    'symfony/polyfill-intl-idn' => 
    array (
      'pretty_version' => 'v1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '89de1d44f2c059b266f22c9cc9124ddc4cd0987a',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c79c051f5b3a46be09205c73b80b346e4153e494',
    ),
    'symfony/polyfill-php70' => 
    array (
      'pretty_version' => 'v1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6b88000cdd431cd2e940caa2cb569201f3f84224',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9050816e2ca34a8e916c3a0ae8b9c2fccf68b631',
    ),
    'symfony/process' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '009f8dda80930e89e8344a4e310b08f9ff07dd2e',
    ),
    'symfony/routing' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '6b25a86df5860461ff1990946168c0ef944f83db',
    ),
    'symfony/translation' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => '3e2966209567ffed8825905b53fc8548446130aa',
    ),
    'symfony/var-dumper' => 
    array (
      'pretty_version' => 'v3.4.23',
      'version' => '3.4.23.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd34d10236300876d14291e9df85c6ef3d3bb9066',
    ),
    'theseer/tokenizer' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cb2f008f3f05af2893a87208fe6a6c4985483f8b',
    ),
    'tightenco/collect' => 
    array (
      'replaced' => 
      array (
        0 => '<5.5.33',
      ),
    ),
    'tijsverkoyen/css-to-inline-styles' => 
    array (
      'pretty_version' => '2.2.1',
      'version' => '2.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '0ed4a2ea4e0902dac0489e6436ebcd5bbcae9757',
    ),
    'vlucas/phpdotenv' => 
    array (
      'pretty_version' => 'v2.6.1',
      'version' => '2.6.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2a7dcf7e3e02dc5e701004e51a6f304b713107d5',
    ),
    'webmozart/assert' => 
    array (
      'pretty_version' => '1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '83e253c8e0be5b0257b881e1827274667c5c17a9',
    ),
    'yajra/laravel-datatables-oracle' => 
    array (
      'pretty_version' => 'v8.13.5',
      'version' => '8.13.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a97a173a52f2b60075f310dac39932faa377fb4f',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}

if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}





private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {
foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
