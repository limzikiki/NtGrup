<?php if (isset($collection['color']) && $collection['color']) { ?>
<style>
    .app-header { border-top: 8px <?php echo  $collection['color'] ; ?> solid; }
    .revisions-box { height: auto; max-height: 45vh; }
</style>
<?php } ?>

<script>

  window.__revisions = <?php echo  json_encode($revisions) ; ?>;
  window.__collection = <?php echo  json_encode($collection) ; ?>;
  window.__entry = <?php echo  json_encode($entry) ; ?>;

</script>

<div>
    <ul class="uk-breadcrumb">
        <li><a href="<?php $app->route('/collections'); ?>"><?php echo $app("i18n")->get('Collections'); ?></a></li>
        <li data-uk-dropdown="mode:'hover', delay:300">
            <a href="<?php $app->route('/collections/entries/'.$collection['name']); ?>"><i class="uk-icon-bars"></i> <?php echo  htmlspecialchars(@$collection['label'] ? $collection['label']:$collection['name']) ; ?></a>

            <?php if ($app->module('collections')->hasaccess($collection['name'], 'collection_edit')) { ?>
            <div class="uk-dropdown">
                <ul class="uk-nav uk-nav-dropdown">
                    <li class="uk-nav-header"><?php echo $app("i18n")->get('Actions'); ?></li>
                    <li><a href="<?php $app->route('/collections/collection/'.$collection['name']); ?>"><?php echo $app("i18n")->get('Edit'); ?></a></li>
                    <?php if ($app->module('collections')->hasaccess($collection['name'], 'entries_delete')) { ?>
                    <li class="uk-nav-divider"></li>
                    <li><a href="<?php $app->route('/collections/trash/collection/'.$collection['name']); ?>"><?php echo $app("i18n")->get('Trash'); ?></a></li>
                    <?php } ?>
                    <li class="uk-nav-divider"></li>
                    <li class="uk-text-truncate"><a href="<?php $app->route('/collections/export/'.$collection['name']); ?>" download="<?php echo  $collection['name'] ; ?>.collection.json"><?php echo $app("i18n")->get('Export entries'); ?></a></li>
                    <li class="uk-text-truncate"><a href="<?php $app->route('/collections/import/collection/'.$collection['name']); ?>"><?php echo $app("i18n")->get('Import entries'); ?></a></li>
                </ul>
            </div>
            <?php } ?>
        </li>
        <li><a href="<?php $app->route("/collections/entry/{$collection['name']}/{$entry['_id']}"); ?>"><?php echo $app("i18n")->get('Entry'); ?></a></li>
    </ul>
</div>


