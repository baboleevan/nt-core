<?php
$html->addStyleSheet(NT_CSS_URL.DIRECTORY_SEPARATOR.'common.css', 'header', 0, __c('cf_css_version'));
$html->addStyleSheet(NT_THEME_CSS_URL.DIRECTORY_SEPARATOR.'default.css', 'header', 0, __c('cf_css_version'));
$html->addStyleSheet('https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css','header', 0, '',  'integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous"');
$html->addStyleSheet(NT_THEME_CSS_URL.DIRECTORY_SEPARATOR.'bootstrap-4-navbar.css', 'header', 0);

$html->addJavaScript('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', 'header', 0);
$html->addJavaScript(NT_JS_URL.DIRECTORY_SEPARATOR.'common.js.php', 'header', 0);
$html->addJavaScript('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 'footer', 0, '', 'integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"');
$html->addJavaScript('https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js', 'footer', 0, '', 'integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"');
$html->addJavaScript(NT_THEME_JS_URL.DIRECTORY_SEPARATOR.'bootstrap-4-navbar.js', 'footer', 0);

$html->addScriptString('<script>
var nt_url      = "'.NT_URL.'";
var nt_img_url  = "'.NT_IMG_URL.'";
var nt_ajax_url = "'.NT_AJAX_URL.'";
</script>', 'header', 0);

$menus = $html->getMenus((string)__c('cf_menus'));

require_once(__DIR__.DIRECTORY_SEPARATOR.'header.sub.php');
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?php echo NT_URL; ?>"><?php echo _d('Home', THEME_LOCALE_DOMAIN); ?></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <?php
            if ($menus) {
                echo '<ul class="navbar-nav">'.PHP_EOL;
                echo $menus.PHP_EOL;
                echo '</ul>'.PHP_EOL;
            }
            ?>

            <ul class="navbar-nav ml-auto">
                <?php if ($isAdmin) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo NT_LINK_ADMIN; ?>"><?php echo _d('Admin', THEME_LOCALE_DOMAIN); ?></a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo NT_URL; ?>/<?php echo BOARD_DIR; ?>/free"><?php echo _d('Free Board', THEME_LOCALE_DOMAIN); ?></a>
                </li>
                <?php if ($isMember) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo NT_LINK_ACCOUNT; ?>"><?php echo _d('My Account', THEME_LOCALE_DOMAIN); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo NT_LINK_LOGOUT; ?>"><?php echo _d('Log Out', THEME_LOCALE_DOMAIN); ?></a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo NT_LINK_LOGIN; ?>"><?php echo _d('Log In', THEME_LOCALE_DOMAIN); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo NT_LINK_SIGNUP; ?>"><?php echo _d('Sign Up', THEME_LOCALE_DOMAIN); ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>

<main role="main" class="container">