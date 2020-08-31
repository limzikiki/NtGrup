
<?php if ($singleton['color']) { ?>
<style>
    .app-header { border-top: 8px <?php echo  $singleton['color'] ; ?> solid; }
</style>
<?php } ?>

<div>
    <ul class="uk-breadcrumb">
        <li><a href="<?php $app->route('/singletons'); ?>"><?php echo $app("i18n")->get('Singletons'); ?></a></li>
        <li class="uk-active" data-uk-dropdown>

            <a><i class="uk-icon-bars"></i> <?php echo  htmlspecialchars(@$singleton['label'] ? $singleton['label']:$singleton['name']) ; ?></a>

            <?php if ($app->module('singletons')->hasaccess($singleton['name'], 'edit')) { ?>
            <div class="uk-dropdown">
                <ul class="uk-nav uk-nav-dropdown">
                    <li class="uk-nav-header"><?php echo $app("i18n")->get('Actions'); ?></li>
                    <li><a href="<?php $app->route('/singletons/singleton/'.$singleton['name']); ?>"><?php echo $app("i18n")->get('Edit'); ?></a></li>
                </ul>
            </div>
            <?php } ?>

        </li>
    </ul>
</div>

<div class="uk-width-medium-1-2 uk-viewport-height-1-2 uk-container-center uk-flex uk-flex-center uk-flex-middle" riot-view>

    <div class="uk-animation-fade uk-width-1-1">

        <p class="uk-h2">
            <?php echo $app("i18n")->get('This singleton is already being edited.'); ?>
        </p>
        <div class="uk-panel-box uk-panel-card uk-margin-top">
            <strong class="uk-text-uppercase uk-text-small"><?php echo $app("i18n")->get('Current editor'); ?></strong>
            <div class="uk-margin-top uk-flex">
                <div>
                    <cp-gravatar size="30" alt="<?=($meta['user']['name'] ? $meta['user']['name'] : $meta['user']['user'])?>"></cp-gravatar>
                </div>
                <div class="uk-margin-left">
                    <span><?=($meta['user']['name'] ? $meta['user']['name'] : $meta['user']['user'])?></span><br />
                    <span class="uk-text-muted"><?=($meta['user']['email'])?></span>
                </div>
            </div>

            <?php echo $app->view('cockpit:views/_partials/unlock.php', ['resourceId' => $meta['rid']]); ?>
        </div>

    </div>

</div>
