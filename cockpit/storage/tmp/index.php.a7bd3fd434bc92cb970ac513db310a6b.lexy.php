<div>
    <ul class="uk-breadcrumb">
        <li><a href="<?php $app->route('/settings'); ?>"><?php echo $app("i18n")->get('Settings'); ?></a></li>
        <li class="uk-active"><span><?php echo $app("i18n")->get('Groups'); ?></span></li>
    </ul>
</div>

<div class="uk-margin-top" riot-view>

    <?php if ($app->module('cockpit')->isSuperAdmin()) { ?>
    <div class="uk-form uk-clearfix" show="{!loading}">

        <span class="uk-form-icon">
            <i class="uk-icon-filter"></i>
            <input type="text" class="uk-form-large uk-form-blank" ref="txtfilter" placeholder="<?php echo $app("i18n")->get('Filter by name...'); ?>" onchange="{ updatefilter }">
        </span>

        <!--<div class="uk-form-select">
            <span class="uk-button uk-button-outline uk-text-uppercase {(aclfilter != '_all' && 'uk-text-primary') || 'uk-text-muted'}">
                <i class="uk-icon-group"></i> {filterGroup == '_all' ? App.i18n.get('All') : filterGroup }
            </span>
            <select onchange="{ updatefilter }" ref="aclfilter">
                <option value="_all"><?php echo $app("i18n")->get('All'); ?></option>
                <option value="{acl}" each="{acl in acls}">{acl}</option>
            </select>
        </div>-->

        <div class="uk-float-right">
            <a class="uk-button uk-button-primary uk-button-large" href="<?php $app->route('/groups/create'); ?>">
                <i class="uk-icon-plus-circle uk-icon-justify"></i> <?php echo $app("i18n")->get('Group'); ?>
            </a>
        </div>

    </div>
    <?php } ?>

    <div class="uk-text-xlarge uk-text-center uk-text-primary uk-margin-large-top" show="{ loading }">
        <i class="uk-icon-spinner uk-icon-spin"></i>
    </div>

    <div class="uk-text-large uk-text-center uk-margin-large-top uk-text-muted" show="{ !loading && !groups.length }">
        <img class="uk-svg-adjust" src="<?php echo $app->pathToUrl('assets:app/media/icons/accounts.svg'); ?>" width="100" height="100" alt="<?php echo $app("i18n")->get('Accounts'); ?>" data-uk-svg />
        <p><?php echo $app("i18n")->get('No groups found'); ?></p>
    </div>

    <table class="uk-table uk-table-tabbed uk-table-striped uk-margin-top" if="{ ready && !loading && groups.length }">
        <thead>
            <tr>
                <th class="uk-text-small" data-sort="group">
                    <a class="uk-link-muted uk-noselect {sortedBy == 'group' && 'uk-text-primary'}">
                        <?php echo $app("i18n")->get('Name'); ?> <span if="{sortedBy == 'group'}" class="uk-icon-long-arrow-{ sortedOrder == -1 ? 'up':'down'}"></span>
                    </a>
                </th>
                <th class="uk-text-small" data-sort="admin">
                    <a class="uk-link-muted uk-noselect {sortedBy == 'admin' && 'uk-text-primary'}">
                        <?php echo $app("i18n")->get('Admin'); ?> <span if="{sortedBy == 'admin'}" class="uk-icon-long-arrow-{ sortedOrder == -1 ? 'up':'down'}"></span>
                    </a>
                </th>
                <th class="uk-text-small" data-sort="backend">
                    <a class="uk-link-muted uk-noselect {sortedBy == 'backend' && 'uk-text-primary'}">
                        <?php echo $app("i18n")->get('Backend'); ?> <span if="{sortedBy == 'backend'}" class="uk-icon-long-arrow-{ sortedOrder == -1 ? 'up':'down'}"></span>
                    </a>
                </th>
                <th class="uk-text-small" data-sort="finder">
                    <a class="uk-link-muted uk-noselect {sortedBy == 'finder' && 'uk-text-primary'}">
                        <?php echo $app("i18n")->get('Finder'); ?> <span if="{sortedBy == 'finder'}" class="uk-icon-long-arrow-{ sortedOrder == -1 ? 'up':'down'}"></span>
                    </a>
                </th>
                <th class="uk-text-small" data-sort="_created">
                    <a class="uk-link-muted uk-noselect {sortedBy == '_created' && 'uk-text-primary'}">
                        <?php echo $app("i18n")->get('Created'); ?> <span if="{sortedBy == '_created'}" class="uk-icon-long-arrow-{ sortedOrder == -1 ? 'up':'down'}"></span>
                    </a>
                </th>
                <th class="uk-text-small" data-sort="_modified">
                    <a class="uk-link-muted uk-noselect {sortedBy == '_modified' && 'uk-text-primary'}">
                        <?php echo $app("i18n")->get('Modified'); ?>  <span if="{sortedBy == '_modified'}" class="uk-icon-long-arrow-{ sortedOrder == -1 ? 'up':'down'}"></span>
                    </a>
                </th>
                <th width="20"></th>
            </tr>
        </thead>
        <tbody>
            <tr each="{group, $index in groups}" if="{ infilter(group) }">
                <td>
                    <a class="uk-link-muted" href="<?php $app->route('/groups/group'); ?>/{ group._id }" title="<?php echo $app("i18n")->get('Edit account'); ?>">
                        { group.group }
                    </a>
                </td>
                <td>
                   <!--
                   TODO JB: this is not working properly
                   -->
                    { group.admin ? "<?php echo $app("i18n")->get('Yes'); ?>" : "<?php echo $app("i18n")->get('No'); ?>" }
                </td>
                <td>
                    { group.cockpit.backend ? "<?php echo $app("i18n")->get('Yes'); ?>" : "<?php echo $app("i18n")->get('No'); ?>" }
                </td>
                <td>
                    { group.cockpit.finder ? "<?php echo $app("i18n")->get('Yes'); ?>" : "<?php echo $app("i18n")->get('No'); ?>" }
                </td>

                <td><span class="uk-badge uk-badge-outline uk-text-muted">{ App.Utils.dateformat( new Date( 1000 * group._created )) }</span></td>
                <td><span class="uk-badge uk-badge-outline uk-text-primary">{ App.Utils.dateformat( new Date( 1000 * group._modified )) }</span></td>
                <td>
                    <span data-uk-dropdown="pos:'bottom-right'">

                        <a class="uk-icon-bars"></a>

                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-nav-dropdown uk-dropdown-close">
                                <li class="uk-nav-header"><?php echo $app("i18n")->get('Actions'); ?></li>
                                <li><a href="<?php $app->route('/groups/group'); ?>/{ group._id }"><?php echo $app("i18n")->get('Edit'); ?></a></li>
                                <li class="uk-nav-item-danger"><a onclick="{ this.parent.remove }" href="#"><?php echo $app("i18n")->get('Delete'); ?></a></li>
                            </ul>
                        </div>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="uk-margin uk-flex uk-flex-middle" if="{ !loading && pages > 1 }">

        <ul class="uk-breadcrumb uk-margin-remove">
            <li class="uk-active"><span>{ page }</span></li>
            <li data-uk-dropdown="mode:'click'">

                <a><i class="uk-icon-bars"></i> { pages }</a>

                <div class="uk-dropdown">

                    <strong class="uk-text-small"><?php echo $app("i18n")->get('Pages'); ?></strong>

                    <div class="uk-margin-small-top { pages > 5 ? 'uk-scrollable-box':'' }">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li class="uk-text-small" each="{k,v in new Array(pages)}"><a class="uk-dropdown-close" onclick="{ parent.loadpage.bind(parent, v+1) }"><?php echo $app("i18n")->get('Page'); ?> {v + 1}</a></li>
                        </ul>
                    </div>
                </div>

            </li>
        </ul>

        <div class="uk-button-group uk-margin-small-left">
            <a class="uk-button uk-button-small" onclick="{ loadpage.bind(this, page-1) }" if="{page-1 > 0}"><?php echo $app("i18n")->get('Previous'); ?></a>
            <a class="uk-button uk-button-small" onclick="{ loadpage.bind(this, page+1) }" if="{page+1 <= pages}"><?php echo $app("i18n")->get('Next'); ?></a>
        </div>

    </div>
    
    <?php echo $app->view("groups:views/partials/github-footer.php"); ?>

    <script type="view/script">

        var $this = this, limit = 20;

        this.groups   = [];
        this.current  = <?php echo  json_encode($current) ; ?>;
        this.filter   = '';
        this.aclfilter = '_all'
        this.sort     = {'_created': -1};
        this.page     = 1;
        this.count    = 0;
        this.page     = 1;

        this.loading  = true;
        this.ready    = false;

        this.on('mount', function() {

            App.$(this.root).on('click', '[data-sort]', function() {
                $this.updatesort(this.getAttribute('data-sort'));
            });

            this.load();
        });

        remove(evt) {
            var group = evt.item.group;

            if (group._id == this.current) {
                App.ui.notify("You can't delete your own group", "danger");
                return;
            }

            App.ui.confirm("Are you sure?", function() {

                App.request('/groups/remove', { "group": group }).then(function(data){

                    App.ui.notify("Group removed", "success");
                    $this.groups.splice(evt.item.$index, 1);
                    $this.update();
                });
            });
        }

        updatefilter() {
            var load = this.filter ? true : false;

            this.filter = this.refs.txtfilter.value || null;
            this.aclfilter = this.refs.aclfilter.value || null;

            if (this.filter || this.aclfilter || load) {
            //if (this.filter || load) {
                this.groups = [];
                this.loading = true;
                this.page = 1;
                this.load();
            }
        }

        infilter(group) {
            var group = group.group.toLowerCase();
            return (!this.filter || (group && group.indexOf(this.filter) !== -1));
        }

        updatesort(field) {

            if (!field) {
                return;
            }

            var col = field;

            if (!this.sort[col]) {
                this.sort      = {};
                this.sort[col] = 1;
            } else {
                this.sort[col] = this.sort[col] == 1 ? -1 : 1;
            }

            this.sortedBy = field;
            this.sortedOrder = this.sort[col];

            this.accounts = [];

            this.load();
        }

        load() {

            var options = { sort:this.sort };

            if (this.filter || this.filterGroup) {
                options.filter = {};
            }

            /*
            if (this.filter) {
                options.filter.$or = [
                    {name  : {$regex : this.filter}},
                    {user  : {$regex : this.filter}},
                    {email : {$regex : this.filter}}
                ];
            }
            */

            /*
            if (this.filterGroup && this.filterGroup != '_all') {
                options.filter.group = this.filterGroup;
            }
            */

            options.limit = limit;
            options.skip  = (this.page - 1) * limit;

            this.loading = true;

            return App.request('/groups/find', {options:options}).then(function(data){

                this.groups   = data.groups;
                this.pages    = data.pages;
                this.page     = data.page;
                this.count    = data.count;

                this.ready    = true;
                this.loadmore = data.groups.length && data.groups.length == limit;

                this.loading = false;

                this.update();

            }.bind(this))
        }

        loadpage(page) {
            this.page = page > this.pages ? this.pages:page;
            this.load();
        }

    </script>

</div>