<div class="uk-margin-top-large" riot-view>

    <div class="uk-width-medium-1-3 uk-viewport-height-1-2 uk-container-center uk-text-center uk-flex uk-flex-center uk-flex-middle" if="{!revisions.length}">
        <div class="uk-text-muted uk-width-1-1">
            <img class="uk-svg-adjust" src="<?php echo $app->pathToUrl('assets:app/media/icons/revisions.svg'); ?>" width="150" alt="icon" data-uk-svg>
            <div class="uk-h2 uk-margin"><?php echo $app("i18n")->get('No revisions available'); ?></div>
            <div class="uk-margin-large">
                <a class="uk-button uk-button-large uk-button-link" href="<?php $app->route("/collections/entry/{$collection['name']}/{$entry['_id']}"); ?>"><?php echo $app("i18n")->get('Back to entry'); ?></a>
            </div>
        </div>
    </div>

    <div class="uk-grid" if="{revisions.length}">
        <div class="uk-width-4-5">

            <div class="uk-text-muted uk-width-medium-1-3 uk-viewport-height-1-3 uk-container-center uk-text-center uk-flex uk-flex-center uk-flex-middle" if="{!active}">
                <div>
                    <img class="uk-svg-adjust" src="<?php echo $app->pathToUrl('assets:app/media/icons/revisions.svg'); ?>" width="150" alt="icon" data-uk-svg>
                    <div class="uk-h2 uk-margin uk-text-center"><?php echo $app("i18n")->get('Please select a revision'); ?></div>
                </div>
            </div>

            <div if="{active}">

                <div class="uk-panel uk-panel-box uk-panel-card">
                    <div class="uk-flex uk-flex-middle">
                        <div class="uk-flex-item-1 uk-text-small">
                            <strong>{ App.Utils.dateformat(active._created*1000, 'MMMM Do YYYY @ hh:mm:ss a') }</strong>
                            <div class="uk-margin-small-top"><cp-account account="{active._creator}"></cp-account></div>
                        </div>
                        <div>
                            <button onclick="{ restoreActive }" class="uk-button uk-button-large uk-button-danger" show="{ hasDiffs() }">
                                <?php echo $app("i18n")->get('Restore to this version'); ?>
                            </button>

                            <a class="uk-margin-left uk-button uk-button-large uk-button-link" href="<?php $app->route("/collections/entry/{$collection['name']}/{$entry['_id']}"); ?>"><?php echo $app("i18n")->get('Back to entry'); ?></a>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-large">

                    <div class="uk-text-muted uk-width-medium-1-3 uk-viewport-height-1-3 uk-container-center uk-text-center uk-flex uk-flex-center uk-flex-middle" show="{ !hasDiffs() }">

                        <div>
                            <img class="uk-svg-adjust" src="<?php echo $app->pathToUrl('assets:app/media/icons/revisions.svg'); ?>" width="150" alt="icon" data-uk-svg>
                            <div class="uk-h2 uk-margin uk-text-center"><?php echo $app("i18n")->get('No changes'); ?></div>
                        </div>
                    </div>

                    <div if="{ hasDiffs() }">

                        <div class="uk-margin uk-flex uk-flex-middle">
                            <div class="uk-h3 uk-flex-item-1"><?php echo $app("i18n")->get('Changes'); ?></div>
                            <div class="uk-margin-left">
                                <field-boolean bind="showOnlyChanged" label="<?php echo $app("i18n")->get('Show only changed fields'); ?>"></field-boolean>
                            </div>
                        </div>

                        <div class="uk-panel uk-margin" each="{value,key in active.data}" if="{['_id','_modified','_created','_by'].indexOf(key) < 0 && (showOnlyChanged ? JSON.stringify(value) !== JSON.stringify(current[key]) : true)}">

                            <div class="uk-margin uk-panel uk-panel-box uk-panel-card">

                                <div class="uk-margin uk-grid uk-flex-middle">
                                    <div class="uk-flex-item-1"><span class="uk-badge uk-badge-outline uk-badge-primary">{ key }</span></div>
                                    <div show="{JSON.stringify(value) !== JSON.stringify(current[key])}"><a onclick="{restoreValue}" title="<?php echo $app("i18n")->get('Restore value'); ?>" data-uk-tooltip><i class="uk-icon-refresh"></i></a></div>
                                </div>

                                <div>
                                    <cp-diff class="uk-display-block" oldtxt="{ value }" newtxt="{ parent.current[key] || '' }"></cp-diff>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="uk-width-1-5">

            <h3 class="uk-text-bold uk-flex">
                <span class="uk-flex-item-1"><?php echo $app("i18n")->get('Revisions'); ?></span>
                <a class="uk-button uk-button-link uk-button-small" onclick="{removeAll}"><?php echo $app("i18n")->get('Delete all'); ?></a>
            </h3>

            <div class="uk-margin revisions-box { revisions.length > 10 && 'uk-scrollable-box'}">
                <ul class="uk-nav">
                    <li class="uk-margin-small-bottom {rev == active && 'uk-active uk-text-large'}" each="{rev,idx in revisions}">
                        <hr show="{rev==active}">
                        <div class="uk-flex">
                            <a class="uk-flex-item-1 uk-margin-small-right {rev !== active && 'uk-text-muted'}" onclick="{ parent.selectRevision }">
                                { App.Utils.dateformat(rev._created*1000, 'MMMM Do YYYY') }<br>
                                <span class="uk-text-small">{ App.Utils.dateformat(rev._created*1000, 'hh:mm:ss a') }</span>
                            </a>
                            <a show="{rev==active}" onclick="{remove}"><i class="uk-icon-button uk-icon-button-danger uk-icon-trash-o"></i></a>
                        </div>
                        <hr show="{rev==active}">
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <script type="view/script">

        this.mixin(RiotBindMixin);

        var $this = this;

        this.collection = window.__collection;
        this.revisions  = window.__revisions;
        this.current    = window.__entry;

        this.showOnlyChanged = true;

        selectRevision(e) {

            this.active = e.item.rev;
        }

        hasDiffs() {

            if (!this.active) {
                return;
            }

            for (var k in this.active.data) {

                if (['_id','_modified','_created','_by'].indexOf(k) > -1) continue;

                if (JSON.stringify(this.active.data[k]) != JSON.stringify(this.current[k])) {
                    return true;
                }
            }

            return false;
        }

        restoreValue(e) {

            App.ui.confirm("Are you sure?", function() {

                $this.current[e.item.key] = e.item.value;
                $this.update();

                $this.save("Value restored");
            });
        }

        restoreActive() {

            if (!this.active) {
                return;
            }

            App.ui.confirm("Are you sure?", function() {

                $this.current = _.extend($this.current, $this.active.data);
                $this.update();

                $this.save("Entry restored");
            });
        }

        removeAll() {

            App.ui.confirm('Are you sure?', function() {

                App.request('/cockpit/utils/revisionsRemoveAll', {oid:$this.revisions[0]._oid}).then(function(){
                    $this.revisions = [];
                    $this.update();
                });
            });
        }

        remove(e) {

            var idx = e.item.idx;

            App.ui.confirm('Are you sure?', function() {

                App.request('/cockpit/utils/revisionsRemove', {rid:$this.active._id}).then(function(){
                    $this.active = null;
                    $this.revisions.splice(idx, 1);
                    $this.update();
                });
            });
        }

        save(message) {

            App.request('/collections/save_entry/'+this.collection.name, {entry:this.current}).then(function(entry) {

                if (entry) {
                    App.ui.notify(message, "success");
                } else {
                    App.ui.notify("Restoring failed.", "danger");
                }
            }, function(res) {
                App.ui.notify(res && res.message ? res.message : "Restoring failed.", "danger");
            });
        }

    </script>

</div>
