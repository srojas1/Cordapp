<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'CSSmin' => $vendorDir . '/mrclay/minify/min/lib/CSSmin.php',
    'Cartalyst\\Sentry\\Groups\\GroupExistsException' => $vendorDir . '/cartalyst/sentry/src/Groups/Exceptions.php',
    'Cartalyst\\Sentry\\Groups\\GroupNotFoundException' => $vendorDir . '/cartalyst/sentry/src/Groups/Exceptions.php',
    'Cartalyst\\Sentry\\Groups\\NameRequiredException' => $vendorDir . '/cartalyst/sentry/src/Groups/Exceptions.php',
    'Cartalyst\\Sentry\\Throttling\\UserBannedException' => $vendorDir . '/cartalyst/sentry/src/Throttling/Exceptions.php',
    'Cartalyst\\Sentry\\Throttling\\UserSuspendedException' => $vendorDir . '/cartalyst/sentry/src/Throttling/Exceptions.php',
    'Cartalyst\\Sentry\\Users\\LoginRequiredException' => $vendorDir . '/cartalyst/sentry/src/Users/Exceptions.php',
    'Cartalyst\\Sentry\\Users\\PasswordRequiredException' => $vendorDir . '/cartalyst/sentry/src/Users/Exceptions.php',
    'Cartalyst\\Sentry\\Users\\UserAlreadyActivatedException' => $vendorDir . '/cartalyst/sentry/src/Users/Exceptions.php',
    'Cartalyst\\Sentry\\Users\\UserExistsException' => $vendorDir . '/cartalyst/sentry/src/Users/Exceptions.php',
    'Cartalyst\\Sentry\\Users\\UserNotActivatedException' => $vendorDir . '/cartalyst/sentry/src/Users/Exceptions.php',
    'Cartalyst\\Sentry\\Users\\UserNotFoundException' => $vendorDir . '/cartalyst/sentry/src/Users/Exceptions.php',
    'Cartalyst\\Sentry\\Users\\WrongPasswordException' => $vendorDir . '/cartalyst/sentry/src/Users/Exceptions.php',
    'CreateCommentsTable' => $baseDir . '/database/migrations/2014_07_19_110723_create_comments_table.php',
    'CreateEventsTable' => $baseDir . '/database/migrations/2014_07_19_110724_create_events_table.php',
    'CreatePagesTable' => $baseDir . '/database/migrations/2014_07_19_110721_create_pages_table.php',
    'CreatePostsTable' => $baseDir . '/database/migrations/2014_07_19_110722_create_posts_table.php',
    'CreateRevisionsTable' => $baseDir . '/database/migrations/2014_07_19_093030_create_revisions_table.php',
    'DatabaseSeeder' => $baseDir . '/database/seeds/DatabaseSeeder.php',
    'DooDigestAuth' => $vendorDir . '/mrclay/minify/min/lib/DooDigestAuth.php',
    'FirePHP' => $vendorDir . '/mrclay/minify/min/lib/FirePHP.php',
    'HTTP_ConditionalGet' => $vendorDir . '/mrclay/minify/min/lib/HTTP/ConditionalGet.php',
    'HTTP_Encoder' => $vendorDir . '/mrclay/minify/min/lib/HTTP/Encoder.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'JSCompilerContext' => $vendorDir . '/mrclay/minify/min/lib/JSMinPlus.php',
    'JSMin' => $vendorDir . '/mrclay/minify/min/lib/JSMin.php',
    'JSMinPlus' => $vendorDir . '/mrclay/minify/min/lib/JSMinPlus.php',
    'JSMin_UnterminatedCommentException' => $vendorDir . '/mrclay/minify/min/lib/JSMin.php',
    'JSMin_UnterminatedRegExpException' => $vendorDir . '/mrclay/minify/min/lib/JSMin.php',
    'JSMin_UnterminatedStringException' => $vendorDir . '/mrclay/minify/min/lib/JSMin.php',
    'JSNode' => $vendorDir . '/mrclay/minify/min/lib/JSMinPlus.php',
    'JSParser' => $vendorDir . '/mrclay/minify/min/lib/JSMinPlus.php',
    'JSToken' => $vendorDir . '/mrclay/minify/min/lib/JSMinPlus.php',
    'JSTokenizer' => $vendorDir . '/mrclay/minify/min/lib/JSMinPlus.php',
    'MigrationCartalystSentryInstallGroups' => $baseDir . '/database/migrations/2012_12_06_225929_migration_cartalyst_sentry_install_groups.php',
    'MigrationCartalystSentryInstallThrottle' => $baseDir . '/database/migrations/2012_12_06_225988_migration_cartalyst_sentry_install_throttle.php',
    'MigrationCartalystSentryInstallUsers' => $baseDir . '/database/migrations/2012_12_06_225921_migration_cartalyst_sentry_install_users.php',
    'MigrationCartalystSentryInstallUsersGroupsPivot' => $baseDir . '/database/migrations/2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot.php',
    'Minify' => $vendorDir . '/mrclay/minify/min/lib/Minify.php',
    'Minify_Build' => $vendorDir . '/mrclay/minify/min/lib/Minify/Build.php',
    'Minify_CSS' => $vendorDir . '/mrclay/minify/min/lib/Minify/CSS.php',
    'Minify_CSS_Compressor' => $vendorDir . '/mrclay/minify/min/lib/Minify/CSS/Compressor.php',
    'Minify_CSS_UriRewriter' => $vendorDir . '/mrclay/minify/min/lib/Minify/CSS/UriRewriter.php',
    'Minify_CSSmin' => $vendorDir . '/mrclay/minify/min/lib/Minify/CSSmin.php',
    'Minify_Cache_APC' => $vendorDir . '/mrclay/minify/min/lib/Minify/Cache/APC.php',
    'Minify_Cache_File' => $vendorDir . '/mrclay/minify/min/lib/Minify/Cache/File.php',
    'Minify_Cache_Memcache' => $vendorDir . '/mrclay/minify/min/lib/Minify/Cache/Memcache.php',
    'Minify_Cache_WinCache' => $vendorDir . '/mrclay/minify/min/lib/Minify/Cache/WinCache.php',
    'Minify_Cache_XCache' => $vendorDir . '/mrclay/minify/min/lib/Minify/Cache/XCache.php',
    'Minify_Cache_ZendPlatform' => $vendorDir . '/mrclay/minify/min/lib/Minify/Cache/ZendPlatform.php',
    'Minify_ClosureCompiler' => $vendorDir . '/mrclay/minify/min/lib/Minify/ClosureCompiler.php',
    'Minify_ClosureCompiler_Exception' => $vendorDir . '/mrclay/minify/min/lib/Minify/ClosureCompiler.php',
    'Minify_CommentPreserver' => $vendorDir . '/mrclay/minify/min/lib/Minify/CommentPreserver.php',
    'Minify_Controller_Base' => $vendorDir . '/mrclay/minify/min/lib/Minify/Controller/Base.php',
    'Minify_Controller_Files' => $vendorDir . '/mrclay/minify/min/lib/Minify/Controller/Files.php',
    'Minify_Controller_Groups' => $vendorDir . '/mrclay/minify/min/lib/Minify/Controller/Groups.php',
    'Minify_Controller_MinApp' => $vendorDir . '/mrclay/minify/min/lib/Minify/Controller/MinApp.php',
    'Minify_Controller_Page' => $vendorDir . '/mrclay/minify/min/lib/Minify/Controller/Page.php',
    'Minify_Controller_Version1' => $vendorDir . '/mrclay/minify/min/lib/Minify/Controller/Version1.php',
    'Minify_DebugDetector' => $vendorDir . '/mrclay/minify/min/lib/Minify/DebugDetector.php',
    'Minify_HTML' => $vendorDir . '/mrclay/minify/min/lib/Minify/HTML.php',
    'Minify_HTML_Helper' => $vendorDir . '/mrclay/minify/min/lib/Minify/HTML/Helper.php',
    'Minify_ImportProcessor' => $vendorDir . '/mrclay/minify/min/lib/Minify/ImportProcessor.php',
    'Minify_JS_ClosureCompiler' => $vendorDir . '/mrclay/minify/min/lib/Minify/JS/ClosureCompiler.php',
    'Minify_JS_ClosureCompiler_Exception' => $vendorDir . '/mrclay/minify/min/lib/Minify/JS/ClosureCompiler.php',
    'Minify_Lines' => $vendorDir . '/mrclay/minify/min/lib/Minify/Lines.php',
    'Minify_Loader' => $vendorDir . '/mrclay/minify/min/lib/Minify/Loader.php',
    'Minify_Logger' => $vendorDir . '/mrclay/minify/min/lib/Minify/Logger.php',
    'Minify_Packer' => $vendorDir . '/mrclay/minify/min/lib/Minify/Packer.php',
    'Minify_Source' => $vendorDir . '/mrclay/minify/min/lib/Minify/Source.php',
    'Minify_YUICompressor' => $vendorDir . '/mrclay/minify/min/lib/Minify/YUICompressor.php',
    'Minify_YUI_CssCompressor' => $vendorDir . '/mrclay/minify/min/lib/Minify/YUI/CssCompressor.php',
    'MrClay\\Cli' => $vendorDir . '/mrclay/minify/min/lib/MrClay/Cli.php',
    'MrClay\\Cli\\Arg' => $vendorDir . '/mrclay/minify/min/lib/MrClay/Cli/Arg.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Resources/stubs/SessionHandlerInterface.php',
    'UpdateGroupsTable' => $baseDir . '/database/migrations/2014_07_19_093021_update_groups_table.php',
    'UpdateUsersTable' => $baseDir . '/database/migrations/2014_07_19_093020_update_users_table.php',
);